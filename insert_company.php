<?php
//=============================================================================
// Contents   : 入力値が正値である場合、DBに追加し登録完了
// FileName   : insert_company.php
// Author     : yamada
// LastUpdate : 2018/5/29
// Since      : 2018/5/29
//=============================================================================

session_start();
require_once("Util.php");

$_SESSION['name'] = $_POST['name'];
$_SESSION['tel'] = $_POST['tel'];
$_SESSION['staff'] = $_POST['staff'];
$_SESSION['address'] = $_POST['address'];
$_SESSION['pass'] = $_POST['pass'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登録完了画面</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./material.min.css">
    <link rel="stylesheet" type="text/css" href="./styles.css">
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

  <div>
    <?php
    //DB情報
    $user = 'root';
    $password = 'mariadb';
    $dbName = 'lcmatching_db';
    $host = 'localhost:3306';
    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

    //フォームからPOSTされた値を取り出す
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $staff = $_POST['staff'];
    $mail_address = $_POST['address'];
    $pass = $_POST['pass'];

    //DBに接続
    try {
      $pdo = new PDO($dsn,$user,$password);
      //プリペアドステートメントのエミュレーションを無効にする
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      //例外がスローされる設定にする
      $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      //SQL文の作成
      $sql = "INSERT INTO company (company_name,tel,staff,mail_address,pass) VALUES (:company_name,:tel,:staff,:mail_address,sha2(:pass,256))";
      $stm = $pdo->prepare($sql);//プリペアドステートメントの作成

      //プレースホルダに値をバインド
      $stm->bindValue(':company_name',$name,PDO::PARAM_STR);
      $stm->bindValue(':tel',$tel,PDO::PARAM_STR);
      $stm->bindValue(':staff',$staff,PDO::PARAM_STR);
      $stm->bindValue(':mail_address',$mail_address,PDO::PARAM_STR);
      $stm->bindValue(':pass',$pass,PDO::PARAM_STR);

      //SQL文の実行
      if($stm->execute()){
        echo "<p>新規登録完了しました。</p>";
        echo "<form method='post' action='index.php'>";
        echo "<input type='submit'  value='ログインページへ'>";
        echo "</form>";
      }else {
        echo '<span class="error">追加エラーがありました。</span><br>';
      }
      $pdo = NULL;
    } catch (Exception $e) {
      echo '<span class="error">入力した電話番号かメールアドレスは、既に使用されています。</span><br>';
      ?>
      <form method="post" action="entry_company.php">
      <input type="submit" value="戻る">
    </form>
    <?php
      exit();
      }
     ?>
   </div>
 </div>
 </div>
 <footer class="demo-footer mdl-mini-footer"></footer>
 </main>
 </div>
  </body>
  </html>
