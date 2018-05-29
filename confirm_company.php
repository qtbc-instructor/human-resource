<?php
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
</head>

<body>
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
    <form method="post" action="complete_entry_company.php">
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
</body>
</html>
