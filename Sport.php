<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Les Activités Sportives de la Cité Chlef</title>
  <link rel="stylesheet" href="BootStrap/style.css" />
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
</head>

<body>
  <?php
  require_once 'menuGeneral.php';
  ?>
  <center>
    <h1>Les Activités Sportives de la Cité Chlef</h1>
  </center>
  <br>
  <main>
    <div class="cadre">
      <?php
      require_once "conectionBDD.php";

      $apporte = $database->prepare("SELECT * FROM activite WHERE typeA LIKE 'Sportif'");
      $apporte->execute();
      if ($apporte->rowCount() != 0) {
        echo '<div class="boit-act" >';
        foreach ($apporte as $value) {
          echo '<div class="border border-dark mx-1 px-3">';
          echo '<div><div class="mt-3"><center>' . $value['nomA'] . '</center></div>';
          echo '<hr></div>';
          $typePhotoA = $value['typePhotoA'];
          if ($typePhotoA != "") {
            $getPhoto = "data:" . $typePhotoA . ";base64," . base64_encode($value['photoA']);
            echo '<center><img src="' . $getPhoto . '" width="200px"/></center><br/>';
          }

          if ($value['clubA'] != "") {
            echo '<div><ins>club de:</ins> ' . $value['clubA'] . '</div>';
          } else {
            echo "<div><center>n'a pas un club</center></div>";
          }
          if ($value['descrA'] != "") {
            echo '<div>-' . $value['descrA'] . '</div>';
          } else {
            echo "<div><center>Rien de nouveau</center></div>";
          }

          $codeA = $value['codeA'];
          $prog = $database->prepare("SELECT * FROM seance WHERE codeA LIKE :codeA");
          $prog->bindParam("codeA", $codeA);
          $prog->execute();
          if ($prog->rowCount() != 0) {
            echo "<form method='POST' action='VoirSeanceSpecial.php'>
                          <center><button type='submit' class='btn btn-success mt-3' name='heures' value='" . $codeA . "'>Voir son programme</button></center>
                          </form><br>";
          } else {
            echo "<div><center>Le programme de cette activité n'a pas encore été déterminé</center></div>";
          }

          echo '</div>';
        }
        echo '</div>';
      } else {
        echo 'il n y a pas des activités ';
      }
      ?>
    </div>
  </main>
  <br>
  <?php
  require_once "footeur.php";
  ?>
  <script src="BootStrap/script.js"></script>
</body>

</html>