<!DOCTYPE>
<html>
<head>
  <mata charset="utf-8">
    <title>検索結果</title>
</head>
  <body>
    <div>
  <?php
      $date = $_POST['date'];
      $mozi = mb_substr($date, 0, 7);
      $firstDate = $mozi.'-00';
      $lastDate = $mozi.'-31';
      $wantSkill = $_POST['skill'];
      $user = 'root';
      $password = 'mariadb';
      $dbName = 'lcmatching_db';
      $host = 'localhost:3306';
      $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
      try{
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "データベース{$dbName}に接続しました。","<br>";

      $sql = "SELECT * FROM lecture JOIN freeday ON lecture.id = freeday.lecturer_id JOIN skill_table ON lecture.id = skill_table.lecturer_id WHERE freeday.begin BETWEEN '$firstDate' AND '$lastDate'  AND skill_table.skill_id = '$wantSkill'";
      $stm = $pdo->query($sql);
      $results = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo "<pre>";
      var_dump($results);
      echo "<pre>";
      ?>

        <form method="POST" action="confirm_offer.php">
          <?php
          //テーブルのタイトル行
          echo "<table class>";
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
          echo "<td>",'<input type="checkbox" name="check[]" value=',$row['id'],'>',"</td>";
          echo "<td>",$row['id'],"</td>";
          echo "<td>",$row['name'],"</td>";
          echo "<td>",$row['tel'],"</td>";
          echo "<td>",$row['mail_address'],"</td>";
          echo "<td>",$row['skill_id'],"</td>";
          echo "<td>",$row['begin'],"</td>";
          $array = array($row['id']);
          $ID = implode(",", $array);
          echo $ID;
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
    </div>
  </body>
</html>
