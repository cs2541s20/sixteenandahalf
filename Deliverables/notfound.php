<?php
session_start();

if(isset($_SESSION['uid'])){
	header('Location: index.php');
}
else{
	header('Location: login.php');
}

?>

