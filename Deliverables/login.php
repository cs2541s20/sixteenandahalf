






<?php

  require_once('connectvars.php');
  //require_once('header.php');
  //require_once('appvars.php');
  //require_once('navbar.php');

  // TODO: Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // TODO: If the user isn't logged in, try to log them in
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

     if (!empty($user_id) && !empty($user_password)) {
        // This is where you query to see if the username password combination
        $query = "select * from users where uid = '$user_id' and password = '$user_password'";
	$data = mysqli_query($dbc, $query);

        // If The log-in is OK
        if (mysqli_num_rows($data) == 1) {


          $row = mysqli_fetch_array($data);
		
	  $_SESSION['uid'] = $row['uid'];
	  $_SESSION['viewuid'] = $row['uid'];
	  $_SESSION['viewtype'] = $row['permission'];
	  $_SESSION['type'] = $row['permission'];
	  $_SESSION['name'] = $row['fname'] . " " . $row['lname'];
          $home_url = 'index.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid user id and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your user id and password to log in.';
      }
    }
  

  // Insert the page header
  $page_title = 'Log In';
  //require_once('header.php');
 // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

<style>
html, body {   
width: 100%;   
height: 100%;   
font-family: "Helvetica Neue", Helvetica, sans-serif;   
color: #444;   
-webkit-font-smoothing: antialiased;    background: #f0f0f0;
}
#container {


position: fixed;
width: 350px;
height: 280px;
top: 50%;
left: 50%;
margin-top: -140px;
margin-left: -170px;
}

form {
    margin: 0 auto;
    margin-top: 20px;
 background-color: #FFFAFA;
}
label {
    color: #555;
    display: inline-block;
    margin-left: 18px;
    padding-top: 10px;
    font-size: 14px;

}

p a {
    font-size: 11px;
    color: #aaa;
    float: right;
    margin-top: -13px;
    margin-right: 20px;
}
p a:hover {
    color: #555;
}
input {
    font-family: "Helvetica Neue", Helvetica, sans-serif;
    font-size: 12px;
    outline: none;
}
input[type=text],
input[type=password] {
    color: #777;
    padding-left: 10px;
    margin: 10px;
    margin-top: 12px;
    margin-left: 18px;
    width: 290px;
    height: 35px;
}



input[type=text],
input[type=user_id] {
    color: #777;
    padding-left: 10px;
    margin: 10px;
    margin-top: 12px;
    margin-left: 18px;
    width: 290px;
    height: 35px;



}



#lower {
    background: #ecf2f5;
    width: 100%;
    height: 69px;
    margin-top: 20px;
}
input[type=checkbox] {
    margin-left: 20px;
    margin-top: 30px;
}
.check {
    margin-left: 3px;
}
input[type=submit] {
    float: right;
    margin-right: 20px;
    margin-top: 20px;
    width: 80px;
    height: 30px;
}


{background-color:rgba(192,192,192,0.3);}



background: #fff;
    border-radius: 3px;
    border: 1px solid #ccc;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .1);


#container {
    position: fixed;
    width: 340px;
    height: 280px;
    top: 50%;
    left: 50%;
    margin-top: -140px;
    margin-left: -170px;
background: #fff;
    border-radius: 3px;
    border: 1px solid #ccc;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .1);
border: 1px solid #c7d0d2;
    border-radius: 2px;
background-color:rgba(192,192,192,0.5);
    box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #f5f7f8;
}

input[type=user_id] {
    color: #777;
    padding-left: 10px;
    margin: 10px;
    margin-top: 12px;
    margin-left: 18px;
    width: 290px;
    height: 35px;
    border: 1px solid #c7d0d2;
    border-radius: 2px;
    box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #f5f7f8;

}



input[type=password] {
    color: #777;
    padding-left: 10px;
    margin: 10px;
    margin-top: 12px;
    margin-left: 18px;
    width: 290px;
    height: 35px;
    border: 1px solid #c7d0d2;
    border-radius: 2px;
    box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #f5f7f8;
}
{font-size: 14px;
    font-weight: bold;
    color: #fff;
    background-color: rgba(0, 0, 255, 0.3); 
    background-image: -webkit-gradient(linear, left top, left bottom, from(#acd6ef), to(#6ec2e8));
    background-image: -moz-linear-gradient(top left 90deg, #acd6ef 0%, #6ec2e8 100%);
    background-image: linear-gradient(top left 90deg, #acd6ef 0%, #6ec2e8 100%);
    border-radius: 30px;
    border: 1px solid #66add6;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .3), inset 0 1px 0 rgba(255, 255, 255, .5);
    cursor: pointer;
}





input[type=submit] {
    float: right;
    margin-right: 20px;
    margin-top: 20px;
    width: 80px;
    height: 30px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    background-color: #acd6ef; /*IE fallback*/
    background-image: -webkit-gradient(linear, left top, left bottom, from(#acd6ef), to(#6ec2e8));
    background-image: -moz-linear-gradient(top left 90deg, #acd6ef 0%, #6ec2e8 100%);
    background-image: linear-gradient(top left 90deg, #acd6ef 0%, #6ec2e8 100%);
    border-radius: 30px;
    border: 1px solid #66add6;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .3), inset 0 1px 0 rgba(255, 255, 255, .5);
    cursor: pointer;
}
{  -webkit-transition: all .4s ease;
    -moz-transition: all .4s ease;
    transition: all .4s ease;
box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #f5f7f8;
    -webkit-transition: all .4s ease;
    -moz-transition: all .4s ease;
    transition: all .4s ease;
}
input[type=text]:hover,
input[type=password]:hover {
    border: 1px solid #b6bfc0;
    box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .7), 0 0 0 5px #f5f7f8;
}
input[type=text]:focus,
input[type=password]:focus {
    border: 1px solid #a8c9e4;
    box-shadow: inset 0 1.5px 3px rgba(190, 190, 190, .4), 0 0 0 5px #e6f2f9;
}
input[type=submit]:hover {
    background-image: -webkit-gradient(linear, left top, left bottom, from(#b6e2ff), to(#6ec2e8));
    background-image: -moz-linear-gradient(top left 90deg, #b6e2ff 0%, #6ec2e8 100%);
    background-image: linear-gradient(top left 90deg, #b6e2ff 0%, #6ec2e8 100%);
}
input[type=submit]:active {
    background-image: -webkit-gradient(linear, left top, left bottom, from(#6ec2e8), to(#b6e2ff));
    background-image: -moz-linear-gradient(top left 90deg, #6ec2e8 0%, #b6e2ff 100%);
    background-image: linear-gradient(top left 90deg, #6ec2e8 0%, #b6e2ff 100%);
}



 { background-color: #D3D3D3;}


</style>






  <div id="container">  

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Log In</legend>
      <label for="user_id">Username:</label>
      <input type="text" name="user_id" value="<?php if (!empty($user_id)) echo $user_id; ?>" /><br />
      <label for="password">Password:</label>
      <input type="password" name="password" />
   <div id="lower">
   <input type="checkbox"><label for="checkbox">Keep me logged in</label>
   </div><!--/ lower-->
   </fieldset>
    <input type="submit" value="Log In" name="submit" />

  </form>

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">Welcome ' . $row['fname'] . ' '. $row['lname'] .'.</p>');
  }
?>



<html>
<head>
<style type="text/css">
<?php
$profpic = "gw_primary_2c_0.png";
?>

body {
background-image: url('<?php echo $profpic;?>');
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome, Please Login</title>
</head>
<body>
</body>
</html>
