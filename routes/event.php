<?php
	$app->post('/event/create', function() use ($app) {
		require 'database.php';

		//get JSON body
		$event = json_decode($app->request->getBody());

		$Date_Start = new DateTime($event->Date_Start);
		$Date_End = new DateTime($event->Date_End);

		$query = "INSERT INTO event (Name, Date_Start, Date_End, Latitude, Longitude, Age_Min, Age_Max, CreatorID, CategoryID, GenderID) VALUES ('$event->Name', '". $Date_Start->format('Y-m-d H:i') ."', '".$Date_End->format('Y-m-d H:i')."', '$event->Latitude', '$event->Longitude', '$event->Age_Min', '$event->Age_Max', '". $app->user->UserID."', '$event->CategoryID', 3)";
		$con->query($query);
		if ($con->error)
			throw new Exception($con->error, 1);
		$query = "SELECT * FROM event WHERE CreatorID = '" .$app->user->UserID."' ORDER BY Created_DateTime DESC LIMIT 1;";
		$result = $con->query($query);
		$result = $result->fetch_object();


		$app->render(200 ,array(
			'event' => $result
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
