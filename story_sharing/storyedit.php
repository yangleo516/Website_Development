<?php
			session_start();
			require 'database.php';
			
			$storyid = $_POST['storyid'];
			
			$stmt = $mysqli->prepare("SELECT title, content, link FROM story
			WHERE story_id = ?");
			if(!$stmt) {
				printf("Query Prep Failed: %s", $mysqli->error);
				exit;
			}
			$stmt->bind_param('i',$storyid);
			$stmt->execute();
			$stmt->bind_result($title, $content, $link);
			$stmt->fetch();
			$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="login.css" media="screen">
		<title> Edit story</title>
	</head>
	
	<body style="background-image: url(loginbg.jpg);">
		<form action = 'isStoryEdit.php' method = "POST">
			<label for = "title">Title:</label>
			<br>
			<textarea name = "title" id = "title" rows = "2" cols = "60"><?php echo $title;?></textarea>
			<br>
			<label for "link">Link:</label>
			<br>
			<textarea name = "link" id = "link" rows = "3" cols = "60"><?php echo $link;?></textarea>
			<br>
			<label for = "content">Content:</label>
			<br>
			<textarea name = "content" id = "content" rows = "8" cols = "80"><?php echo $content;?></textarea>
			<br>
			<input type = "hidden" name = "storyid" value = "<?php echo $storyid;?>"/>
			<input type = "hidden" name = "token" value="<?php echo $_SESSION['token'];?>"/>
			<input type = "submit" value = "submit">
		</form>		
	</body>
</html>