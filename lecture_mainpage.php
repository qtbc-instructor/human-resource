<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>講師ログイン画面</title>
</head>
<body>
  <?php   
  session_start();
  require_once("./PDO.php");

  $sql = "SELECT * FROM lecture WHERE mail_address=:ad and pass=:pa";
  $stm = $pdo->prepare($sql);
  // $stm->bindValue(':ad',$_POST["login_address"],PDO::PARAM_STR);   $stm->bindValue(':pa',$_POST["login_pass"],PDO::PARAM_STR);
  $stm->bindValue(':ad',"nagai@gmail.com",PDO::PARAM_STR);   $stm->bindValue(':pa',"naga11111",PDO::PARAM_STR);
  
  $stm->execute();
  $result = $stm->fetch(PDO::FETCH_ASSOC);  
  $lecture_id = $result['id'];
  
  $sql = "SELECT *
    FROM lecture as l
    INNER JOIN freeday as f ON l.id = f.lecturer_id
    INNER JOIN status as s ON l.id = s.id
    INNER JOIN company as c ON c.id = s.company_id
    INNER JOIN status_master stm ON s.status = stm.id
    INNER JOIN skill_table as st ON l.id = st.lecturer_id
    INNER JOIN skill_master as sm ON st.skill_id = sm.id
    WHERE l.id = :id";
  
  $stm = $pdo->prepare($sql);
  $stm->bindValue(':id',$lecture_id,PDO::PARAM_INT); 
  $stm->execute();
  
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);
  ?>
  
  <h3>名前</h3>
  <h1>登録日時表示</h1>
  <table border="1">
    <tr>
      <td>認証</td>
      <td>取り消し</td>
      <td>企画名</td>
      <td>期間</td>
      <td>スキル</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
   <h1>通知</h1>
   <form method="post" action="confirm_selection.php">
   <table border="1">
     <tr>
       <td>認証</td>
       <td>拒否</td>
       <td>企業名</td>
       <td>期間</td>
       <td>スキル</td>
     </tr>
     <?php
     foreach ($result as $row) { 
       $_SESSION["status"] = $row["status"];
       $_SESSION["company_name"] = $row["company_name"];;
       $_SESSION["begin"] = date('Y年n月j日', strtotime($row["begin"]));
       $_SESSION["end"] = date('Y年n月j日', strtotime($row["end"]));
       $_SESSION["skilltype"] = $row["skilltype"];
       ?>
      <tr>
       <td><input type='radio' name='status_check' value='1' id='approval' checked ></td>
       <td><input type='radio' name='status_check' value='3' id='cancel' ></td>
       <td><input type="hidden" name="select" id="select" value=""></td>
       <td><?php echo $row["company_name"]; ?></td>
       <td><?php echo date('Y年n月j日', strtotime($row["begin"]))," ~ ",date('Y年n月j日', strtotime($row["end"])); ?></td>
       <td><?php echo $row["skilltype"]; ?></td>
       </tr>
     <?php } ?>
     <br>
     <?php var_dump($result); ?>
     <br>
     
  </table>
  <input type="submit" value="送信" id="sendButton">
  <form>
  <script type="text/javascript">  
    var sendButton = document.getElementById("sendButton");
  
    sendButton.addEventListener('click',function(){
      var radioSelect = document.getElementsByClassName("status_check").value;
      document.getElementById("select").value = radioSelect;    
    });
  </script>  
    
    
  <style type="text/css">
  h3 {
    width: 30%;
    border-bottom: 2px solid #333;
  }
  </style>
</body>
</html>