<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="login.css" media="screen">
		<title>Display news</title>
	</head>

	<body style="background-image: url(loginbg.jpg);">
		<?php
			session_start();
			$username = -1;
			if(isset($_SESSION['username'])){
				$username = $_SESSION['username'];
			}
			
			require 'database.php';
			
			// $stmtuser = $mysqli -> prepare("SELECT id FROM users WHERE username = ?");
// 			if(!$stmtuser) {
// 				printf("Query Prep Failed: %s\n", $mysqli->error);
// 				exit;
// 			}
// 			$stmtuser->bind_param('s', $username);
// 			$stmtuser->execute();
// 			$stmtuser->bind_result($userid);
// 			$stmtuser->fetch();
// 			$stmtuser->close();
			
			$stmt = $mysqli -> prepare(
			"SELECT title, users.username AS author, substring(content,1,500) AS subContent, 
			story.story_id, COUNT(likes.id) as numOfLikes, link
			 FROM story JOIN users ON (users.id = story.user_id)
			 LEFT JOIN likes ON (story.story_id = likes.story_id)
			 GROUP BY (story.story_id)");
			if(!$stmt){
			echo "test";
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
	    	}
	    	
	    	$stmt->execute();
			$stmt->bind_result($title, $author, $subContent, $storyid, $numOfLikes, $link);
			
			while($stmt->fetch()) {
			if($link == 'http://') {
				printf("
				<div style = 'border:5px solid lightblue; position:relative; width:600px;left:300px;text-align:left;
				background-color:white;'>
				%s
				<br>
				%s \t Likes: %s
				<div style = 'border:1px dashed lightblue;'>
				%s...
				<br>
				</div>
					<form action = 'viewstory.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'submit' value = 'View full story'>
					</form>
					
					<form action = 'like.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'hidden' name = 'username' value = '$username'>
						<input type = 'submit' src = 'like.png' alt='like'>
					</form>
				</div>",
				htmlspecialchars($title), htmlspecialchars($author),
 				htmlspecialchars($numOfLikes),htmlspecialchars($subContent));
			}
			else {
				printf("
				<div style = 'border:5px solid lightblue; position:relative; width:600px;left:300px;text-align:left;
				background-color:white;'>
				<a href='%s'>%s</a>
				<br>
				%s \t Likes: %s
				<div style = 'border:1px dashed lightblue;'>
				%s...
				<br>
				</div>
					<form action = 'viewstory.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'submit' value = 'View full story'>
					</form>
					
					<form action = 'like.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'hidden' name = 'username' value = '$username'>
						<input type = 'submit' value = 'like' alt='like'>
					</form>
				</div>",
				htmlspecialchars($link), htmlspecialchars($title), htmlspecialchars($author),
				htmlspecialchars($numOfLikes),htmlspecialchars($subContent));
			}
			}
			$stmt->close();
		?>
		
		<div style = 'border:5px solid lightblue; position:fixed; width:150px;left20px;top:20px;
		text-align:center;'>
			<a href = 'postStory.php'>Share my story</a>
			<br>
			<a href = 'viewMyStories.php'>View my stories</a>
			<br>
			<a href = 'logout.php'>Log out</a>
			
		</div>
	</body>
</html>