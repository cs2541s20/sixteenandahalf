<?php

session_start();
if(!isset($_SESSION['viewtype'])){
	header('Location: login.php');
}

if(isset($_POST['reset'])){
	echo "reseting";
	


}
require_once("navbar.php");
?>
<html><H2>Welcome to Banweb 2.0 </H2></html>

<body onload="navbar();">

<form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<input type = "submit", value = "RESET", name = "reset"/>

</body>
