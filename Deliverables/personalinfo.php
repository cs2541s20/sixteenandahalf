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
$query = 'SELECT * FROM student join users on student.uid = users.uid  where student.uid = $user_id';
$data = mysqli_query($dbc, $query);

?>
<html>
<body onload="navbar();">

</body>
<H4>Personal Information</H4>
<table style="width:50%">
  <tr>
    <th>First Name</th>
    <th>Last Name </th>
    <th>Email Address</th>
    <th>Permission</th>
    <th>Degree</th>
    <th>Program</th>
  </tr>
      <?php while( $row = mysqli_fetch_array($data)) { ?>

  <tr>
    <th><?php echo ''. $row['fname'] ?></th>
    <th><?php echo ''. $row['lname'] ?></th>
    <th><?php echo ''. $row['email']?></th>
    <th><?php echo ''. $row['permission']?></th>
    <th><?php echo ''. $row['degree']?></th>
    <th><?php echo ''. $row['program']?></th>
   </tr>
<?php } ?>

</table>
</html>








