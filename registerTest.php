<?php
  // Initialize variables
  $username = "";
  $email = "";
  $password = "";
  $confirm_password = "";
  $errors = array();

  // Process form data when form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    if (empty(trim($_POST["username"]))) {
      $errors[] = "Please enter a username.";
    } else {
      $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["email"]))) {
      $errors[] = "Please enter an email address.";
    } else {
      $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
      $errors[] = "Please enter a password.";
    } else {
      $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
      $errors[] = "Please confirm your password.";
    } else {
      $confirm_password = trim($_POST["confirm_password"]);
      if ($password != $confirm_password) {
        $errors[] = "Passwords do not match.";
      }
    }

    // If no errors, process registration
    if (count($errors) == 0) {
      // Create user array
      $user = array(
        'username' => $username,
        'email' => $email
        'password' => $password
      );

      // Save user to file
      $filename = "users.txt";
      $file = fopen($filename, "a");
      fwrite($file, serialize($user) . "\n");
      fclose($file);

      // Redirect to login page
      header("location: login.php");
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
</head>
<body>
  <h2>Registration Form</h2>
  <?php if (count($errors) > 0) : ?>
    <div>
      <?php foreach ($errors as $error) : ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <form method="post">
    <div>
      <label>Username:</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div>
      <label>Email:</label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div>
      <label>Password:</label>
      <input type="password" name="password">
    </div>
    <div>
      <label>Confirm Password:</label>
      <input type="password" name="confirm_password">
    </div>
    <div>
      <button type="submit">Register</button>
    </div>
  </form>
</body>
</html>