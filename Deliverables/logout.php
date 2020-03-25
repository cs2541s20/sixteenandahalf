<?php
session_start();  

if(isset($_SESSION['uid'])) {
	$_SESSION = array();
	session_destroy();
} 


header('Location: login.php'); 


?>
