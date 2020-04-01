<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<?php
session_start();
if(!isset($_SESSION['uid'])){
	header('Location: login.php');
}
if($_SESSION['viewtype'] != 'faculty'){
	header('Location: index.php');
}



$user_ID = $_SESSION['viewuid'];

require_once("navbar.php");
require_once("connectvars.php");


$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$dbc) {
	die("Connection failed: " . mysqli_connect_error());
	echo "connection refused";
}



if(!isset($_POST['search']) && !isset($_POST['gradeupdate'])){
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$dbc) {
		die("Connection failed: " . mysqli_connect_error());
		echo "connection refused";
	}
	$query = "select crn, name from coursedata where instructorid = " . $user_ID;
	$data = mysqli_query($dbc, $query);
	if (!$data) {
		echo "Error:" .  mysqli_error($dbc);
	}
	$returnable = array();
	echo "<form id = 'classform' method='post' action = " . $_SERVER['PHP_SELF'] . ">
		<select name='search' onchange= " . "\"$('#classform').submit();\">
		<option>Select a class</option>";
	while ($row = mysqli_fetch_array($data)) {
		echo "<option value= {$row['crn']}>" . $row['crn'] . ": " . $row['name'] . "</option>";
	}
	echo "</select>
	    </form>";	


}


if(isset($_POST['search']) || (!isset($_POST['search']) && isset($_POST['gradeupdate']))){
	if(isset($_POST['search'])){
		$_SESSION['course'] = $_POST['search'];
	}
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "select concat(fname, ' ', lname) as name, enrollment.uid as userid, grade, gradeModified, crn from enrollment join users on enrollment.uid = users.uid where crn = " . $_SESSION['course'];
	$data = mysqli_query($dbc, $query);
	if (!$data) {
		echo "Error:" .  mysqli_error($dbc);
	}
	if(mysqli_num_rows($data) == 0){
		echo "<br/>Note: No students have registered for this course. Modify grades from a different course?";
		$query = "select crn, name from coursedata where instructorid = " . $user_ID;
		$data = mysqli_query($dbc, $query);
		if (!$data) {
			echo "Error:" .  mysqli_error($dbc);
		}
		$returnable = array();
		echo "<form id = 'classform' method='post' action = " . $_SERVER['PHP_SELF'] . ">
			<select name='search' onchange= " . "\"$('#classform').submit();\">
			<option>Select a class</option>";
		while ($row = mysqli_fetch_array($data)) {
			echo "<option value= {$row['crn']}>" . $row['crn'] . ": " . $row['name'] . "</option>";
		}
		echo "</select>
		    </form>";	


	}
	else{
		echo "<form id= 'gradeform' method = 'post' action = " . $_SERVER['PHP_SELF'] . "><table>";
		while($row = mysqli_fetch_array($data)){
			echo "<tr>
				<td>" . $row['userid'] . "</td>
				<td>" . $row['name'] . "</td>";
			if($_SESSION['type'] == 'gradsec' || $_SESSION['type'] == 'admin' || $row['gradeModified'] != true){
				echo "<td><select name = 'gradeupdate[]' onchange = ". "\"$('#gradeform').submit();\">";
				echo "<option value = 'unmodified'>Select a grade</option>";
				if($row['grade'] == "IP"){
					echo "<option value = 'IP'>IP</option>";
				}
				echo "
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "A'>A</option>
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "A-'>A-</option>
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "B+'>B+</option>		
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "B'>B</option>
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "B-'>B-</option>
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "C+'>C+</option>
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "C'>C</option>
	<option value = '" . $row['crn'] . ", " . $row['userid'] . ", " . "F'>F</option>

	</select></td>";


			}
			else{
				echo "<td>" . $row['grade'] . "</td>";
			}
			echo "</tr>";
		
		}
		echo "</table></form>";

	}

}


if(isset($_POST['gradeupdate'])){
	//post request with gradeupdate contains in this order:
	//values[0]: crn
	//values[1]: userid (aka uid in database)
	//values[2]: grade to assign


	for($i = 0; $i<sizeof($_POST['gradeupdate']); $i++){
		if($_POST['gradeupdate'][$i] != "unmodified"){
			$values = explode(", ", $_POST['gradeupdate'][$i]);
		}	
	}


	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "update enrollment set grade = '" . $values[2] . "', gradeModified = true where crn = " . $values[0] . " and uid = " . $values[1];
	$data = mysqli_query($dbc, $query);
	if (!$data) {
		echo "Error:" .  mysqli_error($dbc);
	}
	echo "Grade Successfully Updated! Grade set to: " . $values[2] . " for user: " . $values[1] .".<br/>";
	if($_SESSION['type'] == 'faculty'){
		echo "Note, as a faculty member, you have one opportunity to modify a grade. If you leave this page, the grade will be set and may only be updated by a Graduate Secretary or System Administrator. If you have made this grade change in error, you will be allowed to modify this grade once more before it is permenantly set.";
	}
 
}


?>

<body onload = "navbar();">
</body>
