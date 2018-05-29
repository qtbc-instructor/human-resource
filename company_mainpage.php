<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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

echo "<table border='1'>";
echo "<thead><tr>";
echo "<th>","講師名","</th>";
echo "<th>","日付","</th>";
echo "</thead></tr>";
echo "<tbody>";
foreach($result as $approvalPending) {
  echo "<tr>";
  echo "<td>", $approvalPending['name'], "</td>";
  echo "<td>", $approvalPending['begin'], "</td>";
  echo "</tr>";
}
echo "<tbody>";
echo "</table>";
?>

<p class="company_notification">通知</p>
<?php
$user = "root";
$pass = "mariadb";
$dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 1";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dbh = null;

echo "<table border='1'>";
echo "<thead><tr>";
echo "<th>","講師名","</th>";
echo "<th>","日付","</th>";
echo "</thead></tr>";
echo "<tbody>";
foreach($result as $approvalPending) {
  echo "<tr>";
  echo "<td>", $approvalPending['name'], "</td>";
  echo "<td>", $approvalPending['begin'], "</td>";
  echo "</tr>";
}
echo "<tbody>";
echo "</table>";
?>

<!-- 未実装状態 -->
<p class"company_valution">評価登録</p>
<?php
$user = "root";
$pass = "mariadb";
$dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id AND status = 1";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dbh = null;

echo "<table border='1'>";
echo "<thead><tr>";
echo "<th>","講師名","</th>";
echo "<th>","日付","</th>";
echo "</thead></tr>";
echo "<tbody>";
foreach($result as $approvalPending) {
  echo "<tr>";
  echo "<td>", $approvalPending['name'], "</td>";
  echo "<td>", $approvalPending['begin'], "</td>";
  echo "</tr>";
}
echo "<tbody>";
echo "</table>";
?>
<button id="company_valution_button"><a href="company_mainpage.php">評価登録評価する</a></button>

<p class="company_search_item" >講師検索</p>
<?php
$user = "root";
$pass = "mariadb";
$dbh =new PDO('mysql:host=localhost;dbname=lcmatching_db;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 日付データ
$sql = "SELECT id,name, begin, status FROM lecture,status WHERE lecture.id = lecture_id";
$freeDay = "SELECT begin FROM freeday";
$freeDaystml = $dbh->query($freeDay);
$freeDayResult = $freeDaystml->fetchAll(PDO::FETCH_ASSOC);
// スキルデータ
$sql = "SELECT id,name,skill_id FROM lecture,skill_table WHERE lecture.id = lecture_id";
$skill = "SELECT skill_id FROM skill_table";
$skillStml = $dbh->query($skill);
$skillResult = $skillStml->fetchAll(PDO::FETCH_ASSOC);
$dbh = null;
var_dump($skillResult);
?>

期間：
<form method="POST" action="search_result.php">
  <select name="begin-end">
<?php
    foreach ($freeDayResult as $freeDay) { ?>
      <option value="<?php echo $freeDay['begin']; ?>"><?php echo $freeDay['begin']; ?></option>
<?php
    }
?>
  </select>
  <select name="ski">
<?php
    foreach ($skillResult as $skill) { ?>
      <option value="<?php echo $skill['skill_id']; ?>"><?php echo $skill['skill_id']; ?></option>
<?php
    }
?>
  </select>
  <input type="submit" value="送信">
  </form>
</body>
</html>
