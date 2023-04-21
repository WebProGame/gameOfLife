<?php
  $username = "";
  $password = "";
  $confirm_password = "";
  $score = 0;
  $time = 0;
  $missing = array();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    if (empty(trim($_POST["name"]))) {
      $missing[] = "Enter a username!";
    } else {
      $username = trim($_POST["name"]);
    }

    if (empty(trim($_POST["pass"]))) {
      $missing[] = "Enter a password!";
    } else {
      $password = trim($_POST["pass"]);
    }

    if (empty(trim($_POST["confirmPass"]))) {
      $missing[] = "Confirm your password!";
    } else {
      $confirm_password = trim($_POST["confirmPass"]);
      if ($password != $confirm_password) {
        $missing[] = "Passwords are not matching!";
      }
    }

        if (count($missing) == 0) {
            // Create user array
            $user = array(
              'username' => $username,
              'password' => $password,
              'score' => $score,
              'time' => $time
            );
      
            // Save user to file
            $filename = "players.txt";
            $file = fopen($filename, "a");
            fwrite($file, serialize($user)."\n");
            fclose($file);
      
            // Redirect to login page
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
                <?php if (count($missing) > 0) : 
                    ?>
                <div>
                    <?php foreach ($missing as $error) : 
                        ?>
                    <p class="error">
                    <?php echo $error; 
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

                <p>Already have an account? <a href="index.php">Click here to login</a></p>

            </div>
        </form>
</body>
</html>