<?php

require 'database.php';
ini_set("session.cookie_httponly", 1);
session_start();
header("content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

$get_id = $mysqli->prepare("select owner from shared_calendar where user=?");
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
    $get_id -> bind_result($owner);

    $owners = [];
    while ($get_id->fetch()) {
        array_push($owners, array(
            "owner" => htmlentities($owner)
        ));
    }
    $get_id->close();


$new_event = $mysqli->prepare("select event_id, title, date, time, location, description from events where owner=?");
if(!$new_event){
    printf("Failed: %s \n", $mysqli->error);
    echo json_encode(array(
        "success" => false,
        "message" => "failure"
    ));
    exit;
}
$list = [];
foreach ($owners as $each){
$new_event-> bind_param('s',$each['owner']);

    $new_event->execute();
    $new_event -> bind_result($event_id,$title, $date, $time, $location, $description);

    
    while ($new_event->fetch()){
        //https://www.php.net/manual/en/function.array-push.php
        array_push($list, array(
      "event_id" => htmlentities($event_id),
      "title" => htmlentities($title),
      "date" => htmlentities($date),
      "time" => htmlentities($time),
      "location" => htmlentities($location),
      "description" => htmlentities($description)
        ));
    }
}
            echo json_encode(array(
                "success" => true,
                "events" => $list
            ));
            exit;
        
?>