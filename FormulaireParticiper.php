<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Demander la participation, Activités de la cité Chlef</title>
    <link rel="stylesheet" href="BootStrap/style.css" />
    <link rel="stylesheet" href="indexCSS.css" />
    <link rel="icon" href="logo/icon-site-1.png" />
</head>

<body>
    <?php
    require_once 'menuGeneral.php';
    require_once "conectionBDD.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['demander'])) {
            $_SESSION['demander'] = $_POST['demander'];
        }

        $codeEV = $_SESSION['demander'];
        $affEV = $database->prepare("SELECT * FROM evenement WHERE codeEV LIKE :codeEV");
        $affEV->bindParam("codeEV", $codeEV);
        $affEV->execute();
        foreach ($affEV as $selectInfo) {
            $nomEV = $selectInfo['nomEV'];
            $pourINSC = $selectInfo['pourINSC'];
            $codeA = $selectInfo['actEV'];
            $nbrPartici = $selectInfo['nbrPartici'];
            $dateTEST = $selectInfo['dateTEST'];
            $heureTEST = $selectInfo['heureTEST'];
        }

    ?>

        <center>
            <h1>Demander la participation</h1>
        </center>
        <ul class="menu-bouton">
            <li><a class="menu" href="Conditions.php">Voir les Conditions s'inscrire & participer</a></li>
            <li><a class="menu" href="Participer.php">Choiser autre évènement</a></li>
        </ul>
        <br>
        <main class="px-5 h-100">
            <?php

            $dateCourant = date("Y-m-d");

            if (isset($_POST['envoiyer'])) {


                ///*---------------------
                $numCart = $_POST['numCart'];
                $nomE = $_POST['nomE'];
                $preE = $_POST['preE'];
                if (($numCart != "") && ($nomE != "") && ($preE != "")) {
                    $verifier1 = $database->prepare("SELECT * FROM etudres WHERE numCart LIKE :numCart AND nomE LIKE :nomE AND preE LIKE :preE");
                    $verifier1->bindParam("numCart", $numCart);
                    $verifier1->bindParam("nomE", $nomE);
                    $verifier1->bindParam("preE", $preE);
                    $verifier1->execute();
                    if ($verifier1->rowCount() == 1) {
                        $verifier2 = $database->prepare("SELECT * FROM participer WHERE codeEV LIKE :codeEV AND numCart LIKE :numCart");
                        $verifier2->bindParam("codeEV", $codeEV);
                        $verifier2->bindParam("numCart", $numCart);
                        $verifier2->execute();
                        if ($verifier2->rowCount() == 0) {
                            if ($pourINSC == 0) {
                                $verifier3 = $database->prepare("SELECT * FROM participer WHERE codeEV LIKE :codeEV");
                                $verifier3->bindParam("codeEV", $codeEV);
                                $verifier3->execute();
                                if ($verifier3->rowCount() < $nbrPartici) {
                                    $participant = $database->prepare("INSERT INTO participer(numCart, codeEV, test) VALUES(:numCart, :codeEV, 1)");
                                    $participant->bindParam("numCart", $numCart);
                                    $participant->bindParam("codeEV", $codeEV);
                                    if ($participant->execute()) {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>La demande envoyée
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Une erreur inattendue!!!, contactez nous pour expliquer le problème
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Nombre maximal de participations atteint (max <strong>" . $nbrPartici . "</strong> participants)
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                }
                            } else {

                                $verifier3 = $database->prepare("SELECT * FROM inscrir WHERE numCart LIKE :numCart AND codeA LIKE :codeA AND validerInscrir LIKE 1");
                                $verifier3->bindParam("numCart", $numCart);
                                $verifier3->bindParam("codeA", $codeA);
                                $verifier3->execute();
                                if ($verifier3->rowCount() == 1) {
                                    $participant = $database->prepare("INSERT INTO participer(numCart, codeEV, test) VALUES(:numCart, :codeEV, NULL)");
                                    $participant->bindParam("numCart", $numCart);
                                    $participant->bindParam("codeEV", $codeEV);
                                    if ($participant->execute()) {
                                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>La demande envoyée
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                        echo "<center>Rendez-vous du TEST: <strong>" . $dateTEST . "</strong> à l'heure de <strong>" . $heureTEST . "</strong></center>";
                                    } else {
                                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Une erreur inattendue!!!, contactez nous pour expliquer le problème
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>La demande est échouée, Vous n'êtes pas inscrit dans l'activité de cette évènement
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                                }
                            }
                        } else {
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>vous êtes déja participant dans cette évènement
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                        }
                    } else {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>La demande est échouée, Vous n'êtes pas résidants dans la Cité universitaire Chlef ou au mois une de informations est incorect
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    }
                } else {

                    $nbr_mot = 0;
                    $mot;
                    if ($numCart == "") {
                        $mot[$nbr_mot] = "le numéro";
                        $nbr_mot++;
                    }

                    if ($nomE == "") {
                        $mot[$nbr_mot] = "le nom";
                        $nbr_mot++;
                    }

                    if ($preE == "") {
                        $mot[$nbr_mot] = "le prénom";
                        $nbr_mot++;
                    }

                    if ($nbr_mot == 3) {
                        echo "<div id='a4' class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir toutes les champs obligatoires de la demande
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                    } elseif ($nbr_mot == 1) {
                        echo "<div id='a5' class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir <strong>" . '"' . $mot[0] . '"' . "</strong> de la demande
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                    } else {
                        echo "<div id='a6' class='alert alert-warning alert-dismissible fade show' role='alert'>Vous devez remplir <strong>" . '"' . $mot[0] . '"' . "</strong> et <strong>" . '"' . $mot[1] . '"' . "</strong> de la demande
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                    }
                }
            }
            echo "<div class='cadre'>";
            echo "<center><h5><ins>L'évenement </ins>: " . $nomEV . "</h5></center><br>";

            ?>

            <div class='d-grid gap-2 col-10 m-3 mx-auto'>
                <form method='POST'>
                    <label for='numCart'>Numéro de la carte</label><span style='color:#eb0000;'> *</span>
                    <input type='number' name='numCart' id='numCart' placeholder="entrer votre numéro (10 Chiffres)" class='form-control'><br>
                    <label for='nomE'>Nom de participant</label><span style='color:#eb0000;'> *</span>
                    <input type='text' name='nomE' id='nomE' placeholder="entrer votre nom" class='form-control' maxlength='35'><br>
                    <label for='preE'>Prénom de participant</label><span style='color:#eb0000;'> *</span>
                    <input type='text' name='preE' id='preE' placeholder="entrer votre prénom" class='form-control' maxlength='35'><br>
                    <center><button type='submit' name='envoiyer' class='btn btn-success mt-1 w-75'>envoiyer</button></center>
                </form>
            </div>
            </div>
        </main>
        <br>

        <?php
        require_once "footeur.php";
        ?>

    <?php
    } else {
        echo "<center><h1>répétez l'entrer</h1></center>";
        header("refresh:4;url=Participer.php");
    }
    ?>
    <script src="BootStrap/script.js"></script>
</body>

</html>