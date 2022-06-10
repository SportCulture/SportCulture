<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Les Activités Culturelles de la Cité Chlef</title>
  <link rel="stylesheet" href="BootStrap/style.css" />
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
</head>

<body>
  <nav class="navbar navbar-light fixed-top shadow-lg couleur-h">
    <div class="container-fluid">
      <span></span>
      <a class="" href="#"><img id="logo" src="logo/icon-site-1.png" alt="" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end couleur-t" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item E">
              <a class="nav-link active" aria-current="page" href="indexAcc.php">Accueil</a>
            </li>
            <li class="nav-item E">
              <a class="nav-link" href="Conditions.php">Conditions s'inscrire & participer</a>
            </li>
            <li class="nav-item E">
              <a class="nav-link" href="Tous-Evenement.php">Tous les évènements</a>
            </li>
            <li class="nav-item E">
              <a class="nav-link" href="EmploiTemps.php">L'emploi du temps</a>
            </li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li class="nav-item E">
              <a class="nav-link" href="CONTACTER.php">CONTACTER</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div>
    <center>
      <h1>Les Activités Culturelles de la Cité Chlef</h1>
    </center>
  </div>
  <br>
  <main>
    <div class="cadre">
      <?php
      require_once "conectionBDD.php";


      $apporte = $database->prepare("SELECT * FROM activite WHERE typeA LIKE 'Culturel'");
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