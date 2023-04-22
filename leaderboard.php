<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./leaderboard.css" type="text/css" rel="stylesheet">
    <title> Leaderboard! </title>
</head>
<body>
  
   <?php
    
    $newuser; //declare new user variable
    // We search through the players.txt file to find a certain user's data. Continues until end of file.
    $filename = "players.txt";
    $file = fopen($filename, "r");
    while (!feof($file)) { //while there's still content within the file...
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
 
<div id="table"> 
        <br>
        <table id="scoreboard" >
            <caption> <span> Leaderboard </span> </caption>
            <tr>
                <th> User </th>
                <th> Score </th>
                <th> Time </th>
            </tr>
            <tr>
                <td> Name </td>
                <td> Score </td>
                <td> Time </td>
            </tr>
        </table>
    </div>
</body>
</html>