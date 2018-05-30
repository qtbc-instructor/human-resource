<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>スキル追加完了画面</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/material.min.css">
  <link rel="stylesheet" type="text/css" href="./css/styles.css">
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
  
<h3>スキル追加完了画面</h3>
<h4>スキル追加しました。</h4>
<?php 
session_start();
require_once("./PDO.php");

$skillList = $_POST["skillList"];

foreach($skillList as $value){
  $sql = "INSERT INTO skill_table VALUES('',:id,:skill)";
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':id',$_SESSION["id"],PDO::PARAM_INT); 
  $stm->bindValue(':skill',$value,PDO::PARAM_STR); 
  $stm->execute();
}
 ?>
 <script type="text/javascript">
 function move (){window.location = "index.php";}
 setTimeout(move, 5000);
 </script>

</div>
</div>
<footer class="demo-footer mdl-mini-footer"></footer>
</main>
</div>
</body>
</html>