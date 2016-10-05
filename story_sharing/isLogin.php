<?php
session_start();

require 'database.php';
 
$stmt = $mysqli->prepare("SELECT COUNT(*), id, password FROM users WHERE username=?");

$userInput = $_POST['username'];
$stmt->bind_param('s',$userInput);
$stmt->execute();

$stmt->bind_result($count, $userid, $pwd_hash);
$stmt->fetch();
 
$pwdInput = $_POST['password'];

if( $count == 1 && crypt($pwdInput, $pwd_hash)==$pwd_hash){
	$_SESSION['username'] = $userInput;
	$_SESSION['userid'] = $userid;
	header("Location:display.php");
}
else{
	echo "Login failed. Invalid username or password"."<br><br>";
	echo "<a href='login.php'>Login again</a>";
}

?>