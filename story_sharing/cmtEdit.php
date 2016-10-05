<?php
		session_start();
		require 'database.php';
		
		$cmtId = $_POST['cmtId'];
		
		$stmt = $mysqli->prepare("SELECT story_id, comment FROM comments
		WHERE id = ?");
		if(!$stmt) {
			printf("Query Prep Failed: %s", $mysqli->error);
			exit;
		}
		$stmt->bind_param('i',$cmtId);
		$stmt->execute();
		$stmt->bind_result($storyid, $comment);
		$stmt->fetch();
		$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Update comment</title>
	</head>
	
	<body>
		<form action = 'isCmtEdit.php' method = "POST">
			<label for = "content">Comment:</label>
			<textarea name = "comment" id = "comment" rows = "5" cols = "60"><?php echo $comment;?></textarea>
			<br>
			<input type = "hidden" name = "cmtId" value = "<?php echo $cmtId;?>"/>
			<input type = "hidden" name = "storyid" value = "<?php echo $storyid?>"/>
			<input type = "submit" value = "submit">
		</form>		
	</body>
</html>