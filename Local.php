<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Local</title>
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
              <a class="nav-link E active" href="Local.php">Ajouter Locaux</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="Seance.php">Les Heures des Séances</a>
            </li>
            <li class="nav-item">
              <a class="nav-link E" href="event.php">Planifier Les évènements</a>
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
    <h4>Ajouter Locaux</h4>
  </center>
  <br>
  <main class="px-5 h-100">
    <?php
    require_once "conectionBDD.php";

    //Ajout

    if (isset($_GET['ajout'])) {
      if ($_GET['lieu'] != "") {
        $lieu = $_GET['lieu'];
        $surface = $_GET['surface'];
        if ($surface > 0) {
          $condition = $database->prepare("SELECT COUNT(*) FROM local WHERE lieu LIKE :item ");
          $condition->bindparam("item", $lieu);
          $condition->execute();
          foreach ($condition as $repiter) {
            $nebr = $repiter['COUNT(*)'];
          }
          if ($nebr == 0) {

            $insert = $database->prepare("INSERT INTO local(lieu, surface) VALUES (:lieu, :surface) ");
            $insert->bindparam("lieu", $lieu);
            $insert->bindparam("surface", $surface);

            if ($insert->execute()) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> Bien ajoutée <strong>"' . $lieu . '"</strong>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
            } else {
              echo '<div class="alert alert-danger" role="alert">pour effectuer la suppression de cette lieu, Vous devez supprimer toutes les évènements dans cette lieu !!!</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">  Le lieu <strong>"' . $lieu . '"</strong> est existe déja
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Vous devez saisir <strong>"un surface"</strong> valide 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
        }
      } else {

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Vous devez spécifier un lieu 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      }
    }
    echo '<div class="cadre">';
    echo "<center><ins><h6>ajouter un lieu</h6></ins></center><br/>";
    echo '<div class="d-grid gap-2 col-10 m-3 mx-auto"><form  method="GET"> 
            <label for="lieu" class="form-label">Nom Lieu</label><span style="color:#eb0000;"> *</span>
            <input type="text" name="lieu" class="form-control" id="lieu" placeholder="entrez le nom de lieu" requird/><br>
            <label for="surface" class="form-label">Le surface du Lieu</label><span style="color:#eb0000;"> *</span>
            <input type="number" name="surface" class="form-control" id="surface" placeholder="(m²)" requird/><br>
            <center><button type="submit" name="ajout" class="btn btn-success mt-1 w-75">Ajouter</button></center>
            </form></div>';

    echo '</div></main><br>';

    echo "<main class='px-5 h-100'>";

    //Suppresion
    if (isset($_GET['supp'])) {
      $supp = $_GET['supp'];


      $sqlSupp = $database->prepare("DELETE FROM local WHERE lieu=:supp");
      $sqlSupp->bindparam("supp", $supp);

      if ($sqlSupp->execute()) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">La suppression effectuée sur <strong>"' . $supp . '"</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>la suppression est imposible!</strong> pour faire ça premièrement effacez tous qui liés à ce local
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
      }
    }


    echo '<div class="cadre">';

    //Affichage
    $sql = $database->prepare("SELECT * FROM local ORDER BY codeL DESC");
    $sql->execute();
    echo "<center><ins><h6>les lieux disponibles</h6></ins></center><br/>";
    echo '<div><center><table class="table table-bordered border-dark w-75">';
    foreach ($sql as $place) {

      echo "<tr><th><center>" . $place['lieu'] . "</center></th>";

      echo "<td rowspan='2'><center><form method='GET'><center><button type='submit' name='supp' class='btn btn-danger mx-1 w-50' value='" . $place['lieu'] . "'>X</button></center></form></center></td>";
      echo '</tr>';
      echo "<tr><td><center>" . $place['surface'] . " m²</center></td></tr>";
    }
    echo '</table></center><div>';

    ?>
    </div>
  </main><br>
  <script src="BootStrap/script.js"></script>
</body>

</html>