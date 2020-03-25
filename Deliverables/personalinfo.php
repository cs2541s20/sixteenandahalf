<?php
session_start();
if(!isset($_SESSION['uid'])){
  header('Location: login.php');
}

require_once('connectvars.php');

$user_id = $_SESSION['viewuid'];

require_once("navbar.php");

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(!$dbc){

  die("Connection failed ". mysqli_connect_error());
  echo "connection refused";
}
if($_SESSION['type'] == "student"){
  $isstudent = true;
  $query = "SELECT * FROM student join users on student.uid = users.uid where student.uid = " . $user_id;
}
else{
  $isstudent = false;
  $query = "select * from users where users.uid = " . $user_id;
}
$data = mysqli_query($dbc, $query);
if(!$data){
  echo "Error: " . mysqli_error($dbc);
	die("Connection failed ". mysqli_connect_error());
	echo "connection refused";
}
if($_SESSION['viewtype'] == "student"){
	$isstudent = true;
	$query = "SELECT * FROM student join users on student.uid = users.uid where student.uid = " . $user_id;
}
else{
	$isstudent = false;
	$query = "select * from users where users.uid = " . $user_id;
}
$data = mysqli_query($dbc, $query);
if(!$data){
	echo "Error: " . mysqli_error($dbc);
}
?>
<html>
<body onload="navbar();">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Change Address</legend>
      <label for="New Address">New Address:</label>
      <input type="text" name="New Address" />
    </fieldset>
    <input type="submit" value="submit" name="Change Address" />
  </form>
</body>
<H4>Personal Information</H4>
<table style="width:50%">
  <tr>
    <th>First Name</th>
    <th>Last Name </th>
    <th>Email Address</th>
    <th>Address</th>
    <th>Permission</th>
    <?php if($isstudent == true){
      echo "<th>Degree</th>";
      echo "<th>Program</th>";
     }?>
  </tr>
      <?php while( $row = mysqli_fetch_array($data)) { ?>

  <tr>
    <th><?php echo ''. $row['fname'] ?></th>
    <th><?php echo ''. $row['lname'] ?></th>
    <th><?php echo ''. $row['email']?></th>
    <th><?php echo ''. $row['address']?></th>
    <th><?php echo ''. $row['permission']?></th>
    <?php if($isstudent == true){
      echo "<th> {$row['degree']}</th>";
      echo "<th> {$row['program']}</th>";
     }?>
   </tr>
<?php } ?>

</table>
</html>
