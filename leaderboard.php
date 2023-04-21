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

<div id="table"> 
        <br>
        <table id="scoreboard" >
            <caption> <span> Leaderboard </span> </caption>
            <tr>
                <th> Rank </th>
                <th> User </th>
                <th> Score </th>
            </tr>
            <tr>
                <td> 1 </td>
                <td> Wubzy </td>
                <td> Score </td>
            </tr>
        </table>
    </div>

</body>
</html>