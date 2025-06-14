<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: login-admin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose number</title>
    <style>
     body {
      background-color: #D3D3D3;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    form {
      background-color: white;
      border: 1px solid #cccccc;
      border-radius: 5px;
      box-shadow: 0 0 5px #cccccc;
      margin: auto;
      max-width: 400px;
      padding: 20px;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }

    input[type="number"] {
      border: 1px solid #cccccc;
      border-radius: 3px;
      font-size: 16px;
      margin-bottom: 10px;
      padding: 10px;
      width: 100%;
    }

    input[type="submit"] {
      background-color: #696969;
      border: none;
      border-radius: 3px;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      padding: 10px;
      width: 100%;
    }
    a {
      background-color: #D3D3D3;
      border: none;
      border-radius: 3px;
      color: black;
      cursor: pointer;
      display: inline-block;
      font-size: 16px;
      margin-top: 20px ;
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
<form action="add-survey.php" method="get">
    <p>Enter number of quastions</p>
    <input type="text" placeholder="Choose number" name="countQ">
    <input type="submit" value="GO">
</form>
</body>
<footer>
   <a href="login-admin.php"> Log out </a>
</footer>
</html>