<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
header("content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);
//Variables can be accessed as such:


$title = htmlentities($json_obj['title']);
$date = htmlentities($json_obj['date']);
$time = htmlentities($json_obj['time']);
$description = htmlentities($json_obj['description']);
$location = htmlentities($json_obj['location']);
$event_id = htmlentities($json_obj['event_id']);
$share_username = htmlentities($json_obj['share_username']);

$share_user_id =0;

    $stmt = $mysqli->prepare("select user_id from users where username=?");

	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		echo json_encode(array(
			"success" => false,
			"message" => "Incorrect Username or Password",
		));
		exit;
	}
	

	$stmt->bind_param('s', $share_username);
	$stmt->execute();

	$stmt->bind_result($user_id);
    
    while ($stmt->fetch()) {
        $share_user_id = htmlentities($user_id);
    }


$share_event = $mysqli->prepare("insert into shared (event_id, owner, user, title, date, time, location, description) values (?,?,?,?,?,?,?,?) ");
        if(!$share_event){
            printf("Failed: %s \n", $mysqli->error);
            echo json_encode(array(
                "success" => false,
                "message" => "failure"
            ));
            exit;
        }
        $user_id = $_SESSION['user_id'];
        $share_event->bind_param('sissssss', $event_id, $user_id, $share_user_id, $title, $date, $time, $location, $description);
        
            $share_event->execute();
 
            $share_event->close();

            echo json_encode(array(
                "success" => true,
                "message" => "success"
            ));
            exit;

        
?>