<?php
	$app->post('/event/create', function() use ($app) {
		require 'database.php';

		//get JSON body
		$user = json_decode($app->request->getBody());


		$app->render(200 ,array(
			'msg' => $events,
		));
	});

	$app->get('/event/:id', function($id) use ($app) {
		require 'database.php';
		$escapedId = $con->real_escape_string($id);
		$query = "SELECT * FROM event WHERE EventID = $escapedId LIMIT 1;";
		$result = $con->query($query);
		if ($con->error)
			throw new Exception($con->error, 1);
		$event = $result->fetch_object();
		$app->render(200 ,array(
			'event' => $event
		));
	})->name('event');

	// $app->get('/event/delete/:id', function($id) use ($app) {
	// 	$app->render(200 ,array(
	// 		'msg' => 'deleted event ' . $id
	// 	));
	// });

	$app->get('/events/', function() use ($app) {
		require 'database.php';

		$query = "SELECT * FROM event";
		$result = $con->query($query);
		if ($con->error)
			throw new Exception($con->error, 1);
		$events = array();
		while($event = $result->fetch_object()){
			array_push($events, $event);
		}
		$app->render(200 ,array(
			'events' => $events
		));
	})->name('events');
