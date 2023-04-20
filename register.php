<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./register.css">
    <title>Register Now</title>
</head>
<body>
    <main class="bg"></main>
    <form action="./registerSuccess.php" method="post" name="login-form">
            <div class="loginBox">
                <p id="loginTitle">Register</p>
                <?php if(isset($msg)){
                    print_r($logins);
                 echo $msg;
                 } ?>

                <label for="name" class="credentials"><b>Username</b></label>
                <input type="text" placeholder="Username" name="name" class="inputBox" ><br>

                <label for="pass"><b>Password</b></label>
                <input type="password" placeholder="Password" name="pass" class="inputBox"><br>

                <button type="submit" id="register" name="submit">Register</button>

            </div>
        </form>
</body>
</html>