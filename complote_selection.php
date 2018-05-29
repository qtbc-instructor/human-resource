<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>変更完了画面</title>
</head>
<body>
  <?php
  session_start();
  require_once("./PDO.php");
  
  $sql = "INSERT INTO	status (status) VALUES (:value)";
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':value',$_SESSION["status"],PDO::PARAM_INT); 
  $stm->execute();
  ?>
  <h1>変更完了画面</h1>
  <p>変更完了しました。</p>
  <script type="text/javascript">
  function move (){window.location = "index.php";}
  setTimeout(move, 5000);
  </script>
  
</body>
</html>