<?php
//=============================================================================
// Contents   : 入力値が正値である場合、DBに追加し登録完了
// FileName   : insert_lecture.php
// Author     : yamada
// LastUpdate : 2018/5/29
// Since      : 2018/5/25
//=============================================================================

session_start();
require_once("Util.php");

$_SESSION['name'] = $_POST['name'];
$_SESSION['tel'] = $_POST['tel'];
$_SESSION['address'] = $_POST['address'];
$_SESSION['pass'] = $_POST['pass'];

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>登録完了画面</title>
</head>

<body>
  <div>
    <?php
    //db情報
    $user = 'root';
    $password = 'mariadb';
    $dbName = 'lcmatching_db';
    $host = 'localhost:3306';
    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

    //フォームからPOSTされた値を取り出す
    $name = $_POST['name'];
    $tel = $_POST['tel'];
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
      $sql = "INSERT INTO lecture (name,tel,mail_address,pass) VALUES (:name,:tel,:mail_address,:pass)";
      $stm = $pdo->prepare($sql);//プリペアドステートメントの作成

      //プレースホルダに値をバインド
      $stm->bindValue(':name',$name,PDO::PARAM_STR);
      $stm->bindValue(':tel',$tel,PDO::PARAM_STR);
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
    } catch (Exception $e) {//例外が起きた場合
      echo '<span class="error">入力した電話番号かメールアドレスは、既に使用されています。</span><br>';
      //echo $e->getMessage();
      ?>
      <form method="post" action="entry_lecture.php">
      <input type="submit" value="戻る">
    </form>
    <?php
      exit();
      }
     ?>
   </div>
  </body>
  </html>
