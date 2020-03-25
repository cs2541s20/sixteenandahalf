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
?>
<html><h3>Course Registration</h3></html>
<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

if(isset($_POST['Register'])){
    $user_crn = mysqli_real_escape_string($dbc, trim($_POST['CRN']));
    $query = "SELECT * from course where crn ='$user_crn'";
    $data = mysqli_query($dbc, $query);
    if($row = mysqli_fetch_array($data) == true){
      $sql = "INSERT INTO enrollment VALUES ('$user_id', '$user_crn', 'Fall', 'Sophomore', NULL, false)";
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



?>
<html>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Course Register</legend>
      <label for="CRN">CRN:</label>
      <input type="text" name="CRN" />
    </fieldset>
    <input type="submit" value="submit" name="Register" />
  </form>
  </html>