<?php require 'connexion.php'; 

// gestion mise à jour d'une information
if (isset($_POST['loisir'])) { 

    $loisir = addslashes($_POST['loisir']);
    $id_loisir = $_POST['id_loisir'];

    $pdoCV -> exec(" UPDATE t_loisirs SET loisir = '$loisir' WHERE id_loisir = '$id_loisir' ");
    header('location: ../admin/loisirs.php');
    exit();
} // fin du (isset($_POST['loisir']))




// je récupère l'id de ce que je mets à jour
$id_loisir = $_GET['id_loisir']; // par son id et avec GET 
$sql = $pdoCV -> query (" SELECT * FROM  t_loisirs WHERE id_loisir='$id_loisir' ");
$ligne_loisir = $sql -> fetch(); // va récupérer les données 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour loisir</title>
     <!-- Lien Bootstrap -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Lien Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Ici, j'inclus ma page naviagtion.php -->
    <?php require 'inc/navigation.php'; ?>

    <h1>Mise à jour d'un loisir</h1>
    <!-- Mise à jour d'un nouveau loisir formulaire  -->
    <form action="modif_loisir.php" method="post">
       <div class="">
            <label for="loisir">Loisir</label>                
            <input type="text" name="loisir" value="<?php echo $ligne_loisir['loisir']; ?>" required>    
       </div>
        <div class="">
        <input type="hidden" name="id_loisir" value="<?php echo $ligne_loisir['id_loisir']; ?>">
            <button type="submit">MAJ</button>
        </div>
    </form><!-- fin du formulaire -->
</body>
</html>