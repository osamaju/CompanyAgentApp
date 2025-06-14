<?php
$message="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_POST["email"]!="" && $_POST["password"]!=""){
        require_once "connection.php";
        connection::setConnection();
        $pdo=connection::getConnection();
        $sql="SELECT * FROM users WHERE email=:email AND password=:password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":email"=>$_POST['email'],
            ":password"=>$_POST['password']
        ]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            session_start();
            $_SESSION["user"]=$_POST['email'];
            header('location: home.php');
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
    <title>Login </title>
    <style>
body {
  background-color: #D3D3D3;
  font-family: Arial, sans-serif;
  height: 100vh;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

form {
  background-color: #fff;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  padding: 32px;
  width: 400px;
}

h1 {
  font-size: 24px;
  margin-bottom: 16px;
}

input[type="email"],
input[type="password"] {
  border: none;
  border-bottom: 2px solid #ccc;
  font-size: 16px;
  margin-bottom: 16px;
  padding: 8px 0;
  transition: border-color 0.3s ease;
  width: 100%;
}

input[type="email"]:focus,
input[type="password"]:focus {
  border-color: #808080;
  outline: none;
}

input[type="submit"] {
  background-color: #A9A9A9	;
  border: none;
  border-radius: 4px;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  margin-top: 16px;
  padding: 12px 24px;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #696969;
}

p {
  color: #ff0000;
  font-size: 14px;
  margin-top: 16px;
}

    </style>
</head>
<body>
    <form method="post">
        <h1>Login</h1>
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="password">
        <input type="submit" value="Login">
        <p>
            <?php
              echo $message 
              ?>
        </p>
        <p> Don't have user? sign up here</P> <input type="submit" value="Sign up"name="signup" <?php if (isset($_POST["signup"])){header('location: signup.php');}?>>
        <p> Are you admin ? click here</P> <input type="submit" value="Go"name="login-admin" <?php if (isset($_POST["login-admin"])){header('location: login-admin.php');}?>>
      </form>
</body>
</html>