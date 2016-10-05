
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="login.css" media="screen">
        <title>login page</title>
    </head>
    <body style="background-image: url(loginbg.jpg);">
    <img src="logintitle.jpg" alt="login title img" style="width:500px;height:200px;">
        <div class="loginbox">
        <form action="isLogin.php" method="POST">
            <label>Username: </label>
            <input type="text" name="username" id="username"/>
            <br/>
            <label>Password: </label>
            <input type="password" name="password" id="password"/>
            <br/>
            <input type="submit" value="login" name="submit"/>
        </form>
        </div>
        <div class="guest">
        <a href="guestLogin.php">Login as a guest</a>
        &nbsp;&nbsp;
        <a href="register.php">Register</a>
        </div>
    </body>
</html>