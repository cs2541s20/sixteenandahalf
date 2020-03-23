<?php
session_start();
if(!isset($_SESSION['viewtype'])){
	header('Location: login.php');
}

else{
	$_SESSION['viewuid'] = $_SESSION['uid'];
	$_SESSION['viewtype'] = $_SESSION['type'];
	header('Location: index.php');
}
