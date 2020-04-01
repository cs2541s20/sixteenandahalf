
<?php

$filename = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if($filename == 'connectvars.php'){
	if(isset($_SESSION['uid'])){
		header('Location: index.php');
	}
	else{
		header('Location: login.php');
	}
}

  // Define database connection constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'sixteenandahalf'); //replace this
  define('DB_PASSWORD', 'Sixteen.5'); //edit this
  define('DB_NAME', 'sixteenandahalf'); //edit this
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
?>
