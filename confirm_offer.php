<!DOCTYPE>
<html>
<head>
  <mata charset="utf-8">
    <title>確認</title>
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
        // echo "<pre>";
        // var_dump($results);
        // echo "<pre>";
      ?>

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


      $begin = $_POST['begin'];
      var_dump($begin);
      $check = $_POST['check'];
      var_dump($check);
      $ID = $_POST['ID'];
      
      foreach($results as $row) {
        if(($_POST($row['id'])){
          echo "<tr>";
          echo "<td>",$row['id'],"</td>";
          echo "<td>",$row['name'],"</td>";
          echo "<td>",$row['tel'],"</td>";
          echo "<td>",$row['mail_address'],"</td>";
          echo "<td>",$row['skill'],"</td>";
          echo "<td>",$row['begin'],"</td>";
          echo "</tr>";
        } else {
          echo "当てはまる講師はいません。";
        }
      }
      echo "<tbody>";
      echo "</table>";

    } catch (Exception $e){
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
      exit();
    }


    ?>

       <form method="POST" action="lecture_mainpage.php">
         <ul>
           <input type="button" value="戻る" onclick="location.href='search_result.php'">
           <input type="submit" value="送信する" onclick="location.href='complete_company.php'">
         </ul>
       </form>
       <div>
       </body>
     </html>
