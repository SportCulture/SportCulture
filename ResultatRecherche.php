<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Résultat de Recherche, Activités de la cité Chlef</title>
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
  <?php
  ?>
  <center>
    <h4>Résultat de Recherche</h4>
  </center>
  <div class='d-grid gap-2 col-4 m-3 mx-auto'>
    <form class="d-flex" method="POST" action="ResultatRecherche.php">
      <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" name="chercher">
      <button class="btn btn-outline-success" type="submit" name="rechercher">Rechercher</button>
    </form>
  </div>

  <main class="px-5 h-100 rechacher">
    <?php
    require_once "conectionBDD.php";

    if (isset($_POST['rechercher'])) {
      $chercher = $_POST['chercher'];
      //pour chercher sur les activités
      $recharche_Activite = $database->prepare("SELECT * FROM `activite` WHERE nomA LIKE '%$chercher%' OR typeA LIKE '$chercher'");
      $recharche_Activite->execute();

      //pour chercher sur les activités
      $recharche_Evenement = $database->prepare("SELECT * FROM `evenement` WHERE nomEV LIKE '%$chercher%' OR actEV LIKE '%$chercher%'");
      $recharche_Evenement->execute();

      $recharche_A = $database->prepare("SELECT * FROM `activite`");
      $recharche_A->execute();
      $recharche_E = $database->prepare("SELECT * FROM `evenement`");
      $recharche_E->execute();

      $nbr_Act = $recharche_Activite->rowcount();
      $nbr_EV = $recharche_Evenement->rowcount();

      if (($recharche_A->rowcount() != $nbr_Act) && ($recharche_E->rowcount() != $nbr_EV)) {

        if (($nbr_Act != 0) || ($nbr_EV != 0)) {
          if ($nbr_Act == 1) {
            $n_act = "un activité";
          } else {
            $n_act = $nbr_Act . " activités";
          }
          if ($nbr_EV == 1) {
            $n_ev = "un évènement";
          } else {
            $n_ev = $nbr_EV . " évènements";
          }
          if (($nbr_Act != 0) && ($nbr_EV != 0)) {
            echo "<div class='alert alert-info'>Les résultats obtenus de <strong>" . '"' . $chercher . '"' . "</strong> est : &nbsp; <strong>" . $n_act . "</strong> et <strong>" . $n_ev . "</strong></div>";
          } elseif ($nbr_Act != 0) {
            echo "<div class='alert alert-info'>Les résultats obtenus de <strong>" . '"' . $chercher . '"' . "</strong> est : &nbsp; <strong>" . $n_act . "</strong></div>";
          } else {
            echo "<div class='alert alert-info'>Les résultats obtenus de <strong>" . '"' . $chercher . '"' . "</strong> est : &nbsp; <strong>" . $n_ev . "</strong></div>";
          }
        }
      }

      if (($chercher != "") && (($recharche_Activite->rowCount() != 0) || ($recharche_Evenement->rowCount() != 0))) {

        echo '<div class="cadre">';

        if (($recharche_Activite->execute()) && ($recharche_Activite->rowCount() != 0)) {
          echo "<center><h2>Les Activités trouvée</h2></center><br/>";
          echo '<div class="boit-act" >';
          foreach ($recharche_Activite as $value) {
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
        }

        echo "</div>";
    ?>
        <!-- Partie affichage les évènement du résultat  -->
    <?php
        if (($recharche_Evenement->execute()) && ($recharche_Evenement->rowCount() != 0)) {
          echo '<div class="cadre">';

          echo '<center><h5 class="mb-5">Les évènements trouver</h5></center>
        <div class="tous-scrol-even">';

          $dateCourant = date("Y-m-d");

          foreach ($recharche_Evenement as $toutEV) {
            echo "<div class='evenement border border-light px-1'>";
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
            echo  "<P><center><strong>" . $nomEV . "</strong></center><hr><ins>Sera organisé en:</ins> <strong>" . $dateEV . "</strong></P>
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
                echo  "<P><ins>Participation Limitée que au inscrit dans l'activité de<strong></ins> " . $actEV . "</strong></P>";
                echo  "<P><ins>A été accepter :</ins> <strong>" . $nbrPartici . "</strong> participations à travers le test </P>";
                echo  "<P><ins>Le test est programée en:</ins> <strong>" . $dateTEST . "</strong> à l'heure de <strong>" . $heureTEST . "</strong></P>";
              }
              // echo "</div>";
              $codeEV = $toutEV['codeEV'];
              if ($deliePartici >= $dateCourant) {
                echo "<form method='POST' action='FormulaireParticiper.php'><button type='submit' class='btn btn-success mx-5' name='demander' value='" . $codeEV . "'>
                          Participer</button></form>";
              }
            }

            echo "</div>";
          }
        }


        echo "</div>";
      } else {
        echo "<div class='cadre'><center>Aucun Résultats</center></div>";
      }
    }


    ?>
  </main>
  <br>

  <?php
  require_once "footeur.php";
  ?>
  <script src="BootStrap/script.js"></script>
</body>

</html>