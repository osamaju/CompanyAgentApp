<?php
if (isset($_GET['countQ']) || isset($_SESSION['countQ'])) {
    session_start();
    $_SESSION['countQ'] = $_GET['countQ'];

} else {
    header('location: pick-number.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'connection.php';
    connection::setConnection();
    $conn=connection::getConnection();
    $sql = "insert into surveys values(null,:title,:details)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':title'=> $_POST['title'],
        ':details'=>$_POST['content']
    ]);
    $id_survey=$conn->lastInsertId();
    $sql="insert into questions values (null,:title,:id_survey)";
    $stmt = $conn->prepare($sql);
    $questions=$_POST['questions'];
    foreach($questions as $question){
        $stmt->execute([
            ':title'=> $question,
            ':id_survey'=>$id_survey
        ]);
    }
    echo "survey added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new survey</title>
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
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 5px;
      box-shadow: 0 0 5px #cccccc;
      margin: auto;
      max-width: 800px;
      padding: 20px;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }

    input[type="text"],
    textarea {
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

    label {
      font-weight: bold;
      margin-top: 20px;
    }

    p {
      font-size: 18px;
      margin-bottom: 10px;
      margin-top: 20px;
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

    <form method="post">
    <a href="dashboard.php">Home</a>
        <a href="login-admin.php">Log out</a>
        <?php
        echo "<p>Title: </p>";
        echo "<input type='text' name='title'>";
        echo "<p>Content: </p>";
        echo '<textarea name="content" id="" cols="30" rows="10" ></textarea>';
        for ($i = 0; $i < $_SESSION['countQ']; $i++) {
            echo "<p>Q" . ($i + 1) . "</p>";
            echo "<input type='text' name='questions[]'>";
        }
        ?>
        <input type="submit" value="Save">
    </form>

</body>

</html>