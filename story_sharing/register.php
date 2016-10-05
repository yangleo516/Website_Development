<!DOCTYPE html>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="login.css" media="screen">
    	<title>Register</title>
    </head>
    <body style="background-image: url(loginbg.jpg);">
    <img src="logintitle.jpg" alt="login title img" style="width:500px;height:200px;">
        <div class="loginbox">
        <form action="isRegister.php" method="POST">
            
            <label>Create a username: </label>
            <input type="text" name="username" id="username"/>
            <br/>
            <label>The length of the username should be 3 ~ 20 charactor long.</label><br />
            
            <label>Create a password: </label>
            <input type="password" name="password" id="password"/>
            <br/>
            <label>The length of the password should be 6 ~ 40 charactor long.</label><br />
            
            <input type="submit" value="register" name="register"/>
        </form>
    </body>
</html>