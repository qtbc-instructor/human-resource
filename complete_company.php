<!DOCTYPE>
<html>
  <head>
    <mata charset="utf-8">
      <title>完了</title>
  </head>
  <body>
    <div>
      <p>申し込みが完了しました。</p>
      <?php
      $user = 'root';
      $password = 'mariadb';
      $dbName = 'lcmatching_db';
      $host = 'localhost:3306';
      $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

      //データベースに接続
      try{
      $pdo = new PDO($dsn, $user, $password);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "データベース{$dbName}に接続しました。","<br>";

      $sql = "UPDATE status SET status = 0";
      $stm = $pdo->query($sql);
      $results = $stm->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
      exit();
    }
      ?>

       <form method="POST" action="company_mainpage.php">
         <ul>
           <input type="submit" value="完了/戻る">
         </ul>
       </form>
     </div>
   </body>
 </html>
