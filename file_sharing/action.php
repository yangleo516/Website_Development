<?php
        session_start();
        $username = $_SESSION['id'];
        $path_to_file = sprintf("/home/yleo/userfile/%s",$username);  // get the path
        $files = scandir($path_to_file);                           // list files and directory inside the path
?>
<!DOCTYPE html>
<html>
    <head>
        <title>manage your files</title>
        <link rel="stylesheet" href="stylesheet.css"/>
    </head>
    <body style="background-image:url(image/showbg.jpg);">
        <table>
            <tr>
                <th>Files</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach($files as $file) {   
            ?>
            <tr>
                <td><?php echo $file;?></td>
                <td>
                    <a href="open.php?filename=<?php echo $file;?>">Open</a>
                    <a href="delete.php?filename=<?php echo $file;?>">Delete</a>
                    <a href="share.php?filename=<?php echo $file;?>">Share</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        
        <!-- upload file -->
        <form enctype="multipart/form-data" action="uploader.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose a file to upload:</label>
            <input name="uploadedfile" type="file" id="uploadfile_input" style="border-style: solid;border-width: 1px;
            width:250px;"/>
        </p>
        <p>
        <input type="submit" value="upload" />
        </p>
        </form>
    </body>
</html>