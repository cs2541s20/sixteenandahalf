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

if(isset($_POST['Create_Account'])){
      
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
    echo "connection refused";
  }


  $errVal = "";
  $user_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
  if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
    $errVal = '1';
    echo '<p class="errText">Invalid Email Address Entered</p>';
  }
  
  $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
  if(preg_match("/^[a-zA-Z][a-zA-Z -]+$/", $first_name) === 0) {
    $errVal = '1';
    echo '<p class="errText">First name must be from letters, dashes, spaces and must not start with dash</p>';
  }

  $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
  if(preg_match("/^[a-zA-Z][a-zA-Z -]+$/", $last_name) === 0) {
    $errVal = '1';
    echo '<p class="errText">Last name must be from letters, dashes, spaces and must not start with dash</p>';
  }
  
  $pass_word = mysqli_real_escape_string($dbc, $_POST['password']);
  /*note for the poor soul reading my regex...
   *^$ -- line boundary, must contain all of the following without anything extra on the left or right
   *(?=........) -- positive lookahead to check that some x pattern is there. I check for a number, an uppercase and lowercase letter, and any character within that ascii range (all the possible special chars)
   *[\x20-\x7e]{8,} -- must contain at least 8 typable characters from the ascii table.
   *
   * Really, this long mess just checks what is written below in the echo message. There are no capturing groups by the way, the special character positive lookahead contains (?:) for do not capture.
   */
  if(preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*(?:[!-\/]|[:-@]|[[-`]|[{-~]))[ -~]{8,}$/", $pass_word) === 0) {
    $errVal = '1';
    echo '<p class="errText">Password must contain both uppercase and lowercase letters, a number, a special character, and be at least 8 characters long.</p>';
  }

  
  $type_of_user = mysqli_real_escape_string($dbc, trim($_POST['type_of_user']));
  if(preg_match("/^(student|faculty|gradsec|admin)$/", $type_of_user) === 0) {
    $errVal = '1';
    echo '<p class="errText">Valid user types are: student, faculty, gradsec, admin. These are case sensitive.</p>';
  }
  
  $user_ID = mysqli_real_escape_string($dbc, trim($_POST['userID']));
  if(preg_match("/^[1-9]\d{7}$/", $user_ID) === 0) {
    $errVal = '1';
    echo '<p class="errText"> UserID must be 8 digits exactly, and cannot start with a 0.</p>';
  }


  $add_ress = mysqli_real_escape_string($dbc, trim($_POST['address']));
   if(preg_match("/^\d+ (?:\w| |\.|\-|\')+$/", $add_ress) == 0) {
      $errVal = '1';
      echo "<p class='errText'>Address must have the format number Street name etc. Example: 212 K St. NW</p>";
    }

    if($errVal == ''){	  
    $sql = "select uid from users where uid = ". $user_ID;
    $data = mysqli_query($dbc, $sql);
    if(mysqli_num_rows($data) == 0){
      $sql = "INSERT INTO users VALUES ('$user_ID', '$add_ress', '$first_name', '$last_name', '$pass_word', '$user_email','$type_of_user')";
      
      if($dbc->query($sql) === TRUE){
	     
	      $sql = "INSERT INTO student VALUES ('$user_ID', 'yes', 'undecided' , 'undetermined')";

 			if($dbc->query($sql) === TRUE){
	      			echo  'Account Created.' ;
			
			}
       		}
      }
    else{
      echo 'Failed to Create Account. Account ID already exists.';
    }
  }
  else{
    echo "Please fix the above issues, and then retry creating the account.";
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

  <p>Enter New Account Information:</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <label for="firstname">First Name:</label>
    <input type="text" name="firstname" /><br />
   

    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" /><br />
    <label for="email">Email Address:</label>
    <input type="text" name="email" /><br />
    
    
    <label for="type of user">Type of User:</label>
    <input type="text" name="type_of_user" /><br />

    <label for="userrID">Enter UserID:</label>
    <input type="number" name="userID" size="8" /><br />

    <label for="password">Enter Password:</label>
    <input type="text" name="password" size="32" /><br />

    <label for="address">Enter Address:</label>
    <input type="text" name="address" size="32" /><br />

    <input type="submit" value="Create Account" name="Create_Account" /><br/><br/>
  </form>


<img src="createGuidlines.png" alt="Guidlines" width="650" height="200">
</body>
</html>

<body onload="navbar();">

</body>
