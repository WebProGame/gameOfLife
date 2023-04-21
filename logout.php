<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./logout.css">
    <title>Logout</title>
</head>
<body>
    <main class="bg"></main>
    <div id='backing'>
        <p>You have been logged out!</p>
        <a href="index.php">HOME</a>
    </div>
</body>
</html>