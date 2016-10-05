<?php
// Content of database.php
$mysqli = new mysqli('localhost', 'module3_inst', 'module3_pass', 'module3_news');
 
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>