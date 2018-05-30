<?php
//=============================================================================
// Contents   : 新規企業画面での入力フォームの値を確認
// FileName   : confirm_company.php
// Author     : yamada
// LastUpdate : 2018/5/29
// Since      : 2018/5/25
//=============================================================================

session_start();
require_once("Util.php");
require_once("ErrorCheck.php");
$gobackURL = "entry_company.php";

//文字エンコードの検証
if(!Util::cken($_POST)){
  header("Location:{$gobackURL}");
  exit();
}

//セッション変数に格納
$_SESSION['name'] = $_POST['name'];
$_SESSION['tel'] = $_POST['tel'];
$_SESSION['staff'] = $_POST['staff'];
$_SESSION['address'] = $_POST['address'];
$_SESSION['pass'] = $_POST['pass'];

//エラーチェック
$check = new ErrorCheck();
$errorCheck = $check->validation($_POST,"company");

//エラー発生時
if(count($errorCheck)>0){
  $_SESSION['errors'] = $errorCheck;
  header("location:{$gobackURL}");
  exit();
}
//エラー無し
else{
  $_SESSION['errors'] = NULL;
  $name = $_POST['name'];
  $tel = $_POST['tel'];
  $staff = $_POST['staff'];
  $mail_address = $_POST['address'];
  $pass = $_POST['pass'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>登録内容確認</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./material.min.css">
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body>
  <div>
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

<div>
  <p>登録内容確認</P>
  <p>確認して、問題がなければ登録ボタンを押してください。</p>

    <!--登録内容一覧表示 -->
    <table border="1">
      <tr><th>企業名</th><td><?php echo $name; ?></td></tr>
      <tr><th>電話番号</th><td><?php echo $tel; ?></td></tr>
      <tr><th>担当者氏名</th><td><?php echo $staff; ?></td></tr>
      <tr><th>メールアドレス</th><td><?php echo $mail_address; ?></td></tr>
      <tr><th>パスワード</th><td><?php echo $pass; ?></td></tr>
    </table>
  </div>

  <div>
    <form method="post" action="insert_company.php">
      <!-- hiddenで登録完了ページに値を渡す -->
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="tel" value="<?php echo $tel; ?>">
      <input type="hidden" name="staff" value="<?php echo $staff; ?>">
      <input type="hidden" name="address" value="<?php echo $mail_address; ?>">
      <input type="hidden" name="pass" value="<?php echo $pass; ?>">
      <input type="submit" value="登録"><!--完了ページへ移行-->
    </form>
    <button onclick="location.href='entry_company.php'">戻る</button><!--入力ページに戻る-->
  </div>
</div>
<footer class="demo-footer mdl-mini-footer"></footer>
</main>
</div>
</body>
</html>
