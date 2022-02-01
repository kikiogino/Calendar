<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
header("content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);
//Variables can be accessed as such:
$event_id = $json_obj['event_id'];
$title = $json_obj['title'];
$date = $json_obj['date']; 
$time = $json_obj['time'];
$location = $json_obj['location'];
$description = $json_obj['description'];
// $token = $json_obj['token'];

// if(!hash_equals($_SESSION['token'], $token)){
// 	die("Request forgery detected");
// }

if(!isset($_SESSION['token'])){
	die("Request forgery detected");
}

$new_event = $mysqli->prepare("update events set title=?, date=?, time=?, location=?, description=? where event_id=?");
        if(!$new_event){
            printf("Failed: %s \n", $mysqli->error);
            echo json_encode(array(
                "success" => false,
                "message" => "failure"
            ));
            exit;
        }
        $new_event-> bind_param('ssssss',$title, $date, $time, $location, $description, $event_id);
        
            $new_event->execute();
          
            echo json_encode(array(
                "success" => true,
                "message" => "worked"
            ));
            exit;
        
?>