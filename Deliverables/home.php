<?php

if(!isset($_SESSION['viewtype'])){
	header('Location: login.php');
}

else{
	$_SESSION['viewas'] = $_SESSION['uid'];
	header('Location: index.php');
}
