<?php require 'connexion.php'; 
 
// insertion d'un formulaire
if (isset($_POST['titre_form'])) { // si on a reçu une nouvelle formation
    if ($_POST['titre_form'] !='' && $_POST['stitre_form'] !='' && $_POST['stitre_form'] !='' && $_POST['dates_form'] !='' && $_POST['description_form'] !='' ) {

        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
        $description_form = addslashes($_POST['description_form']);
        $pdoCV -> exec(" INSERT INTO t_formations VALUES (NULL, '$titre_form', '$stitre_form', '$dates_form', '$description_form', '1') ");

        header("location: ../admin/formations.php");
            exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['formation'])

// suppresion d'un élément de la BDD
if (isset($_GET['id_formation'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_formation']; // je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_formations WHERE id_formation = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut le faire avec exec également

    header("location: ../admin/formations.php");
    
}   // fin de isset($_GET['id_formation']) pour la suppresion
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Lien Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Admin : Formations</title>
</head>
<body>

     <!-- Ici, j'inclus ma page naviagtion.php -->
     <?php require 'inc/navigation.php'; ?>

<h1>Les formations et insertion d'une nouvelle formation</h1>
    <?php 
        //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_formations");
        $sql -> execute();
        $nbr_formations = $sql -> rowCount();
    ?>

   <div class="voir">
        <table border="1">
        <caption>Mes formations : <?php echo $nbr_formations; ?> </caption>
            <thead>
                <tr>
                    <th>Titre de la formation</th>
                    <th>Sous titre de la formation</th>
                    <th>Date de la formation</th>
                    <th>Description de la formation</th>
                    <th>Modification</th>
                    <th>Suppression</th>
                </tr>
            </thead>
    
            <tbody>
            <?php  while($ligne_formation = $sql -> fetch()) 
                {
            ?>
                <tr>
                    <td><?php echo $ligne_formation['titre_form']; ?></td>
                    <td><?php echo $ligne_formation['stitre_form']; ?></td>
                    <td><?php echo $ligne_formation['dates_form']; ?></td>
                    <td><?php echo $ligne_formation['description_form']; ?></td>
                    <td><a href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation']; ?> " ><i class="fas fa-edit"></i></a></td>
                    <td><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation']; ?> " ><i class="fas fa-trash"></i></a></td>
                </tr>
                <?php 
                    }  // fin de la boucle while
                ?>
            </tbody>
        
        </table><!-- fin <table> -->
   </div>
    <hr>
    <!-- Insertion d'une nouvelle formations dans le formulaire  -->
    <form action="formations.php" method="post">
       <div class="form-group">
            <label for="titre_form">Titre de la formation</label>                
            <input type="text" name="titre_form" placeholder="Nouvelle formation" required>    
       </div>

        <div class="form-group">
            <label for="titre_form">Sous Titre de la formation</label>                
            <input type="text" name="stitre_form" placeholder="Sous titre de la formation" required>    
       </div>

        <div class="form-group">
            <label for="titre_form">Date de la formation</label>                
            <input type="text" name="dates_form" placeholder="Date de la formation" required>    
       </div>

        <div class="form-group">
            <label for="titre_form">Description de la formation</label>                
            <input type="text" name="description_form" placeholder="Description de la formation" required>    
       </div>
        <div class="">
            <button class="btn btn-success" type="submit">Insérer une formation</button>
        </div>
    </form>
     <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>