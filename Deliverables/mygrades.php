
<?php

/*testing variables: TODO delete later
 *
 */
$_SESSION['viewtype'] = 'admin';
$_SESSION['viewas'] = '1234';
$_SESSION['uid'] = 11111111;
$user_id = $_SESSION['uid'];
require_once('connectvars.php');

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
