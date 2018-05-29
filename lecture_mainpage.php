<?php
require_once("lib/Util.php");
session_start();
$err = false;
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
         if(isset($_POST['login_address'])){
           $lecture_mail_address = $_POST['login_address'];
           $_SESSION['login_address'] = $lecture_mail_address;
         }else if(isset($_SESSION['login_address'])){
           $lecture_mail_address = $_SESSION['login_address'];
         }else{$err = true;}
         if(isset($_POST['login_pass'])){
           $lecture_pass = $_POST['login_pass'];
           $_SESSION['login_pass'] = $lecture_pass;
         }else if($_SESSION['login_pass']){
           $lecture_pass = $_SESSION['login_pass'];
         }else{$err=true;}
         if($err == true){
           throw new Exception("ログイン情報が未入力");
         }

         //データベース接続
         $pdo = new PDO($dsn,$user,$password);//接続
         $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//エミュレーション無効
         $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//例外がスローされる
         echo "データベース{$dbName}に接続しました。<br>";

         //講師検索
         $sql = "select id,name from lecture where mail_address=\"{$lecture_mail_address}\" and pass=\"{$lecture_pass}\";";
         $stm = $pdo->prepare($sql);
         $stm->execute();
         $result = $stm->fetchAll(PDO::FETCH_ASSOC);

         //講師名表示
         if(count($result)==0){
           throw new Exception("ログインに失敗しました。");
         }
         foreach ($result as $lecture_info) {
           echo "<h3>ID:",$id = $_SESSION['id']=$lecture_info['id'],"<br>講師名:",$lecture_name = $lecture_info['name'],"さんの登録情報</h3>";
         }

         //日付検索
         $sql = "select begin,end from lecture inner join freeday on lecture.id = freeday.lecturer_id where lecture.name='{$lecture_name}';";
         $stm = $pdo->prepare($sql);
         $stm->execute();
         $result = $stm->fetchAll(PDO::FETCH_ASSOC);

         //日付検索結果
         echo "<form action='confirm_delete_period.php' method='post'>";
         echo "<table border=1>";
         echo "<thead><tr>";
         echo "<th colspan = '3'>登録日</th>";
         echo "</tr></thead>";
         echo "<tbody>";
         if(!count($result)==0){
           foreach ($result as $day) {
             echo "<tr>";
             echo "<td><input type='checkbox' name='delete_period[]' value=\"{$day['begin']}\">";
             echo $day['begin']," 〜 ",$day['end'],"</td>";
             echo "</tr>";
           }
         }else{
          echo "<tr><td colspan='3'>登録日なし</td></tr>";
         }
         echo "</tbody>";
         echo "</table>";
         echo "<input type='submit' value='選択期間削除'>";
         echo "</form>";
         echo "<button onclick=\"location.href='add_period.php'\">日付追加</button>";

         //スキル表示
         $sql = "select skilltype,skill_id from skill_table inner join skill_master on skill_master.id = skill_table.skill_id inner join lecture on lecture.id = skill_table.lecturer_id where lecturer_id = \"{$id}\";";
         $stm = $pdo->prepare($sql);
         $stm->execute();
         $result = $stm->fetchAll(PDO::FETCH_ASSOC);
         echo "<form action='confirm_delete_skill.php' method='post'>";
         echo "<table border=1>";
         echo "<thead><tr>";
         echo "<th>登録スキル</th>";
         echo "</tr></thead>";
         echo "<tbody>";

         if(!count($result)==0){
           foreach ($result as $skill) {
             echo "<tr>";
             echo "<td><input type='checkbox' name='delete_skill[]' value=\"{$skill['skilltype']}\">";
             echo "{$skill['skilltype']}</td>";
             echo "</tr>";
           }
         }else{
          echo "<tr><td>登録スキルなし</td></tr>";
         }
         echo "</tbody>";
         echo "</table>";
         echo "<input type='submit' value='選択スキル削除'>";
         echo "</form>";
         echo "<button onclick=\"location.href='add_skill.php'\">スキル追加</button>";

       }catch(Exception $e){
         echo '<span>エラー：</span>';
         echo $e->getMessage();
       }
        ?>

      <hr>
      <button onclick="location.href='index.php'">ログイン画面へ</button>
     </div>
   </body>
 </html>
