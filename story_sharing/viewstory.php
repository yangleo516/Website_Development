<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="login.css" media="screen">
	<title>View Full Story</title>
</head>

<body style="background-image: url(loginbg.jpg);">
	<?php
		session_start();
		require 'database.php';
		
		if(isset($_SESSION['username'])){
				$username = $_SESSION['username'];
		}
		else{
			$username = -1;
		}
		$story_id = $_POST['storyid'];
		
		$stmtstory = $mysqli->prepare(
		"SELECT title, content, link, user_id, users.username
		FROM story JOIN users on (users.id = story.user_id)
		WHERE story_id = ?");
		
		if(!$stmtstory) {
			printf("Query Prep Failed: %s", $mysqli->error);
			exit;
		}
		
		$stmtstory -> bind_param('i', $story_id);
		$stmtstory -> execute();
		$stmtstory -> bind_result($title, $content, $link, $userid, $author);
		$stmtstory->fetch();
		
		echo "<h3>Story:</h3>";
		
			printf(
			"<div style = 'border:5px solid lightblue; position:relative; width:600px;left:300px;text-align:left;
				background-color:white;'>
			<a href='%s'>%s</a>
			<br>
			%s
			<br>
			<div style = 'border:1px dashed red;'>
			%s
			</div>
			</div>",
			htmlspecialchars($link), htmlspecialchars($title),
 			htmlspecialchars($author),htmlspecialchars($content));
		
		$stmtstory -> close();
		
		// check if the current user is the author
		if($author == $username) {
			echo "<form action = 'storyedit.php' method = 'POST'>
				  <input type = 'hidden' name = 'storyid' value = '$story_id'/>
				  <input type = 'submit' value = 'Edit'/>
				  </form>";
			echo "<form action = 'storydelete.php' method = 'POST'>
				  <input type = 'hidden' name = 'storyid' value = '$story_id'/>
				  <input type = 'submit' value = 'Delete'/>
				  </form>";
		}
		
		$stmtComment = $mysqli->prepare(
		"SELECT comments.id, comment, users.username
		 FROM comments JOIN users ON (users.id = comments.user_id)
		 WHERE story_id = ?");
		 
		 $stmtComment -> bind_param('i', $story_id);
		 $stmtComment -> execute();
		 $stmtComment -> bind_result($cmtId, $comment, $commenter);
		 
		 echo "<h3>Comments:</h3>";
		 
		 while($stmtComment -> fetch()) {
		 	printf("
		 	<div style = 'border:2px solid lightblue; position:relative; width:600px;left:300px;text-align:left;
				background-color:white;'>
			%s
			<br>
			<div style = 'border:1px dashed red;'>
			%s
			</div>
			</div>", htmlspecialchars($commenter), htmlspecialchars($comment));
			echo "<br>";
			if($username == $commenter) {
				echo "<form action = 'cmtEdit.php' method = 'POST'>
					  <input type = 'hidden' name = 'cmtId' value = '$cmtId'/>
					  <input type = 'hidden' name = 'storyId' value = '$story_id'/>
					  <input type = 'submit' value = 'Edit'/>
					  </form>";		
				echo "<form action = 'cmtDelete.php' method = 'POST'>
					  <input type = 'hidden' name = 'cmtId' value = '$cmtId'/>
					  <input type = 'hidden' name = 'storyId' value = '$story_id'/>
					  <input type = 'submit' value = 'Delete'/>
					  </form>";
			}
			echo "<br>";
		 }
		$stmtComment -> close();
	?>
	<br><br>
	<form action = "postComment.php" method = "POST">
		<textarea rows = "5" cols = "80" name = "comment">Enter comment here...</textarea>
		<br>
		<input type = "hidden" name = "storyid" value = "<?php echo $story_id;?>"/>
		<input type = "submit" value = "Submit"/>
	</form>
	
	<?php
	echo "<a href = 'display.php'>Back</a>" . "&nbsp" . "&nbsp";
	echo "<a href = 'logout.php'>Logout</a>";
	?>
</body>