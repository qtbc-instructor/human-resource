<?php
session_start();
$delete_period = [];
if(isset($_POST['delete_period'])){
  $delete_period = $_POST['delete_period'];
  $_SESSION['delete'] = $delete_period;
}
$id = $_SESSION['id'];
$completeURL = "complete_delete_period.php";
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
    <title>削除確認</title>
  </head>
  <body>
    日付削除：確認<br>
    <?php
    if(!count($delete_period)==0){
      try{
        $pdo = new PDO($dsn,$user,$password); //接続
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); //エミュレーション無効
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //例外がスローされる

        $begin_end=[];
        foreach ($delete_period as $begin) {
          $sql = "select begin,end from freeday where lecturer_id={$id} and begin='{$begin}'" ;
          $stm = $pdo->prepare($sql);
          $stm->execute();
          $result = $stm->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $day ) {
            echo $day['begin']," 〜 ",$day['end'],"<br>";
            $begin_end = [ $day['begin'] => $day['end'] ];
          }
        }
        echo "以上の日付を削除します。<br>";
        echo "<button onclick=\"location.href='{$completeURL}'\">削除</button>";

      }catch(Exception $e){
        echo '<span class="error">エラーがありました。</span><br>';
        echo $e->getMessage();
      }
    }else{
      echo "日付が選択されていません。";
    }
     ?>
     <hr>
     <button onclick="location.href='lecture_mainpage.php'">戻る</button>
  </body>
</html>
