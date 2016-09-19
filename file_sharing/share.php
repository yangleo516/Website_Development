<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen">
	<title>Share your file</title>
</head>
<body style="background-image:url(image/showbg.jpg);">
    
<?php
	$filename = $_GET['filename'];
?> 
	<form action="isShared.php?filename=<?php echo $filename;?>" method="POST">
		<p>I'd like to share my file with: </p> 
		<input type="text" name="other" id="other">
		<input type="submit" value="Share Now">
	</form>
	
	<?php
		$ids = fopen("/home/yleo/users/users.txt","r");
		echo "Users you want to share with:" . "<br>";
   		while(!feof($ids)) {
   			echo fgets($ids) . "<br>";
   		}
	?>
</body>
</html>