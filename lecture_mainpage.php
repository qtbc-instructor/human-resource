<?php
require_once("lib/Util.php");
session_start();

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
     <title>講師メインページ</title>
   </head>
   <body>
     <div>
       <?php
       try{
         //データベース接続
         $pdo = new PDO($dsn,$user,$password);//接続
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//エミュレーション無効
         $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//例外がスローされる
         echo "データベース{$dbName}に接続しました。";

         //講師名表示
         if(isset($_POST['login_address'])){
           $lecture_mail_address = $_POST['login_address'];
           $_SESSION['login_address'] = $lecture_mail_address;
         }else{
           $lecture_mail_address = $_SESSION['login_address'];
         }
         if(isset($_POST['login_pass'])){
           $lecture_pass = $_POST['login_pass'];
           $_SESSION['login_pass'] = $lecture_pass;
         }else{
           $lecture_pass = $_SESSION['login_pass'];
         }
         $sql_lecture_name = "select id,name from lecture where mail_address=\"{$lecture_mail_address}\" and pass=\"{$lecture_pass}\";";
         $stm_lecture_name = $pdo->prepare($sql_lecture_name);
         $stm_lecture_name->execute();
         $result_lecture_name = $stm_lecture_name->fetchAll(PDO::FETCH_ASSOC);
         foreach ($result_lecture_name as $lecture_info) {
           echo "<h3>ID:",$_SESSION['id']=$lecture_info['id'],"<br>講師名:",$lecture_name = $lecture_info['name'],"さんの登録情報</h3>";
         }

         //日付用
         $sql = "select begin,end from lecture inner join freeday on lecture.id = freeday.lecturer_id where lecture.name='{$lecture_name}';";
         $stm = $pdo->prepare($sql);
         $stm->execute();
         $result = $stm->fetchAll(PDO::FETCH_ASSOC);

         //日付用テーブル作成
         echo "<table border=1>";
         echo "<thead><tr>";
         echo "<th colspan = '3'>登録日</th>";
         echo "</tr></thead>";
         echo "<tbody>";

         //検索結果表示
         foreach ($result as $row) {
           echo "<tr>";
           echo "<td>",Util::es($row['begin']),"</td>";
           echo "<td>〜</td>";
           echo "<td>",Util::es($row['end']),"</td>";
           echo "</tr>";
         }
         echo "</tbody>";
         echo "</table>";

       }catch(Exception $e){
         echo '<span class="error">エラーがありました。</span><br>';
         echo $e->getMessage();
         exit();
       }
        ?>
      <button onclick="location.href='add_period.php'">日付追加</button>
      <hr>
      <button onclick="location.href='index.php'">戻る</button>
     </div>
   </body>
 </html>
