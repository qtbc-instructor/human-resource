<?php
session_start();
<<<<<<< HEAD
session_destroy(); ?>
=======

killSession();
// セッションを破棄する
function killSession(){
  // セッション変数の値を空にする
  $_SESSION = [];
  // セッションクッキーを破棄する
  if (isset($_COOKIE[session_name()])){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()-36000, $params['path']);
  }
  // セッションを破棄する
  session_destroy();
}
 ?>


>>>>>>> feature/entry
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン画面</title>
<<<<<<< HEAD
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
=======
</head>

<body>
  <?php
  require_once("./FormCheck.php");

  echo $_POST["login_address"];

  if(!isset($_POST["login_address"])){
    echo "未入力項目があります。";
  }

  // if($value == "sex" && !in_array($_POST[$value],$check_sex)){
  //   $err[] = $value."　の送られたデータが不正です。";
  // }




   ?>



>>>>>>> feature/entry
  <!-- 登録済みアカウントログインフォーム -->
  <div>
    <form method="post" id="loginForm">
      <ul>
        <li><label>メールアドレス：<input type="email" name="login_address" placeholder="メールアドレスを入力" id="email" value=""></label></li>
        <li><label>パスワード：<input type="password" name="login_pass" placeholder="パスワードを入力" value="" id="password"></label></li>
        <li>
          <label><input type="radio" name="select_page" value="company" id="target_company">企業用</label>
          <label><input type="radio" name="select_page" value="lecture" id="target_lecture">講師用</label>
        </li>
        <input type="submit" value="ログイン" id="loginButton">
      </ul>
    </form>
  </div>

  <!-- 新規アカウントログインフォーム -->
  <div>
    <label>新規登録はコチラ：
      <a href="entry_company.php">企業用</a>
      <a href="entry_lecture.php">講師用</a>
    </label>
  </div>
<<<<<<< HEAD
</div>
       </div>
       <footer class="demo-footer mdl-mini-footer"></footer>
     </main>
   </div>
=======

>>>>>>> feature/entry
  <script type="text/javascript">
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var loginButton = document.getElementById("loginButton");

<<<<<<< HEAD
    //email.onblur = function(){ chkRegEmail(email.value);};
=======
  //  email.onblur = function(){ chkRegEmail(email.value);};
>>>>>>> feature/entry
    //password.onblur = function(){ isHanAlpha(password);};

    function chkRegEmail(str){
      var Seiki=/[!#-9A-~]+@+[a-z0-9]+.+[^.]$/i;
      if(str!=""){
<<<<<<< HEAD
        if(!str.match(Seiki)){
          alert("メールアドレスの形式が不正です");
          return false;
        }
      } else {
        alert("メールアドレスを入力してください");
        return false;
=======
        if(str.match(Seiki)){
          alert(str.match(Seiki)+"\n\nメールアドレスの形式は正しいです");
        } else {
          alert("メールアドレスの形式が不正です");
        }
      } else {
        alert("メールアドレスを入力してください");
>>>>>>> feature/entry
      }
    };

    function isHanAlpha(obj){
      var str=obj.value;
      if(str!=""){
        if(str.match(/^[A-Za-z0-9]*$/)){
<<<<<<< HEAD
          if(str.length < 6 | str.length > 12){
            alert("6文字以上12文字以内で入力して下さい");
            return false;
          }
        } else {
          alert("半角英数字で入力して下さい。");
          return false;
        }
      } else {
        alert("パスワードを入力して下さい");
        return false;
=======
          if(str.length > 6 && str.length < 12){
            alert("6文字以上12文字以内で入力して下さい");
          }
        } else {
          alert("半角英数字で入力して下さい。");
        }
      } else {
        alert("パスワードを入力して下さい")
>>>>>>> feature/entry
      }
    };

    // 企業・講師選択ボタン
    loginButton.addEventListener('click', function() {
      var loginForm = document.getElementById( "loginForm" ) ;
      var loginForm_selected = loginForm.select_page ;
      var selected_value = loginForm_selected.value ;

      if(selected_value === "company"){
<<<<<<< HEAD
        loginForm.setAttribute('action','sample.php');
        loginForm.submit();
      } else if(selected_value === "lecture"){
        loginForm.setAttribute('action','lecture_mainpage.php');
=======
        alert("company");
        loginForm.setAttribute('action','company_mainpage.php');
        loginForm.submit();
      } else if(selected_value === "lecture"){
        alert("lecture");
        loginForm.setAttribute('action','sample.php');
>>>>>>> feature/entry
        loginForm.submit();
      } else {
        alert("企業・講師を選択して下さい。");
      }
    });
  </script>
</body>
</html>
