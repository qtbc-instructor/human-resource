<?php 
require_once("./util.php");
  //データベースユーザ
  $user = 'root';
  $password = 'mariadb';
  // 利用するデータベース
  $dbname = 'lcmatching_db';
  // MySQLサーバ
  $host = 'localhost:3306';
  // MySQLのDSN文字列
  $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
  
  // MySQLに接続する
  try{
    $pdo = new PDO($dsn, $user, $password);
    //プリペードステートメント
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //例外がスローされる設定にする
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "データベース{$dbname}に接続しました。";"<br>";
  } catch (Exception $e){
     echo '<span class="error">エラーがありました。</span><br>';
     echo $e->getMessage();
     exit();
   }        
 ?>