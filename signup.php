<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST)) {
        require_once "connection.php";
        connection::setConnection();
        $pdo = connection::getConnection();
        $sql = "insert into users values(null,:fullname,:password,:email)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":fullname" => $_POST['fullname'],
            ":password" => $_POST['password'],
            ":email" => $_POST['email'],
        ]);
        echo"You have signed up successfuly!";
        header('location: login.php');
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  padding: 30px;
  width: 400px;
}

h1 {
  font-size: 32px;
  margin-bottom: 20px;
  text-align: center;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  border: none;
  border-radius: 5px;
  font-size: 16px;
  margin-bottom: 10px;
  padding: 10px;
  width: 100%;
  background-color: #f5f5f5;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
  outline: none;
  box-shadow: 0 0 5px #ccc;
  background-color: #fff;
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
    </style>
</head>

<body>
    <form method="post">
        <h1>Signup</h1>
        <input type="text" placeholder="Fullname" name="fullname">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Password" name="password">
        <input type="submit" value="signup">
        <p> have user? Log in here</P> <input type="submit" value="Log in"name="login" <?php if (isset($_POST["login"])){header('location: login.php');}?>>
    </form>
</body>

</html>