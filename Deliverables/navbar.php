<?php
$filename = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if($filename == 'navbar.php'){
        if(isset($_SESSION['uid'])){
                header('Location: index.php');
        }
        else{
                header('Location: login.php');
        }
}

?>



<html>
<head>
        <link rel="stylesheet" href="style.css">
</head>
     <body>
	<header>
    <img src="logoIndex.png">
	</header>
     </body>
<style>
header img {
    height: 80px;
}
header img {
    height: 80px;
}
body {
    height: 125vh;
    background-image: url("backgroundNAV.jpg");
    background-size: cover;
    font-family: sans-serif;
    margin-top: 80px;
    padding: 30px;

}
header img {
    height: 80px;
}

main {
    color: white; 

}
header {
   background-color: white;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    display: flex;
    text-align: center; 
  box-shadow: 2px -3px 22px 1px black;

}
div.navdiv {
	
	top: 25px;
	position: fixed;
	left: 120;
       	z-index: 1;
        color: black;
        text-decoration: none;        	
	text-shadow:0px 0px 1px #FFF;
	line-height: 80px;
	text-decoration: none;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 29px;
	color: #371C1C;

	text-decoration:none;
	color:#222;
	padding:2px 2px 2px 4px;
	margin:2px;
	display:block;

}



 .welcome  {
        position: fixed;
	top: 14px;
	left: 600;
        z-index: 1;
        color: black;
        text-decoration: none;
 }

header navlink {
    display: inline;
}
header navlink  {
    margin: 20px;
}
header  {
    color: black;
    text-decoration: none;
}

</style>

</html>





<?php

	//$filename = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	
	
	/*
	  let 'type' refer to a permission level of the actual user as either:
	  	'admin'
		'gradsec'
		'faculty'
		'student'

	  let 'viewtype' refer to a permission level of the simulated user as either:
		'admin'
		'gradsec'
		'faculty'
		'student'
		
	  let 'viewuid' refer to the uid of the user we are simulating
	  
	  let 'uid' refer to the uid of the logged in user
	  
	  if the viewuid and uid session variables are equal, then a supervising user is on their account.
	  Otherwise, the user is viewing a different person's account and we need to create a "Back to my account"
	  link to allow the user to go back to their actual account.
	
	*/


	if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
		if($_SESSION['viewuid'] == $_SESSION['uid']){
			//debuginfo();
			setsysadmin(false);
		}
		else{
			if($_SESSION['viewtype'] ==  'admin'){
				//debuginfo();
				setsysadmin(true);
			}
			if($_SESSION['viewtype'] == 'gradsec'){
				//debuginfo();
				setgradsec(true);
			}
			if($_SESSION['viewtype'] ==  'faculty'){
				//debuginfo();
				setfaculty(true);
			}
			if($_SESSION['viewtype'] == 'student'){
				//debuginfo();
				setstudent(true);
			}		
		}
	}

	else if(isset($_SESSION['type']) && $_SESSION['type'] == 'gradsec'){
		if($_SESSION['viewuid'] == $_SESSION['uid']){
			//debuginfo();
			setsysadmin(false);
		}
		else{
			if($_SESSION['viewtype'] == 'gradsec'){
				//debuginfo();
				setgradsec(true);
			}
			if($_SESSION['viewtype'] ==  'faculty'){
				//debuginfo();
				setfaculty(true);
			}
			if($_SESSION['viewtype'] == 'student'){
				//debuginfo();
				setstudent(true);
			}		
		}
	}

	else if(isset($_SESSION['type']) && $_SESSION['type'] == 'faculty' /*&& $_SESSION['viewuid'] != $_SESSION['uid']*/){
		//debuginfo();
		setfaculty(false);
	}
	
	else if(isset($_SESSION['type']) && $_SESSION['type'] == 'student'){
		//debuginfo();
		setstudent(false);
	}	
	
	else{
		echo "no pages";
		$navbar = array();
		$navbar[0] = "Not logged in test";
		$navbar[1] = "#";
		$_SESSION['navbar'] = $navbar;
	}
	
	function setsysadmin($needsHome){
		$navbar = array();
		$navbar[0] = "Home";
		$navbar[1] = "index.php";
		$navbar[2] = "My info";
		$navbar[3] = "personalinfo.php";
		$navbar[4] = "Log Out";
		$navbar[5] = "logout.php";
		$navbar[6] = "Create Accounts";
		$navbar[7] = "createaccount.php";
		if($needsHome == true){
			$navbar[8] = "Back to my Account";
			$navbar[9] = "home.php";
		}
		else{
			$navbar[8] = "Other Accounts";
			$navbar[9] = "otheraccounts.php";
		}
		$_SESSION['navbar'] = $navbar;
	}

	
	function setgradsec($needsHome){
		$navbar = array();
		$navbar[0] = "Home";
		$navbar[1] = "index.php";
		$navbar[2] = "Log Out";
		$navbar[3] = "logout.php";
		$navbar[4] = "My info";
		$navbar[5] = "personalinfo.php";
		$navbar[6] = "Other Accounts";
		$navbar[7] = "otheraccounts.php";
		if($needsHome == true){
			$navbar[8] = "Back to my Account";
			$navbar[9] = "home.php";
		}
		else{
			$navbar[8] = "Other Accounts";
			$navbar[9] = "otheraccounts.php";
		}		$_SESSION['navbar'] = $navbar;
	}
	
	function setfaculty($needsHome){
		$navbar = array();
		$navbar[0] = "Home";
		$navbar[1] = "index.php";
		$navbar[2] = "My info";
		$navbar[3] = "personalinfo.php";
		$navbar[4] = "Log Out";
		$navbar[5] = "logout.php";
		$navbar[6] = "My Courses";
		$navbar[7] = "mycourses.php";
		$navbar[8] = "Edit Grades";
		$navbar[9] = "examplegradechange.php";
		if($needsHome == true){
			$navbar[10] = "Back to my Account";
			$navbar[11] = "home.php";
		}

		$_SESSION['navbar'] = $navbar;
	}
	
	function setstudent($needsHome){
		$navbar = array();
		$navbar[0] = "Home";
		$navbar[1] = "index.php";
		$navbar[2] = "My info";
		$navbar[3] = "personalinfo.php";
		$navbar[4] = "Log Out";
		$navbar[5] = "logout.php";
		$navbar[6] = "My Grades";
		$navbar[7] = "mygrades.php";
		$navbar[8] = "Registration";
		$navbar[9] = "register.php";
		if($needsHome == true){
			$navbar[10] = "Back to my Account";
			$navbar[11] = "home.php";
		}

		$_SESSION['navbar'] = $navbar;
	}

	function debuginfo(){
		echo "logged in userid: " . $_SESSION['uid'];
		echo "logged in user permission level: " . $_SESSION['type'];
		echo "viewing as user: " . $_SESSION['viewuid'];
		echo "view with permission level: " . $_SESSION['viewtype'];
	}	
