<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
else if($_SESSION['viewtype'] != "student" /*&& $_SESSION['viewtype'] != 'faculty'*/){
	header('Location: index.php');
}
require_once('connectvars.php');


$user_id = $_SESSION['viewuid'];



require_once("navbar.php");
?>
<html><h3>Course Registration</h3>
<body onload='navbar();'>
<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

if(isset($_POST['Register'])){
    $user_crn = mysqli_real_escape_string($dbc, trim($_POST['CRN']));
    $query = "SELECT * from course where crn ='$user_crn'";
    $data = mysqli_query($dbc, $query);
    if($row = mysqli_fetch_array($data) == true){
      $sql = "INSERT INTO enrollment VALUES ('$user_id', '$user_crn', 'Fall', 'Sophomore', 'IP', false)";
      if($dbc->query($sql) === TRUE){
        $query = "SELECT * from prereqs where crn ='$user_crn'";
        $data = mysqli_query($dbc, $query);
        if($row = mysqli_fetch_array($data) == true){
          $query = "SELECT * from enrollment join prereqs on enrollment.crn = prereqs.crn where enrollment.crn = '$user_crn' and uid = '$user_id'";
          $data = mysqli_query($dbc, $query);
          if($row = mysqli_fetch_array($data) == true){
            echo  'Course Added' ;
          }
          else{
            $sql = "DELETE FROM enrollment WHERE crn = '$user_crn' = and uid = '$user_id'";
              echo 'Prerqs Needed' ;
          
        }
        }
        else{
          echo 'Course Added';
        }
      }
      else{
        echo 'Failed To Add Course';
      }
      if(!$user_crn){
        echo 'No Results';
      }
    }
    else{
      echo 'Failed to Add Course';
    }
  }
if(isset($_POST['Drop'])){
  $user_drop = mysqli_real_escape_string($dbc, trim($_POST['drop'])); 
  $sql = "DELETE FROM enrollment WHERE crn = '$user_drop' and uid = '$user_id'";
  if($dbc->query($sql) === TRUE){
    echo "Course Removed";
  }

}



?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Course Register</legend>
      <label for="CRN">CRN:</label>
      <input type="text" name="CRN" />
    </fieldset>
    <input type="submit" value="submit" name="Register" />
  </form>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Drop Class</legend>
      <label for="drop">Drop:</label>
      <input type="text" name="drop" />
    </fieldset>
    <input type="submit" value="submit" name="Drop" />
  </form>

  </body>
  </html>

  <?php 
  $query = "SELECT * FROM coursedata join course on course.crn = coursedata.crn";
$data = mysqli_query($dbc, $query);
?>
<html>


</body>
<H4>My Grades</H4>
<style>
      table, th, td {
      padding: 10px;
      border: 1px solid black; 
      border-collapse: collapse;
      }
    </style>
<table style="width:50%"; 
 >
  <tr>
    <th>CRN</th>
    <th>CID</th>
    <th>Department</th>
    <th>Course Name</th>
    <th>Credits</th>
    <th>Semester</th>
    <th>Day</th>
    <th>Start Time</th>
    <th>End Time</th>
    <th>Location</th>
    <th>Section</th>
  </tr>
      <?php while( $row = mysqli_fetch_array($data)) { ?>

  <tr>
    <th><?php echo ''. $row['crn'] ?></th>
    <th><?php echo ''. $row['cid']; ?></th>
    <th><?php echo ''. $row['dept']?></th>
    <th><?php echo ''. $row['name']?></th>
    <th><?php echo ''. $row['credits']?></th>
    <th><?php echo ''. $row['semester']?></th>
    <th><?php echo ''. $row['day']?></th>
    <th><?php echo ''. $row['starttime']?></th>
    <th><?php echo ''. $row['endtime']?></th>
    <th><?php echo ''. $row['location']?></th>
    <th><?php echo ''. $row['section']?></th>
  </tr>
<?php } ?>

</table>
</html>
