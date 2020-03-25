//start the index page
<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
else if($_SESSION['type'] != 'faculty'){
	header('Location: index.php');
}

require_once('connectvars.php');
require_once("navbar.php");
$user_id = $_SESSION['uid'];
?>




<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CHange Grades</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Change Grade</h2>

  <p>Change Grade:</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <label for="firstname">First name:</label>
    <input type="text" name="firstname" /><br />
   

    <label for="lastname">Last name:</label>
    <input type="text" name="lastname" /><br />
    <label for="email">What is your email address?</label>
    <input type="text" name="email" /><br />
    
    
    <label for="type of user">What type of user?</label>
    <input type="text" name="type of user" /><br />

    <label for="userrID">Enter userID:</label>
    <input type="text" name="userID" size="32" /><br />


    

    <input type="submit" value="Change Grade" name="Change Grade" /><br/><br/>
  </form>
</body>
</html>

<body onload="navbar();">

</body>
