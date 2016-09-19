<!DOCTYPE html>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen">
        <title>Share your files</title>
    </head>
    <body style="background-image:url(image/showbg.jpg);">
    <?php
    	session_start();
    	$_SESSION['id'] = $_GET['userid'];                 // SESSION variable
        $id = $_SESSION['id'];
   		$isIn = false;
		
		// check if user is in the list. If it does redirect the user to mamage files
		// otherwise redirect the user to login again
   		$ids = fopen("/home/yleo/users/users.txt","r");
   		while(!feof($ids)) {
   			if($id == trim(fgets($ids))) {
   				$isIn = true;
   			}
   		}
   		if($isIn == false) {
   			echo "<h1>Invalid ID, try it again.</h1><br/>";
            echo "<a href='login.php'>login</a> <br>";
            echo "<a href='logout.php'>log out</a><br>";
   			exit;
   		}
        else {
			echo "<h1>Welcome $id</h1><br/>";
			// check if the user has a personal directory. If not make one for him.
			$personalDir = sprintf("/home/yleo/userfile/%s",$id);
			if(!file_exists($personalDir)) {
				mkdir($personalDir);
			}
            echo"<a href='action.php'>Manage my files</a><br>";
            echo "<a href='createId.html'>create a new id</a><br>";
            echo"<a href='logout.php'>Log out</a><br>";
        }
    ?>
    </body>
</html>