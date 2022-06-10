<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Le service des activités culturelles et sportives reste debout sur le confort de ses étudiants pour cela fournit divers activités divertissements à travers ça permet eux s’inscrire dans plusieurs activités, aussi il organise des évènements et des tournois sur ses activités disponibles et plus.">
  <meta name="keywords" content="cité Chlef, Activités sportives, Activités culturelles, Résidence Sidi Amar, tournois de la cité">
  <title>SportCulture, Activités de la cité Chlef</title>
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
            <li class="nav-item E">
              <a class="nav-link" href="#R-intern">Règlement Interne</a>
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
              <center><a class="nav-link" href="AuthentificationAdmin.php">Admin</a></center>
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
    <div id="fix"><span><a href="#" class="btn btn-outline-success">^</a></span></div>
    <div class="logo">
      <img id="logo-1" src="logo/chlef-icon.jpg" alt="">
      <img id="logo-2" src="logo/chlef-icon.jpg" alt="">
    </div>
    <center>
      <h1>Espace des activités de la résidence Chlef</h1>
      <span>Culturel-Sportif</span>
    </center>
  </div>
  <div class="menu-bouton-b7th">

    <ul class="menu-bouton">
      <li class="conteneur-liste"><a class="menu part" href="#Activite">Activités disponibles</a>
        <ul id="liste">
          <li><a href="Culture.php">&nbsp;&nbsp;&nbsp;Culturel &nbsp;&nbsp;</a></li>
          <li><a href="Sport.php">&nbsp;&nbsp;&nbsp;&nbsp;Sportif &nbsp;&nbsp;&nbsp;</a></li>
          <li><a href="Scientifique.php">scientifique</a></li>
        </ul>
      </li>
      <li><a class="menu" href="Tous-Evenement.php">évènements</a></li>
      <li><a class="menu" href="Conditions.php">Condition s'inscrire & participer</a></li>
      <li><a class="menu" href="FormulaireInscrir.php">S'inscrire</a></li>
      <li><a class="menu" href="Participer.php">Participer</a></li>
      <li><a class="menu" href="#Locaux">Locaux</a></li>
      <li><a class="menu" href="#Historique">Qui sommes-nous ?</a></li>
      <li>
        <form class="d-flex" method="POST" action="ResultatRecherche.php">
          <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="chercher">
          <button class="btn btn-outline-success" type="submit" name="rechercher">Rechercher</button>
        </form>
      </li>
    </ul>
  </div>

  <!-- évènements -->
  <main class="mt-0">
    <div class="cadre">
      <center>
        <h5 class="mb-5">Coups de coeur</h5>
      </center>
      <div class="tous-scrol-even">
        <?php
        require_once "conectionBDD.php";

        $dateCourant = date("Y-m-d");
        $affEV = $database->prepare("SELECT * FROM evenement WHERE dateEV >= :dateCourant ORDER BY codeEV DESC");
        $affEV->bindParam("dateCourant", $dateCourant);
        $affEV->execute();

        foreach ($affEV as $toutEV) {
          echo "<div class='evenement px-1 shadow-lg'>";
          $getfil = "data:" . $toutEV['typeAffEV'] . ";base64," . base64_encode($toutEV['affEV']);
          echo '<img src="' . $getfil . '" width="200px"/><br/>';
          $nomEV = $toutEV['nomEV'];
          $dateEV = $toutEV['dateEV'];
          $nbrJOUR = $toutEV['nbrJOUR'];

          $codeL = $toutEV['lieuEV'];
          $localEV = $database->prepare("SELECT * FROM local WHERE codeL LIKE :codeL");
          $localEV->bindParam("codeL", $codeL);
          $localEV->execute();
          foreach ($localEV as $place) {
            $lieuEV = $place['lieu'];
          }
          if ($nbrJOUR == 1) {
            $nbrJOUR = "un jour";
          } else {
            $nbrJOUR = $nbrJOUR . " jours";
          }
          echo  "<P><center><strong>" . $nomEV . "</center></strong><hr><ins>Sera organisé en:</ins> <strong>" . $dateEV . "</strong></P>
                    <P><ins>Sa durée:</ins> <strong>" . $nbrJOUR . "</strong> <br><ins>Dans:</ins> <strong>" . $lieuEV . "</strong></P>";
          $bPartici = $toutEV['bPartici'];
          if ($bPartici == '1') {
            $deliePartici = $toutEV['deliePartici'];
            $nbrPartici = $toutEV['nbrPartici'];
            $pourINSC = $toutEV['pourINSC'];

            $codeA = $toutEV['actEV'];
            if ($codeA != "") {
              $affA = $database->prepare("SELECT * FROM activite WHERE codeA LIKE :codeA");
              $affA->bindParam("codeA", $codeA);
              $affA->execute();
              foreach ($affA as $act) {
                $actEV = $act['nomA'];
              }
            }
            echo  "<P><ins>Le dernier délié de participation:</ins> <strong>" . $deliePartici . "</strong></P>";
            if ($pourINSC == '0') {
              echo  "<P><ins>Participation ouverte à tous les résidents dans l'activité de</ins> <strong>" . $actEV . "</strong></P>";
              echo  "<P><ins>Autorisée que :</ins> <strong>" . $nbrPartici . "</strong> participations</P>";
            } else {
              $dateTEST = $toutEV['dateTEST'];
              $heureTEST = $toutEV['heureTEST'];
              echo  "<P><ins>Participation Limitée que au inscrit dans l'activité de</ins> <strong>" . $actEV . "</strong></P>";
              echo  "<P><ins>A été accepter :</ins> <strong>" . $nbrPartici . "</strong> participations à travers le test </P>";
              echo  "<P><ins>Le test est programée en:</ins> <strong>" . $dateTEST . "</strong> à l'heure de <strong>" . $heureTEST . "</strong></P><br>";
            }
            $codeEV = $toutEV['codeEV'];
            if ($deliePartici >= $dateCourant) {
              echo "<form method='POST' action='FormulaireParticiper.php'><button type='submit' class='btn btn-success mx-5' name='demander' value='" . $codeEV . "'>
                          Participer</button></form>";
            }
          }

          echo "</div>";
        }

        ?>
      </div>
      <span id="Activite"></span>
    </div>
  </main>
  <br>

  <!-- activités -->
  <main>
    <div class="cadre">
      <?php
      $username = "root";
      $password = "";
      $database = new PDO("mysql:host=localhost;dbname=city;charset=utf8;", $username, $password);

      $apporte = $database->prepare("SELECT * FROM activite ORDER BY codeA DESC");
      $apporte->execute();
      if ($apporte->rowCount() != 0) {
        echo "<center><h2>Les Activités de la Cité Chlef</h2></center><br/>";
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
  </main>
  <!-- locaux -->
  <br>
  <main class="">
    <div class="cadre">
      <h5><span>Plane</span> de la résidence</h5>
      <p>Cité Univercitaire Chlef</p>
      <img id="cite" src="images/plane.jpg" alt="" />
      <span id="Locaux"></span>
      <hr>
      <h5>Les Locaux</h5>
      <br>
      <div class="tous-scrol">
        <div class="lieu">
          <img src="images/entrer.jpg" alt="">
          <Center>
            <h6>Entrée la cité</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/restaurant.jpg" alt="">
          <Center>
            <h6>Restaurant des étudiants et des employés</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/administration-Chlef.jpg" alt="">
          <Center>
            <h6>Administration Dali Ali de la cité</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/service-A-C.jpg" alt="">
          <Center>
            <h6>Administration du service des activités culturelles et sportifs</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/teatre.jpg" alt="">
          <Center>
            <h6>Théàtre de féte</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/salle-Sport.jpg" alt="">
          <Center>
            <h6>Salle Multi-sports</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/chapelle-Ex.jpg" alt="">
          <Center>
            <h6>Chapelle vue de l'extérieur</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/chapelle-In.jpg" alt="">
          <Center>
            <h6>à l'intérieur de la Chapelle</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/service-tech.jpg" alt="">
          <Center>
            <h6>Service des technitiens</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/magasin-general.jpg" alt="">
          <Center>
            <h6>Magasin général</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/medecine.jpg" alt="">
          <Center>
            <h6>Unité de médecine préventive</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-1.jpg" alt="">
          <Center>
            <h6>pavillon n°:01</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-2.jpg" alt="">
          <Center>
            <h6>pavillon n°:02</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-3.jpg" alt="">
          <Center>
            <h6>pavillon n°:03</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-4.jpg" alt="">
          <Center>
            <h6>pavillon n°:04</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-5.jpg" alt="">
          <Center>
            <h6>pavillon n°:05</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-6.jpg" alt="">
          <Center>
            <h6>pavillon n°:06</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-7.jpg" alt="">
          <Center>
            <h6>pavillon n°:07</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-8.jpg" alt="">
          <Center>
            <h6>pavillon n°:08</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-9.jpg" alt="">
          <Center>
            <h6>pavillon n°:09</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-10.jpg" alt="">
          <Center>
            <h6>pavillon n°:10</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-11.jpg" alt="">
          <Center>
            <h6>pavillon n°:11</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-12.jpg" alt="">
          <Center>
            <h6>pavillon n°:12 (inutilisé)</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-13.jpg" alt="">
          <Center>
            <h6>pavillon n°:13 (inutilisé)</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-14.jpg" alt="">
          <Center>
            <h6>pavillon n°:14</h6>
          </Center>
        </div>
        <div class="lieu">
          <img src="images/pavillon-15.jpg" alt="">
          <Center>
            <h6>pavillon n°:15</h6>
          </Center>
        </div>
      </div>
      <span id="R-intern"></span>
    </div>
  </main>
  <br>
  <main class="">
    <div class="cadre">
      <h5>Règlement interne</h5>
      <br>
      <div>
        <h6><span>En entrant dans la résidence</span></h6>
        <p>Présenter la carte d'étudiant ou la carte résident, pour les gardiens de l'entrée extérieure afin de 
          faciliter le processus de garantie de la sécurité intérieure de résidence.</p>
        <hr />
        <h6><span>En entrant dans Restaurant</span></h6>
        <p>L'entrée des étudiants au restaurant nécessite la présentation d'une carte de résident et d'un ticket déjeuner ou petit-déjeuner.
          <span id="Historique"></span>
        </p>
      </div>
    </div>
  </main>
  <br>

  <main class="">
    <div class="cadre">

      <h5>Qui Sommes-Nous</h5>
      <br>
      <p>La cité universitaire Chlef est un campus unique à Annaba. Elle accueille chaque année 400 étudiants, dans ses
        15 pavillons. Elle s’est bâtie pour donner aux étudiants la chance de suivre leurs études sans les contraintes
        de la distance. Elle offre plusieurs activités ( Culturelles et sportives ) pour découvrir de nombreux talents.
      </p>
    </div>
  </main>
  <br>

  <?php
  require_once "footeur.php";
  ?>
  <script src="BootStrap/script.js"></script>
</body>

</html>