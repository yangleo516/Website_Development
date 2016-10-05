<?php

if (isset ($_POST['username'], $_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
}

require 'database.php';

// check if the username entered has been registered or not 
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE username=?");

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('s',$username);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
 
if ($count == 1) {
	// This username has been registered
	echo "This username has been registered. Please try another one.";
	// redirect to register
	echo "<a href='register.php'>Try a new one!</a>";
	exit;	
}
$stmt->close();

$u_len = strlen($username);
$p_len = strlen($password);

if ($u_len < 3 || $u_len > 20) {
	echo "The length of the username should be 3 ~ 20 charactor long.";
	echo "<a href='register.php'>Try a new one</a>";
	exit;
}

elseif ($p_len < 6 || $p_len > 40) {
	echo "The length of the password should be 6 ~ 40 charactor long.";
	echo "<a href='register.php'>Try a new one</a>";
	exit;
}

// valid username and password entered
else {
	$crypted_p = crypt($password);
	$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
	
	if(!$stmt) {
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	
	$stmt->bind_param('ss', $username, $crypted_p);
	$stmt->execute();
	$stmt->close();
	
	echo "You have successfully registered!" . "<br>";
	echo "<a href='login.php'>Login now!</a>";
}


?>