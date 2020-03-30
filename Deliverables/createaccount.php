//start the index page
<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
else if($_SESSION['type'] != 'admin'){
	header('Location: index.php');
}

require_once('connectvars.php');
require_once("navbar.php");
$user_id = $_SESSION['viewuid'];
?>


<?php 

if(isset($_POST['firstname'])){

$firstname = $_POST['firstname'];
if(preg_match("/^[A-Z][a-zA-Z -]+$/", $_POST["firstname"]) === 0) {
$errName = '<p class="errText">Name must be from letters, dashes, spaces and must not start with dash</p>';
echo 'Name must be from letters, dashes, spaces and must not start with dash <br/>';
}
}
?>


<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(isset($_POST['Create Account'])){
	$user_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	$first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
        $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
        $pass_word = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $type_of_user = mysqli_real_escape_string($dbc, trim($_POST['type of user']));
	$user_ID = mysqli_real_escape_string($dbc, trim($_POST['userID']));
        $add_ress = mysqli_real_escape_string($dbc, trim($_POST['address']));
      if($row = mysqli_fetch_array($data) == true){
      $sql = "INSERT INTO enrollment VALUES ('$user_ID', '$add_ress', '$firstname', '$lastname', '$password', '$email','$type_of_user')";
      if($dbc->query($sql) === TRUE){
        echo  'Account Created' ;
      }
      else{
        echo 'Failed to Create Account';
      }
      if(!$user_email){
        echo 'No Results';
      }
    }
    else{
      echo 'Failed to Create Account';
    }
  }



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Create an Account!</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Create Account</h2>

  <p>Create an Account:</p>
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

    <label for="password">Enter password?</label>
    <input type="text" name="password" size="32" /><br />

    <label for="address">Enter Address?</label>
    <input type="text" name="address" size="32" /><br />

    <input type="submit" value="Create Account" name="Create Account" /><br/><br/>
  </form>
</body>
</html>

<body onload="navbar();">

</body>
