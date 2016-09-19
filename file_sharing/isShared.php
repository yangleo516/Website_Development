<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen">
	<title>Share result</title>
</head>
<body style="background-image:url(image/showbg.jpg);">

<?php
session_start();
$filename = $_GET["filename"];

$other = $_POST['other'];
	// check if the input username is in a valid format
	if( !preg_match('/^[\w_\-]+$/', $other) ){   
		echo "Invalid Username"."<br><br>";
		echo "<a href='share.php'>Share my file again</a>";
		exit;
	}
	
	// check if the user that you share file with has a repo
	// if not, make one for him
	$personalDir = sprintf("/home/yleo/userfile/%s",$other);
	if(!file_exists($personalDir)) {
				mkdir($personalDir);
			}

	// check if the input username exists in the user.txt
	$users = fopen("/home/yleo/users/users.txt","r");
	$isExist = false;

	while (! feof($users)) {
		if ($other == trim(fgets($users))) {
			$isExist = true;
		}
				
	}
	// the input username does not exist
	if (!$isExist) {
		echo "User does not exist"."<br><br>";
		echo "<a href='share.php'>Try again</a>";
		exit;
	}
	fclose($users);

$username = $_SESSION['id'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}


$my_file_path = sprintf("/home/yleo/userfile/%s/%s", $username,$filename);

$other_file_path = sprintf("/home/yleo/userfile/%s/%s", $other, $filename);

$scan_path = sprintf("/home/yleo/userfile/%s", $other);

$files = scandir($scan_path);

$file_exist = false;

// Check if the file already exists in the other user's folder
foreach($files as $file){
	if ($file == $filename){
		$file_exist == true;
	}
}

// check if the file has already existed in the other's repo
if ($file_exist) {
	echo "File already exists."."<br><br>"; 
	echo "<a href='action.php'>Manage my file</a>";
	exit;
}
// share your file with the other user
else {
	if( copy($my_file_path, $other_file_path) ){
		echo "Successfully<br>";
		echo "<a href='action.php'>Manage my file</a>";
		exit;
	}
	else {
		echo "Failed"."<br>";
		echo "<a href='action.php'>Manage my file</a>";
		exit;
	}
}

?>

</body>
</html>