
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>スキル追加</title>
    <link rel="stylesheet" type="text/css" href="./css/reset.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/material.min.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
  </head>
  <body>
    <?php session_start();?>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
    <header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
    <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">人材マッチングシステム</span>
          </div>
        </header>
        <div class="demo-ribbon"></div>
        <main class="demo-main mdl-layout__content">
          <div class="demo-container mdl-grid">
            <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
            <h3>スキル追加画面</h3>
            <?php 
            require_once("./PDO.php");
        
            $sql = "SELECT skilltype FROM skill_master WHERE NOT skilltype LIKE :sklill";
            $stm = $pdo->prepare($sql);
            $stm->bindValue(':sklill',$_SESSION["skilltype"],PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <form method="post" action="confirm_skill.php">
              <table>
                <?php 
                foreach($result as $row){?>
                  <tr><td><input type="checkbox" name="skilllist[]" value="<?php echo $row["skilltype"];?>"><?php echo $row["skilltype"]; ?> </td></tr>
              <?php  } ?>
              <?php $_SESSION['id']; ?>
              </table>
              <input type="submit" value="追加する"/>
            </form>
            <a href="lecture_mainpage.php"><button>戻る</button></a>
          </div>
        </div>
        <footer class="demo-footer mdl-mini-footer"></footer>
      </main>
    </div>
  </body>
</html>
