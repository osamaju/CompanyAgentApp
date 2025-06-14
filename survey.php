<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
if (!isset($_GET['id'])) {
    header('location:home.php');
}
require_once 'connection.php';
connection::setConnection();
$conn = connection::getConnection();
$id_survey = $_GET['id'];
$sql = "SELECT * from questions WHERE id_survey=:id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id_survey]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "select id from users where email=:email";
$stmt = $conn->prepare($sql);
$stmt->execute([':email' => $_SESSION['user']]);
$id_user = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "select active from user_answer_state where id_user=:id_user AND id_survey=:id_survey";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id_user' => $id_user,
        ":id_survey" => $id_survey
    ]);
    $is_not_answered = empty($stmt->fetch(PDO::FETCH_ASSOC)) ? true : false;
    if ($is_not_answered == true) {

        $sql = "insert into users_answers values(null,:id_user,:id_question,:id_answer,:id_survey)";
        $stmt = $conn->prepare($sql);
        $answers = $_POST['answers'];
        $quastions = $rows;
        $index = 0;
        foreach ($answers as $id_answer) {
            $stmt->execute([
                ':id_user' => $id_user,
                ':id_question' => $quastions[$index]['id'],
                ':id_answer' => $id_answer,
                ":id_survey" => $id_survey
            ]);
            $index++;
        }
        $sql = "INSERT INTO user_answer_state VALUES(:id_user,:id_survey,:active)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id_user' => $id_user,
            ":id_survey" => $id_survey,
            ':active' => 1
        ]);
    } else {
        echo "<p style='color:red;'>You have already answerd!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surveys</title>
    <style>
        body {
  background-color: #D3D3D3;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

form {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  margin: auto;
  max-width: 600px;
  padding: 20px;
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
  text-align: center;
}

label {
  display: block;
  font-size: 18px;
  margin-bottom: 10px;
}

input[type="radio"] {
  margin-right: 10px;
}

input[type="submit"] {
  background-color: #A9A9A9;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  margin-top: 20px;
  padding: 10px;
  width: 100%;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #696969;
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
p {
  color: red;
  text-align: center;
  margin-top: 10px;
}
    </style>
</head>

<body>
    <form method="POST">
        <?php
        foreach ($rows as $quastion) {
            echo $quastion['title'] . "<br>";
            echo "<lable for='answer" . $quastion['id'] . "'>نعم</lable>";
            echo "<input type='radio' id='answer" . $quastion['id'] . "' name='answers[]" . $quastion['id'] . "' value='1'></br>";

            echo "<lable for='answer" . $quastion['id'] . "'>لا</lable>";
            echo "<input type='radio' id='answer" . $quastion['id'] . "'  name='answers[]" . $quastion['id'] . "' value='2'></br>";
        }
        ?>
        <input type="submit">
        <a href="home.php">Home</a>
        <a href="login.php">Log out</a>
    
    </form>
</body>

</html>