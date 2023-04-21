<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $filename = "players.txt";
    $file = fopen($filename, "r");
    while (!feof($file)) {
      $line = fgets($file);
      $user = unserialize(trim($line));
      if ($user['username'] == 'raymond')
      {
        
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    //  echo "Username: ".$user['username']." ";
    //  echo "Score: ". $user['score']." ";
     // echo "Time: ". $user['time']."<br>";
      }
    }
    ?>
</body>
</html>