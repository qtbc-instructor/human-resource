<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
  <p class="company_approval_pending">承認待ち</p>
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 0";
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;
  echo "<div class='syounin'>";
  echo "<table border='1' class='syounin'>";
  echo "<thead><tr>";
  echo "<th>","講師名","</th>";
  echo "<th>","日付","</th>";
  echo "<th>","状態","</th>";
  echo "</thead></tr>";
  echo "<tbody>";
  foreach($result as $approvalPending) {
    echo "<tr>";
    echo "<td>", $approvalPending['name'], "</td>";
    echo "<td>", $approvalPending['begin'], "</td>";
    echo "<td>", $approvalPending['status'], "</td>";
    echo "</tr>";
  }
  echo "<tbody>";
  echo "</table>";
  echo "</div>";
  ?>

  <p class="company_notification">承認済み</p>
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 1";
  $sqlNg = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 4";
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;

  echo "<table border='1' class='syouninzumi'>";
  echo "<thead><tr>";
  echo "<th>","講師名","</th>";
  echo "<th>","日付","</th>";
  echo "<th>","状態","</th>";
  echo "</thead></tr>";
  echo "<tbody>";
  foreach($result as $approvalPending) {
    echo "<tr>";
    echo "<td>", $approvalPending['name'], "</td>";
    echo "<td>", $approvalPending['begin'], "</td>";
    echo "<td>", $approvalPending['status'], "</td>";
    echo "</tr>";
  }
  echo "<tbody>";
  echo "</table>";
  echo"<br>";
  ?>

  <p class="company_notification">拒否されました</p>
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 4";
  $stmt = $dbh->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $dbh = null;

  echo "<table border='1' class='kyohi'>";
  echo "<thead><tr>";
  echo "<th>","講師名","</th>";
  echo "<th>","日付","</th>";
  echo "<th>","状態","</th>";
  echo "</thead></tr>";
  echo "<tbody>";
  foreach($result as $approvalPending) {
    echo "<tr>";
    echo "<td>", $approvalPending['name'], "</td>";
    echo "<td>", $approvalPending['begin'], "</td>";
    echo "<td>", $approvalPending['status'], "</td>";
    echo "</tr>";
  }
  echo "<tbody>";
  echo "</table>";
  echo"<br>";
  ?>

  <p class"company_valution">評価登録</p>
  <?php
  $user = "root";
  $pass = "mariadb";
  $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 2";
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
    <form action="company_mainpage.php" method="POST">
      <td>
        <select name="evaluationCount">
          <option value="">評価を選択してください</option>
        <option value="1000-00-00">1</option>
        <option value="2000-00-00">2</option>
        <option value="3000-000-00">3</option>
        <option value="4000-00-00">4</option>
        <option value="5000-00-00">5</option>
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
      $evalutionData = $_POST['evaluationCount'];
      $evalutionId = $_POST['evaluationId'];

      $user = "root";
      $pass = "mariadb";
      $dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE status SET evaluation = '$evalutionData' where lecture_id = '$evalutionId'";
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $dbh = null;
    }
    ?>

</body>
</style>
</html>
