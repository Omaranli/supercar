<?php
    include("server.php");
    function inserer($table, $colonnes) {
        // cette fonction insere une nouvelle enregistrement dans une table dot le nom est en paramètre ainsi qeu les colonnes
        global $dbd;
        //initialise la valeur de la varible inserer a faux
        $insertion = false;
        $erreur = ""; // Variable pour stocker les messages d'erreur
        $noms_colonnes = implode(",", $colonnes); //on regroupe les noms des colonnes passées en paramètre en une chaine de caractère
        $valeurs = []; // on declare un tableau vide dont on va stocker les valeur recupérés dans le formulaire 
        foreach ($colonnes as $colonne) {
            $valeurs[] = "'" . mysqli_real_escape_string($dbd, $_POST[$colonne]) . "'";// on récupère les valeurs saisits dans le form 
        }
        $valeurs_colonnes = implode(",", $valeurs);  // on regroupe les valeurs en une chaine 
        if(isset($_POST["ajouter_$table"])){
            $inserer = "INSERT INTO $table ($noms_colonnes) VALUES ($valeurs_colonnes)";
            $executer = mysqli_query($dbd, $inserer);
            if($executer){
                $insertion = true;
                header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                exit(); // Terminer le script après la redirection
            } else {
                $erreur = "<p>Erreur lors de l'insertion dans $table: " . mysqli_error($dbd) . "</p>";
            }
        }
        mysqli_close($dbd);
        return $erreur; // Retourne le message d'erreur
    }


    function supprimer($table, $cle_primaire){
        //cette fonction supprimer une ou plusieurs lignes cochés
        global $dbd;
        $suppression = false;
        $erreur = ""; // Variable pour stocker les messages d'erreur
        if(isset($_POST["supprimer_$table"])){
            $suppression = false; // on initiallise la valeur de la varialbe $suppressin a faux
            if(isset($_POST[$cle_primaire]) && is_array($_POST[$cle_primaire])){ // s'il y'a au moins une seule case qui est coché
                // on supprime chaque ligne coché 1 par 1
                foreach($_POST[$cle_primaire] as $identifiant){ 
                    $supprimer = "DELETE FROM $table WHERE $cle_primaire='$identifiant'";
                    $executer_suppression = mysqli_query($dbd, $supprimer);
                    if($executer_suppression){
                        $suppression = true; // à la fin de la suppression, la varible $suppression prend la vleur vrai
                    } else {
                        $erreur = "<p>Erreur lors de la suppression dans $table: " . mysqli_error($dbd) . "</p>";
                    }
                }
                if($suppression){
                    header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                    exit(); // Terminer le script après la redirection
                }
            }
        }
        mysqli_close($dbd);
        return $erreur; // Retourne le message d'erreur
    }


    function option_marques(){
        //cette fonction selectionne tous les marque dans la base et les affiche dans une balise "select"
        global $dbd;
        $options_marques = '';
        $id = [];
        $selection = "SELECT * FROM marque order by NomMarque";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdMarque = $row["IdMarque"];
            array_push($id, $IdMarque);
            $NomMarque = $row["NomMarque"];
            $options_marques .= "<option value='$IdMarque'>$NomMarque</option>";
        }
        mysqli_free_result($curseur);
        return $options_marques;
    }


    function option_modeles(){
        //cette fonction selectionne tous les models de voitures et les affices dans une balise select
        global $dbd;
        $options_modeles = '';
        $selection = "SELECT * FROM modele order by NomModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdModele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $options_modeles .= "<option value='$IdModele'>$NomModele</option>";
        }
        mysqli_free_result($curseur);
        return $options_modeles;
    }


    function afficher_infos_modeles(){
        //affichage de tous les models
        global $dbd;
        $selection = "SELECT * FROM modele order by IdModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdModele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $prix = $row["Prix"];
            echo "
                <div class='col-12 mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3 border'>($IdModele)_$NomModele</div>
                        <div class='col-6 p-3 border'>€ $prix</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdModele[]' value=$IdModele></div>
                    </div>
                </div>
                ";
        }
        mysqli_free_result($curseur);
    }


    function afficher_infos_voitures(){
        //affichage de tous les voitures
        global $dbd;
        $infos_voitures = "";
        $selection = "SELECT voitures.*, NomModele, Prix
        FROM voitures
        INNER JOIN modele ON voitures.IdModele = modele.IdModele
        ORDER BY NomModele";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdVoiture = $row["IdVoiture"];
            $Idmodele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $typemoteur = $row["TypeMoteur"];
            $BoiteVitesse = $row["BoiteVitesse"];
            $Prix_modele = $row["Prix"];
            $infos_voitures .= "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>
                            <div class='row' style='text-decoration: none;'>
                                <div class='col-10'><a href=''>$NomModele</a></div>
                                <div class='col-2'><a href='modele2.php?id=$Idmodele&modele_noms=$NomModele&prix_modele=$Prix_modele'>📝</a></div>
                            </div>
                        </div>       
                        <div class='col-3 p-3'>$typemoteur</div>
                        <div class='col-4 p-3'>$BoiteVitesse</div>
                        <div class='col-1 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdVoiture[]' value=$IdVoiture></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
        return $infos_voitures;
    }


    function afficher_infos_inscrits(){
        // affiche de tous les personne inscrits
        global $dbd;
        $selection = "SELECT * FROM inscription order by IdInscription";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdInscription = $row["IdInscription"];
            $nom= $row["Nom"];
            $prenom = $row["Prenom"];
            $adresse = $row["Adresse"];
            $telephone = $row["NumTel"];
            $email = $row["email"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-3 p-3'><a href='voir_inscrit.php?id=$IdInscription' class='col-8' style='background-color: white; color: black; text-decoration: none;'>$prenom</a></div>
                        <div class='col-3 p-3'>$nom</div>
                        <div class='col-4 p-3'>$adresse</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdInscription[]' value=$IdInscription></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
    }



    function afficher_infos_marques(){
        //affichage de tous la marques
        global $dbd;
        $selection = "SELECT * FROM marque order by IdMarque";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdMarque = $row["IdMarque"];
            $NomMarque = $row["NomMarque"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>$IdMarque</div>
                        <div class='col-6 p-3'>$NomMarque</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdMarque[]' value=$IdMarque></div>
                    </div>
                </div>
            ";
        }
        mysqli_free_result($curseur);
    }


    function afficher_infos_essaies(){
        //affichage de tous les demandes d'essais en faisant une jointure entre la table demandeessai et la table inscription
        global $dbd;
        $selection = "SELECT demandeessaie.*, inscription.Nom, inscription.Prenom 
        FROM demandeessaie 
        INNER JOIN inscription ON demandeessaie.IdInscription = inscription.IdInscription
        ORDER BY DateEssaie DESC;
        ";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $Ref_Essaie = $row["Ref_Essaie"];
            $IdInscription = $row["IdInscription"];
            $DateEssaie= $row["DateEssaie"];
            $HeureEssaie = $row["HeureEssaie"];
            $Prenom = $row["Prenom"];
            $Nom = $row["Nom"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>$Prenom</div>
                        <div class='col-4 p-3'>$Nom</div>
                        <div class='col-2 p-3'>$DateEssaie</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='Ref_Essaie[]' value=$Ref_Essaie></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
    }


    function ajouter_DemandeEssaie(){
        // insertion de demande d'essai
        global $dbd;
        if(isset($_POST["ajouter_essaie"])){
            // onrécupère les valeur echapés pour éviter les injectins sql
            $email = mysqli_real_escape_string($dbd, $_POST["email"]);
            $date = mysqli_real_escape_string($dbd, $_POST["DateEssaie"]);
            $heure = mysqli_real_escape_string($dbd, $_POST["HeureEssaie"]);
            $marque = mysqli_real_escape_string($dbd, $_POST["Marque"]);
            $modele = mysqli_real_escape_string($dbd, $_POST["Modele"]);
            $moteur = mysqli_real_escape_string($dbd, $_POST["moteur"]);
             // Vérifier si l'adresse email existe déjà
            $requete_email = "SELECT * FROM inscription WHERE email = '$email'";
            $resultat_email = mysqli_query($dbd, $requete_email);
            if (mysqli_num_rows($resultat_email) > 0) {
                $row = mysqli_fetch_array($resultat_email);
                //l'email existe dans la base de données
                $IdInscription = $row["IdInscription"];
                $inserer = "INSERT INTO demandeessaie (DateEssaie, HeureEssaie, Marque, Modele, Moteur, IdInscription)
                        Values ('$date', '$heure', '$marque', '$modele', '$moteur', '$IdInscription')
                ";
                $ajout = mysqli_query($dbd, $inserer);
                if($ajout){
                    header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                    exit(); // Terminer le script après la redirection
                }
            mysqli_close($dbd);
            }else{
                //cas où l'email ne figure pas dans la base de donées
                echo"l'email ne figure pas dans la base de données";
            }
        }
    }

    function afficher_infos_evenements(){
        // on affiche tous les évenements enregisgtré dans la base
        global $dbd;
        $infos_evenements = "";
        $selection = "SELECT * FROM evenement order by DateDebut DESC";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdEvenement = $row["IdEvenement"];
            $theme = $row["théme"];
            $debut = $row["DateDebut"];
            $fin = $row["DateFin"];
            $image = $row["image"];
            $prix = $row["Prix"];
            $infos_evenements .= "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>
                            <a href='voir_evenement.php?id=$IdEvenement' class='row' style='font-size: 20px; text-decoration: none;'>
                                <div  class='col-10'>$theme</div>
                                <div class='col-2'>📝</div>
                            </a>
                        </div>
                        <div class='col-3 p-3'>$debut</div>
                        <div class='col-3 p-3'>$fin</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdEvenement[]' value=$IdEvenement></div>
                    </div>
                </div>";
        }
        mysqli_free_result($curseur);
        return $infos_evenements;
    }

    function nouveau_evenement(){
        global $dbd;
        $chemin_image = "../images/evenements_images/";
        if(isset($_POST["ajouter_evenement"])){
            $theme = mysqli_real_escape_string($dbd, $_POST["théme"]);
            $DateDebut = mysqli_real_escape_string($dbd, $_POST["DateDebut"]);
            $DateFin = mysqli_real_escape_string($dbd, $_POST["DateFin"]);
            $Description = mysqli_real_escape_string($dbd, $_POST["Description"]);
            $image = mysqli_real_escape_string($dbd, $_POST["image"]);
            $Prix = mysqli_real_escape_string($dbd, $_POST["Prix"]);
            $chemin_image .= $image;
            $insertion = "INSERT INTO evenement (théme, DateDebut, DateFin, Description, image, Prix)
                        VALUES('$theme', '$DateDebut', '$DateFin', '$Description', '$chemin_image', '$Prix')";
            if(mysqli_query($dbd, $insertion)) {
                header("location: ".$_SERVER['PHP_SELF']); // Redirection après insertion réussie
                exit(); // Terminer le script après la redirection
            } else {
                echo "<p>Erreur lors de l'insertion des données : " . mysqli_error($dbd) . "</p>";
            }
            mysqli_close($dbd);
        }
    }

    function afficher_infos_contacts(){
        //affichage de tous les contacts
        global $dbd;
        $selection = "SELECT * FROM contacts order by IdContact";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdContact = $row["IdContact"];
            $Nom = $row["Nom"];
            $Prenom = $row["Prenom"];
            $email= $row["email"];
            $telephone = $row["NumTel"];
            echo "
                <div class='col-12 border mt-3'>
                    <div class='row'>
                        <div class='col-4 p-3'>$Nom</div>
                        <div class='col-6 p-3'>$email</div>
                        <div class='col-2 p-3 border text-center'><input type='checkbox' class='form-check-input' name='IdContact[]' value=$IdContact></div>
                    </div>
                </div>
            ";
        }
        mysqli_free_result($curseur);
    }
    function est_connecte(){
        
    }


    function verifierAuthentification() {
        // Définir le temps d'expiration de session à 30 minutes (ou la valeur appropriée)
        $tempsExpiration = 30 * 60; // 30 minutes en secondes

        // Commencer la session si ce n'est pas déjà fait
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifier si la session est active
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $tempsExpiration)) {
            // La session a expiré, déconnecter l'utilisateur
            session_unset();
            session_destroy();
            // Rediriger l'utilisateur vers une autre page
            header("Location: connection_admin.php");
            exit();
        }

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['username'])) {
            // L'utilisateur n'est pas connecté, rediriger vers une autre page
            header("Location: connection_admin.php");
            exit();
        }

        // Mettre à jour le timestamp de la dernière activité
        $_SESSION['last_activity'] = time();
    }

?>