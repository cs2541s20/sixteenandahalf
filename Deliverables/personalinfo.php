<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
require_once("navbar.php");

?>

<body onload="navbar();">

</body>
