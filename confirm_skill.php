<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>スキル追加確認画面</title>
  <link rel="stylesheet" type="text/css" href="./css/reset.css">
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
  <h4>スキル追加確認画面</h4>
  <p>スキル追加してよろしいでしょうか？</p>
  <form method="post" action="complote_skill.php">
  <table>
    <tr><td>選択スキル</td></tr>
  <?php 
    $selection_list = $_POST["skilllist"];
    foreach($selection_list as $value){ ?>
      <tr><td><?php echo $value; ?><input type="hidden" name="skillList[]" value="<?php echo $value?>"></td><tr>
  <?php  }?>
  </table>
  <input type="submit" value="送信する">
  <a href="add_skill.php"><button>戻る</button></a>
  </form>
</div>
</div>
<footer class="demo-footer mdl-mini-footer"></footer>
</main>
</div>
  
</body>
</html>