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

    // We search through the players.txt file to find a certain user's data. Continues until end of file.
    $filename = "players.txt";
    $file = fopen($filename, "r");
    while (!feof($file)) {
      $line = fgets($file);
      $user = unserialize(trim($line));
    // Once found, we update their data into a new associative array, newUser
      if ($user['username'] == $_SESSION['username'])
      {
        $newUser = $user;
        $newUser['score'] = 1000;
        $newUser['time'] = 60;
        echo "<pre>";
        print_r($newUser);
        echo "</pre>";
      }
    }

    // Your new associative array is added to the end of players.txt
    $filename = "players.txt";
    $file = fopen($filename, "a");
    fwrite($file, "\n".serialize($newUser));
    fclose($file); 

    $filename = "players.txt";
    $file = fopen($filename, "r+");

    while (!feof($file)) {
      $line = fgets($file);
      // check if the line contains the keyword
      if (strpos($line, $_SESSION['username']) !== false) {
      // delete the line by moving the file pointer to the beginning of the line and writing an empty string
          fseek($file, -strlen($line), SEEK_CUR);
          fwrite($file, str_repeat(" ", strlen($line)));
          break; 
      }
  }

  fclose($file);
    ?> 
</body>
</html>