<?php
//=============================================================================
// Contents   : 新規企業アカウントの基本情報入力フォーム
// FileName   : entry_company.php
// Author     : yamada
// LastUpdate : 2018/5/30
// Since      : 2018/5/25
//=============================================================================
//セッション開始
session_start();
require_once("Util.php");

//セッションの値を格納するための配列
$input = array(
  "name" => "",
  "tel" => "",
  "staff" => "",
  "address" => "",
  "pass" => ""
 );
//セッション変数格納
foreach ($_SESSION as $key => $value) {
  if($key == "name") $input[$key] = Util::es($value);
  else if($key == "tel") $input["tel"] = Util::es($value);
  else if($key == "staff") $input["staff"] = Util::es($value);
  else if($key == "address") $input["address"] = Util::es($value);
  else if($key == "pass") $input["pass"] = Util::es($value);
}
//エラーメッセージの有無
  if(isset($_SESSION['errors'])){
    $errorMassage = $_SESSION['errors'];
  }
  else {
    $errorMassage = NULL;
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>新規企業登録画面</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./material.min.css">
    <link rel="stylesheet" type="text/css" href="./styles.css">
</head>

<body><div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
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

  <!-- 新規企業アカウント登録フォーム -->
  <p>新規企業登録</p>
  <div>
    <form method="post" action="confirm_company.php">
      <ul>
        <li><label>企業名</label></li>
        <label>
            <input type="text" name="name" value="<?php echo $input['name']; ?>">
            <?php if(isset($errorMassage['name'])) echo $errorMassage['name']; ?>
          </label>

        <li><label>電話番号(例：090-xxxx-yyyy)</label></li>
        <label>
             <input type="tel" name="tel" value="<?php echo $input['tel']; ?>">
            <?php if(isset($errorMassage['tel'])) echo $errorMassage['tel']; ?>
          </label>

        <li><label>担当者氏名</label></li>
        <label>
            <input type="text" name="staff" value="<?php echo $input['staff']; ?>">
            <?php if(isset($errorMassage['staff'])) echo $errorMassage['staff']; ?>
          </label>

        <li><label>メールアドレス(例：xyzxyz@gmail.com)</label></li>
        <label>
            <input type="email" name="address" value="<?php echo $input['address']; ?>">
            <?php if(isset($errorMassage['address'])) echo $errorMassage['address']; ?>
          </label>

        <li><label>パスワード(半角英数で6文字以上12文字以内)</label></li>
        <label>
            <input type="password" name="pass" value="<?php echo $input['pass']; ?>">
            <?php if(isset($errorMassage['pass'])) echo $errorMassage['pass']; ?>
          </label>
          <br>

        <input type="button"  value="戻る" onclick="location.href='index.php'"><!--ログインページに戻る-->
        <input type="submit" value="確認"><!-- 入力一覧表示画面へ -->
      </ul>
    </form>
  </div>
  </div>
</div>
<footer class="demo-footer mdl-mini-footer"></footer>
</main>
</div>

</body>
</html>
