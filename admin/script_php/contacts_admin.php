<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['ajouter_marque'])) {
            inserer();
        } elseif(isset($_POST['supprimer_marque'])) {
            supprimer();
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--lien font awsome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../style/marque_admin.css">
    </head>
    <body>
        <div class="container-fluid border">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 border">
                    <div class="row">
                        <form action="" method="POST" class="col-12 p-3 mt-5 mb-5">
                            <div class="row p-3">
                                <div class="col-12">
                                    <label for="Nom">Nom</label>
                                    <input class="col-12" type="text" name="Nom" required>
                                </div>
                                <div class="col-12">
                                    <label for="Prenom">Prenom</label>
                                    <input class="col-12" type="text" name="Prenom" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <input type="submit" name="ajouter_contacts" value="ajouter">
                                </div>
                            </div>
                        </form>
                        <div class="col-12 ps-5 pt-5">
                            <h5><i class="fa-solid fa-arrow-left"></i><a href="dashboard.php" class="retour">RETOUR</a></h5>
                        </div>
                    </div>
                </div>
                <div class='col-12 col-sm-12 col-md-12 col-lg-8 border mt-3'>
                    <form class='row' action='' method='post'>
                        <div class="col-12 mb-3 sticky-top" style='background-color: #4A7696;'>
                            <div class="row">
                                <div class="col-2 border">Couleur</div>
                                <div class="col-3 border">Moteur</div>
                                <div class="col-2 border">Carburant</div>
                                <div class="col-1 border">Km</div>
                                <div class="col-3 border">Boite vitesse</div>
                                <div class="col-1 border text-center"><button value="supprimer" name="supprimer_contacts" style="background-color:  #4A7696; color: white; border: none"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></div>
                            </div>
                        </div>
                        <?php
                            include("test.php");
                            afficher_infos_contacts();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>