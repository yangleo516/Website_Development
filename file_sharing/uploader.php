<!DOCTYPE html>
<html>
<head>
	<!--<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen">-->
	<title>Upload</title>
</head>
<body style="background-image:url(image/showbg.jpg);">
	<?php
	session_start();

	// Get the filename and make sure it is valid
	$filename = basename($_FILES['uploadedfile']['name']);
	if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
		echo "<h1>Invalid filename</h1><br>";
		echo "<a href='action.php'>Manage my files</a>" ."<br>";
		echo "<a href='logout.php'>Log out</a>" . "<br>";
		exit;
	}

	// Get the username and make sure it is valid
	$username = $_SESSION['id'];
	if( !preg_match('/^[\w_\-]+$/', $username) ){
		echo "<h1>Invalid username</h1>";
		echo "<a href='logout.php'>Log out</a>";
		exit;
	}

	$full_path = sprintf("/home/yleo/userfile/%s/%s", $username,$filename);
	$scan_path = sprintf("/home/yleo/userfile/%s", $username);
	
	$files = scandir($scan_path);
	$file_exist = false;
	
	// Check if the file already exists in the user's folder
	foreach($files as $file){
		if ($file == $filename){
			$file_exist = true;
		}
	}
	
	if ($file_exist) {
		echo "<h1>File already exists </h1><br>"; 
		echo "<a href='action.php'>Manage my file</a>";
		exit;
	}
	else {
		if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path)){
 			header("Location: upload_success.html");
 			exit;
 		}
	 	else {
	 		header("Location: upload_failure.html");
	 		exit;
	 	}
	}
?>
<body>
</html>