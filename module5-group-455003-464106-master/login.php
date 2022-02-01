<?php
// login_ajax.php
require 'database.php';
ini_set("session.cookie_httponly", 1);

header("content-type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$username = $json_obj['username'];
$password = $json_obj['password'];

//This is equivalent to what you previously did with $_POST['username'] and $_POST['password']

// Check to see if the username and password are valid.  (You learned how to do this in Module 3.)

if(isset($username) && isset($password) && $username !== "" && $password !== ""){

	$stmt = $mysqli->prepare("select user_id, pwd from users where username=?");

	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		echo json_encode(array(
			"success" => false,
			"message" => "Incorrect Username or Password",
		));
		exit;
	}
	

	$stmt->bind_param('s', $username);
	$stmt->execute();

	$stmt->bind_result($user_id, $password_hash);
	$stmt->fetch();
	// exit;
	if(password_verify((String)$password, $password_hash)){
		session_start();
		ini_set("session.cookie_httponly", 1);
		$_SESSION['username'] = $username;
		$_SESSION["user_id"] = $user_id;
		$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32)); 
		echo json_encode(array(
			"success" => true,
			"message" => "success",
			"token" => $_SESSION['token'],
			"username" => $username
		));
		$stmt->close();
		exit;
	}
else{
	echo json_encode(array(
		"success" => false,
		"message" => "Incorrect Username or Password"
	));
	exit;
}
}

?>
