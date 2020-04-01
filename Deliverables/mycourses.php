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
$query = "SELECT name, course.crn, day, concat(starttime, '-', endtime) as time, location, section from coursedata join course on coursedata.crn = course.crn where instructorid = $user_id";
$data = mysqli_query($dbc, $query);



echo"<html>
<body onload='navbar();'>
</body>
<H4>My Courses</H4>
<table style='width:50%'; class='courselist'>
    <style>
      .courselist, th {
      padding: 10px;
      border: 3px solid #a88420;
      border-collapse: collapse;
      }
    </style>

 <tr>
    <th>CRN</th>
    <th>Class</th>
    <th>Day</th>
    <th>Time</th>
    <th>Location</th>
    <th>Section</th>
  </tr>";
      while( $row = mysqli_fetch_array($data)) {
  echo "<tr>
    <th>{$row['crn']}</th>
    <th>{$row['name']}</th>
    <th>{$row['day']}</th>
    <th>{$row['time']}</th>
    <th>{$row['location']}</th>
    <th>{$row['section']}</th>
  </tr>";
      }
echo"
</table>
</html>
";
?>




