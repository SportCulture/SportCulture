<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter les Résidants</title>
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
              <a class="nav-link E active" href="AjoutResid.php">Ajouter Les résidents</a>
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
    <h4>Ajouter les résidents</h4>
  </center>
  <br />
  <main class="px-5 h-100">
    <?php
    require_once "conectionBDD.php";

    if (isset($_GET['ajout'])) {
      $numCart = $_GET['numCart'];
      $nomE = $_GET['nomE'];
      $preE = $_GET['preE'];
      if (($numCart != "") && ($nomE != "") && ($preE != "")) {

        $add = $database->prepare("INSERT INTO etudres (numCart, nomE, preE, emailE) VALUES (:numCart, :nomE, :preE, NULL)");
        $add->bindParam("numCart", $numCart);
        $add->bindParam("nomE", $nomE);
        $add->bindParam("preE", $preE);
        if ($add->execute()) {
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'> L'ajouter de l'étudiant <strong>" . '"' . $nomE . " " . $preE . '"' . "</strong> a été réussi
               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        } else {
          echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>le numéro de la carte <strong>" . '" ' . $numCart . ' "' . "</strong> d'un étudiant est existe déjà !!!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
        }
      } else {

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Vous devez remplir toutes les champs obligatoires
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      }
    }
    echo '<div class="cadre">';

    //formulaire de l'ajout
    echo "<center><ins><h6>pour ajouter les résidants</h6></ins></center><br/>";
    echo "<div class='d-grid gap-2 col-10 m-3 mx-auto'><form method='GET'>
          <label for='numCart' class='form-label'>Numéro de la carte d'étudiant </label><span style='color:#eb0000;'> *</span>
          <input type='number' name='numCart' id='numCart' class='form-control' placeholder='entrez le numéro (10 Chiffres)'/><br>
          <label for='nomE' class='form-label'>Nom Etudiant</label><span style='color:#eb0000;'> *</span>
          <input type='text' name='nomE' id='nomE' class='form-control' placeholder='entrez le nom' maxlength='35'/><br>
          <label for='preE' class='form-label'>Prénom Etudiant</label><span style='color:#eb0000;'> *</span>
          <input type='text' name='preE' id='preE' class='form-control' placeholder='entrez le prénom' maxlength='35'/><br>
          <center><button type='submit' name='ajout' class='btn btn-success mt-1 w-75'>Ajouter</button></center>
      </form>
    </div>";
    echo "</div>
        </main>
        <br>";
    echo '<main class="px-5 h-100">
        <div class="cadre" style="overflow-x: auto;">';
    echo "<center><ins><h6>les résidants ajoutés</h6></ins></center><br/>";
    $affichResid = $database->prepare("SELECT * FROM etudres ORDER BY nomE, preE");
    $affichResid->execute();

    $Numero = 1;
    echo '<div style="overflow-x: auto;"><table class="table table-success table-striped">
      <thead>
        <tr>
          <th>N°</th>
          <th>Numéro de la Carte</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>';
    foreach ($affichResid as $etudiant) {

      echo "<tr>
                <td>" . $Numero . "</td>
                <td>" . $etudiant['numCart'] . "</td>
                <td>" . $etudiant['nomE'] . "</td>
                <td>" . $etudiant['preE'] . "</td>
                <td>" . $etudiant['emailE'] . "</td>
            </tr>";
      $Numero++;
    }
    echo "</tbody>
    </table></div>";

    ?>
    </div>
  </main>
  <br>
  <script src="BootStrap/script.js"></script>
</body>

</html>