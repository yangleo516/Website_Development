<?php
	session_start();
	require 'database.php';
	$cmtId = $_POST['cmtId'];
	$storyId = $_POST['storyId'];
	echo "$cmtId";
	
	$stmt = $mysqli->prepare("DELETE FROM comments WHERE id = ?");
	if(!$stmt) {
		printf("Query Prep Failed: %s", $mysqli->error);
		exit;
	}
	$stmt->bind_param('i',$cmtId);
	$stmt->execute();
	$stmt->close();
	
	echo "<form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyId'>
	   		<input type='submit' value='Back'>
	 	  </form>";
	echo "<a href = 'display.php'>View all stories</a>";
?>