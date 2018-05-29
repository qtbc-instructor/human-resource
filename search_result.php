<!DOCTYPE>
<html>
<head>
  <mata charset="utf-8">
    <title>検索結果</title>
</head>
  <body>
    <div>

  <?php
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

      $sql = "SELECT * FROM lecture";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $results = $stm->fetchAll(PDO::FETCH_ASSOC);
      echo "<pre>";
      var_dump($results);
      echo "<pre>";
      ?>

      <form method="POST" action="confirm_offer.php">
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
        echo "<td>",'<input type="checkbox" name="check[]" value=',$row['id'],'>',"</td>";
        echo "<td>",$row['id'],"</td>";
        echo "<td>",$row['name'],"</td>";
        echo "<td>",$row['tel'],"</td>";
        echo "<td>",$row['mail_address'],"</td>";
        echo "<td>",$row['skill'],"</td>";
        echo "<td>",$row['freeday'],"</td>";
        echo "</tr>";
      }
      echo "<tbody>";
      echo "</table>";

      } catch (Exception $e){
        echo '<span class="error">エラーがありました。</span><br>';
        echo $e->getMessage();
        exit();
      }

      $error = [];
      if(isSet($_POST["name"])){
        $names = ($_POST["name"]);
        $diffValue = array_diff($_POST["name"], $names);
        if(count($diffValue)==0){
          $nameChecked = $_POST["name"];
        } else {
          $nameChecked = [];
          $error[] = "エラーです";
        }
      } else {
        $nameChecked = [];
      }


      ?>
      <input type="button" value="戻る" onclick="location.href='company_mainpage.php'">
      <input type="submit" value="決定">
    </ul>
  </form>
    </div>
  </body>
</html>
