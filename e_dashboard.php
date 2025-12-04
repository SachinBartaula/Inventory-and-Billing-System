<?php
session_start();

if(!isset($_SESSION["username_session"]) || $_SESSION["role_session"] !== "employee") {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 

    <marquee><h1>Site still in process.....</h1></marquee>
</body>
</html>