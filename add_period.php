<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>日付登録</title>
  </head>
  <body>
    <form action="confirm_period.php" method="post">
      <ul>
        <li>
          <label>初日：
            <input type="date" name="begin" placeholder="初日">
          </label>
        </li>
        <li>
          <label>最終日：
            <input type="date" name="end" placeholder="最終日">
          </label>
        </li>
        <li>
          <input type="submit" value="確認">
        </li>
      </ul>
    </form>
    <hr>
    <button onclick="location.href='lecture_mainpage.php'">戻る</button>
  </body>
</html>
