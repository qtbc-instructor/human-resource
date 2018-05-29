<?php
session_start();
?>

<!DOCTYPE>
<html>
<head>
  <mata charset="utf-8">
    <title>確認</title>
  </head>
  <body>
    <div>

      <?php
      $error = [];
      // var_dump($_SESSION["data"]);
        if(!empty($_SESSION['date'])){
          $date = $_SESSION['date'];
        } else {
          $error[] = "";
        }
       ?>
      <?php
          $check = $_POST['check'];
           var_dump($check);
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
          echo "データベース{$dbName}に接続しました。","<br>";

          //チェックボックスのチェック判定
          $sql = "SELECT * FROM lecture JOIN status ON lecture.id = status.lecture_id JOIN skill_table ON lecture.id = skill_table.lecturer_id WHERE lecture_id = '$check'";

          $stm = $pdo->query($sql);
          $results = $stm->fetchAll(PDO::FETCH_ASSOC);

      ?>

      <form method="POST" action="complete_company.php">
        <ul>

  <?php
          echo "<table>";
          echo "<thead><tr>";
          echo "<th>","ID","</th>";
          echo "<th>","名前","</th>";
          echo "<th>","電話番号","</th>";
          echo "<th>","アドレス","</th>";
          echo "<th>","スキル","</th>";
          echo "<th>","日付","</th>";
          echo "</tr></thead>";

      foreach($results as $row) {
          echo "<tr>";
          echo "<td>",$check,"</td>";
          echo "<td>",$row['name'],"</td>";
          echo "<td>",$row['tel'],"</td>";
          echo "<td>",$row['mail_address'],"</td>";
          echo "<td>",$row['skill_id'],"</td>";
          echo "<td>",$row['begin'],"</td>";
          echo "</tr>";
      }
          echo "<tbody>";
          echo "</table>";

    } catch (Exception $e) {
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
      exit();
    }
  ?>

           <input type="button" value="訂正する" onclick="location.href='search_result.php'">
           <input type="submit" value="送信する">
         </ul>
       </form>
     <div>
       </body>
     </html>
