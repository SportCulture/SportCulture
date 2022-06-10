<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Séances</title>
  <link rel="stylesheet" href="BootStrap/style.css">
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
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
              <a class="nav-link E active" href="Seance.php">Les Heures des Séances</a>
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
    <h4>Les Heures des Séances</h4>
  </center>
  <br />
  <main class="px-5 h-100">
    <?php
    require_once "conectionBDD.php";


    //requéte d'insertion
    if (isset($_POST['ajout'])) {
      $codeA = $_POST['codeA'];
      $codeL = $_POST['codeL'];
      $jour = $_POST['jour'];
      $temps = $_POST['temps'];
      if (($codeA != "L'activité") && ($codeL != "Le lieu") && ($jour != "Le jour") && ($temps != "")) {
        $activit = $database->prepare("SELECT * FROM activite WHERE codeA LIKE :codeA");
        $activit->bindparam("codeA", $codeA);
        $activit->execute();
        foreach ($activit as $libelle) {
          $nomA = $libelle['nomA'];
        }

        $condition = $database->prepare("SELECT * FROM seance WHERE codeA LIKE :codeA AND jour LIKE :jour");
        $condition->bindparam("codeA", $codeA);
        $condition->bindparam("jour", $jour);
        $condition->execute();

        if ($condition->rowCount() == 0) {
          $insPro = $database->prepare("INSERT INTO seance(codeA, jour, temps, codeL) VALUES(:codeA, :jour, :temps, :codeL)");
          $insPro->bindparam("codeA", $codeA);
          $insPro->bindparam("jour", $jour);
          $insPro->bindparam("temps", $temps);
          $insPro->bindparam("codeL", $codeL);
          if ($insPro->execute()) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>L'ajoutée de la séance au <strong>'" . $jour . "'</strong> dans l'activité <strong>'" . $nomA . "'</strong> est réussi
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
          } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Erreur!</strong> inattendue me contacter</div>';
          }
        } else {

          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>La Séance du <strong>'" . $jour . "'</strong> de l'activité <strong>'" . $nomA . "'</strong> est existe déja 
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        }
      } else {
        $nbr_mot = 0;
        $mot;
        if ($codeA == "L'activité") {
          $mot[$nbr_mot] = "L'activité";
          $nbr_mot++;
        }
        if ($codeL == "Le lieu") {
          $mot[$nbr_mot] = "Le lieu";
          $nbr_mot++;
        }
        if ($jour == "Le jour") {
          $mot[$nbr_mot] = "Le jour";
          $nbr_mot++;
        }
        if ($temps == "") {
          $mot[$nbr_mot] = "L'heure de la séance";
          $nbr_mot++;
        }
        if ($nbr_mot == 4) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir toutes les champs obligatoires de la séance à <strong>ajouter</strong>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } elseif ($nbr_mot == 1) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir <strong>" . '"' . $mot[0] . '"' . "</strong> de la séance
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } else {
          $phrase = "";
          $counteur = 0;
          for ($counteur = 0; $counteur < count($mot); $counteur++) {
            $phrase = $phrase . "<strong>" . $mot[$counteur] . "</strong>";
            if (count($mot) - 2 == $counteur) {
              $phrase = $phrase . " et ";
            } elseif (count($mot) - 1 == $counteur) {
              $phrase = $phrase . " ";
            } else {
              $phrase = $phrase . " , &nbsp;";
            }
          }
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier " . $phrase . " de la séance
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        }
      }
    }

    if (isset($_POST['supp'])) {
      $supp = $_POST['supp'];


      $sqlSupp = $database->prepare("DELETE FROM Seance WHERE codeS=:supp");
      $sqlSupp->bindparam("supp", $supp);

      if ($sqlSupp->execute()) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">La suppression effectuée
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      } else {
        echo '<div class="alert alert-danger" role="alert"><strong>Erreur!</strong> inattendue me contacter</div>';
      }
    }


    echo '<div class="cadre">';
    //formulaire de l'ajout
    $affA = $database->prepare("SELECT * FROM activite ORDER BY codeA DESC");
    $affA->execute();
    //selected l'activité
    echo "<div class='d-grid gap-2 col-10 m-3 mx-auto'><form method='POST'>";
    echo "<center><ins><h6>ajouter une séance</h6></ins><br/></center>";

    echo '<label for="codeA" class="form-label">Activité</label><span style="color:#eb0000;"> *</span>
          <select name="codeA" id="codeA" class="form-select" aria-label="Default select example">';
    echo "<option selected>L'activité</option>";
    foreach ($affA as $contenu) {
      echo '<option value="' . $contenu['codeA'] . '">' . $contenu['nomA'] . '</option>';
    }
    echo '</select>';
    echo '<br>';
    //selected le lieu
    $affL = $database->prepare("SELECT * FROM local");
    $affL->execute();

    echo '<label for="codeL" class="form-label">Lieu</label><span style="color:#eb0000;"> *</span>
        <select name="codeL" id="codeL" class="form-select" aria-label="Default select example">';
    echo '<option selected>Le lieu</option>';
    foreach ($affL as $place) {
      echo '<option value="' . $place['codeL'] . '">' . $place['lieu'] . '</option>';
    }
    echo '</select>';
    echo '<br>';
    //selected le jour  
    echo '<label for="jour" class="form-label">Jour</label><span style="color:#eb0000;"> *</span>
    <select name="jour" id="jour" class="form-select" aria-label="Default select example">';
    echo '<option selected>Le jour</option>';
    echo '<option value="Samedi">Samedi</option>
           <option value="Dimanche">Dimanche</option>
           <option value="Lundi">Lundi</option>
           <option value="Mardi">Mardi</option>
           <option value="Mercredi">Mercredi</option>
           <option value="Jeudi">Jeudi</option>
           <option value="Vendredi">Vendredi</option>';
    echo '</select>';
    echo '<br>';
    //selected le temps
    echo "<label for='temps' class='form-label'>Heure de la séance</label><span style='color:#eb0000;'> *</span>";
    echo '<input type="time" name="temps" class="form-control" id="temps" value="" requird/><br>';

    echo "<center><button type='submit' name='ajout' class='btn btn-success mt-1 w-75'>Ajouter</button></center>";
    echo "</form></div>";

    echo '</div>  
    </main>
    <br>';



    //supprition



    //affichage les séances
    echo "<center><ins><h6>les programmes ajoutés</h6></ins></center><br/>";
    $chaqAct = $database->prepare("SELECT * FROM activite ORDER BY nomA ASC");
    $chaqAct->execute();
    echo '<center><div>';
    foreach ($chaqAct as $act) {
      $codeA = $act['codeA'];
      $nomA = $act['nomA'];
      $seanceAct = $database->prepare("SELECT * FROM seance WHERE codeA LIKE :codeA");
      $seanceAct->bindparam("codeA", $codeA);
      $seanceAct->execute();
      if ($seanceAct->rowCount() != 0) {
        echo '<main class="px-5 h-100">
      <div class="cadre"><br>';
        echo '<table class="table table-bordered border-dark">
		<tr>
			<th colspan="4" class="bg-dark text-light"><center>' . $nomA . '</center></th>
		</tr>';
        echo "<tr><th class='text-dark'>Jour</th>
      <th class='text-dark'>Heure</th>
      <th class='text-dark'>Salle</th>
      <th class='text-dark'>Supprimer</th>
      </tr>";
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
				<td>' . $lieu . '</td>
				<td>';
          echo "<center><form method='POST'><button type='submit' name='supp' class='btn btn-danger mx-3 w-75' value='" . $codeS . "'>X</button></form><center></div>";
          "</td>
				</tr>";
        }

        echo '</table><br>';

        echo '</div></main><br>';
      }
    }
    echo '</div></center>';

    ?>

    <script src="BootStrap/script.js"></script>
</body>

</html>