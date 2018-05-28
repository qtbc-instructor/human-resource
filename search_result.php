<!DOCTYPE>
<html>
<head>
  <mata charset="utf-8">
    <title>検索結果</title>
  </head>
  <body>
    <div>
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

      $sql = "SELECT * FROM lecture";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $results = $stm->fetchAll(PDO::FETCH_ASSOC);

      //テーブルのタイトル行
      echo "<table>";
      echo "<thead><tr>";
      echo "<tr>","ID","</tr>";
      echo "<th>","名前","</th>";
      echo "<th>","電話番号","</th>";
      echo "<th>","アドレス","</th>";
      echo "<th>","スキル","</th>";
      echo "<th>","日付","</th>";
      echo "</tr></thead>";
      echo "<tbody>";

      foreach ($result as $row){
        echo "<tr>";
        echo "<td>",es($row['id']),"</td>";
        echo "<td>",es($row['name']),"</td>";
        echo "<td>",es($row['tel']),"</td>";
        echo "<td>",es($row['adress']),"</td>";
        echo "<td>",es($row['skill']),"</td>";
        echo "<td>",es($row['freeday']),"</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    } catch (Exception $e){
      echo '<span class="error">エラーがありました。</span><br>';
      echo $e->getMessage();
      exit();
    }

      $skill = $_POST["skill"];
      $skillList = ["1skill","2skill","3skill"];
      $date = $_POST["date"];
      $date_List = "select * from date WHERE start_date>='01/01'and end_date<='12/31'";
      $results = lecture($skill, $skillList, $id, $name, $date, $date_List);
      echo "{$results}";


　　　//検索結果の表示
     //スキル検索の場合
    //  function lecture($skill, $skillList, $id, $name, $date, $date_List){
    //   if(in_array($skill, $skillList) || in_array($date, $date_List)){
    //     $results = "{$id}:{$name}   {$skill}   {$date}";
    //   } else {
    //     $results = "";
    //   }
    //   return $results;
    // }

     ?>



       <form method="POST" action="confirm_offer.php">
         <ul>
           <input type="button" value="戻る" onclick="location.href='company_mainpage.php'">
           <input type="submit" value="確認">
         </ul>
       </form>
       <div>
       </body>
     </html>
