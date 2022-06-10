<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gérer les activités</title>
  <link rel="stylesheet" href="BootStrap/style.css">
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
</head>

<body>
  <nav class="navbar navbar-light fixed-top shadow-lg couleur-h">
    <div class="container-fluid">
      <span></span>
      <a class="navbar-brand" href="#"><img id="logo" src="logo/icon-site-1.png" height="35px" alt="" />(espace Admin)</a>
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
              <a class="nav-link E active" href="Activite.php">Gérer les activités</a>
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
    <h4>Gérer les activités</h4>
  </center>
  <br />


  <?php
  require_once "conectionBDD.php";
  echo '<main class="px-5 h-100">';


  //Ajout
  //requette de l'ajout


  if (isset($_POST['ajout'])) {
    $nomA = $_POST['nomA'];
    $typeA = $_POST['typeA'];
    $clubA = $_POST['clubA'];
    $descrA = $_POST['descrA'];
    $typePhotoA = $_FILES['photoA']['type'];
    if (($nomA != "") && ($typeA != "type activité") && ($typePhotoA != "")) {
      $photoA = file_get_contents($_FILES['photoA']['tmp_name']);

      $condition = $database->prepare("SELECT COUNT(*) FROM activite WHERE nomA LIKE :item ");
      $condition->bindparam("item", $nomA);
      $condition->execute();
      foreach ($condition as $repiter) {
        $nebr = $repiter['COUNT(*)'];
      }

      if ($nebr == 0) {

        $insert = $database->prepare("INSERT INTO activite (nomA, typeA, clubA, descrA, photoA, typePhotoA) VALUES (:nomA, :typeA, :clubA, :descrA, :photoA, :typePhotoA)");
        $insert->bindParam("nomA", $nomA);
        $insert->bindParam("typeA", $typeA);
        $insert->bindParam("clubA", $clubA);
        $insert->bindParam("descrA", $descrA);
        $insert->bindParam("photoA", $photoA);
        $insert->bindParam("typePhotoA", $typePhotoA);
        if ($insert->execute()) {
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>L'ajout de <strong>" . '"' . $nomA . '"' . "</strong> est réussi 
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } else {
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Erreur! inattendue me contacter </div>";
        }
      } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>L'activité <strong>" . '"' . $nomA . '"' . "</strong> est existe déja
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      }
    } else {
      $nbr_mot = 0;
      $mot;
      if ($nomA == "") {
        $mot[$nbr_mot] = "le nom";
        $nbr_mot++;
      }

      if ($typeA == "type activité") {
        $mot[$nbr_mot] = "le type";
        $nbr_mot++;
      }

      if ($typePhotoA == "") {
        $mot[$nbr_mot] = "la photo";
        $nbr_mot++;
      }

      if ($nbr_mot == 3) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir toutes les champs obligatoires de l'activité à <strong>ajouter</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      } elseif ($nbr_mot == 1) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir <strong>" . '"' . $mot[0] . '"' . "</strong> de l'activité
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir <strong>" . '"' . $mot[0] . '"' . "</strong> et <strong>" . '"' . $mot[1] . '"' . "</strong> de l'activité
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      }
    }
  }



  //pour sauvgarder les modifications

  if (isset($_POST['sauvgarder'])) {
    $sauvgarder = $_POST['sauvgarder'];
    $clubA = $_POST['clubA'];
    $descrA = $_POST['descrA'];
    $mis = $database->prepare("UPDATE activite SET clubA=:clubA, descrA=:descrA WHERE codeA LIKE :codeA");
    $mis->bindParam("clubA", $clubA);
    $mis->bindParam("descrA", $descrA);
    $mis->bindParam("codeA", $sauvgarder);
    if ($mis->execute()) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">les modifications ont été sauvgardées
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    } else {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Erreur! inattendue me contacter</div>";
    }
  }


  //formulaire de mettre nouvelles informations
  if (isset($_POST['modifier'])) {
    if ($_POST['codeA'] != "choisir activité que vous modifier") {
      $codeA = $_POST['codeA'];
      $choix = $database->prepare("SELECT * FROM activite WHERE codeA LIKE :codeA");
      $choix->bindParam("codeA", $codeA);
      $choix->execute();
      echo '<div class="cadre">';
      echo "<div class='d-grid gap-2 col-10 m-3 mx-auto'><form method='POST'>";
      foreach ($choix as $value) {
        echo '<center><label>Mettre les modifications sur <strong><ins>' . $value['nomA'] . '</ins></strong></label></center><br>';
        echo '<label for="clubA">Club</label><input type="text" name="clubA" class="form-control" placeholder="entrez nouvelle nom de club" maxlength="40" value="' . $value['clubA'] . '"/>';
        echo '<br>';
        echo '<label for="descrA">Description</label><input type="text" name="descrA" class="form-control" placeholder="entrez nouvelle description" maxlength="350" value="' . $value['descrA'] . '"/>';
      }
      echo '<br>';
      echo "<center><button type='submit' name='sauvgarder' class='btn btn-dark mt-1 w-75' value='" . $codeA . "'>sauvgarder</button></center>";
      echo "</form></div>";
      echo "</div>";
    } else {
      echo "<div  id='m3' class='alert alert-warning alert-dismissible fade show' role='alert'>Vous n'avez pas spécifié un activité à <strong>modifier</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
    }
  }


  //rêquette de La suppression

  if (isset($_POST['supp'])) {
    if ($_POST['codeA'] != "choisir activité que vous modifier") {
      $codeA = $_POST['codeA'];

      $execlu = $database->prepare("DELETE FROM activite WHERE codeA LIKE :codeA");
      $execlu->bindParam("codeA", $codeA);

      if ($execlu->execute()) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">La suppression effectuée
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">pour effectuer la suppression de cette activité, Vous devez supprimer tout ce qui associé à cette activité !!!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      }
    } else {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous n'avez pas spécifié un activité à <strong>supprimer</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
    }
  }


  //formulaire de l'ajout

  echo '<div class="cadre"><div class="d-grid gap-2 col-10 m-3 mx-auto"><form method="POST" enctype="multipart/form-data">';
  echo "<center><ins><h6>ajouter une activité</h6></ins></center><br/>";
  echo '<label for="nomA">Nom Activité</label><span style="color:#eb0000;"> *</span><input type="text" name="nomA" id="nomA" class="form-control" placeholder="entrez le nom de nouveau activité" maxlength="20"/>';
  echo '<br>';
  echo '<label for="typeA">Type</label><span style="color:#eb0000;"> *</span><select id="typeA" name="typeA" class="form-select" aria-label="Default select example">';
  echo '<option selected>type activité</option>';

  echo "<option value='Sportif'>Sportif</option>";
  echo "<option value='Culturel'>Culturel</option>";
  echo "<option value='Scientifique'>scientifique</option>";

  echo '</select>';
  echo '<br>';
  echo '<label for="photoA">Photo</label><span style="color:#eb0000;"> *</span><input type="file" id="photoA" name="photoA" accept="image/*" class="form-control"/>';
  echo '<br>';
  echo '<label for="clubA">Club</label><input type="text" id="clubA" name="clubA" class="form-control" placeholder="entrez le nom de club s il existe" maxlength="40"/>';
  echo '<br>';
  echo '<label for="descrA">Description</label><textarea type="text" id="descrA" name="descrA" class="form-control" placeholder="ajouter un description" maxlength="350"></textarea><br>';
  echo "<center><button type='submit' id='ajout' name='ajout' class='btn btn-success mt-1 w-75'>Ajouter</button></center>";
  echo "</form></div>";
  echo '</div></main><br>';


  //pour le mise a jour

  echo "<main class='px-5 h-100'>";

  echo '<div class="cadre">';
  //formulaire de mise-à-jour
  $aff = $database->prepare("SELECT * FROM activite ORDER BY codeA DESC");
  $aff->execute();
  echo "<div class='d-grid gap-2 col-10 m-3 mx-auto'><form method='POST'>";
  echo "<center><ins><h6>mise-à-jours d'un activité</h6></ins></center><br/>";
  echo '<select name="codeA" class="form-select" aria-label="Default select example">';
  echo '<option selected>choisir activité que vous modifier</option>';
  foreach ($aff as $contenu) {
    echo '<option value="' . $contenu['codeA'] . '">' . $contenu['nomA'] . '</option>';
  }
  echo '</select>';
  echo '<br>';
  echo "<center><button type='submit' id='modifier' name='modifier' class='btn btn-secondary mt-1 mx-5 w-25'>modifier</button>";
  echo "<button type='submit' id='supp' name='supp' class='btn btn-danger mt-1 mx-5 w-25'>supprimer</button></center>";
  echo "</form></div>
    </div>
    </main><br/>";


  //pour l'affichage
  ?>
  <main class="px-5 h-100">
    <div class="cadre">
      <?php

      $apporte = $database->prepare("SELECT * FROM activite ORDER BY codeA DESC");
      $apporte->execute();
      if ($apporte->rowCount() != 0) {
        echo "<center><ins><h6>Les Activités de la Cité universitaire Chlef</ins></h6></center><br/>";
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
          echo '</div>';
        }
        echo '</div>';
      } else {
        echo '<div class="boit-act" >';
        echo "il n'y a pas des activités ";
        echo '</div>';
      }
      ?>
    </div>
  </main>

  <br>

  <script src="BootStrap/script.js"></script>
</body>

</html>