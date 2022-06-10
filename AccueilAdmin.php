<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Les étudiants inscrits</title>
  <link rel="stylesheet" href="BootStrap/style.css">
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />

  <style>
    .inscrit {
      display: grid;
      grid-auto-flow: column;
      gap: 14px;
      grid-auto-columns: 300px;
      overflow-x: auto;
      padding-bottom: 4px;
    }

    .inscrit>div {
      background-color: rgba(255, 255, 255, 0.15);
      height: 300px;
      overflow-y: auto;
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
              <a class="nav-link active E" aria-current="page" href="AccueilAdmin.php">Accueil</a>
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
              <a class="nav-link E" href="event.php">Créer Les évènements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="Participants.php">Les étudiants participants</a>
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
    <h4>Accueil (espace Admin)</h4>
  </center>
  <br />
  <?php
  require_once "conectionBDD.php";

  $demandeIns = $database->prepare("SELECT * FROM inscrir WHERE validerInscrir LIKE 0 ORDER BY codeInsc ASC");
  $demandeIns->execute();
  $nbrDemande = $demandeIns->rowCount();
  echo "<div class='text-capitalize border border-light mx-5 py-1' style='border-radius: 20px; background-color:rgba(168, 103, 173, 0.45);'><center>nombres les demandes d'inscription : " . $nbrDemande . "</center></div><br>";
  if ($nbrDemande != 0) {
    echo '<main class="px-5 h-100">';
    //action de valider
    if (isset($_POST['OUI'])) {
      $valide = $_POST['OUI'];
      $attacher = $database->prepare("UPDATE inscrir SET validerInscrir='1' WHERE codeInsc=:codeInsc");
      $attacher->bindParam("codeInsc", $valide);
      $attacher->execute();
      echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>Validation effectuée
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
    }
    if (isset($_POST['NON'])) {
      $pas_valide = $_POST['NON'];
      $attacher = $database->prepare("DELETE FROM inscrir WHERE codeInsc=:codeInsc");
      $attacher->bindParam("codeInsc", $pas_valide);

      $updateemail = $database->prepare("SELECT * FROM inscrir WHERE codeInsc=:codeInsc");
      $updateemail->bindParam("codeInsc", $pas_valide);
      $updateemail->execute();

      if ($updateemail->rowCount() == 1) {
        foreach ($updateemail as $resid) {
          $numCart = $resid['numCart'];
          $enlevu = $database->prepare("UPDATE etudres SET emailE=NULL WHERE numCart=:numCart");
          $enlevu->bindParam("numCart", $numCart);
          $enlevu->execute();
        }
      }



      if ($attacher->execute()) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>l'annulation effectuée
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Erreur! inattendue me contacter
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      }
    }
    //affichage des demandes
    echo '<div class="cadre">';
    echo "<div class='inscrit'>";
    foreach ($demandeIns as $etud) {
      $codeInsc = $etud['codeInsc'];
      $numCart = $etud['numCart'];
      $typeCerti = $etud['typeCerti'];
      echo "<div class='border border-dark mx-1 px-3' ><br>
            <ins>Numéro de Carte:</ins> " . $numCart . "<br>";
      $detail = $database->prepare("SELECT * FROM etudres WHERE numCart LIKE :numCart");
      $detail->bindParam("numCart", $numCart);
      $detail->execute();
      foreach ($detail as $info) {
        $nomE = $info['nomE'];
        $preE = $info['preE'];
        echo  "<ins>Nom:</ins> " . $nomE . "<br><ins>Prénom:</ins> " . $preE . "<br>";
      }
      $codeA = $etud['codeA'];
      $choix = $database->prepare("SELECT * FROM activite WHERE codeA LIKE :codeA");
      $choix->bindParam("codeA", $codeA);
      $choix->execute();
      foreach ($choix as $act) {
        $nomA = $act['nomA'];
        echo  "<ins>Choix de l'activité:</ins> " . $nomA . "<br><br>";
      }
      if ($typeCerti != "") {
        echo "<center><div>";
        $getfil = "data:" . $etud['typeCerti'] . ";base64," . base64_encode($etud['certi']);
        echo '<a href="' . $getfil . '" download><img src="' . $getfil . '" width="200px"/><br/></a>';
        echo "<p><ins>certificat de:</ins>  " . $nomE . "  " . $preE . "</p>";
        echo "</div></center>";
      }
      echo "<center><form method='POST'><button type='submit' class='btn btn-outline-danger' name='NON' value='" . $codeInsc . "'>Refuser</button>";
      echo "<button type='submit' class='btn btn-success mx-3' name='OUI' value='" . $codeInsc . "'>Valider</button></form></center><br/></div>";
    }
    echo "</div>";
    echo "</div></main><br>";
  }
  echo '<main class="px-5 h-100">
  <div class="cadre" style="overflow-x: auto;">';
  echo "<center><ins><h6>Les étudiants inscrits</h6></ins><br/><center>";
  $act = $database->prepare("SELECT * FROM activite ORDER BY nomA");
  $act->execute();
  echo '<table class="table table-bordered border-dark">
      <thead>
        <tr>
          <th>Activité</th>
          <th>Numéro de la Carte</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Certificat</th>
        </tr>
      </thead>
      <tbody>';
  foreach ($act as $activit) {
    $codeA = $activit['codeA'];
    $nomA = $activit['nomA'];
    $valid = $database->prepare("SELECT * FROM inscrir WHERE validerInscrir LIKE 1 AND codeA LIKE :codeA");
    $valid->bindParam("codeA", $codeA);
    $valid->execute();
    if ($valid->rowCount() != 0) {
      $nbrligne = $valid->rowCount();
      echo "<tr>";

      echo "<td rowspan='" . $nbrligne . "'>" . $nomA . "</td>";
      foreach ($valid as $etudValid) {
        $numCart = $etudValid['numCart'];
        echo "<td>" . $numCart . "</td>";
        $etudIns = $database->prepare("SELECT * FROM etudres WHERE numCart LIKE :numCart");
        $etudIns->bindParam("numCart", $numCart);
        $etudIns->execute();
        foreach ($etudIns as $info) {
          echo "<td>" . $info['nomE'] . "</td>";
          echo "<td>" . $info['preE'] . "</td>";
          echo "<td>" . $info['emailE'] . "</td>";
        }
        $typeCerti = $etudValid['typeCerti'];
        if ($typeCerti != "") {
          $getfile = "data:" . $etudValid['typeCerti'] . ";base64," . base64_encode($etudValid['certi']);
          echo '<td><a href="' . $getfile . '" download>Télécharger</a></td>';
        } else {
          echo '<td>--------</td>';
        }

        echo "</tr>";
      }
    }
  }
  echo "</tbody>
    </table>";
  echo "</div>
        </main>
        <br>";

  ?>
  <script src="BootStrap/script.js"></script>
</body>

</html>