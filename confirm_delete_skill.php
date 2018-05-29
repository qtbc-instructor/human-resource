<?php
session_start();
$delete_skill = [];
$completeURL = "complete_delete_skill.php";

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>スキル削除</title>
   </head>
   <body>
     <?php

      if(isset($_POST['delete_skill'])){
        echo "日付削除：確認<br>";
        $delete_skill = $_POST['delete_skill'];
        $_SESSION['delete_skill'] = $delete_skill;
        foreach ($delete_skill as $skill) {
          echo $skill,"<br>";
        }
        echo "以上のスキルを削除します。<br>";
        echo "<button onclick=\"location.href='{$completeURL}'\">削除</button>";

      }else{
        echo "削除するスキルが選択されていません。";
      }
      ?>
      <hr>
      <button onclick="location.href='lecture_mainpage.php'">戻る</button>
   </body>
 </html>
