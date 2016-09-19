<?php
session_start();
$filename = $_GET['filename'];
$username = $_SESSION['id'];

$full_path = sprintf("/home/yleo/userfile/%s/%s",$username,$filename);
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);
        
header("Content-Type: ".$mime);
readfile($full_path);
?>