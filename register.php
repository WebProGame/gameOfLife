<?php
  $username = "";
  $password = "";
  $confirm_password = "";
  $score = 0;
  $time = 0;
  $missing = array();
    // The code within only activates when the form button is POSTED.
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Checks if name is empty after removing white space from username input
    if (empty(trim($_POST["name"]))) {
    // If it is then a message is added to missing array
      $missing[] = "Enter a username!";
    } else {
    // Otherwise if the username is present, it is added from POST array to $username variable
      $username = trim($_POST["name"]);
    }

    // Checks if password is empty after removing white space from password input
    if (empty(trim($_POST["pass"]))) {
    // If it is then a message is added to missing array
      $missing[] = "Enter a password!";
    } else {
    // Otherwise if the password is present, it is added from POST array to $password variable
      $password = trim($_POST["pass"]);
    }

    // Checks if password confirmation is empty after removing white space from password confirmation input
    if (empty(trim($_POST["confirmPass"]))) {
    // If it is then a message is added to missing array
      $missing[] = "Confirm your password!";
    } else {
    // Otherwise if password confirmation is present, it is added from POST array to $confirm_password variable
      $confirm_password = trim($_POST["confirmPass"]);
    // A check is done between both password inputs; if they don't match then a message is added
      if ($password != $confirm_password) {
        $missing[] = "Passwords are not matching!";
      }
    }

    // If no missing messages are present then if_block runs which creates an array of the player's date...
        if (count($missing) == 0) {
            // Create user array
            $player = array(
              'username' => $username,
              'password' => $password,
              'score' => $score,
              'time' => $time
            );
      
    // And stores that data into a text on its own line.        
            $filename = "players.txt";
            $file = fopen($filename, "a");
            fwrite($file, serialize($player)."\n");
            fclose($file);
      
    // Registration is complete and the player is redirected automatically to the index.php page to login
            header("location: index.php");
          }
        }
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
    <form method="post" name="register-form">
            <div class="loginBox">
                <p id="loginTitle">Register</p>
    <!-- This php block displays the missing messages if any are present -->
                <?php if (count($missing) > 0) : 
                    ?>
                <div>
                    <?php foreach ($missing as $missing) : 
                        ?>
                    <p class="error">
                    <?php echo $missing; 
                    ?></p>
                    <?php endforeach; 
                    ?>
                </div>
                <?php endif; ?>
                <label for="name" class="credentials"><b>Username</b></label>
                <input type="text" placeholder="Username" name="name" class="inputBox" ><br>

                <label for="pass"><b>Password</b></label>
                <input type="password" placeholder="Password" name="pass" class="inputBox"><br>

                <label><b>Confirm Password:</b></label>
                <input type="password" placeholder="Password" name="confirmPass" class="inputBox">

                <button type="submit" id="register" name="submit">Register</button>

                <p>Already have an account? <a href="index.php" id="login_link">Click here to login</a></p>

            </div>
        </form>
</body>
</html>