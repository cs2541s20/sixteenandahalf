<?php

/*testing variables: TODO delete later
 *
 */

session_start();
if(!isset($_SESSION['viewtype'])){
	header('Location: login.php');
}
require_once("navbar.php");
?>
<html><H2>Welcome to Banweb 2.0 </H2></html>

<body onload="navbar();">

</body>
