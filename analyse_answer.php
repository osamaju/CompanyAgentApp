<?php
$count = -1;
$sql = "SELECT * FROM surveys";
require "connection.php";
connection::setConnection();
$conn=connection::getConnection();
$stmt=$conn->query($sql);
$stmt->execute();
$survies=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analyse Survey</title>
    <style>
        body {
  background-color:#D3D3D3;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

select {
  background-color: #fff;
  border: none;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  font-size: 16px;
  margin: 20px;
  padding: 10px;
  width: 200px;
}

h1 {
  font-size: 24px;
  margin: 20px;
  text-align: center;
}

h2 {
  font-size: 24px;
  margin: 20px;
  text-align: center;
  color: #4CAF50;
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
    <select name="survey" id="ddl-survey">
        <option selected disabled>Select survey</option>
        <?php
           foreach($survies as $val){
              echo '<option value="'.$val['id'].'">'.$val['title'].'</option>';
           } 
        ?>
    </select>
    <select name="question" id="ddl-question">
    <option selected disabled>Select question</option>
    </select>
    <select name="answer" id="ddl-answer">
    <option selected disabled>Select Answer</option>
    </select>
    <h1>عدد الناس التي جاوبت على هذا جواب  :</h1>
    <h2 id="result"></h2>
   <script src="main.js"></script>
   <a href="dashboard.php">Back</a>
   <a href="login-admin.php">Log out</a>
</body>

</html>