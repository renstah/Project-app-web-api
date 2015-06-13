<?php
	$app->post('/user/create', function() use ($app) {
		require 'database.php';
		// $json = $app->request->getBody();
		//
		// $user = json_decode($json);

		$user = json_decode($app->request->getBody());

		$query = "INSERT INTO user (Name, Social_Token, GenderID) VALUES ('$user->Name', $user->Social_Token, $user->Gender);";
		$result = $con->query($query);
		if ($con->error)
			throw new Exception($con->error, 1);

		$app->render(200 ,array(
			'msg' => $result
		));
	});

	$app->get('/user/:id', function($id) use ($app) {
		require 'database.php';
		$escapedId = $con->real_escape_string($id);
		$query = "SELECT * FROM user WHERE UserID = $escapedId LIMIT 1;";
		$result = $con->query($query);
		if ($con->error)
			throw new Exception($con->error, 1);
		$user = $result->fetch_object();
		$app->render(200 ,array(
			'user' => $user
		));
	});
