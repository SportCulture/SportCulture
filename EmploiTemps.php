<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>L'emploi du temps, Activités de la cité Chlef</title>
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
              <a class="nav-link" aria-current="page" href="indexAcc.php">Accueil</a>
            </li>
            <li class="nav-item E">
              <a class="nav-link" href="Conditions.php">Conditions s'inscrire & participer</a>
            </li>
            <li class="nav-item E">
              <a class="nav-link" href="Tous-Evenement.php">Tous les évènements</a>
            </li>
            <li class="nav-item E">
              <a class="nav-link active" href="EmploiTemps.php">L'emploi du temps</a>
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
  <center>
    <h1>L'emploi du temps</h1>
  </center>
  <br>

  <?php
  require_once "conectionBDD.php";

  $chaqAct = $database->prepare("SELECT * FROM activite ORDER BY nomA ASC");
  $chaqAct->execute();
  foreach ($chaqAct as $act) {

    $codeA = $act['codeA'];
    $nomA = $act['nomA'];
    $seanceAct = $database->prepare("SELECT * FROM seance WHERE codeA LIKE :codeA");
    $seanceAct->bindparam("codeA", $codeA);
    $seanceAct->execute();
    if ($seanceAct->rowCount() != 0) {
      echo "<main class='px-5 h-100'>
                    <div class='cadre'><br>";
      echo '<table class="table table-bordered border-dark">
                <tr>
                    <th colspan="3" class="bg-dark text-light"><center>' . $nomA . '</center></th>
                </tr>';
      echo "<tr><th class='text-dark'>Jour</th>
                      <th class='text-dark'>Heure</th>
                      <th class='text-dark'>Salle</th></tr>";
      foreach ($seanceAct as $seanc) {

        $codeL = $seanc['codeL'];
        $selectLocal = $database->prepare("SELECT * FROM local WHERE codeL=:codeL");
        $selectLocal->bindparam("codeL", $codeL);
        $selectLocal->execute();
        foreach ($selectLocal as $place) {
          $lieu = $place['lieu'];
        }

        $jour = $seanc['jour'];
        $temps = $seanc['temps'];
        $codeS = $seanc['codeS'];
        echo '<tr>
                        <td>' . $jour . '</td>
                        <td>' . $temps . '</td>
                        <td>' . $lieu . '</td>';
        echo "</tr>";
      }

      echo '</table>';

      echo "</div>
                </main><br>";
    }
  }

  ?>


  <?php
  require_once "footeur.php";
  ?>

  <script src="BootStrap/script.js"></script>
</body>

</html>