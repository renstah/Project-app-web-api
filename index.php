<?php
	require 'vendor/autoload.php';
		
	$app = new \Slim\Slim();
	$app->view(new \JsonApiView());
	$app->add(new \JsonApiMiddleware());

	//include all routes
	foreach (glob('Routes/*.php') as $filename)
	{
		include_once $filename;
	}
	
	$app->run();
?>