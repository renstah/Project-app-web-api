<?php
	require 'vendor/autoload.php';
	require_once('Middleware/AuthMiddleware.php');
	require 'database.php';

	$app = new \Slim\Slim();
	$app->view(new \JsonApiView());
	$app->add(new \JsonApiMiddleware());
	$app->add(new \AuthMiddleware($con));

	// include routes
	include_once('routes/category.php');
	include_once('routes/event.php');
	include_once('routes/user.php');

	$app->run();
?>
