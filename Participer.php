<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Les évenements disponible pour La participation, Activités de la cité Chlef</title>
  <link rel="stylesheet" href="BootStrap/style.css" />
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
</head>

<body>
  <?php
  require_once 'menuGeneral.php';
  ?>
  <center>
    <h1>Les évenements disponible pour La participation</h1>
  </center>
  <ul class="menu-bouton">
    <li><a class="menu" href="Conditions.php">Voir les Conditions s'inscrire & participe</a></li>
  </ul>
  <br>
  <main>
    <div class="cadre">
      <div class="tous-scrol-even">
        <?php
        require_once "conectionBDD.php";

        $dateCourant = date("Y-m-d");
        $affEV = $database->prepare("SELECT * FROM evenement WHERE deliePartici >= :dateCourant ORDER BY codeEV DESC");
        $affEV->bindParam("dateCourant", $dateCourant);
        $affEV->execute();
        if ($affEV->rowCount() != 0) {

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

              echo "<form method='POST' action='FormulaireParticiper.php'><button type='submit' class='btn btn-success mx-5' name='demander' value='" . $codeEV . "'>
                        Participer</button></form>";
            }

            echo "</div>";
          }
        } else {
          echo "<P><center>Pour le moment, il n'y pas des évènement dans lesquelles vous pouvez participer</center</P>";
        }

        ?>
      </div>
      <span id="Activite"></span>
    </div>
  </main>

  <br>
  <?php
  require_once "footeur.php";
  ?>
  <script src="BootStrap/script.js"></script>
</body>

</html>