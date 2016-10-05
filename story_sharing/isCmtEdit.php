<?php
	session_start();
	require 'database.php';
	
	$cmtId = $_POST['cmtId'];
	$storyid = $_POST['storyid'];
	$comment = $_POST['comment'];
		
	$stmt = $mysqli->prepare("UPDATE comments SET comment=? WHERE id = ?");
	if(!$stmt){
		printf("Query Prep Failed: %s", $mysqli->error);
		exit;
    }
    $stmt->bind_param('si',$comment, $cmtId);
    $stmt->execute();
    $stmt->close();
    
    echo "Update successfully!";
    echo "<br>";
    echo "<a href='logout.php'>Log out</a>";
    echo "<form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyid'>
	   		<input type='submit' value='Back'>
	 	  </form>";
?>