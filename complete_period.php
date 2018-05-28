<?php
session_start();
$user = 'root';
$password = 'mariadb';
$dbName = 'lcmatching_db';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

$id = $_SESSION['id'];
$begin = $_SESSION['begin'];
$end = $_SESSION['end'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>完了</title>
  </head>
  <body>
    <?php
    try {
      $pdo = new PDO($dsn,$user,$password);//接続
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//エミュレーション無効
      $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//例外がスローされる
      // echo "データベース{$dbName}に接続しました。"
      echo "<h1>",$id,"<br>",$begin,"<br>",$end,"</h1>";
      $sql = "insert into freeday values('','{$id}','{$begin}','{$end}')";
      $stm = $pdo->prepare($sql);
      $stm->execute();
    }catch(Exception $e) {

    }
     ?>
    <hr>
    <button onclick="location.href='lecture_mainpage.php'">戻る</button>
  </body>
</html>
