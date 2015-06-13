<?php
	require 'vendor/autoload.php';

	$app = new \Slim\Slim();
	$app->view(new \JsonApiView());
	$app->add(new \JsonApiMiddleware());

	//include routes
	include_once('routes/category.php');
	include_once('routes/event.php');
	include_once('routes/user.php');

	$app->run();
?>
