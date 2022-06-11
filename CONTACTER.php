<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CONTACTER, Activités de la cité Chlef</title>
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
              <a class="nav-link active" href="CONTACTER.php">CONTACTER</a>
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
    <h1>CONTACTER</h1>
  </center>
  <br>
  <main class='px-5 h-100'>

    <?php
    require_once "conectionBDD.php";
    if (isset($_POST['envoi'])) {
      $nomE = $_POST['nomE'];
      $emailE = $_POST['emailE'];
      $contenu = $_POST['contenu'];
      if (($nomE != "") && ($emailE != "") && ($contenu != "")) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Le message envoyé
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      } else {
        $nbr_mot = 0;
        $mot;
        if ($nomE == "") {
          $mot[$nbr_mot] = "le nom et le prénom";
          $nbr_mot++;
        }
        if ($emailE == "") {
          $mot[$nbr_mot] = "l'émail";
          $nbr_mot++;
        }
        if ($contenu == "") {
          $mot[$nbr_mot] = "le message";
          $nbr_mot++;
        }

        if ($nbr_mot == 3) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir toutes les champs obligatoires
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } elseif ($nbr_mot == 1) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir <strong>" . '"' . $mot[0] . '"' . "</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } else {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir <strong>" . '"' . $mot[0] . '"' . "</strong> et <strong>" . '"' . $mot[1] . '"' . "</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        }
      }
    }

    ?>

    <div class="cadre">
      <div class='d-grid gap-2 col-10 m-3 mx-auto'>
        <form method='POST'>
          <h4>Une question ou une suggestion ?</h4>
          <label for='nomE'>Nom et prénom</label><span style='color:#eb0000;'> *</span>
          <input type='text' id='nomE' name='nomE' placeholder='entrez votre nom et votre prénom' class='form-control' maxlength='35' /><br />
          <label for='emailE'>Email</label><span style='color:#eb0000;'> *</span>
          <input type='email' id='emailE' name='emailE' placeholder='entrez votre email' class='form-control' maxlength='30' /><br />
          <label for="contenu">Message</label><span style='color:#eb0000;'> *</span>
          <textarea type="text" id="contenu" name="contenu" class="form-control" placeholder="Mettr votre message" maxlength="350"></textarea><br>
          <center><button type='submit' name='envoi' class='btn btn-success mt-1 w-75'>Envoyer</button></center>
        </form>
      </div>
    </div>
  </main>
  <br>

  <?php
  require_once "footeur.php";
  ?>
  <script src="BootStrap/script.js"></script>
</body>

</html>
