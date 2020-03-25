<?php

session_start();
if(!isset($_SESSION['viewtype'])){
	header('Location: login.php');
}
require_once("connectvars.php");
if(isset($_POST['reset'])){
	echo "reseting";
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$commands = file_get_contents("databasesProject.sql");
	$this->$dbc->multi_query($commands);
}	

require_once("navbar.php");
?>
<html><H2>Welcome to Banweb 2.0 </H2></html>

<body onload="navbar();">

<form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<input type = "submit", value = "RESET", name = "reset"/>
</form>
</body>
