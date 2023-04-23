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

   <?php
    
    $newuser; //declare new user variable
    // We search through the players.txt file to find a certain user's data. Continues until end of file.
    $filename = "players.txt";
    $file = fopen($filename, "r");
    while (!feof($file)) { //while there's still content within the file...
      $line = fgets($file); //get a line from the file and store it into $line
      $user = unserialize(trim($line));
    // Once found, we update their data into a new associative array, newUser
      if ($user['username'] == $_SESSION['username'])
      {
        $newUser = $user;
        $newUser['score'] = 1000; //will later be updated to $_SESSION['time']
        $newUser['time'] = 60; //will later be updated to $_SESSION['score']
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
          trim($line);
          break; 
      }
  }

  fclose($file); 

  //below will be code that will access players.txt information in order to generate the table for the leaderboard
  $filename = "players.txt";
  $file = fopen($filename, "r");
  echo "<table>"; //start the table
  echo "<caption> <span> Leaderboard </span> </caption>";
  echo "<tr>  <th> User </th>   <th> Score </th>   <th> Time </th>  </tr>"; //table header created
  while(!feof($file)){
    $line = fgets($file);
    $user = unserialize(trim($line)); //unserializes the dats so we just get values we need
    //below we start generating the table rows!
    echo "<tr>  <td>" . $user['username'] . "</td>   <td>" . $user['score'] . "</td>  <td>" . $user['time'] . "</td>  </tr>";
  }
  echo "</table>"; //end the table here after the loop to generate the rows is done!

  fclose($file); 

    ?>

<!--
<div> 
        <br>
        <table>
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
-->
</body>
</html>