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
<body onload='navbar();'> </body>
<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

if(isset($_POST['Register'])){
    $conflict = false;
    $user_cid = mysqli_real_escape_string($dbc, trim($_POST['CRN']));
    $query = "SELECT crn from enrollment where crn = '$user_cid' and uid = $user_id";
    $data = mysqli_query($dbc, $query);
    if(mysqli_num_rows($data) == 1){
	    echo "You have already registered for this class.";
    }
    else{
	    $query = "SELECT crn from coursedata where crn ='$user_cid'";
	    $data = mysqli_query($dbc, $query);
	    if(($row2 = mysqli_fetch_array($data)) == TRUE){
	      $user_crn = $row2['crn'];
	       echo $user_crn . "<br></br>";
	      $sql = "INSERT INTO enrollment VALUES ('$user_id', '$user_crn', 'Fall', 'Sophomore', 'IP', false)";
	      if($dbc->query($sql) === TRUE){
		$query = "SELECT prereq from enrollment join prereqs on enrollment.crn = prereqs.crn where enrollment.uid = '$user_id' and prereqs.crn = '$user_crn'";
		$data = mysqli_query($dbc, $query);
		while( $row = mysqli_fetch_array($data)){
		  $needed_prereq = $row['prereq'];
		  $query = "SELECT crn from enrollment where uid = '$user_id' and crn = '$needed_prereq' and grade !='IP' and grade != 'F'";
		  $result = mysqli_query($dbc, $query);
		  if ($row = mysqli_fetch_array($result) == FALSE) {
		    $sql = "DELETE FROM enrollment WHERE crn = '$user_crn' and uid = '$user_id'";
		    if($dbc->query($sql) === TRUE){
		      echo "Prereq Needed" . "<br></br>";
		    }
		  }
		  else{
		    echo "Prereqs Met" . "<br></br>";
		  }

		}
	      }
	      else{
		echo 'Unable to enter course at this time' . "<br></br>";
		$conflict = TRUE;
	      }
	      if(!$user_cid){
		echo 'No Results';
		$conflict = TRUE;
	      }
	    }
	    
	  else{
	  echo 'Course Does Not Exist' . "<br></br>";
	  }
    }
  if(isset($user_crn)){
    $query = "SELECT day, starttime, endtime from course where crn = '$user_crn'";
    $data = mysqli_query($dbc, $query);
    if(($row3 = mysqli_fetch_array($data)) == TRUE){
      $add_day = $row3['day'];
      $add_starttime = $row3['starttime'];
      $add_endtime = $row3['endtime'];
      $query = "SELECT day, starttime, endtime, enrollment.crn from course join enrollment on course.crn = enrollment.crn where uid = $user_id and day = '$add_day' and enrollment.crn != $user_crn;";
      $data = mysqli_query($dbc, $query);
      while( $row = mysqli_fetch_array($data)){
        $enroll_day = $row['day'];
        $enroll_starttime = $row['starttime'];
        $enroll_endtime = $row['endtime'];
        if(($add_starttime<= $enroll_starttime && $add_endtime >= $enroll_starttime) || ($enroll_starttime <= $add_starttime && $enroll_endtime >= $add_starttime)){
          $sql = "DELETE FROM enrollment WHERE crn = '$user_crn' and uid = '$user_id'";
            if($dbc->query($sql) === TRUE){
              echo "Time Conflict Found" . "<br></br>";
              $conflict = true;
            } 
        }
      }
      if($conflict == false){
        echo "No Time Conflict Found" . "<br></br>";
        echo "Class Added Successfully" . "<br></br>";

      }
    }
    else{
      echo "Failed To Add Course" . "<br></br>";
    }
  }
}

  // this was also supposedly extra, I'm commenting it out}
if(isset($_POST['Drop'])){
  $user_drop = mysqli_real_escape_string($dbc, trim($_POST['drop']));
  $query = "SELECT * from course where crn = '$user_drop'";
  $data = mysqli_query($dbc, $query);
  if($row = mysqli_fetch_array($data)){
    $query = "SELECT * from enrollment where crn = '$user_drop'and uid = '$user_id'";
    $data = mysqli_query($dbc, $query);
    if($row = mysqli_fetch_array($data)){
      $query = "SELECT grade from enrollment where crn = '$user_drop' and uid = '$user_id'";
      $data = mysqli_query($dbc, $query);
      while( $row = mysqli_fetch_array($data)){
        $inprogress = $row['grade'];
        if($inprogress == 'IP'){
          $sql = "DELETE FROM enrollment WHERE crn = '$user_drop' and uid = '$user_id'";
          if($dbc->query($sql) === TRUE){
            echo "Course Removed";
          }
          else{
            echo "Failed to remove Course". "<br></br>";
          }
        }
        else{
       echo "Can not drop a course that is not in progress" . "<br></br>";
        }
      }
    }
    else{
    echo "You are not enrolled in this class, please refer to your grades page to see your enrolled courses." . "<br></br>";
    }
  }
  else{
     echo "Class does not exist, please look at the list of available classes below" . "<br></br>";
  }
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Course Register</legend>
      <label for="CRN">CRN:</label>
      <input type="text" name="CRN" />
    </fieldset>
    <input type="submit" value="submit" name="Register" maxlength="2" pattern="\d{4}" required/>
  </form>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Drop Class</legend>
      <label for="drop">CRN Drop:</label>
      <input type="text" name="drop" />
    </fieldset>
    <input type="submit" value="submit" name="Drop" />
  </form>


  </html>

  <?php 
  $query = "SELECT * FROM coursedata join course on course.crn = coursedata.crn";
$data = mysqli_query($dbc, $query);
?>
<html>



<H4>Course List</H4>

<table style="width:50%"; class="courselist">
  <style>
      .courselist, th {
      padding: 10px;
      border: 2px solid  #a88420; 
      border-collapse: collapse;
      }
    </style>
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
