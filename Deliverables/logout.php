<?php
  // TODO: start session
session_start();  

  // TODO: If the user is logged in, delete the session vars to log them out
if(isset($_SESSION['user_id'])) {
	$_SESSION = array();
	session_destroy();
} 

  // TODO: Redirect to the login page


$home_url = 'http://' . $_SERVER["HTTP_HOST"] .
dirname($_SERVER["PHP_SELF"]) . '/login.php';

header('Location:'  . $home_url); 


?>
