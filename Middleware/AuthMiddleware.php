<?php

class AuthMiddleware extends \Slim\Middleware
{

    protected $con;

    public function __construct($mysql) {
        $this->con = $mysql;
    }

    public function call()
    {
        $this->app->hook('slim.before.dispatch', array($this, 'onBeforeDispatch'));

        $this->next->call();
    }

    public function onBeforeDispatch()
    {
        $route = $this->app->router()->getCurrentRoute()->getPattern();
        // Get authentication stuff
        $token = $this->app->request->headers->get('X-API-TOKEN');
        $userID = $this->app->request->headers->get('X-API-CLIENT-ID');

        if ($this->is_route_protected($route) && !$this->user_has_permission($token, $userID))
        {
          $this->app->render(401 ,array(
            'user' => 'You shall not pass!',
            'error' => true
          ));
        }
    }

    private function is_route_protected($route) {
      return $route != "/user/create";
    }

    private function user_has_permission($token, $userID) {
      // escape strings
      $token = $this->con->real_escape_string($token);
      $userID = $this->con->real_escape_string($userID);

      // query user
      $query = "SELECT * FROM user WHERE UserID ='" . $userID . "' AND Api_Token ='" . $token . "' LIMIT 1;";
  		$result = $this->con->query($query);
  		if ($this->con->error)
  			throw new Exception($this->con->error, 1);

      if ($result->num_rows > 0) {
        // make user available in app
        $this->app->user = $result->fetch_object();
        return true;
      }
      else
      {
        return false;
      }
    }
}
