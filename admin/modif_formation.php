<?php require 'connexion.php'; 

// gestion mise à jour d'une information
if (isset($_POST['titre_form'])) { 

    $titre_form = addslashes($_POST['titre_form']);
    $stitre_form = addslashes($_POST['stitre_form']);
    $dates_form = addslashes($_POST['dates_form']);
    $description_form = addslashes($_POST['description_form']);

    $id_formation = $_POST['id_formation'];

    $pdoCV -> exec(" UPDATE t_formations SET titre_form = '$titre_form', stitre_form='$stitre_form', dates_form = '$dates_form', description_form = '$description_form' WHERE id_formation = '$id_formation' ");
    header('location: ../admin/formations.php');
    exit();
} // fin du (isset($_POST['competence']))




// je récupère l'id de ce que je mets à jour
$id_formation = $_GET['id_formation']; // par son id et avec GET 
$sql = $pdoCV -> query (" SELECT * FROM t_formations WHERE id_formation='$id_formation' ");
$ligne_formation = $sql -> fetch(); // va récupérer les données 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour d'une formation</title>
    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.php'; ?>

    <h1>Mise à jour d'une formation</h1>
    <!-- Mise à jour d'une nouvelle compétence formulaire  -->
    <div class="form-group"><!-- Début .form-group -->
        <form action="modif_formation.php" method="post">
           <div class="form-group">
                <label for="titre_form">Titre de la formation</label>                
                <input type="text" name="titre_form" value="<?php echo $ligne_formation['titre_form']; ?>" required>    
           </div>
    
           <div class="form-group">
                <label for="stitre_form">Sous titre de la formation</label>                
                <input type="text" name="stitre_form" value="<?php echo $ligne_formation['stitre_form']; ?>" required>
           </div>
    
           <div class="form-group">
                <label for="dates_form">Date de la formation</label>                
                <input type="text" name="dates_form" value="<?php echo $ligne_formation['dates_form']; ?>" required>
           </div>

           <div class="form-group">
                <label for="description_form">Description de la formation</label>                
                <textarea class="form-control" name="description_form" value="<?php echo $ligne_formation['description_form']; ?>"></textarea>
           </div>
    
            <div class="form-group">
                <button class="btn btn-danger" type="submit">MAJ</button>
                <input type="hidden" name="id_formation" value="<?php echo $ligne_formation['id_formation']; ?>">
            </div>
        </form><!-- fin form -->
    </div><!-- Fin .form-group -->

</body>
</html>