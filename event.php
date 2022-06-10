<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planifier des évènements, Admin Activité de la cité Chlef</title>
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
              <a class="nav-link E" href="Seance.php">Les Heures des Séances</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E active" href="event.php">Planifier Les évènements</a>
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
    <h4>Planifier un évènement</h4>
  </center>
  <br />
  <main class="px-5 h-100">
    <?php
    require_once "conectionBDD.php";

    if (isset($_POST['cree'])) {
      $nomEV = $_POST['nomEV'];
      $dateEV = $_POST['dateEV'];
      $typeAffEV = $_FILES['affEV']['type'];
      if ($typeAffEV != "") {
        $affEV = file_get_contents($_FILES['affEV']['tmp_name']);
      } else {
        $affEV = NULL;
      }
      $nbrJOUR = $_POST['nbrJOUR'];
      $lieuEV = $_POST['lieuEV'];
      $bPartici = $_POST['bPartici'];
      $infoP = false;
      $dateCourant = date("Y-m-d");
      if (($nomEV != "") && ($dateEV != "") && ($typeAffEV != "") && ($lieuEV != "") && ($nbrJOUR != "")) {
        if ($dateEV > $dateCourant) {
          if ($bPartici == 0) {
            $add = $database->prepare("INSERT INTO evenement(nomEV, dateEV, affEV, typeAffEV, nbrJOUR, lieuEV, bPartici, deliePartici, actEV, pourINSC, nbrPartici, dateTEST, heureTEST) VALUES(:nomEV, :dateEV, :affEV, :typeAffEV, :nbrJOUR, :lieuEV, 0, NULL, NULL, NULL, NULL, NULL, NULL)");
            $add->bindParam("nomEV", $nomEV);
            $add->bindParam("dateEV", $dateEV);
            $add->bindParam("affEV", $affEV);
            $add->bindParam("typeAffEV", $typeAffEV);
            $add->bindParam("nbrJOUR", $nbrJOUR);
            $add->bindParam("lieuEV", $lieuEV);
            $infoP = true;
          } else {
            $deliePartici = $_POST['deliePartici'];
            $actEV = $_POST['actEV'];
            $pourINSC = $_POST['pourINSC'];
            $nbrPartici = $_POST['nbrPartici'];
            if (($deliePartici != "") && ($deliePartici < $dateEV) && ($deliePartici > $dateCourant)) {
              if ($actEV != "") {
                if ($pourINSC == 0) {
                  if ($nbrPartici != "") {

                    $add = $database->prepare("INSERT INTO evenement(nomEV, dateEV, affEV, typeAffEV, nbrJOUR, lieuEV, bPartici, deliePartici, actEV, pourINSC, nbrPartici, dateTEST, heureTEST) VALUES(:nomEV, :dateEV, :affEV, :typeAffEV, :nbrJOUR, :lieuEV, 1, :deliePartici, :actEV, 0, :nbrPartici, NULL, NULL)");
                    $add->bindParam("nomEV", $nomEV);
                    $add->bindParam("dateEV", $dateEV);
                    $add->bindParam("affEV", $affEV);
                    $add->bindParam("typeAffEV", $typeAffEV);
                    $add->bindParam("nbrJOUR", $nbrJOUR);
                    $add->bindParam("lieuEV", $lieuEV);
                    $add->bindParam("deliePartici", $deliePartici);
                    $add->bindParam("actEV", $actEV);
                    $add->bindParam("nbrPartici", $nbrPartici);
                    $infoP = true;
                  } else {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>le Nombre maximale des participations</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                  }
                } else {
                  if ($nbrPartici != "") {
                    $dateTEST = $_POST['dateTEST'];
                    if (($dateTEST != "") && ($deliePartici < $dateTEST)) {
                      if ($dateTEST < $dateEV) {
                        $heureTEST = $_POST['heureTEST'];
                        if ($heureTEST != "") {

                          $add = $database->prepare("INSERT INTO evenement(nomEV, dateEV, affEV, typeAffEV, nbrJOUR, lieuEV, bPartici, deliePartici, actEV, pourINSC, nbrPartici, dateTEST, heureTEST) VALUES(:nomEV, :dateEV, :affEV, :typeAffEV, :nbrJOUR, :lieuEV, 1, :deliePartici, :actEV, 1, :nbrPartici, :dateTEST, :heureTEST)");

                          $add->bindParam("nomEV", $nomEV);
                          $add->bindParam("dateEV", $dateEV);
                          $add->bindParam("affEV", $affEV);
                          $add->bindParam("typeAffEV", $typeAffEV);
                          $add->bindParam("nbrJOUR", $nbrJOUR);
                          $add->bindParam("lieuEV", $lieuEV);
                          $add->bindParam("deliePartici", $deliePartici);
                          $add->bindParam("actEV", $actEV);
                          $add->bindParam("nbrPartici", $nbrPartici);
                          $add->bindParam("dateTEST", $dateTEST);
                          $add->bindParam("heureTEST", $heureTEST);

                          $infoP = true;
                        } else {
                          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>le Temps de TEST</strong> pour les participants
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                        }
                      } else {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>La date " . '"' . $dateTEST . '"' . " de TEST</strong> est pas valide par apport de <strong>la date " . '"' . $dateEV . '"' . " de début</strong> de participer de l'évènement
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                      }
                    } else {

                      if ($dateTEST == "") {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>la date de TEST</strong> de participer
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                      } else {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>La date " . '"' . $dateTEST . '"' . " de TEST</strong> de participer de l'évènement est pas valide
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                      }
                    }
                  } else {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>Le Nombre des participations sera accepté après le test</strong> de l'évènement
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                  }
                }
              } else {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>l'activité</strong> de l'évènement
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
              }
            } else {
              if ($deliePartici == "") {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>la date limite</strong> de participer
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
              } else {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>La date " . '"' . $deliePartici . '"' . " limite</strong> de participer de l'évènement est pas valide
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
              }
            }
          }
        } else {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>La date " . '"' . $dateEV . '"' . " de début</strong> de l'évènement est pas valide
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        }
      } else {

        $nbr_mot = 0;
        $mot;
        if ($nomEV == "") {
          $mot[$nbr_mot] = "le nom";
          $nbr_mot++;
        }

        if ($dateEV == "") {
          $mot[$nbr_mot] = "le début";
          $nbr_mot++;
        }

        if ($typeAffEV == "") {
          $mot[$nbr_mot] = "le posteur";
          $nbr_mot++;
        }

        if ($nbrJOUR == "") {
          $mot[$nbr_mot] = "le nombre du jours";
          $nbr_mot++;
        }

        if ($lieuEV == "") {
          $mot[$nbr_mot] = "le lieu";
          $nbr_mot++;
        }

        if ($nbr_mot == 5) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir toutes les champs obligatoires de l'évènement à <strong>planifier</strong>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } elseif ($nbr_mot == 1) {
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier <strong>" . '"' . $mot[0] . '"' . "</strong> de l'évènement
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } else {
          $phrase = "";
          $counteur = 0;
          for ($counteur = 0; $counteur < count($mot); $counteur++) {
            $phrase = $phrase . "<strong>" . $mot[$counteur] . "</strong>";
            if (count($mot) - 2 == $counteur) {
              // $phrase=$phrase."<strong>".$mot[$counteur]."</strong> et ";
              $phrase = $phrase . " et ";
            } elseif (count($mot) - 1 == $counteur) {
              // $phrase=$phrase."&nbsp;<strong>".$mot[$counteur]."</strong> ";
              $phrase = $phrase . " ";
            } else {
              // $phrase=$phrase."<strong>".$mot[$counteur]."</strong> , &nbsp;";
              $phrase = $phrase . " , &nbsp;";
            }
          }
          echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez spécifier " . $phrase . " de l'évènement
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        }
      }
      if ($infoP == true) {
        if ($add->execute()) {
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>L'évènement ont été crée
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        } else {
          echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Une erreur inattendue!!!, peut être le problème dans votre fichier. capturer le et réessayer ou déposer un autre
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        }
      }
    }

    if (isset($_POST['supp'])) {
      $codeEV = $_POST['supp'];
      $condition = $database->prepare("SELECT * FROM participer WHERE codeEV LIKE :codeEV");
      $condition->bindParam("codeEV", $codeEV);
      $condition->execute();

      $spec = $database->prepare("SELECT * FROM evenement WHERE codeEV LIKE :codeEV");
      $spec->bindParam("codeEV", $codeEV);
      $spec->execute();
      foreach ($spec as $EV) {
        $nomEV = $EV['nomEV'];


        if ($condition->rowCount() == 0) {
          $execlu = $database->prepare("DELETE FROM evenement WHERE codeEV LIKE :codeEV");
          $execlu->bindParam("codeEV", $codeEV);
          if ($execlu->execute()) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>La suppression effectuée d'évènement <strong>" . '"' . $nomEV . '"' . "</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
          } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Erreur!</strong> inattendue me contacter</div>';
          }
        } else {

          echo "<center><div class='alert alert-warning alert-dismissible fade show' role='alert'>Vous pouvez <strong>supprimer</strong> aussi les demandes de participations de L'évènement <strong>" . '"' . $nomEV . '"' . "</strong> ? 
        <form method='POST'><button type='submit' class='btn btn-outline-danger mx-3' name='OUI' value='" . $codeEV . "'>OUI</button>
        <button type='submit' class='btn btn-success mx-3' name='NON' value='" . $codeEV . "'>NON</button>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></form></div></div></center>";
        }
      }
    }

    //
    if (isset($_POST['OUI'])) {
      $codeEV = $_POST['OUI'];
      $sup1 = $database->prepare("DELETE FROM participer WHERE codeEV LIKE :codeEV");
      $sup1->bindParam("codeEV", $codeEV);
      $sup1->execute();
      $sup2 = $database->prepare("DELETE FROM evenement WHERE codeEV LIKE :codeEV");
      $sup2->bindParam("codeEV", $codeEV);
      if ($sup2->execute()) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>La suppression effectuée
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
      } else {
        echo '<div class="alert alert-danger" role="alert"><strong>Erreur!</strong> inattendue me contacter</div>';
      }
    }
    if (isset($_POST['NON'])) {

      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>L'annulation effectuée
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
    }

