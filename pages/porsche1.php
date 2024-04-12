<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Porsche</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../stylesheet/marques.css">

        <!--lien font awsome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    </head>
    <body>
        <div class="container-fluid" id="haut" style="background-color: rgb(35, 35, 35);">
            <div class="row">
                <div class="col p-3" style="color: blue;">Supercar : ne experience unique</div>
                <div class="col d-flex justify-content-end">
                    <a href=""><i class="fa-brands fa-facebook-f p-3" id="facebook"></i></a>
                    <a href=""><i class="fa-brands fa-instagram p-3"></i></a>
                    <a href=""><i class="fa-brands fa-x-twitter p-3"></i></a>
                    <a href=""><i class="fa-brands fa-linkedin-in p-3"></i></a>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" id="header">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <img src="../images/logo.png" alt="">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center navmenu">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Acceuille</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="voitures.html">voitures</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="essai.html img-voiture">Demande d'essai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="evenement.html">Evenement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact1.html">contactesz nous</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="signup.html">s'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">se connecter</a>
                            </li>
                        </ul>
                    </span>
                </div>
            </div>
        </nav>
        <div class="container-fluid border p-3" style="background-color: rgb(255, 34, 0);">
            <div class="row">
                <div class="col-12 col-md-5 d-flex justify-content-center align-items-center flex-column">
                    <div class="row">
                        <div class="col-12">
                            <h1>Modèles Porsche</h1>
                        </div>
                        <div class="col-12">
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <div class="col-1" style="background-color: black; width: 0.5rem"></div>
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <img src="../images/porche-vert-removebg-preview.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 p-5 d-flex justify-content-center" id="moteurs-thermique-p"><h1>Moteurs thérmiques</h1></div>
            </div>
        </div>
        <?php
            include ("../database/connexion.php");
            $selection = "SELECT * FROM modele JOIN voitures ON modele.IdModele = voitures.IdModele WHERE modele.IdModele BETWEEN 7 AND 8;";
            $curseur = mysqli_query($dbd, $selection);
            while($row = mysqli_fetch_array($curseur)) {
                $nommodele = $row["NomModele"];
                $annee= $row["Annee"];
                $prix = $row["Prix"];
                $idvoiture = $row["IdVoiture"];
                $couleur = $row["Couleur"];
                $typemoteur = $row["TypeMoteur"];
                $carburant = $row["Carburant"];
                $km = $row["Km"];
                $boitevitesse = $row["BoiteVitesse"];
                $image = $row["Image"]
        ?>
    <div class="container voitures mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-5 d-flex justify-content-center align-items-center">
                <div class="row text-center">
                    <div class="col-12 pt-3"><h4><u><?php echo $nommodele; ?></u></h4></div>
                    <div class="col-12 text-center"><p>Année: <?php echo $annee; ?></p></div>
                    <div class="col-12 text-center"><p>Prix: <?php echo $prix; ?> €</p></div>
                    <div class="col-12 text-center"><p>KM: <?php echo $km; ?> km/h</p></div>
                    <div class="col-12 text-center"><p>Type moteur: <?php echo $boitevitesse; ?></p></div>
                    <div class="col-12 text-center"><h6><a href="essai.html">Essayer</a></h6></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <img src=<?php echo $image; ?> class="img-fluid">
            </div>
        </div>
    </div> 
    <?php
        }
        mysqli_free_result($curseur);
        mysqli_close($dbd);
    ?>
    <div class="container">
            <div class="row">
                <div class="col-12 p-5 d-flex justify-content-center" id="moteurs-thermique-p"><h1>Moteurs électriques</h1></div>
            </div>
        </div>
        <?php
            include ("../database/connexion.php");
            $selection = "SELECT * FROM modele JOIN voitures ON modele.IdModele = voitures.IdModele WHERE modele.IdModele BETWEEN 9 AND 10;";
            $curseur = mysqli_query($dbd, $selection);
            while($row = mysqli_fetch_array($curseur)) {
                $nommodele = $row["NomModele"];
                $annee= $row["Annee"];
                $prix = $row["Prix"];
                $idvoiture = $row["IdVoiture"];
                $couleur = $row["Couleur"];
                $typemoteur = $row["TypeMoteur"];
                $carburant = $row["Carburant"];
                $km = $row["Km"];
                $boitevitesse = $row["BoiteVitesse"];
                $image = $row["Image"]
        ?>
    <div class="container voitures mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-5 d-flex justify-content-center align-items-center">
                <div class="row text-center">
                    <div class="col-12 pt-3"><h4><u><?php echo $nommodele; ?></u></h4></div>
                    <div class="col-12 text-center"><p>Année: <?php echo $annee; ?></p></div>
                    <div class="col-12 text-center"><p>Prix: <?php echo $prix; ?> €</p></div>
                    <div class="col-12 text-center"><p>KM: <?php echo $km; ?> km/h</p></div>
                    <div class="col-12 text-center"><p>Type moteur: <?php echo $typemoteur; ?></p></div>
                    <div class="col-12 text-center"><p>boite vitesse: <?php echo $boitevitesse; ?></p></div>
                    <div class="col-12 text-center"><h6><a href="essai.html">Essayer</a></h6></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <img src=<?php echo $image; ?> class="img-fluid">
            </div>
        </div>
    </div> 
    <?php
        }
        mysqli_free_result($curseur);
        mysqli_close($dbd);
    ?>
    <div class="container">
            <div class="row">
                <div class="col-12 p-5 d-flex justify-content-center" id="moteurs-thermique-p"><h1>Moteurs hybrides</h1></div>
            </div>
        </div>
        <?php
        include ("../database/connexion.php");
        $selection = "SELECT * FROM modele JOIN voitures ON modele.IdModele = voitures.IdModele WHERE modele.IdModele BETWEEN 11 AND 12;";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)) {
            $nommodele = $row["NomModele"];
            $annee= $row["Annee"];
            $prix = $row["Prix"];
            $idvoiture = $row["IdVoiture"];
            $couleur = $row["Couleur"];
            $typemoteur = $row["TypeMoteur"];
            $carburant = $row["Carburant"];
            $km = $row["Km"];
            $boitevitesse = $row["BoiteVitesse"];
            $image = $row["Image"]
    ?>
    <div class="container voitures mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-5 d-flex justify-content-center align-items-center">
                <div class="row text-center">
                    <div class="col-12 pt-3"><h4><u><?php echo $nommodele; ?></u></h4></div>
                    <div class="col-12 text-center"><p>Année: <?php echo $annee; ?></p></div>
                    <div class="col-12 text-center"><p>Prix: <?php echo $prix; ?> €</p></div>
                    <div class="col-12 text-center"><p>KM: <?php echo $km; ?> km/h</p></div>
                    <div class="col-12 text-center"><p>Type moteur: <?php echo $boitevitesse; ?></p></div>
                    <div class="col-12 text-center"><h6><a href="essai.html">Essayer</a></h6></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-7">
                <img src=<?php echo $image; ?> class="img-fluid">
            </div>
        </div>
    </div> 
    <?php
        }
        mysqli_free_result($curseur);
        mysqli_close($dbd);
    ?>
        <footer class="container-fluid footer mt-5 text-center p-3">
            <div class="row">
                <div class="col-12 mt-3"><a href=""><a href="">A PROPOS DE NOUS</a></a></div>
                <div class="col-12 mt-3"><a href="">Arborescence</a></div>
                <div class="col-12 mt-3"><a href="mentionslegales.html">Politique de confidentialité</a></div>
                <div class="col-12 copy mt-3" style="border-bottom: solid 1px white; border-top: solid 1px white;;"><a href="">&copy;2024 SUPERCAR</a></div> 
            </div>
        </footer>
        <script src="../script/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>