<?php require 'connexion.php'; 

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
</head>
<body>

     <!-- Ici, j'inclus ma page naviagtion.php -->
     <?php require 'inc/navigation.php'; ?>

    <h1>Mise à jour d'une compétence</h1>
    <!-- Mise à jour d'une nouvelle compétence formulaire  -->
    <form action="modif_competence.php" method="post">
       <div class="">
            <label for="competence">Compétences</label>                
            <input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" required>    
       </div>

       <div class="">
            <label for="niveau">Niveau</label>                
            <input type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" required>
       </div>

       <div class="">
            <label for="categorie">Catégorie</label>                
            <select name="categorie">
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
        <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
            <button type="submit">MAJ</button>
        </div>
    </form><!-- fin form -->

</body>
</html>