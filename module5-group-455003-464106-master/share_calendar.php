<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
header("content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);
//Variables can be accessed as such:

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

$share_event = $mysqli->prepare("insert into shared_calendar (owner, user) values (?,?) ");
        if(!$share_event){
            printf("Failed: %s \n", $mysqli->error);
            echo json_encode(array(
                "success" => false,
                "message" => "failure"
            ));
            exit;
        }
        $user_id = $_SESSION['user_id'];
        $share_event->bind_param('ss', $user_id, $share_user_id);
        
            $share_event->execute();
 


            echo json_encode(array(
                "success" => true,
                "message" => "success",
                "shared_with" => htmlentities($share_username)
            ));
            exit;
            $share_event->close();

        
?>