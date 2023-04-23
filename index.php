<?php

session_start();


$username = "";
$password = "";
$missing = array();
// The code within only activates when the form button is POSTED.
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
// Checks if name is empty after removing white space from username input
  if (empty(trim($_POST["name"]))) {
// If it is then a message is added to missing array
    $missing[] = "Please enter a username!";
  } else {
// Otherwise if the username is present, it is added from POST array to $username variable
    $username = trim($_POST["name"]);
  }
// Checks if password is empty after removing white space from password input
  if (empty(trim($_POST["pass"]))) {
// If it is then a message is added to missing array
    $missing[] = "Please enter a password.";
  } else {
// Otherwise if the password is present, it is added from POST array to $password variable
    $password = trim($_POST["pass"]);
  }

// If no missing messages are present then if_block runs which creates an array of the player's date...
  if (count($missing) == 0) {
// The players.txt file is read line by line until a matching username and password is found on the same line. 
    $filename = "players.txt";
    $file = fopen($filename, "r");
    while (!feof($file)) {
      $line = fgets($file);
      $player = unserialize(trim($line));
// If a match is found, then the username, score and time is stored in a session variable so it can be reached among different pages.
      if ( ($player["username"] == $username) && ($player["password"] == $password) ) 
      {
        $_SESSION['username'] = $username;
        $_SESSION['score'] = 0;
        $_SESSION['time'] = 0;
// The player is officially logged in and is redirected to the GoL.html page.
        header("location: GoL.html"); 
        exit();
      }
    }
    $missing[] = "Invalid username or password.";
    fclose($file);
  }
}
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>Homepage</title>
</head>
<body>
  
<div id="menu">
            <ul>
                <li>
                    <a href="index.php"> Login </a>
                </li>

                <li>
                    <a href="register.php"> Register </a>
                </li>

                <li>
                    <a href="leaderboard.php"> Leaderboard </a>
                </li>
            </ul>
        </div>
    
    <main class="bg"></main>
        <form method="post" name="login-form">
            <div class="loginBox">
              
                <p id="loginTitle">LOGIN</p>
                <!-- This php block displays the missing messages if any are present -->
                <?php if (count($missing) > 0) : ?>
                <div>
                <?php foreach ($missing as $missing) : ?>
                <p id='error'><?php echo $missing; ?></p>
                <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <label for="name" class="credentials"><b>Username</b></label>
                <input type="text" placeholder="Username" name="name" class="inputBox" ><br>

                <label for="pass"><b>Password</b></label>
                <input type="password" placeholder="Password" name="pass" class="inputBox"><br>

                <button id="register" name="register"><a id="regLink" href="./register.php">Register</a></button>

                <button type="submit" id="submit" name="submit">Login</button>

            </div>
        </form>
</body>
</html>