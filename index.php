<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ログイン画面</title>
</head>

<body>
  <!-- 登録済みアカウントログインフォーム -->
  <div>
    <form method="post" action="">
      <ul>
        <li><label>メールアドレス：<input type="email" name="login_address" placeholder="メールアドレスを入力"></label></li>
        <li><label>パスワード：<input type="password" name="login_pass" placeholder="パスワードを入力"></label></li>
        <li>
          <label><input type="radio" name="select_page" value="company">企業用</label>
          <label><input type="radio" name="select_page" value="lecture">講師用</label>
        </li>
        <input type="submit" value="ログイン">
      </ul>
    </form>
  </div>


  <!-- 新規アカウントログインフォーム -->
  <div>
        <label>新規登録はコチラ：
          <a href="entry_company.php">企業用</a>
          <a href="entry_lecture.php">講師用</a></labael>
  </div>
</body>
</html>
