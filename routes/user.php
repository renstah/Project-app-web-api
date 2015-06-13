<?php
	$app->post('/user/create', function() use ($app) {
		require 'database.php';
		// $json = $app->request->getBody();
		//
		// $user = json_decode($json);

		$user = json_decode($app->request->getBody());

		//select existing
		$query = "SELECT * FROM user WHERE Social_Token = $user->Social_Token LIMIT 1;";
		$result = $con->query($query);
		if ($con->error)
			throw new Exception($con->error, 1);
		$result = $result->fetch_object();

		//insert new user
		if ($result == null)
		{
			$query = "INSERT INTO user (Name, Social_Token, GenderID) VALUES ('$user->Name', $user->Social_Token, $user->Gender)";
			$con->query($query);
			if ($con->error)
				throw new Exception($con->error, 1);
			$query = "SELECT * FROM user WHERE Social_Token = $user->Social_Token LIMIT 1;";
			$result = $con->query($query);
			$result = $result->fetch_object();

		}

		$app->render(200 ,array(
			'msg' => $result
		));
	});

	$app->get('/user/:id', function($id) use ($app) {
		require 'database.php';
		$escapedId = $con->real_escape_string($id);

		//Return user
		$query = "SELECT * FROM user WHERE UserID = $escapedId LIMIT 1;";
		$result = $con->query($query);
		if ($con->error)
			throw new Exception($con->error, 1);
		$user = $result->fetch_object();
		$app->render(200 ,array(
			'user' => $user
		));
	});
