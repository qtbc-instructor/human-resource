<<<<<<< HEAD
<?php
session_start();
$err = false;

// ページリダイレクトまたはログインでセッションを生成します

try{
    if(isset($_POST['login_address'])){
          $userAddress = $_POST['login_address'];
          $_SESSION['login_address'] = $userAddress;
        }else if(isset($_SESSION['login_address'])){
          $userAddress = $_SESSION['login_address'];
        }else{$err = true;}
        if(isset($_POST['login_pass'])){
          $userPass = $_POST['login_pass'];
          $_SESSION['login_pass'] = $userPass;
        }else if($_SESSION['login_pass']){
          $userPass = $_SESSION['login_pass'];
        }else{$err=true;}
        if($err == true){
          throw new Exception("ログイン情報が未入力");
        }

  var_dump($userAddress);
  var_dump($userPass);


  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $sql = "SELECT * FROM company INNER JOIN status ON company.id = status.company_id;
  //            WHERE company.mail_address = '$userAddress'";
  $sql = "select id,company_name from company where mail_address=\"{$userAddress}\" and pass=\"{$userPass}\";";

  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  var_dump($result);

  if(count($result)==0){
    throw new Exception("ログインに失敗しました。");
  }
  $companyId = $result[0]['id'];
  $companyName = $result[0]['company_name'];
  $companyAddress = $result[0]['company_name'];


?>


=======
>>>>>>> company_g
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<<<<<<< HEAD
  <title>企業様ログインペーシ</title>
</head>
<body>
  <h1>ようこそ <?php echo"{$companyName}様"; ?></h1>
  <p class="company_approval_pending">承認待ちの講師</p>
=======
</head>
<body>
  <p class="company_approval_pending">承認待ち</p>
>>>>>>> company_g
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
  $sql = "SELECT id,name,begin,company_id, status FROM lecture,status
             WHERE lecture.id = lecture_id AND status = 0 AND company_id = $companyId";
=======
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 0";
>>>>>>> company_g
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;
  echo "<div class='syounin'>";
  echo "<table border='1' class='syounin'>";
  echo "<thead><tr>";
  echo "<th>","講師名","</th>";
  echo "<th>","日付","</th>";
  echo "</thead></tr>";
  echo "<tbody>";
  foreach($result as $approvalPending) {
    echo "<tr>";
    echo "<td>", $approvalPending['name'], "</td>";
    echo "<td>", $approvalPending['begin'], "</td>";
<<<<<<< HEAD
=======
    echo "<td>", $approvalPending['status'], "</td>";
>>>>>>> company_g
    echo "</tr>";
  }
  echo "<tbody>";
  echo "</table>";
  echo "</div>";
  ?>

<<<<<<< HEAD
  <p class="company_notification">承認済みの講師</p>
=======
  <p class="company_notification">承認済み</p>
>>>>>>> company_g
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
  $sql = "SELECT id,name, begin, status FROM lecture,status
            WHERE lecture.id = lecture_id AND status = 1 AND company_id = $companyId";
=======
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 1";
  $sqlNg = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 4";
>>>>>>> company_g
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;

  echo "<table border='1' class='syouninzumi'>";
  echo "<thead><tr>";
  echo "<th>","講師名","</th>";
  echo "<th>","日付","</th>";
<<<<<<< HEAD
=======
  echo "<th>","状態","</th>";
>>>>>>> company_g
  echo "</thead></tr>";
  echo "<tbody>";
  foreach($result as $approvalPending) {
    echo "<tr>";
    echo "<td>", $approvalPending['name'], "</td>";
    echo "<td>", $approvalPending['begin'], "</td>";
<<<<<<< HEAD
=======
    echo "<td>", $approvalPending['status'], "</td>";
>>>>>>> company_g
    echo "</tr>";
  }
  echo "<tbody>";
  echo "</table>";
  echo"<br>";
  ?>

<<<<<<< HEAD
  <p class="company_notification">承認されなかった講師</p>
=======
  <p class="company_notification">拒否されました</p>
>>>>>>> company_g
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
  $sql = "SELECT id,name, begin, status FROM lecture,status
            WHERE lecture.id = lecture_id AND status = 4 AND company_id = $companyId";
=======
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 4";
>>>>>>> company_g
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;

  echo "<table border='1' class='kyohi'>";
  echo "<thead><tr>";
  echo "<th>","講師名","</th>";
  echo "<th>","日付","</th>";
<<<<<<< HEAD
=======
  echo "<th>","状態","</th>";
>>>>>>> company_g
  echo "</thead></tr>";
  echo "<tbody>";
  foreach($result as $approvalPending) {
    echo "<tr>";
    echo "<td>", $approvalPending['name'], "</td>";
    echo "<td>", $approvalPending['begin'], "</td>";
<<<<<<< HEAD
=======
    echo "<td>", $approvalPending['status'], "</td>";
>>>>>>> company_g
    echo "</tr>";
  }
  echo "<tbody>";
  echo "</table>";
  echo"<br>";
  ?>

<<<<<<< HEAD
  <p class"company_valution">まだ評価が登録されていない講師</p>
=======
  <p class"company_valution">評価登録</p>
>>>>>>> company_g
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
  $sql = "SELECT id,name, begin, status FROM lecture,status
            WHERE lecture.id = lecture_id AND status = 2 AND company_id = $companyId";
=======
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 2";
>>>>>>> company_g
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;

  echo "<table border='1' class='hyouka'>";
  echo "<thead><tr>";
  echo "<th>","講師名","</th>";
  echo "<th>","日付","</th>";
  echo "<th>","状態","</th>";
  echo "<th>","id","</th>";
  echo "<th>","送信","</th>";
  echo "<th>","評価","</th>";
  echo "</thead></tr>";
  echo "<tbody>";
  foreach($result as $approvalPending) {
    echo "<tr>";
    echo "<td>", $approvalPending['name'], "</td>";
    echo "<td>", $approvalPending['begin'], "</td>";
    echo "<td>", $approvalPending['status'], "</td>";
    echo "<td>", $approvalPending['id'], "</td>";
    ?>
<<<<<<< HEAD
    <form action="company_mainpage.php" method="POST" name="redirect_page">
      <td>
        <select name="evaluationCount">
          <option value="">評価を選択してください</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
=======
    <form action="company_mainpage.php" method="POST">
      <td>
        <select name="evaluationCount">
          <option value="">評価を選択してください</option>
        <option value="1000-00-00">1</option>
        <option value="2000-00-00">2</option>
        <option value="3000-000-00">3</option>
        <option value="4000-00-00">4</option>
        <option value="5000-00-00">5</option>
>>>>>>> company_g
      </select>
      </td>
      <td>
        <input type="hidden" name="evaluationId" value="<?php echo $approvalPending['id']; ?>">
        <input type="submit" value="評価する">
      </td>
    </form>
  <?php
    echo "</tr>";
  }
  echo "<tbody>";
  echo "</table>";
  ?>

  <p class="company_search_item" >講師検索</p>
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // 日付データ
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecturer_id";
  $freeDay = "SELECT begin FROM freeday";
  $freeDaystml = $dbh->query($freeDay);
  $freeDayResult = $freeDaystml->fetchAll(PDO::FETCH_ASSOC);
  // スキルデータ
  $sql = "SELECT id,name,skill_id FROM lecture,skill_table WHERE lecture.id = lecture_id";
  $skill = "SELECT * FROM skill_table inner join skill_master on skill_table.skill_id = skill_master.id";
  $skillStml = $dbh->query($skill);
  $skillResult = $skillStml->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;
  ?>

  期間：
  <form method="POST" action="search_result.php">
    <input type="date" type="date" name="date">
    <select name="skill">
  <?php
      foreach ($skillResult as $skill) { ?>
        <option value="<?php echo $skill['skill_id']; ?>"><?php echo $skill['skilltype']; ?></option>
  <?php
      }
  ?>
    </select>
    <input type="submit" value="送信">
    </form>

  <?php
    if (isset($_POST['evaluationId'])) {
<<<<<<< HEAD
      $evaluationData = $_POST['evaluationCount'];
      $evaluationId = $_POST['evaluationId'];
=======
      $evalutionData = $_POST['evaluationCount'];
      $evalutionId = $_POST['evaluationId'];
>>>>>>> company_g

      $user = "root";
      $pass = "mariadb";
      $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
      $sql = "UPDATE status SET evaluation = $evaluationData where lecture_id = $evaluationId";
=======
      $sql = "UPDATE status SET evaluation = '$evalutionData' where lecture_id = '$evalutionId'";
>>>>>>> company_g
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $dbh = null;
    }
<<<<<<< HEAD
  }catch(Exception $e){
       echo '<span>エラー：</span>';
       echo $e->getMessage();
  }

=======
>>>>>>> company_g
    ?>

</body>
</style>
</html>
