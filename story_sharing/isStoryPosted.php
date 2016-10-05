<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="login.css" media="screen">
		<title>View all of my stories</title>
	</head>
	<body style="background-image: url(loginbg.jpg);">
	</body>
<html>

<?php
	session_start();
	require 'database.php';
	
	if($_SESSION['token'] != $_POST['token']){
		die("Request forgery detected");
	}
	
	$userid = $_POST['userid'];
	$title = $_POST['title'];
	$link = $_POST['link'];
	$content = $_POST['content'];

   $stmt = $mysqli->prepare("INSERT INTO story (user_id, title, link, content) values (?,?,?,?)");
   if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	
	$stmt->bind_param('isss', $userid, $title, $link, $content);
	$stmt->execute();
	$stmt->close();
	
	echo "<strong>Thanks for sharing your story.</strong>"."<br><br>";
	echo "<a href = 'logout.php'>Log out</a>" . "<br>";
	echo "<a href = 'display.php'>Back</a>";
?>