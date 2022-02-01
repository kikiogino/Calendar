<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);
//Variables can be accessed as such:

$title = $json_obj['title'];
$date = $json_obj['date']; 
$time = $json_obj['time'];
$location = $json_obj['location'];
$description = $json_obj['description'];

if(!isset($_SESSION['token'])){
	die("Request forgery detected");
}

// if(isset($title) && isset($date) && isset($time) && isset($location) && isset($description)) {
$new_event = $mysqli->prepare("insert into events (title, date, time, owner, location, description) values (?,?,?,?,?,?) ");
        if(!$new_event){
            echo json_encode(array(
                "success" => false,
                "message" => "failure"
            ));
            exit;
        }
        $user_id = $_SESSION['user_id'];
        $new_event->bind_param('sssiss', $title, $date, $time, $user_id, $location, $description);

            echo json_encode(array(
                "success" => true,
                "message" => "success"
          ));
          $new_event->execute();
          $new_event->close();
            exit;


        
?>