?>

<script>
function navbar(){
		//navbar
		var loggedin = "<?php 
					if (isset($_SESSION['name'])){
						echo true;
					} 
					else {
						echo false;
					}?>";
		if(loggedin == ""){
			loggedin = false;
		}
		else{
			loggedin = true;
		}

		var viewing = "<?php
					if (isset($_SESSION['viewname'])){
						echo true;
					}
					else{
						echo false;
					}?>";
		if(viewing == ""){
			viewing = false;
		}
		else{
			viewing = true;
		}
		console.log("The value is: \"" + loggedin + "\"");
		var navdiv = document.createElement("DIV");
		navdiv.className = "navdiv";
		var navtable = document.createElement("TABLE");
		navtable.className = "navtable";
		var navtr = document.createElement("TR");
		navtr.className = "navtablerow";
		var navname = <?php echo json_encode($_SESSION['navbar']); ?>;
		for(var i = 0; i<navname.length; i+=2){
			if(window.location.href.includes(navname[i+1])){
				continue;
			}
			if(navname[i] != ""){
				var navtd = document.createElement("TD");
				navtd.className = "navtd";
				var minicontainer = document.createElement("DIV");
				minicontainer.className = "navitem";
				var navlink = document.createElement("A");
				navlink.className = "navlink";
				navlink.innerHTML = navname[i];
				navlink.href = navname[i+1];
				minicontainer.appendChild(navlink);
				navtd.appendChild(minicontainer);
				navtr.appendChild(navtd);
			}
		}
		if(loggedin){
			navtd = document.createElement("TD");
			var welcomelabel = document.createElement("P");
			welcomelabel.className = "welcome";
			welcomelabel.innerText = "Welcome " + "<?php 
					if (isset($_SESSION['name'])){
						echo $_SESSION['name'];
					} 
					else {
						echo "";
					}?>" + "!";
			navtd.appendChild(welcomelabel);
			navtr.appendChild(navtd);
			if(viewing){
				welcomelabel.innerText+= " (Viewing as: " + "<?php
					if (isset($_SESSION['viewname'])){
						echo $_SESSION['viewname'];
					}
					else{
						echo "";
					}?>" + " )";
			}
		}
		navtable.appendChild(navtr);
		navdiv.appendChild(navtable);
		document.body.insertBefore(navdiv, document.body.firstChild);
	}

</script>
