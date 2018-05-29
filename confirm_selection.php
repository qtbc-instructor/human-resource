<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>変更確認画面</title>
</head>
<body>
  <?php 
    session_start();
  ?>
  <h1>通知変更画面</h1>
  <p>表示確認</p>
  <form method="post" action="complote_selection.php">
    <table border="1">
        <tr>
          <td id="labelChange">認証</td>
          <td>企業名</td>
          <td>日付</td>
          <td>スキル</td>
        </tr>
        <tr>
          <td>&Omicron;</td>
          <td><?php echo $_SESSION["company_name"]; ?></td>
          <td><?php echo $_SESSION["begin"]," ~ ",$_SESSION["end"]; ?></td>
          <td><?php echo $_SESSION["skilltype"]; ?></td>
        </tr>
    </table>
    <input type="submit" value="送信する"> 
  </form>    
  </table>
  
  <a href="lecture_mainpage.php"><button>戻る</button></a>
  <script type="text/javascript">
  console.log("test");
  console.log(<?php echo $_POST["status_check"]; ?>);
  var radioSelect = <?php echo $_POST["status_check"]; ?>;
  if(radioSelect === 3){
    document.getElementById("labelChange").innerText = "拒否";
  } 
  </script>
  
  <style type="text/css">
  h1{
    width: 30%;
    border-bottom: 1px solid #333;
  }
  </style>
</body>
</html>