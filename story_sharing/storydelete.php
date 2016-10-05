<?php
	session_start();
	require 'database.php';
	
	$storyid = $_POST['storyid'];
	
	// delete story
	$stmt = $mysqli->prepare("DELETE FROM story WHERE story_id = ?");
	if(!$stmt) {
		printf("Query Prep Failed: %s", $mysqli->error);
		exit;
	}
	$stmt->bind_param('i',$storyid);
	$stmt->execute();
	$stmt->close();
	
	// delete comment
	$stmt = $mysqli->prepare("DELETE FROM comments WHERE story_id = ?");
	if(!$stmt) {
		printf("Query Prep Failed: %s", $mysqli->error);
		exit;
	}
	$stmt->bind_param('i',$storyid);
	$stmt->execute();
	$stmt->close();
	
	echo "Delete story successfully!";
    echo "<br>";
    echo "<a href='logout.php'>Log out</a>";
    echo "<br>";
    echo "<a href='display.php'>Back</a>";
?>