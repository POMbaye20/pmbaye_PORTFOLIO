<?php require 'connexion.php'; 

// La connexion 
session_start(); // à mettre dans toutes les pages de l'admin

if(isset($_SESSION['connexion_admin'])) { // si on est connecté  on récupère les variables de la session    
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $email = $_SESSION['email'];
    $mdp = $_SESSION['mdp'];
    $nom = $_SESSION['nom'];
    // echo $id_utilisateur;
} else {     // si on n'est pas connecté on ne peut pas se connecter
    header('location:authentification.php');
}
// requete pour une seule information 
$sql = $pdoCV -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
$ligne_utilisateur = $sql -> fetch();

// La déconnexion
// pour vider les variables de session destroy dans un if ! 
if (isset($_GET['deconnexion'])) { //  on récupère le terme deconnexion en GET
    
    $_SESSION['connexion_admin'] = '';
    $_SESSION['id_utilisateur'] = '';
    $_SESSION['email'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['mdp'] = '';

    unset($_SESSION['connexion_admin']); // unset() détruit la variable connexion_admin
    session_destroy();

    header('location:authentification.php');
}


// gestion mise à jour d'une information
if (isset($_POST['competence'])) { 

    $competence = addslashes($_POST['competence']);
    $niveau = addslashes($_POST['niveau']);
    $categorie = addslashes($_POST['categorie']);

    $id_competence = $_POST['id_competence'];

    $pdoCV -> exec(" UPDATE t_competences SET competence = '$competence', niveau='$niveau', categorie = '$categorie' WHERE id_competence = '$id_competence' ");
    header('location: ../admin/competences.php');
    exit();
} // fin du (isset($_POST['competence']))




// je récupère l'id de ce que je mets à jour
$id_competence = $_GET['id_competence']; // par son id et avec GET 
$sql = $pdoCV -> query (" SELECT * FROM  t_competences WHERE id_competence='$id_competence' ");
$ligne_competence = $sql -> fetch(); // va récupérer les données 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour d'une compétence</title>
    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Lien Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>

    <h1>Mise à jour d'une compétence</h1>
    <!-- Mise à jour d'une nouvelle compétence formulaire  -->
    <form action="modif_competence.php" method="post">
       <div class="">
            <label for="competence">Compétences</label>                
            <input class="form-control" type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" required>    
       </div>

       <div class="">
            <label for="niveau">Niveau</label>                
            <input class="form-control" type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" required>
       </div>

       <div class="">
            <label for="categorie">Catégorie</label>                
            <select class="custom-select" name="categorie">
                                            <!-- Développement -->
                <option value="Développement"
                    <?php // pour ajouter select="selected" à la balise option si c'est la catégorie de la compétence
                        if (!(strcmp("Développement", $ligne_competence['categorie']))) { // strcmp compare les chaînes de caractères
                            echo "selected=\"selected\"";
                        }
                    ?>>Développement</option>
                

                                            <!-- Infographie -->
                <option value="Infographie"  <?php 
                        if (!(strcmp("Infographie", $ligne_competence['categorie']))) { 
                            echo "selected=\"selected\"";
                        }
                    ?>>Infographie</option>

                                            <!-- Gestion de projet -->
                <option value="Gestion de projet" 
                    <?php 
                        if (!(strcmp("Gestion de projet", $ligne_competence['categorie']))) { 
                            echo "selected=\"selected\"";
                        }
                    ?>>Gestion de projet</option>                 
            </select>       
       </div><!-- Fin du menu déroulant pour les catégories -->

        <div class="">
        <input class="form-control" type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
            <button class="mt-4 bg-danger" type="submit">MAJ</button>
        </div>
    </form><!-- fin form -->

</body>
</html>