<?php
		session_start();
		require 'database.php';
		
		if($_SESSION['token'] != $_POST['token']){
			die("Request forgery detected");
		}
		
		$title = $_POST['title'];
		$content = $_POST['content'];
		$link = $_POST['link'];
		$storyid = $_POST['storyid'];
			
		$stmt = $mysqli->prepare("UPDATE story SET title=?, content=?, link=?
		WHERE story_id = ?");
		if(!$stmt){
			printf("Query Prep Failed: %s", $mysqli->error);
			exit;
    	}
    	$stmt->bind_param('sssi',$title,$content,$link,$storyid);
    	$stmt->execute();
    	$stmt->close();
    	
    	echo "Update successfully!";
    	echo "<br>";
    	echo "<a href='logout.php'>Log out</a>";
    	echo "<br>";
    	echo "<a href='display.php'>Back</a>";
    	echo "<br>";
    	echo "<form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyid'>
	   		<input type='submit' value='View story'>
	 	  </form>";
?>