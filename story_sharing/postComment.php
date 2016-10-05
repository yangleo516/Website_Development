<?php
	session_start();
	require 'database.php';
	
	if (!isset ($_SESSION['username'])) {
		echo "You can't post comment before login"."<br><br>";
		echo "<a href='login.html'>Login</a>"."<br><br>";
		echo "<a href='display.php'>View all stories</>";
		exit;
	}
	$username = $_SESSION['username'];
	
	$comment = $_POST['comment'];
	$storyid = $_POST['storyid'];
	
	$stmt=$mysqli->prepare("SELECT id FROM users WHERE username=?");
    if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
    }
    
   $stmt->bind_param('s', $username);
   $stmt->execute();
   $stmt->bind_result($userid);
   $stmt->fetch();
   $stmt->close();
   
   $stmt=$mysqli->prepare("SELECT user_id FROM comments WHERE story_id=?");
    if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
    }
    
   $stmt->bind_param('s', $storyid);
   $stmt->execute();
   $stmt->bind_result($userIds);
   while($stmt->fetch()) {
   		if($userIds == $userid) {
   			echo "Sorry. You have already commented this story";
   			echo "<form action='viewstory.php' method='POST'>
	   			  <input type='hidden' name='storyid' value='$storyid'>
	   			  <input type='submit' value='Back'>
	 	  		  </form>";
	 	    exit;
   		}
   }
   $stmt->close();
   
   $stmt = $mysqli->prepare("INSERT INTO comments (user_id, story_id, comment) values (?,?,?)");
   if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	
	$stmt->bind_param('iis', $userid, $storyid, $comment);
	$stmt->execute();
	$stmt->close();
	
	echo "Comment Successfully"."<br><br>";
	echo "<a href = 'logout.php'>Log out</>";
	echo "<form action='viewstory.php' method='POST'>
	   		<input type='hidden' name='storyid' value='$storyid'>
	   		<input type='submit' value='Back'>
	 	  </form>";
?>