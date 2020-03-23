<?php
session_start();
if(!isset($_SESSION['viewtype'])){
	echo "would be sending to login";
	//header('Location: login.php');
}

else{
	$_SESSION['viewuid'] = $_SESSION['uid'];
	$_SESSION['viewtype'] = $_SESSION['type'];
	header('Location: index.php');
}
