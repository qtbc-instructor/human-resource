<?php
session_start();
$delete_period = $_SESSION['delete'];
$id = $_SESSION['id'];

//データベース用
$user = 'root';
$password = 'mariadb';
$dbName = 'lcmatching_db';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>削除完了</title>
  </head>
  <body>
    <?php
    try {
      $pdo = new PDO($dsn,$user,$password); //接続
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); //エミュレーション無効
      $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //例外がスローされる
      echo "日付削除：完了<br>";
      //表示
      foreach ($delete_period as $begin) {
        $sql = "select begin,end from freeday where lecturer_id={$id} and begin='{$begin}'" ;
        $stm = $pdo->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $day ) {
          echo $day['begin']," 〜 ",$day['end'],"<br>";
        }
        $sql = "delete from freeday where lecturer_id={$id} and begin='{$begin}'" ;
        $stm = $pdo->prepare($sql);
        $stm->execute();
      }

      echo "以上の日付を削除しました。";
    } catch (Exception $e) {
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
    }

     ?>
     <hr>
     <button onclick="location.href='lecture_mainpage.php'">メインページへ</button>
  </body>
</html>
