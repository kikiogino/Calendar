<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
header("content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
// $token = $json_obj['token'];
$event_id = htmlentities($json_obj['event_id']);

// if(!hash_equals($_SESSION['token'], $token)){
// 	die("Request forgery detected");
// }

if(!isset($_SESSION['token'])){
	die("Request forgery detected");
}

if($event_id !==0){
$delete_event = $mysqli->prepare("delete from events where event_id=?");
        if(!$delete_event){
            printf("Failed: %s \n", $mysqli->error);
            echo json_encode(array(
                "success" => false,
                "message" => "failed"
            ));
            exit;
        }
        $delete_event-> bind_param('s',$event_id);
        
            $delete_event->execute();
          $delete_event->close();

            echo json_encode(array(
                "success" => true,
                "message" => "worked"
            ));
            exit;
        }  
        echo json_encode(array(
            "success" => false,
            "message" => "failed"
        ));
        exit;    
?>