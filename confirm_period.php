<?php
session_start();
$completeURL = "complete_period.php";

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>確認ページ</title>
  </head>
  <body>
    <?php
    $begin = $_SESSION['begin'] = $_POST['begin'];
    $end = $_SESSION['end'] = $_POST['end'];
    if($end<=$begin){
      echo "入力値が間違っています。";
    }else{
      echo $begin," 〜 ",$end," を追加します。<br>";
      echo "<button onclick=\"location.href='{$completeURL}'\">送信</button>";
    }
     ?>

   <hr>
   <button onclick="location.href='add_period.php'">戻る</button>
  </body>
</html>
