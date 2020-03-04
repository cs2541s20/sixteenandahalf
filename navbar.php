<?php

	$filename = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 

	if(isset($_SESSION['permission']) && $_SESSION['permission'] == 'admin'){
		$navbar = array();
		$navbar[0] = "Home";
		$navbar[1] = "index.php";
		$navbar[2] = "Log Out";
		$navbar[3] = "logout.php";


		$_SESSION['navbar'] = $navbar;
	}
	else{
		$navbar = array();
		$navbar[0] = "Home";
		$navbar[1] = "index.php";
		$navbar[2] = "Login";
		$navbar[3] = "login.php";
		$navbar[4] = "Create an Account";
		$navbar[5] = "signup.php";
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
		if(loggedin){
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
		}
		navtable.appendChild(navtr);
		navdiv.appendChild(navtable);
		document.body.insertBefore(navdiv, document.body.firstChild);
	}

</script>
