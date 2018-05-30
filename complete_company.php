<?php
session_start();

//skill_idチェック
if(empty($_SESSION["skill_id"])){
  $skill_id = "";
} else {
  $skill_id = $_SESSION["skill_id"];
  var_dump($skill_id);
}

//日付チェック
if(empty($_SESSION["date"])){
  $begin = "";
} else {
  $begin = $_SESSION["date"];
  var_dump($begin);
}

//lecture_idチェック
  var_dump($_SESSION['check']);
//アドレス、ID確認
var_dump($_SESSION['company_id']);
$company_id = $_SESSION['company_id'];
$test2 = $_SESSION['login_address'];
var_dump($test2);
?>

<!DOCTYPE>
<html>
<head>
  <mata charset="utf-8">
    <title>完了</title>
  </head>
  <body>
    <div>
<<<<<<< HEAD
      <p>送信完了しました。</p>
=======
      <p>申し込みが完了しました。</p>
      <?php
      $check = $_SESSION['check'];
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

      $sql = "INSERT INTO status VALUES
      ('',  '{$check}', '{$skill_id}', '{$begin}', '{$company_id}', '', 0)";
      $stm = $pdo->prepare($sql);
      $stm->execute();

    } catch (Exception $e) {
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
      exit();
    }
      ?>
>>>>>>> 60f85fc833955f2d5b3596fe394f2440abc98ef5

       <form method="POST" action="company_mainpage.php">
         <ul>
           <input type="submit" value="戻る">
         </ul>
       </form>
       <div>
       </body>
     </html>
