<?php
	session_start();
	require 'database.php';
	
	if (!isset ($_SESSION['username'])) {
		echo "You can't share your story before login"."<br><br>";
		echo "<a href='login.html'>Login</a>"."<br><br>";
		echo "<a href='display.php'>Back</>";
		exit;
	}
	
	$username = $_SESSION['username'];
	
	$_SESSION['token'] = substr(md5(rand()), 0, 10);
	
	$stmt=$mysqli->prepare("SELECT id FROM users WHERE username=?");
    if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
    }  
   $stmt->bind_param('s', $username);
   $stmt->execute();
   $stmt->bind_result($userid);
   $stmt->fetch();
   $stmt->close()
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="login.css" media="screen">
		<title>share my story</title>
	</head>
	
	<body style="background-image: url(loginbg.jpg);">
	
		<form action = 'isStoryPosted.php' method = "POST">
			<label for = "title">Title:</label>
			<br>
			<textarea name = "title" id = "title" rows = "2" cols = "60"></textarea>
			<br>
			<label for "link">Link:</label>
			<br>
			<textarea name = "link" id = "link" rows = "3" cols = "60">http://</textarea>
			<br>
			<label for = "content">Content:</label>
			<br>
			<textarea name = "content" id = "content" rows = "8" cols = "80"></textarea>
			<br>
			<input type = "hidden" name = "userid" value = "<?php echo $userid;?>"/>
			<input type = "hidden" name = "token" value="<?php echo $_SESSION['token'];?>">
			<input type = "submit" value = "share">
		</form>		
	</body>
</html>