//formulaire de créer un évènement

    $dateCourant = date("Y-m-d");
    ?>
    <div class="cadre">
      <div class="d-grid gap-2 col-10 m-3 mx-auto">
        <form method="POST" enctype='multipart/form-data'>
          <center><ins>
              <h6>créer un évènement</h6>
            </ins></center><br />
          <label for='nomEV'>Nom événements</label><span style='color:#eb0000;'> *</span><input type='text' id='nomEV' name='nomEV' class='form-control' maxlength='100'><br />
          <?php
          echo "<label for='dateEV'>Début</label><span style='color:#eb0000;'> *</span><input type='date' id='dateEV' name='dateEV' min='" . $dateCourant . "' value='' class='form-control'><br/>";
          ?>
          <label for='affEV'>Posteur</label><span style='color:#eb0000;'> *</span><input type='file' id='affEV' name='affEV' accept='image/*' class='form-control'><br />
          <label for='nbrJOUR'>Nombre du jours</label><span style='color:#eb0000;'> *</span><input type='number' id='nbrJOUR' name='nbrJOUR' value='1' class='form-control'><br />
          <label for='lieuEV'>Lieu</label><span style='color:#eb0000;'> *</span>

          <?php
          $affL = $database->prepare("SELECT * FROM local");
          $affL->execute();
          echo "<select name='lieuEV' class='form-select' aria-label='Default select example'>
            <option selected value=''>lieu de faire</option>";
          foreach ($affL as $place) {
            echo "<option value='" . $place["codeL"] . "'>" . $place["lieu"] . "</option>";
          }
          echo "</select>";
          ?>
          <br>
          <label>Demande de participations ?</label><span style='color:#eb0000;'> *</span>
          <br>
          OUI:<input class="form-check-input" type='radio' id='bPartici1' name='bPartici' value='1'><br>
          NON:<input class="form-check-input" type='radio' id='bPartici2' name='bPartici' value='0' checked><br>
          <br>
          <!-- ///////////////////////////////-----------Partie invisible-----------///////////////////////////////// -->

          <article id="participant" style="display: none;">
            <?php
            echo "<label for='deliePartici'>Date Limite</label><span style='color:#eb0000;'> *</span><input type='date' id='deliePartici' name='deliePartici' min='" . $dateCourant . "' value='' class='form-control'>";
            ?>
            <br>
            <label for="actEV">Activité</label><span style='color:#eb0000;'> *</span>
            <?php
            $affA = $database->prepare("SELECT * FROM activite");
            $affA->execute();
            echo "<select id='actEV' name='actEV' class='form-select' aria-label='Default select example'>
                        <option selected value=''>l'activité de l'événement</option>";
            foreach ($affA as $act) {
              echo "<option value='" . $act["codeA"] . "'>" . $act["nomA"] . "</option>";
            }
            echo "</select>";
            ?>
            <br>
            <label>Participer Limite aux inscrits ?</label><span style='color:#eb0000;'> *</span>
            <br>
            OUI:<input class="form-check-input" type='radio' id='pourINSC1' name='pourINSC' value='1'><br>
            NON:<input class="form-check-input" type='radio' id='pourINSC2' name='pourINSC' value='0' checked><br>
            <br>
            <label id="lib" for="nbrPartici">Nombre maximale des participations</label><span style='color:#eb0000;'> *</span>
            <input type='number' id='nbrPartici' name='nbrPartici' value="" class='form-control'>
            <br>
            <div id='Partie_TEST' style="display: none;">
              <?php
              echo "<label for='dateTEST'>Date de Test</label><span style='color:#eb0000;'> *</span><input type='date' id='dateTEST' name='dateTEST' min='" . $dateCourant . "' value='' class='form-control'>";
              ?>
              <br>
              <label for="heureTEST">Temps de Test</label><span style='color:#eb0000;'> *</span><input type='time' id='heureTEST' name='heureTEST' value='' class='form-control'>
              <br>

            </div>
          </article>




          <center><button type='submit' name='cree' class="btn btn-success mt-1 w-100">créer</button></center>
        </form>
      </div>
      <!-- affichage -->
    </div>
  </main>
  <br>


  <main class="px-5 h-100">
    <div class="cadre">
      <center><ins>
          <h6>Les évènements crées</h6>
        </ins><br /></center>
      <div class="tous-scrol-even">
        <?php
        $username = "root";
        $password = "";
        $database = new PDO("mysql:host=localhost;dbname=city;charset=utf8;", $username, $password);

        // $dateCourant= date("Y-m-d");
        $affEV = $database->prepare("SELECT * FROM evenement ORDER BY codeEV DESC");
        //$affEV->bindParam("dateCourant",$dateCourant);
        $affEV->execute();

        foreach ($affEV as $toutEV) {
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
              echo  "<P><ins>Participation Limitée que au inscrit dans l'activité de</ins> <strong>" . $actEV . "</strong></P>";
              echo  "<P><ins>A été accepter :</ins> <strong>" . $nbrPartici . "</strong> participations à travers le test </P>";
              echo  "<P><ins>Le test est programée en:</ins> <strong>" . $dateTEST . "</strong> à l'heure de <strong>" . $heureTEST . "</strong></P>";
            }
          }
          $codeEV = $toutEV['codeEV'];
          echo "<form method='POST'><button type='submit' class='btn btn-danger mx-5' name='supp' value='" . $codeEV . "'>supprimer</button></form>";

          echo "</div>";
        }

        ?>
      </div>
      <span id="Activite"></span>
    </div>
  </main>
  <br>




  <!-- /////////////////////////////////-----------Partie Java Script------------/////////////////////////////////////// -->
  <script>
    let bPartici1 = document.getElementById("bPartici1");
    let bPartici2 = document.getElementById("bPartici2");
    let participant = document.getElementById("participant");
    bPartici1.onclick = () => {
      participant.style.display = "block";
    }
    bPartici2.onclick = () => {
      participant.style.display = "none";
    }
    let pourINSC1 = document.getElementById("pourINSC1");
    let pourINSC2 = document.getElementById("pourINSC2");
    let lib = document.getElementById("lib");
    let Partie_TEST = document.getElementById("Partie_TEST");
    pourINSC1.onclick = () => {
      lib.innerText = "Le Nombre des participations sera accepté après le test";
      Partie_TEST.style.display = "block";
    }
    pourINSC2.onclick = () => {
      lib.innerText = "Nombre maximale des participations";
      Partie_TEST.style.display = "none";
    }
  </script>
  <script src="BootStrap/script.js"></script>
</body>

</html>