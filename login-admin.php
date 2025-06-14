<?php
$message="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["username"]!="" && $_POST["password"]!=""){
        require_once "connection.php";
        connection::setConnection();
        $pdo=connection::getConnection();
        $sql="SELECT * FROM admins WHERE username=:username AND password=:password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":username"=>$_POST['username'],
            ":password"=>$_POST['password']
        ]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            session_start();
            $_SESSION["admin"]=$_POST['username'];
            header('location: dashboard.php');
            exit();
        }else{
            $message= "login faild";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
      body {
      background-color: #D3D3D3;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    form {
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 5px;
      box-shadow: 0 0 5px #cccccc;
      display: flex;
      flex-direction: column;
      margin: auto;
      max-width: 400px;
      padding: 20px;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }

    input[type="text"],
    input[type="password"] {
      border: 1px solid #cccccc;
      border-radius: 3px;
      font-size: 16px;
      margin-bottom: 10px;
      padding: 10px;
      width: 100%;
    }

    input[type="submit"] {
      background-color: #808080;
      border: none;
      border-radius: 3px;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      padding: 10px;
      width: 100%;
    }

    p {
      color: #ff0000;
      text-align: center;
    }
    </style>
</head>
<body>
    <form method="post">
        <h1>Login Admin</h1>
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <input type="submit" value="Login">
        <input type="submit" value="User login"name="log" <?php if(isset($_POST['log'])){header("location: login.php");}?>>
        <p> 
        </p>
    </form>
</body>
</html>