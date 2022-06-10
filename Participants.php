<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Les étudiants participants</title>
  <link rel="stylesheet" href="BootStrap/style.css">
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
  <style>
    .participant {
      display: grid;
      grid-auto-flow: column;
      gap: 14px;
      grid-auto-columns: 300px;
      overflow-x: auto;
      padding-bottom: 4px;
    }

    .participant>div {
      background-color: rgba(255, 255, 255, 0.15);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-light fixed-top shadow-lg couleur-h">
    <div class="container-fluid">
      <span></span>
      <a class="navbar-brand" href="#"><img id="logo" src="logo/icon-site-1.png" alt="" />(espace Admin)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end couleur-t" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu (espace Admin)</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link E" aria-current="page" href="AccueilAdmin.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="AjoutResid.php">Ajouter Les résidents</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="Activite.php">Gérer les activités</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="Local.php">Ajouter Locaux</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="Seance.php">Les Heures des Séances</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="event.php">Planifier Les évènements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E active" href="Participants.php">Les étudiants participants</a>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <center><a class="nav-link" href="indexAcc.php">Visiteur</a></center>
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
  <br>
  <center>
    <h4>Les étudiants participants</h4>
  </center>
  <br />

  <?php
  require_once "conectionBDD.php";

  //pour faire les tests
  if (isset($_GET['accept'])) {
    $accept = $_GET['accept'];
    $mettreReussi = $database->prepare("UPDATE participer SET test = 1 WHERE numCart LIKE :accept");
    $mettreReussi->bindParam("accept", $accept);
    $mettreReussi->execute();
  }
  if (isset($_GET['reject'])) {
    $reject = $_GET['reject'];
    $mettreEchec = $database->prepare("UPDATE participer SET test = 0 WHERE numCart LIKE :reject");
    $mettreEchec->bindParam("reject", $reject);
    $mettreEchec->execute();
  }


  //Affichage les participants
  $affEV = $database->prepare("SELECT * FROM evenement ORDER BY codeEV DESC");
  $affEV->execute();
  foreach ($affEV as $toutEV) {
    $codeEV = $toutEV['codeEV'];
    $affEtudiantPartici = $database->prepare("SELECT * FROM participer, etudres WHERE participer.numCart=etudres.numCart AND codeEV LIKE :codeEV");
    $affEtudiantPartici->bindParam("codeEV", $codeEV);
    $affEtudiantPartici->execute();

    if ($affEtudiantPartici->rowCount() != 0) {
      echo "<main class='px-5 h-100'>";
      $nomEV = $toutEV['nomEV'];
      $pourINSC = $toutEV['pourINSC'];
      echo "<div class='cadre'>";
      echo "<center><h5>" . $nomEV . "</h5></center><br/>";
      echo "<div class='participant'>";
      foreach ($affEtudiantPartici as $participant) {
        $numCart = $participant['numCart'];
        $nomE = $participant['nomE'];
        $preE = $participant['preE'];
        $emailE = $participant['emailE'];
        $test = $participant['test'];

        echo "<div class='border border-dark mx-1 px-3'><br/>";
        echo "<center><p>" . $numCart . "</p></center><hr/>";
        echo "<p>" . $nomE . "</p>";
        echo "<p>" . $preE . "</p>";
        echo "<p>" . $emailE . "</p>";
        if ($pourINSC == 1) {

          if ($test === NULL) {
            echo "<p>Test: .....</p>";
          } else {
            if ($test == 0) {
              echo "<p>Test: Échouer</p>";
            } else {
              echo "<p>Test: Réussi</p>";
            }
          }
          echo "<center><form method='GET'><div class='btn-Test'>
                      <button type='submit' name='reject' value='" . $numCart . "' class='btn btn-outline-danger mx-1 px-3'>Invalide</button>
                      <button type='submit' name='accept' value='" . $numCart . "' class='btn btn-success mx-1 px-3'>Valide</button>
                      </div></form></center><br/>";
          echo "</div>";
        }
      }
      echo "</div>";
      echo "</div></main><br/>";
    }
  }
  ?>
  <script src="BootStrap/script.js"></script>
</body>

</html>