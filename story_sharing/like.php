<!DOCTYPE html>
<html>
	<head>
		<title>Like this story</title>
	</head>
	
	<body>
		<?php
			session_start();
			$username = $_POST['username'];
			if ($username == -1) {
				echo "You can't do this before login"."<br><br>";
				echo "<a href='login.php'>Login</a>"."<br><br>";
				exit;
			}
			require 'database.php';
			
			$storyid = $_POST['storyid'];
			
			//
			$stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
			if(!$stmt) {
				printf("Query Prep Failed: %s", $mysqli->error);
				exit;
			}
			$stmt->bind_param('i',$username);
			$stmt->execute();
			$stmt->bind_result($userid);
			$stmt->fetch();
			$stmt->close();

			$stmt = $mysqli->prepare("SELECT user_id FROM likes WHERE story_id = ?");
			if(!$stmt) {
				printf("Query Prep Failed: %s", $mysqli->error);
				exit;
			}
			$stmt->bind_param('i',$storyid);
			$stmt->execute();
			$stmt->bind_result($id);
			
			while($stmt->fetch()) {
				if($id == $userid) {
					echo "Sorry, you can't like it twice.";
					echo "<a href = 'display.php'>Back</a>";
					exit;
				}
			}
			$stmt->close();
			
			$stmt = $mysqli->prepare("INSERT INTO likes (story_id,user_id) VALUES (?,?)");
			if(!$stmt) {
				printf("Query Prep Failed: %s", $mysqli->error);
				exit;
			}
			$stmt->bind_param('ii',$storyid,$userid);
			$stmt->execute();
			$stmt->close();
			
			echo "You like this story.";
			echo "<a href = 'display.php'>Back</a>";
			echo "<form action = 'viewstory.php' method = 'POST'>
						<input type = 'hidden' name = 'storyid' value = '$storyid'>
						<input type = 'submit' value = 'View full story'>
			</form>";
		?>
	</body>
</html>