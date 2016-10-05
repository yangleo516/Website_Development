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
	
	if (!isset ($_SESSION['username'])) {
		echo "Please login first"."<br><br>";
		echo "<a href='login.html'>Login</a>"."<br><br>";
		echo "<a href='display.php'>Back</>";
		exit;
	}
	
	$userid = $_SESSION['userid'];
	
	$stmt = $mysqli->prepare("SELECT story_id, title, link, substring(content,1,500)
		 FROM story WHERE user_id = ?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('i',$userid);
	$stmt->execute();
	$stmt->bind_result($storyid, $title, $link, $subContent);
	while($stmt->fetch()){
		if($link == 'http://') {
				printf("
				<div style = 'border:5px solid lightblue; position:relative; width:600px;left:300px;text-align:left;
				background-color:white;'>
				%s
				<br>
				<div style = 'border:1px dashed green;'>
				%s
				<br>
				</div>
					<form action = 'viewstory.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'submit' value = 'View full story'>
					</form>
					
				</div>",
				htmlspecialchars($title), htmlspecialchars($subContent));
			}
			else {
				printf("
				<div style = 'border:5px solid lightblue; position:relative; width:600px;left:300px;text-align:left;
				background-color:white;'>
				<a href='%s'>%s</a>
				<br>
				<div style = 'border:1px dashed red;'>
				%s...
				<br>
				</div>
					<form action = 'viewstory.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'submit' value = 'View full story'>
					</form>
				</div>",
				htmlspecialchars($link), htmlspecialchars($title), htmlspecialchars($subContent));
			}
	}
?>