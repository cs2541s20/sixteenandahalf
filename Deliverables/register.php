<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
else if($_SESSION['viewtype'] != "student" && $_SESSION['viewtype'] != 'faculty'){
	header('Location: index.php');
}
require_once('connectvars.php');


$user_id = $_SESSION['uid'];



require_once("navbar.php");
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 



//$sql = "INSERT INTO enrollemnt VALUES ('$user_id', )";
//if($dbc->query($sql) === TRUE){
 echo $name . " Course Added" ;
//}

?>
<html>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Course Register</legend>
      <label for="CRN">CRN:</label>
      <input type="text" name="CRN" />
    </fieldset>
    <input type="submit" value="Log In" name="submit" />
  </form>
  </html>