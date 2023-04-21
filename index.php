<?php 
$username = "";
$password = "";
$missing = array();

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
  // Validate input data
  if (empty(trim($_POST["name"]))) {
    $missing[] = "Please enter a username!";
  } else {
    $username = trim($_POST["name"]);
  }

  if (empty(trim($_POST["pass"]))) {
    $missing[] = "Please enter a password.";
  } else {
    $password = trim($_POST["pass"]);
  }

  if (count($missing) == 0) {
    // Read users file
    $filename = "players.txt";
    $file = fopen($filename, "r");
    while (!feof($file)) {
      $line = fgets($file);
      $user = unserialize(trim($line));
      if ( ($user["username"] == $username) && ($user["password"] == $password) ) 
      {
        header("location: GoL.html");
        exit();
      }
      else
      {
        $missing[] = "Invalid username or password.";
      }
    }
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
    <main class="bg"></main>
        <form method="post" name="login-form">

            <?php if (count($missing) > 0) : ?>
            <div>
                <?php foreach ($missing as $error) : ?>
                <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="loginBox">
                <p id="loginTitle">LOGIN</p>
                <label for="name" class="credentials"><b>Username</b></label>
                <input type="text" placeholder="Username" name="name" class="inputBox" ><br>

                <label for="pass"><b>Password</b></label>
                <input type="password" placeholder="Password" name="pass" class="inputBox"><br>

                <button id="register" name="register"><a href="./register.php">Register</a></button>

                <button type="submit" id="submit" name="submit">Login</button>

            </div>
        </form>
</body>
</html>