<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen">
        <title>delete a file</title>
    </head>
    <body style="background-image:url(image/showbg.jpg);">
        <?php
        session_start();
        $filename = $_GET['filename'];
        $username = $_SESSION['id'];
        
        
        $full_path = sprintf("/home/yleo/userfile/%s/%s",$username,$filename);
        if(unlink($full_path)) {
        	echo "<h1>Delete file successfully.</h1><br>";
        	echo "<a href='logout.php'>log out</a>";
        	echo "<br>";
        	echo "<a href='action.php'>Manage my file</a>";
        }
        else {
        	echo "<h1>Unable to delete $filename </h1><br>";
        	echo "<a href='logout.php'>log out</a>";
        	echo "<br>";
        	echo "<a href='action.php'>Manage my file</a>";
        }
        
        ?>
    </body>
</html>