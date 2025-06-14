<?php
class analyse
{
   function get_users_count($id_survey)
   {
      $sql = "SELECT COUNT(*) as count FROM (SELECT u.id FROM users u JOIN users_answers uw ON u.id=uw.id_user JOIN surveys sv ON uw.survey_id=sv.id JOIN answers ans ON uw.id_answer=ans.id WHERE sv.id=:id_survey GROUP BY(u.id)) tb;";
      require_once 'connection.php';
      connection::setConnection();
      $conn = connection::getConnection();
      $stmt = $conn->prepare($sql);
      $stmt->execute([
         ':id_survey' => $id_survey
      ]);
      return $row["count"];
   }
   function get_answer_quastion_count($id_survey, $id_quastion, $id_answer)
   {
      $sql = "SELECT COUNT(*) as count FROM (SELECT u.id FROM users u JOIN users_answers uw ON u.id=uw.id_user JOIN surveys sv ON uw.survey_id=sv.id JOIN answers ans ON uw.id_answer=ans.id WHERE sv.id=:id_survey AND uw.id_quastion=:id_quastion AND uw.id_answer=:id_answer GROUP BY(u.id)) tb;";
      require_once 'connection.php';
      connection::setConnection();
      $conn = connection::getConnection();
      $stmt = $conn->prepare($sql);
      $stmt->execute([
         ':id_survey' => $id_survey,
         ':id_quastion' => $id_quastion,
         ':id_answer' => $id_answer,
      ]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row["count"];
   }
   function get_count_surveys_answer()
   {
      $sql = "SELECT COUNT(*) as count ,surveys.title FROM( SELECT DISTINCT users_answers.survey_id,users_answers.id_user FROM users_answers) tb INNER JOIN surveys ON tb.survey_id = surveys.id GROUP BY(tb.survey_id);;";
      require_once 'connection.php';
      connection::setConnection();
      $conn = connection::getConnection();
      $stmt = $conn->query($sql);
      $stmt->execute();
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $row;
   }
   function get_ddl_question($id)
   {
      $sql="select q.id,q.title from questions q JOIN surveys sv ON q.id_survey=sv.id where sv.id=:id;";
      require_once 'connection.php';
      connection::setConnection();
      $conn = connection::getConnection();
      $stmt = $conn->prepare($sql);
      $stmt->execute([
         ":id"=>$id
      ]);
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo "<option selected disabled>Select Question</option>";
      foreach ($row as $q){
         echo "<option value='".$q['id']."'>".$q['title']."</option>";
      }
   }
   function get_ddl_answer($id)
   {
      $sql="select id,value from answers";
      require_once 'connection.php';
      connection::setConnection();
      $conn = connection::getConnection();
      $stmt = $conn->query($sql) ;
      $stmt->execute();
      $row= $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo "<option selected disabled>Select Answer</option>";
      foreach ($row as $a){
         echo "<option value='".$a['id']."'>".$a['value']."</option>";
      };
   }
   function get_result($id_survey,$id_quastion,$id_answer)
   {
      echo $this->get_answer_quastion_count($id_survey,$id_quastion,$id_answer);
   }
}
