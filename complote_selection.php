<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>変更完了画面</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/material.min.css">
  <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
</head>
<body>
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
  <?php
  session_start();
  require_once("./PDO.php");
  
  $sql = "INSERT INTO	status (status) VALUES (:value)";
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':value',$_SESSION["status"],PDO::PARAM_INT); 
  $stm->execute();
  ?>
  <h3>変更完了画面</h3>
  <p>変更完了しました。</p>
</div>
</div>
<footer class="demo-footer mdl-mini-footer"></footer>
</main>
</div>
  <script type="text/javascript">
  function move (){window.location = "index.php";}
  setTimeout(move, 5000);
  </script>
  
</body>
</html>