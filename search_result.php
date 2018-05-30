<?php
session_start();
// var_dump($_SESSION['company_id']);
$test2 = $_SESSION['login_address'];
var_dump($test2);
 ?>

 <?php
 function checked($value, $question){
   if(is_array($question)){
     $isChecked = in_array($value, $question);
   } else {
     $isChecked = ($value===$question);
   }
   if($isChecked){
     echo "checked";
   } else {
     echo "";
   }
 }
  ?>

<!DOCTYPE>
<html>
<head>
  <mata charset="utf-8">
    <title>検索結果</title>
</head>
  <body>
    <div>
      <p>検索結果</p>

  <?php
      if(isset($_POST['date'])){
        $_SESSION['date'] = $_POST['date'];
      }
       $date = $_SESSION['date'];
       $mozi = mb_substr($date, 0, 7);
       $firstDate = $mozi.'-00';
       $lastDate = $mozi.'-31';
      // $wantDate = $_SESSION['date'];
      $wantSkill = $_SESSION['skill'];
      $user = 'root';
      $password = 'mariadb';
      $dbName = 'lcmatching_db';
      $host = 'localhost:3306';
      $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
      //データベースに接続
      try{
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//      echo "データベース{$dbName}に接続しました。","<br>";
<<<<<<< HEAD
      $sql = "SELECT * FROM lecture JOIN status ON lecture.id = status.lecture_id JOIN skill_table ON lecture.id = skill_table.lecturer_id WHERE status.begin = '$wantDate' AND skill_table.skill_id = '$wantSkill'";
=======

      // $sql = "SELECT * FROM lecture JOIN status ON lecture.id = status.lecture_id JOIN skill_table ON lecture.id = skill_table.lecturer_id WHERE status.begin = '$wantDate' AND skill_table.skill_id = '$wantSkill'";
      $sql = "SELECT * FROM lecture JOIN freeday ON lecture.id = freeday.lecturer_id JOIN skill_table ON lecture.id = skill_table.lecturer_id WHERE freeday.begin BETWEEN '$firstDate' AND '$lastDate'";
>>>>>>> 60f85fc833955f2d5b3596fe394f2440abc98ef5
      $stm = $pdo->query($sql);
      $results = $stm->fetchAll(PDO::FETCH_ASSOC);
      // echo "<pre>";
      // var_dump($results);
      // echo "<pre>";
      // var_dump($_SESSION["data"]);
      ?>

      <form method="POST" action="confirm_offer.php" name="confirm">
        <ul>

      <?php
      //テーブルのタイトル行
      echo "<table>";
      echo "<thead><tr>";
      echo "<th>","","</th>";
      echo "<th>","ID","</th>";
      echo "<th>","名前","</th>";
      echo "<th>","電話番号","</th>";
      echo "<th>","アドレス","</th>";
      echo "<th>","スキル","</th>";
      echo "<th>","日付","</th>";
      echo "</tr></thead>";
      foreach($results as $row) {
        echo "<tr>";
        echo "<td>",'<input type="checkbox" name="check" value=',$row['id'],'>',"</td>";
        echo "<td>",$row['id'],"</td>";
        echo "<td>",$row['name'],"</td>";
        echo "<td>",$row['tel'],"</td>";
        echo "<td>",$row['mail_address'],"</td>";
        echo "<td>",$row['skill_id'],"</td>";
        echo "<td>",$row['begin'],"</td>";
        echo "</tr>";
      }
      echo "<tbody>";
      echo "</table>";
      } catch (Exception $e){
        echo '<span class="error">エラーがありました。</span><br>';
        echo $e->getMessage();
        exit();
      }
      ?>

      <input type="button" value="戻る" onclick="location.href='company_mainpage.php'">
      <input type="submit" value="決定">
    </ul>
  </form>
    <div>
  </body>
</html>
