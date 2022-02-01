<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
header("content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);
//Variables can be accessed as such:

$title = $json_obj['title'];
$date = $json_obj['date']; 
$time = $json_obj['time'];
$location = $json_obj['location'];
$description = $json_obj['description'];

$new_event = $mysqli->prepare("select event_id, title, date, time, location, description from events where owner=?");
        if(!$new_event){
            printf("Failed: %s \n", $mysqli->error);
            echo json_encode(array(
                "success" => false,
                "message" => "failure"
            ));
            exit;
        }
        $user_id = $_SESSION['user_id'];
        $new_event-> bind_param('s',$user_id);
        
            $new_event->execute();
            $new_event -> bind_result($event_id,$title, $date, $time, $location, $description);
 
            $total_events = [];
            while ($new_event->fetch()){
                //https://www.php.net/manual/en/function.array-push.php
                array_push($total_events, array(
              "event_id" => htmlentities($event_id),
              "title" => htmlentities($title),
              "date" => htmlentities($date),
              "time" => htmlentities($time),
              "location" => htmlentities($location),
              "description" => htmlentities($description)
                ));
            }

            echo json_encode(array(
                "success" => true,
                "events" => $total_events
            ));
            exit;
        
?>