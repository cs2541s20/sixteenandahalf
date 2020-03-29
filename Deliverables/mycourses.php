//start the index page
<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
else if($_SESSION['viewtype'] != 'faculty' /*&& $_SESSION['viewtype'] != "student"*/){
	header('Location: index.php');
}
require_once('connectvars.php');
$user_id = $_SESSION['viewuid'];

require_once("navbar.php");
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM enrollment join course on enrollment.crn = course.crn where uid = $user_id";
$data = mysqli_query($dbc, $query);
?>
<html>
<body onload="navbar();">
</body>
<H4>My Courses</H4>
<table style="width:50%">
  <tr>
    <th>CRN</th>
    <th>Class</th>
    <th>Day<th>
    <th>Time<th>
    <th>Location<th>
    <th>Section<th>
  </tr>
      <?php while( $row = mysqli_fetch_array($data)) { ?>
  <tr>
    <th><?php echo ''. $row['crn'] ?></th>
    <th><?php echo ''. $row['name']; ?></th>
    <th><?php echo ''. $row['day']?></th>
    <th><?php echo ''. $row['time']?></th>
    <th><?php echo ''. $row['location']?></th>
    <th><?php echo ''. $row['section']?></th>
  </tr>
<?php } ?>

</table>
</html>





