<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>講師ログイン画面</title>
  <link rel="stylesheet" type="text/css" href="./css/reset.css">
  <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/material.min.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body>
  <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
  <header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
  <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Material Design Lite</span>
        </div>
      </header>
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
  <?php 
  session_start();
  require_once("./PDO.php");
  try{
    if(isset($_POST['login_address'])){
      $lecture_mail_address = $_POST['login_address'];
      $_SESSION['login_address'] = $lecture_mail_address;
    }else if(isset($_SESSION['login_address'])){
      $lecture_mail_address = $_SESSION['login_address'];
    }else{$err = true;}
    
    if(isset($_POST['login_pass'])){
      $lecture_pass = $_POST['login_pass'];
      $_SESSION['login_pass'] = $lecture_pass;
    }else if($_SESSION['login_pass']){
      $lecture_pass = $_SESSION['login_pass'];
    }else{$err=true;}
    
    if($err == true){
      throw new Exception("ログイン情報が未入力");
    }
  
    //講師検索
    $sql = "select id,name from lecture where mail_address=\"{$lecture_mail_address}\" and pass=\"{$lecture_pass}\";";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    //講師名表示
    if(count($result)==0){ throw new Exception("ログインに失敗しました。");}
  
    foreach ($result as $lecture_info) {
      echo "<h4>ID:",$id = $_SESSION['id']=$lecture_info['id'],"<br>講師名:",$lecture_name = $lecture_info['name'],"さんの登録情報</h4>";
    }

    //日付検索
    $sql = "select begin,end from lecture inner join freeday on lecture.id = freeday.lecturer_id where lecture.name='{$lecture_name}';";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    ?>
  
    <!--日付検索結果 -->
    <form action='confirm_delete_period.php' method='post'>
      <table border="1">
        <thead><tr><th colspan="3">登録日</th></tr></thead>
        <tbody>
          <?php
          if(!count($result)==0){
            foreach ($result as $day) {  ?>
              <tr><td><input type='checkbox' name='delete_period[]' value=\"{$day['begin']}\">
                <?php echo $day['begin']," 〜 ",$day['end']; ?></td>
              </tr>
            <?php  }
          }else{ ?>
            <tr><td colspan="3">登録日なし</td></tr>
          <?php } ?>
        </tbody>
      </table>
      <input type='submit' value='選択期間削除'>
    </form>
    <button onclick="location.href='add_period.php'">日付追加</button>
  <?php
    //スキル表示
    $sql = "select skilltype,skill_id 
      from skill_table 
      inner join skill_master on skill_master.id = skill_table.skill_id 
      inner join lecture on lecture.id = skill_table.lecturer_id 
      where lecturer_id = \"{$id}\";";
  
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <form action="confirm_delete_skill.php" method="post">
        <table border="1">
          <thead><tr><th>登録スキル</th></tr></thead>
            <tbody>
              <?php
              if(!count($result)==0){
                foreach ($result as $skill) { ?>
                  <tr>
                    <td>
                      <input type="checkbox" name="delete_skill[]" value="<?php echo $skill['skilltype'];?>">
                      <?php echo $skill['skilltype'];?>
                    </td>
                  </tr>
                <?php } 
              }else{ ?>
                <tr><td>登録スキルなし</td></tr>
              <?php } ?>
            </tbody>
          </table>
          <input type='submit' value='選択スキル削除'>
        </form>
        <button onclick="location.href='add_skill.php'">スキル追加</button>
        <?php
      }catch(Exception $e){
        echo '<span>エラー：</span>';
        echo $e->getMessage();
  } ?>
  <hr>
  <button onclick="location.href='index.php'">ログイン画面へ</button>
<?php
$sql = "SELECT * FROM lecture WHERE mail_address=:ad and pass=:pa";
$stm = $pdo->prepare($sql);
$stm->bindValue(':ad',$_SESSION["login_address"],PDO::PARAM_STR);  $stm->bindValue(':pa',$_SESSION["login_pass"],PDO::PARAM_STR);
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

   <h4>通知</h4>
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
       <td><?php echo $row["company_name"]; ?></td>
       <td><?php echo date('Y年n月j日', strtotime($row["begin"]))," ~ ",date('Y年n月j日', strtotime($row["end"])); ?></td>
       <td><?php echo $row["skilltype"]; ?></td>
       </tr>
     <?php } ?>
     
  </table>
  <input type="submit" value="送信" id="sendButton">
  <form>
    
          </div>
        </div>
        <footer class="demo-footer mdl-mini-footer"></footer>
      </main>
    </div>
    
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