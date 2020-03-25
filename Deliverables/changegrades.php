//start the index page
<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
else if($_SESSION['viewtype'] != 'faculty'){
	header('Location: index.php');
}

require_once('connectvars.php');
require_once("navbar.php");
$user_id = $_SESSION['viewuid'];
?>




<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

?>

<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(isset($_POST['Change Grade'])){
    $user_crn = mysqli_real_escape_string($dbc, trim($_POST['CRN']));
    $query = "SELECT * from courses where crn ='$user_crn'";
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
        }
	  
      }
      else{
        echo 'Failed To Change Grades';
      }
      if(!$user_crn){
        echo 'No Results';
      }
    }
    else{
      echo 'Failed to Change Grades';
    }
  }



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>CHange Grades</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Change Grade</h2>

  <p>Change Grade:</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <label for="Student ID">Student ID:</label>
    <input type="text" name="Student ID" /><br />
   

    <label for="CRN">CRN:</label>
    <input type="text" name="CRN" /><br />
    
    

    <label for="userrID">New Grade:</label>
    <input type="text" name="New Grade" size="32" /><br />


    

    <input type="submit" value="Change Grade" name="Change Grade" /><br/><br/>
  </form>
</body>
</html>

<body onload="navbar();">

</body>
