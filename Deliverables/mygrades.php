
<?php

if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
else if($_SESSION['viewtype'] != "student" && $_SESSION['viewtype'] != 'faculty'){
	header('Location: index.php');
}
require_once('connectvars.php');
require_once('login.php');


$user_id = $_SESSION['uid'];



require_once("navbar.php");
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
$query = "SELECT * FROM enrollment join coursedata on enrollment.crn = coursedata.crn where uid = $user_id";
$data = mysqli_query($dbc, $query);
?>
<html>
<body onload="navbar();">

</body>
<H4>My Grades</H4>
<table style="width:50%">
  <tr>
    <th>CRN</th>
    <th>Class</th>
    <th>Grade</th>
  </tr>
      <?php while( $row = mysqli_fetch_array($data)) { ?>

  <tr>
    <th><?php echo ''. $row['crn'] ?></th>
    <th><?php echo ''. $row['name']; ?></th>
    <th><?php echo ''. $row['grade']?></th>
  </tr>
<?php } ?>

</table>
</html>
