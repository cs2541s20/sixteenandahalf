
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php


session_start();


require_once("navbar.php");
require_once("connectvars.php");


if(isset($_POST['search']) && !empty($_POST['search'])){
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$trimmedsearch = mysqli_real_escape_string($dbc, trim($_POST['search']));
		$_SESSION['search'] = $trimmedsearch;

		if (!$dbc) {
			die("Connection failed: " . mysqli_connect_error());
			echo "connection refused";
		}
		$query = "select concat(fname, ' ', lname) as name, uid from users where lname like '%" . $trimmedsearch . "%' or uid like '%" . $trimmedsearch . "%'";
		$data = mysqli_query($dbc, $query);
		if (!$data) {
    			echo "Error:" .  mysqli_error($dbc);
		}
		$_SESSION['unextracteddata'] = $data;
		$returnable = array();
		while ($row = mysqli_fetch_array($_SESSION['unextracteddata'])) {
			$subarray = array();
			array_push($subarray, $row['name']);
			array_push($subarray, $row['uid']);
			array_push($returnable, $subarray);
		}
		
		$_SESSION['returnable'] = $returnable;

}


if(isset($_POST['selecteduser'])){

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "select permission, concat(fname, ' ', lname) as name from users where uid = " . $_POST['selecteduser'];
	$data = mysqli_query($dbc, $query);
	if (!$data) {
		echo "Error:" .  mysqli_error($dbc);
	}
	$row = mysqli_fetch_array($data);
	if(mysqli_num_rows($data) == 1){
		$_SESSION['viewuid'] = $_POST['selecteduser'];
		$_SESSION['viewtype'] = $row['permission'];
		$_SESSION['viewname'] = $row['name'];
		//header('Location: index.php');
		echo "all set! go to index";
	}
	else{
		echo "Unfortunately, we were temporarily unable to connect you through that account. Please try again later.";
	}
}



?>


<body onload = "navbar(); getUsers();">


	<div>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="text" placeholder="Search..." name="search">
			<button id="search"><i>Search!</i></button>
	
		</form>
	</div>

	

</body>

<script>
	function getUsers(){
		var numCategories = "<?php
				if (isset($_SESSION['returnable'])){
					echo mysqli_num_rows($_SESSION['unextracteddata']);
				}
				else {
					echo 0;
				}?>";
		numCategories = parseInt(numCategories);
		var category = <?php
				if(!empty($returnable)){
					echo json_encode($returnable);
					}
					else{
						echo "";
					}?>;
		
		//document.body.appendChild(categoryform);
		var form = document.createElement("FORM");
		form.method = "POST";
		form.action = "<?php echo $_SERVER['PHP_SELF']; ?>";
		form.id = "users";
		var select = document.createElement("SELECT");
		select.name = "selecteduser";
		var defaultOption = document.createElement("option");
		defaultOption.innerHTML = "Select User to View";
		select.appendChild(defaultOption);
		for(var i = 0; i<numCategories; i++){
			var o = document.createElement("option");
			o.innerHTML = category[i];
			o.value = category[i][1];
		
			select.appendChild(o);
		}
		form.appendChild(select);
		select.setAttribute("onchange", "$('#users').submit();");
		document.body.appendChild(form);
	}
</script>
