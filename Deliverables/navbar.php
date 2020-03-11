<?php

	//$filename = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
	
	
	/*let 'viewtype' refer to a permission level as either:
		'admin'
		'gradsec'
		'faculty'
		'student'
		
	  let 'viewas' refer to the uid of the user we are simulating
	  
	  let 'uid' refer to the uid of the logged in user
	  
	  if the viewas and uid session variables are equal, then a supervising user is on their account.
	  Otherwise, the user is viewing a different person's account and we need to create a "Back to my account"
	  link to allow the user to go back to their actual account.
	
	*/

	if(isset($_SESSION['viewtype'])){
		echo "logged in test success!";
	}
	else{
		echo "logged in test failure..";
	}

	if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'admin' && $_SESSION['viewas'] != $_SESSION['uid']){
		echo "sysadmin true";
		setsysadmin(true);
	}
	else if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'admin' && $_SESSION['viewas'] == $_SESSION['uid']){
		echo "sysadmin false";
		setsysadmin(false);
	}
	else if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'gradsec' && $_SESSION['viewas'] != $_SESSION['uid']){
		echo "gradsec true";
		setgradsec(true);
	}
	else if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'gradsec' && $_SESSION['viewas'] == $_SESSION['uid']){
		echo "gradsec false";
		setgradsec(false);
	}
	else if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'faculty' && $_SESSION['viewas'] != $_SESSION['uid']){
		echo "faculty true";
		setfaculty(true);
	}
	else if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'faculty' && $_SESSION['viewas'] == $_SESSION['uid']){
		echo "faculty false";
		setfaculty(false);
	}
	else if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'student' && $_SESSION['viewas'] != $_SESSION['uid']){
		echo "student false";
		setstudent(true);
	}
	else if(isset($_SESSION['viewtype']) && $_SESSION['viewtype'] == 'student' && $_SESSION['viewas'] == $_SESSION['uid']){
		echo "student true";
		setstudent(true);
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
		$navbar[8] = "Other Accounts";
		$navbar[9] = "otheraccounts.php";
		if($needsHome == true){
			$navbar[10] = "Back to my Account";
			$navbar[11] = "home.php";
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

		$_SESSION['navbar'] = $navbar;
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
		if($needsHome == true){
			$navbar[8] = "Back to my Account";
			$navbar[9] = "home.php";
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
		if($needsHome == true){
			$navbar[8] = "Back to my Account";
			$navbar[9] = "home.php";
		}

		$_SESSION['navbar'] = $navbar;
	}

	
?>

<script>
function navbar(){
		//navbar
		var loggedin = "<?php 
					if (isset($_SESSION['username'])){
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
		console.log("The value is: \"" + loggedin + "\"");
		var navdiv = document.createElement("DIV");
		navdiv.className = "navmenu";
		var navtable = document.createElement("TABLE");
		var navtr = document.createElement("TR");
		var navname = <?php echo json_encode($_SESSION['navbar']); ?>;
		for(var i = 0; i<navname.length; i+=2){
			if(window.location.href.includes(navname[i+1])){
				continue;
			}
			if(navname[i] != ""){
				var navtd = document.createElement("TD");
				var minicontainer = document.createElement("DIV");
				minicontainer.className = "navitem";
				var navlink = document.createElement("A");
				navlink.className = "navitem";
				navlink.innerHTML = navname[i];
				navlink.href = navname[i+1];
				minicontainer.appendChild(navlink);
				navtd.appendChild(minicontainer);
				navtr.appendChild(navtd);
			}
		}
		/*if(loggedin){
			navtd = document.createElement("TD");
			var welcomelabel = document.createElement("P");
			welcomelabel.className = "welcome";
			welcomelabel.innerText = "Welcome " + "<?php 
					if (isset($_SESSION['username'])){
						echo $_SESSION['username'];
					} 
					else {
						echo "";
					}?>" + "!";
			navtd.appendChild(welcomelabel);
			navtr.appendChild(navtd);
		}*/
		navtable.appendChild(navtr);
		navdiv.appendChild(navtable);
		document.body.insertBefore(navdiv, document.body.firstChild);
	}

</script>
