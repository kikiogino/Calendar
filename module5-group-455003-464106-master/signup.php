<?php
require 'database.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$first_name = htmlentities($json_obj['firstname']);
$last_name = htmlentities($json_obj['lastname']);
$username = htmlentities($json_obj['username']);
$password = htmlentities($json_obj['password']);


if( !preg_match('/^[\w_\.\-]+$/', $username) ){
    echo json_encode(array(
        "success" => false,
        "message" => "Invalid Username"
    ));
    exit;
}
if(isset($first_name) && isset($last_name) &&isset($username) && isset($password) && $password !== "" && $username !== "" && $first_name !== "" && $last_name !== "") {


$new_user = $mysqli->prepare("insert into users (first_name, last_name, username,pwd) values (?,?,?,?)");
        if(!$new_user){
            printf("Failed: %s \n", $mysqli->error);
            echo json_encode(array(
                "success" => false,
                "message" => "Incorrect Username or Password"
            ));
            exit; 
        }
        $pwd_hash = password_hash($password, PASSWORD_DEFAULT);

        $new_user->bind_param('ssss', $first_name, $last_name, $username, $pwd_hash);

            $new_user->execute();
 
            $new_user->close();

            echo json_encode(array(
                "success" => true,
                "message" => "success"
            ));
            exit;
        }

        echo json_encode(array(
            "success" => false,
            "message" => "Incorrect Username or Password"
        ));
        exit;

    
?>