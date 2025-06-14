<?php
session_start();
if(!isset($_SESSION['user'])){
   header('location:login.php');
}
require_once 'connection.php';
connection::setConnection();
$conn=connection::getConnection();
$sql="select * from surveys";
$stmt=$conn->query($sql);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
  background-color: #D3D3D3;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

h2 {
  margin: 20px;
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
<body >
 <h3>There Are many surveys, Choose what do you want and then answer it!</h3>
<?php
for($i=0;$i<count($result);$i++){
    echo '<h2><a href="survey.php?id='.$result[$i]['id'].'" target="_blank">'.$result[$i]["title"].'</a></h2>';
}
// echo "<a href='home.php'>Home</a>";
 echo "<a href='login.php'>Log out</a>";
?>
</body>
</html>