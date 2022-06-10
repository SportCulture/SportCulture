<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connecter, Activités de la cité Chlef</title>
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
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <br>
            </li>
            <li class="nav-item">
              <center><a class="nav-link active" href="AuthentificationAdmin.php">Admin</a></center>
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
    <h1>Se connecter</h1>
  </center>
  <br>
  <main class="bg px-5 h-100">
    <?php
    require_once "conectionBDD.php";

    if (isset($_POST['connecter'])) {
      $nomAdm = $_POST['nomAdm'];
      $motDePass = $_POST['motDePass'];
      $verifier = $database->prepare("SELECT * From admin WHERE nomAdm LIKE :nomAdm AND motDePass LIKE :motDePass");
      $verifier->bindParam("nomAdm", $nomAdm);
      $verifier->bindParam("motDePass", $motDePass);
      $verifier->execute();
      if ($verifier->rowCount() == 1) {
        echo "<div class='alert alert-success' role='alert'>Connection réussie</div>";
        header("refresh:2;url=AccueilAdmin.php");
      } else {
        echo "<div class='alert alert-danger' role='alert'>les informations saisiés sont erronés</div>";
      }
    }
    ?>

    <div class="cadre">
      <div class='d-grid gap-2 col-10 m-3 mx-auto'>
        <form method='POST'>
          <label for='nomAdm' class='form-label'>Nom Utilisateur</label><span style='color:#eb0000;'> *</span>
          <input type='text' id='nomAdm' name='nomAdm' class="form-control" placeholder="entrez votre nom d'utilisateur"><br>
          <label for='motDePass' class='form-label'>Mot De Passe</label><span style='color:#eb0000;'> *</span>
          <input type='password' id='motDePass' name='motDePass' class="form-control" placeholder="entrez votre mot de passe"><br>
          <center><button type='submit' name='connecter' class='btn btn-success mt-1 w-75'>Connecter</button></center>
        </form>
      </div>
    </div>
  </main>

  <script src="BootStrap/script.js"></script>
</body>

</html>