<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>L'inscription à une activité, Activités de la cité Chlef</title>
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
  <center>
    <h1>L'inscription à une activité</h1>
  </center>
  <ul class="menu-bouton">
    <li><a class="menu" href="Conditions.php">Voir les Conditions s'inscrire & participer</a></li>
  </ul>
  <br />
  <main class="px-5 h-100">
    <?php
    require_once "conectionBDD.php";

    //requitte insertion
    if (isset($_POST['up'])) {
      if ($_FILES['fichier']['name'] != "") {
        $certi = file_get_contents($_FILES['fichier']['tmp_name']);
        $typeCerti = $_FILES['fichier']['type'];
      } else {
        $certi = NULL;
        $typeCerti = NULL;
      }

      $numCart = $_POST['numCart'];
      $nomE = $_POST['nomE'];
      $preE = $_POST['preE'];
      $codeA = $_POST['codeA'];
      $emailE = $_POST['emailE'];
      if (($numCart != "") && ($nomE != "") && ($preE != "") && ($codeA != "L'activité") && ($emailE != "")) {
        $verifier1 = $database->prepare("SELECT * FROM etudres WHERE numCart LIKE :numCart AND nomE LIKE :nomE AND preE LIKE :preE");
        $verifier1->bindParam("numCart", $numCart);
        $verifier1->bindParam("nomE", $nomE);
        $verifier1->bindParam("preE", $preE);
        $verifier1->execute();
        if ($verifier1->rowCount() != 0) {
          $verifier2 = $database->prepare("SELECT * FROM activite WHERE codeA LIKE :codeA");
          $verifier2->bindParam("codeA", $codeA);
          $verifier2->execute();
          foreach ($verifier2 as $typ) {
            $typeA = $typ['typeA'];
          }
          if ((($typeA == "Sportif") && ($_FILES['fichier']['name'] != "")) || (($typeA == "Culturel") && ($_FILES['fichier']['name'] == "")) || (($typeA == "Scientifique") && ($_FILES['fichier']['name'] == ""))) {
            $redandance = $database->prepare("SELECT * FROM inscrir WHERE codeA LIKE :codeA AND numCart LIKE :numCart");
            $redandance->bindParam("numCart", $numCart);
            $redandance->bindParam("codeA", $codeA);
            $redandance->execute();
            if ($redandance->rowCount() == 0) {
              $rejoindre = $database->prepare("INSERT INTO inscrir(numCart, codeA, certi, typeCerti, validerInscrir) VALUES(:numCart, :codeA, :certi, :typeCerti, 0)");
              $rejoindre->bindParam("numCart", $numCart);
              $rejoindre->bindParam("codeA", $codeA);
              $rejoindre->bindParam("certi", $certi);
              $rejoindre->bindParam("typeCerti", $typeCerti);
              $rejoindre->execute();
              $attacher = $database->prepare("UPDATE etudres SET emailE=:emailE WHERE numCart=:numCart");
              $attacher->bindParam("numCart", $numCart);
              $attacher->bindParam("emailE", $emailE);
              if ($attacher->execute()) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Inscription réussie
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
              } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Une erreur !!!, peut être le problème dans votre fichier. Les solution proposés: capturer le et réessayer ou déposer un autre
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
              }
            } else {
              echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>déja vous êtes inscrit dans cette activité
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
          } else {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez déposer l'image de certificat si vous choisissez une activité sportive 
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
          }
        } else {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>L'inscription est échouée, Vous n'êtes pas résidants dans la Cité universitaire Chlef ou au mois une de informations est incorect
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        }
      } else {
        $nbr_mot = 0;
        $mot;
        if ($numCart == "") {
          $mot[$nbr_mot] = "le numéro";
          $nbr_mot++;
        }
        if ($nomE == "") {
          $mot[$nbr_mot] = "le nom";
          $nbr_mot++;
        }
        if ($preE == "") {
          $mot[$nbr_mot] = "le prénom";
          $nbr_mot++;
        }
        if ($codeA == "L'activité") {
          $mot[$nbr_mot] = "L'activité";
          $nbr_mot++;
        }
        if ($emailE == "") {
          $mot[$nbr_mot] = "l'émail";
          $nbr_mot++;
        }
        if ($nbr_mot == 5) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir toutes les champs obligatoires de l'inscription
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        } elseif ($nbr_mot == 1) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>" . '"' . $mot[0] . '"' . "</strong>.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } else {
          $phrase = "";
          $counteur = 0;
          for ($counteur = 0; $counteur < count($mot); $counteur++) {
            $phrase = $phrase . "<strong>" . $mot[$counteur] . "</strong>";
            if (count($mot) - 2 == $counteur) {
              $phrase = $phrase . " et ";
            } elseif (count($mot) - 1 == $counteur) {
              $phrase = $phrase . ". ";
            } else {
              $phrase = $phrase . " , &nbsp;";
            }
          }
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier " . $phrase . "
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        }
      }
    }
    //formulaire d'inscrir
    echo "<div class='cadre'>";
    $affA = $database->prepare("SELECT * FROM activite ORDER BY codeA DESC");
    $affA->execute();
    echo "<div class='d-grid gap-2 col-10 m-3 mx-auto'><form method='POST' enctype='multipart/form-data'>
      <label for='numCart'>Numéro de la carte</label><span style='color:#eb0000;'> *</span>
      <input type='number' id='numCart' name='numCart' placeholder='entrer votre numéro (10 Chiffres)' class='form-control'/><br/>
      <label for='nomE'>Nom étudiant</label><span style='color:#eb0000;'> *</span>
      <input type='text' id='nomE' name='nomE' placeholder='entrez votre nom' class='form-control' maxlength='35'/><br/>
      <label for='preE'>Prénom étudiant</label><span style='color:#eb0000;'> *</span>
      <input type='text' id='preE' name='preE' placeholder='entrez votre prénom' class='form-control' maxlength='35'/><br/>
      <label for='codeA'>Activité</label><span style='color:#eb0000;'> *</span>";
    echo '<select id="codeA" name="codeA" class="form-select" aria-label="Default select example">';
    echo "<option selected>L'activité</option>";
    foreach ($affA as $contenu) {
      echo '<option value="' . $contenu['codeA'] . '">' . $contenu['nomA'] . '</option>';
    }
    echo '</select><br/>';

    echo "<label for='emailE'>Email</label><span style='color:#eb0000;'> *</span>
      <input type='email' id='emailE' name='emailE' placeholder='entrez votre email' class='form-control' maxlength='30'/><br/>
      <label for='fichier'>Certificat &nbsp;&nbsp;&nbsp;(Pour les activités Sportives<span style='color:#eb0000;'> *</span>)</label>
      <input type='file' id='fichier' name='fichier' accept='image/*' class='form-control'/><br/>
      <center><button type='submit' name='up' class='btn btn-success mt-1 w-75'>Envoyer</button></center>
    </form></div>";


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
