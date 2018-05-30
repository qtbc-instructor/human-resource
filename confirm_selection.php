<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>変更確認画面</title>
  <link rel="stylesheet" type="text/css" href="./css/reset.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/material.min.css">
  <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body>
  <?php 
    session_start();
  ?>
  <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
  <header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
  <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">人材マッチングシステム</span>
        </div>
      </header>
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
  <h4>通知変更画面</h4>
  <form method="post" action="complote_selection.php">
    <table>
        <tr>
          <td id="labelChange">認証</td>
          <td>企業名</td>
          <td>日付</td>
          <td>スキル</td>
        </tr>
        <tr>
          <td>○</td>
          <td><?php echo $_SESSION["company_name"]; ?></td>
          <td><?php echo $_SESSION["begin"]," ~ ",$_SESSION["end"]; ?></td>
          <td><?php echo $_SESSION["skilltype"]; ?></td>
        </tr>
    </table>
    <input type="submit" value="送信する"> 
  </form>    
  </table>
  
  <a href="lecture_mainpage.php"><button>戻る</button></a>
</div>
</div>
<footer class="demo-footer mdl-mini-footer"></footer>
</main>
</div>
  <script type="text/javascript">
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
  tr,td{text-align: center;}
  </style>
</body>
</html>