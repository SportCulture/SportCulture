<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Conditions s'inscrire & participer, Activités de la cité Chlef</title>
  <link rel="stylesheet" href="BootStrap/style.css" />
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
</head>

<body>
  <nav class="navbar navbar-light fixed-top shadow-lg couleur-h">
    <div class="container-fluid">
      <span></span>
      <a class="" href="#"><img id="logo" src="logo/icon-site-1.png" height="120px" alt="" /></a>
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
              <a class="nav-link active" href="Conditions.php">Conditions s'inscrire & participer</a>
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
    <h1>Conditions s'inscrire & participer</h1>
  </center>
  <br>
  <main>
    <div class="cadre">
      <center>
        <h5>Comment s'inscrire dans un activité ?</h5>
      </center>
      <br>
      <p>1)- Les inscription ne sont autorisées que pour les étudiants résidents dans la cité Univercitaire Chlef.</p>
      <p>2)- Lorsque vous choisissez de vous inscrire à une activité sportive, vous devez spécifier une coupie d'un
        certificat médical prouvant vous pouvez faire du sport mais de coté des activités culturelles pas nécessaire.</p>
      <p>3)- Il est nécessaire de déposer un certificat médical valide, sinon votre inscription ne sera pas acceptée.</p>
      <p>4)- Après cinq jours d'inscription adressez-vous à l'administration de service des activites pour recevoir la
        carte d'inscription, et n'obliez pas d'apporter une photo pour la carte avec une copie de la carte de résident.</p>
      <ul class="menu-bouton">
        <center><a class="menu" href="FormulaireInscrir.php">Aller à s'inscrire</a></center>
      </ul>
    </div>
  </main>
  <br>

  <main>
    <div class="cadre">
      <center>
        <h5>Comment participer dans un évènement ?</h5>
      </center>
      <br>
      <p>1)- Les participations ne sont autorisées que pour les étudiants résidents dans la cité Univercitaire Chlef
        et parfoit pour ceux inscrits à une activités précise selon les conditions de l'évènement.</p>
      <p>2)- Lors la participation ouverte pour tous les résidents, la demande de participation est accessible tant 
        que n'attiandre pas le nombre maximum des participants.</p>
      <p>3)- Lors la participation limite aux étudiants inscrits dans l'activité de l'évènement à participer, 
        l'acceptation les participations à travers un test connu.</p>
      <p>4)- La demande de participation ne nécessite de dossier tant qu'il s'agit d'un étudiant résident.</p>
      <ul class="menu-bouton">
        <center><a class="menu" href="Participer.php">Aller à participer</a></center>
      </ul>
    </div>
  </main>
  <br>

  <?php
  require_once "footeur.php";
  ?>

  <script src="BootStrap/script.js"></script>
</body>

</html>