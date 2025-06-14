<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: login-admin.php");
    exit();
}
$admin = $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home admin</title>
    <style>
   body {
      background-color: #D3D3D3;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    a {
      background-color: #D3D3D3;
      border: none;
      border-radius: 3px;
      color: black;
      cursor: pointer;
      display: inline-block;
      font-size: 16px;
      margin-top: 20px;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    a:hover {
      background-color: #696969;
    }
    </style>
</head>
<body>
  <a href="pick-number.php"> Add New Survey</a>
  <br>
  <a href="visualization.php"> Show Visualization</a>
  <br>
  <a href="analyse_answer.php"> Analyse Answers</a>
  <br>
  <a href="login-admin.php">Log out</a>
</body>
</html>