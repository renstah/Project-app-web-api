<?php

    $app->get('/categories/', function() use ($app) {
        require 'database.php';
        $query = "SELECT * FROM category";
        $result = $con->query($query);
        if ($con->error)
            throw new Exception($con->error, 1);
        $categories = array();
        while($category = $result->fetch_object()){
            array_push($categories, $category);
        }
        $app->render(200 ,array(
            'categories' => $categories
        ));
    });
