<?php
//$userfile = fopen("users.txt", "w") or die("Unable to open file!");
$user = $_POST['username'];

// check if user has already existed in the user list 
$isIn = false;
$ids = fopen("/home/yleo/users/users.txt","r");
   		while(!feof($ids)) {
   			if($user == trim(fgets($ids))) {
   				$isIn = true;
   			}
   		}
if($isIn) {
	echo "user exists; unable to create";
	exit;
}
file_put_contents("users.txt", "\n", FILE_APPEND); 
file_put_contents("users.txt", $user, FILE_APPEND);
$personalDir = sprintf("/home/yleo/userfile/%s",$user);
			if(!file_exists($personalDir)) {
				mkdir($personalDir);
			}
echo "Create a new user successfully.<br>";
echo"<a href='action.php'>Manage my files</a>";
?>