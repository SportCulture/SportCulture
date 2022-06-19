<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SportCulture, Activités de la cité Chlef</title>
  <link rel="stylesheet" href="BootStrap/style.css" />
  <link rel="stylesheet" href="indexCSS.css" />
  <link rel="icon" href="logo/icon-site-1.png" />
</head>

<body>
  <?php
  require_once 'menuGeneral.php';
  require_once "conectionBDD.php";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['heures'])) {
      $heures = $_POST['heures'];

      $Actt = $database->prepare("SELECT * FROM activite WHERE codeA LIKE :codeA");
      $Actt->bindparam("codeA", $heures);
      $Actt->execute();
      foreach ($Actt as $NomAct) {
        $nomA = $NomAct['nomA'];
      }

      echo "<center><h1>L'emploi du temps de <span> " . '" ' . $nomA . ' "' . " </span></h1></center>
    <br>";

      $seanceAct = $database->prepare("SELECT * FROM seance WHERE codeA LIKE :codeA");
      $seanceAct->bindparam("codeA", $heures);
      $seanceAct->execute();
      echo "<main>
        <div class='cadre'><br>";
      echo '<table class="table table-bordered border-dark">
    <tr>';
      echo "<th class='bg-dark text-light'>Jour</th>
        <th class='bg-dark text-light'>Heure</th>
        <th class='bg-dark text-light'>Salle</th>";
      echo '</tr>';
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
            <td>' . $lieu . '</td>';
        echo "</tr>";
      }

      echo '</table>';
      echo "</div>
    </main><br>";
    }
  } else {
    echo "<center><h1>répétez l'entrer</h1></center>";
    header("refresh:4;url=indexAcc.php");
  }
  ?>
  <br>

  <?php
  require_once "footeur.php";
  ?>

  <script src="BootStrap/script.js"></script>
</body>

</html>