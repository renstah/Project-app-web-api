<?php
	$app->get('/user/create', function() use ($app) {
		$app->render(200 ,array(
			'msg' => 'user created'
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
