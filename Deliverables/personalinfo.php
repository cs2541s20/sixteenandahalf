<?php
session_start();
if(!isset($_SESSION['uid'])){
  header('Location: login.php');
}

require_once('connectvars.php');

$user_id = $_SESSION['viewuid'];

require_once("navbar.php");


//display personal information

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

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
	die("Connection failed ". mysqli_connect_error());
	echo "connection refused";
}

//end display personal information



if($_SESSION['type'] == 'gradsec' || $_SESSION['type'] == 'admin'){
	echo "<form method='post' action='personalinfo.php'> 
	<fieldset>
	  <legend>Update Information</legend>
	  <label for='Note'>Note: modifying some user information will require a logout or simulated logout to take effect</label>
	  <br/>
	  <label for='First Name'>First Name:</label>
	  <input type='text' name='firstname' />
	  <br/>
	  <label for='Last Name'>Last Name:</label>
	  <input type='text' name='lastname' />
	  <br/>
	  <label for='Email Address'>Email Address:</label>
	  <input type='text' name='email' />
	  <br/>
	  <label for='Address'>Address:</label>
	  <input type='text' name='address' />
	  <br/>";

	if($_SESSION['viewtype'] == 'student'){
	  echo "<label for='Degree'>Degree:</label>
	  <input type='text' name='degree' />
	  <br/>
	  <label for='Program'>Program:</label>
	  <input type='text' name='program' />
	  <br/>";
	}
	echo "</fieldset>
	<input type='submit' value='Update Info' name='updateinfo' />
    </form>";

}
else{
	echo "<form method='post' action='personalinfo.php'> 
	<fieldset>
	  <legend>Update Information</legend>
	  <label for='Address'>Address:</label>
	  <input type='text' name='address' />
	</fieldset>
	<input type='submit' value='Update Info' name='updateinfo' />
    </form>";

	

}

if(isset($_POST['updateinfo'])){
  $errVal = "";
  /* echo "<br><br><br>updating"; */

	//if the user logged in is at least a student, they may edit their address
	if(!empty($_POST['address'])){
		$new_address = mysqli_real_escape_string($dbc, trim($_POST['address']));
		if(preg_match("/^\d+ (?:\w| |\.|\-|\')+$/", $new_address) == 1) { 
			$sql = "UPDATE users SET address ='$new_address' WHERE uid = '$user_id'";
			if($dbc->query($sql) === TRUE){
				echo  'Address Updated Successfully' ;
			}
			else{
				echo 'Failed to Update Address';
			}
		}
		else{
			echo "<p class='errText'>Address could not be updated. Expected format: Address number Street name etc. Example: 212 K St. NW</p>";
		}
	}
	
	
	
	
	//if the user logged in is not a student or faculty member, they may edit everything else except the user permission level
	if($_SESSION['type'] != 'student' && $_SESSION['type'] != 'faculty'){
		
		
		if(!empty($_POST['firstname'])){
			$first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
			if(preg_match("/^[a-zA-Z][a-zA-Z -]+$/", $first_name) == 1) { 
				$sql = "UPDATE users SET fname ='$first_name' WHERE uid = '$user_id'";
				if($dbc->query($sql) === TRUE){
					echo  '<br/>First Name Updated Successfully' ;
				}
				else{
					echo '<br/>Failed to Update First Name';
				}	
			
			}
			else{
				echo "<p class='errText'>First name could not be updated. First name must only include letters, dashes and spaces</p>";
			}
		}


                if(!empty($_POST['lastname'])){
                        $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
                        if(preg_match("/^[a-zA-Z][a-zA-Z -]+$/", $last_name) == 1) {
                                $sql = "UPDATE users SET lname ='$last_name' WHERE uid = '$user_id'";
                                if($dbc->query($sql) === TRUE){
                                        echo  '<br/>Last Name Updated Successfully' ;
                                }
                                else{
                                        echo '<br/>Failed to Update Last Name';
                                }

                        }
			else{
                        	echo "<p class='errText'>Last name could not be updated. Last name must only include letters, dashes and spaces</p>";
			}
                }


	        if(!empty($_POST['email'])){
                $new_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
		if (filter_var($new_email, FILTER_VALIDATE_EMAIL)){
		//	$errVal = '1';
			$sql = "UPDATE users SET email ='$new_email' WHERE uid = '$user_id'";
        	        if($dbc->query($sql) === TRUE){
        	                echo  '<br/>Email Address Updated Successfully' ;
        	        }
        	        else{
        	                echo '<br/>Failed to Update Email Address';
        	        }
		}
		else{
       			echo '<br/><p class="errText">Invalid Email Address Entered</p><br/>';
		}
		
		}

           	if(!empty($_POST['degree'])){
                        $student_degree = mysqli_real_escape_string($dbc, trim($_POST['degree']));
                        if(preg_match("/^[a-zA-Z -]+$/", $student_degree) == 1) {
                                $sql = "UPDATE student SET degree ='$student_degree' WHERE uid = '$user_id'";
                                if($dbc->query($sql) === TRUE){
                                        echo  '<br/>Degree Updated Successfully' ;
                                }
                                else{
                                        echo '<br/>Failed to Update Degree';
                                }

                        }
			else{
                        	echo "<p class='errText'>Degree could not be updated. Degree must only include letters, dashes and spaces</p>";
			}
                }

		 if(!empty($_POST['program'])){
                        $new_program = mysqli_real_escape_string($dbc, trim($_POST['program']));
                        if(preg_match("/^[a-zA-Z -]+$/", $new_program) == 1) {
                                $sql = "UPDATE student SET program ='$new_program' WHERE uid = '$user_id'";
                                if($dbc->query($sql) === TRUE){
                                        echo  '<br/>Program Updated Successfully' ;
                                }
                                else{
                                        echo '<br/>Failed to Update Program';
                                }

                        }
			else{
                        	echo "<p class='errText'>Program could not be updated. Program must only include letters, dashes and spaces</p>";
			}
                }







	}




}





?>










<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<body onload="navbar();">

<!--<style>
th, tr {
  padding: 15px;
  text-align: left;


  height: 50px;
  vertical-align: bottom;

}
</style> -->



</body>
<H4>Personal Information</H4>
<table class='personalInfo', style="width:50%">
    <style>
      .personalInfo, th {
      padding: 10px;
      border: 3px solid #a88420;
      border-collapse: collapse; 
      }
    </style>

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
