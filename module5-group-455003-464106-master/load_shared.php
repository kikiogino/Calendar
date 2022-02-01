<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
header("content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json



$get_id = $mysqli->prepare("select event_id, owner, title, date, time, location, description from shared where user=?");
if(!$get_id){
    printf("Failed: %s \n", $mysqli->error);
    echo json_encode(array(
        "success" => false,
        "message" => "failuhhhre"
    ));
    exit;
}
$user_id = $_SESSION['user_id'];
$get_id-> bind_param('s',$user_id);

    $get_id->execute();
    $get_id -> bind_result($event_id, $owner, $title, $date, $time, $location, $description);

    $each_event = [];
    while ($get_id->fetch()) {
        array_push($each_event, array(
            "owner" => htmlentities($owner),
            "event_id" => htmlentities($event_id), 
            "title" => htmlentities($title),
            "date" => htmlentities($date),
            "time" => htmlentities($time),
            "location" => htmlentities($location),
            "description" => htmlentities($description)
        ));
    }
    $get_id->close();

            echo json_encode(array(
                "success" => true,
                "events" => $each_event
            ));
            exit;
        
?>