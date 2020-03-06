<?php
  //require_once('connectvars.php');
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

     if (!empty($user_username) && !empty($user_password)) {
        // This is where you query to see if the username password combination
        //$query = "select * from shopper where username = '$user_username' and password = '$user_password'";
	$data = mysqli_query($dbc, $query);

        // If The log-in is OK
        if (mysqli_num_rows($data) == 1) {


          $row = mysqli_fetch_array($data);

          //TODO: so set the user ID and username session vars
         // $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['user_id'] = $row['user_id'];

          //TODO: redirect to index.php
          $home_url = 'index.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  

  // Insert the page header
  $page_title = 'Log In';
  require_once('header.php');
 // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Log In</legend>
      <label for="user_id">Username:</label>
      <input type="text" name="user_id" value="<?php if (!empty($user_id)) echo $user_id; ?>" /><br />
      <label for="password">Password:</label>
      <input type="password" name="password" />
    </fieldset>
    <input type="submit" value="Log In" name="submit" />
  </form>

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['user_id'] . '.</p>');
  }
?>


