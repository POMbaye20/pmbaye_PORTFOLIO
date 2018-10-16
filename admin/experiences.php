<?php require 'connexion.php'; 
 
// insertion d'un formulaire
if (isset($_POST['titre_exp'])) { // si on a reçu une nouvelle expérience
    if ($_POST['titre_exp'] !=''  && $_POST['stitre_exp']  !='' && $_POST['dates_exp'] !='' && $_POST['description_exp'] !='' ) {

        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $dates_exp = addslashes($_POST['dates_exp']);
        $description_exp = addslashes($_POST['description_exp']);
        $pdoCV -> exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '1') ");

        header("location: ../admin/experiences.php");
            exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['experience'])

// suppresion d'un élément de la BDD
if (isset($_GET['id_experience'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_experience']; // je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_experiences WHERE id_experience = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut le faire avec exec également

    header("location: ../admin/experiences.php");
    
}   // fin de isset($_GET['id_experience']) pour la suppresion
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
    <title>Admin : Expériences</title>
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>


     <div class="jumbotron"><!-- début .jumbotron -->
        <h1 class="display-4">Expériences professionnelles</h1>
        <p class="lead">Je vais présenter ici de mes expériences professionnelles en entreprise </p>
        <hr class="my-4">
        <p>Voici mon tableau des différentes expériences ci - dessous</p>
    </div><!-- fin ..jumbotron -->
    


<h1>Les formations et insertion d'une nouvelle expérience <i class="fas fa-check text-success"></i></h1>
    <?php 
        //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_experiences");
        $sql -> execute();
        $nbr_experiences = $sql -> rowCount();
    ?>

   <div class="table_exp">
        <table class="table table-hover" border="1">
        <caption>Mes expériences professionnelles : <?php echo $nbr_experiences; ?> </caption>
            <thead>
                <tr>
                    <th>Titre de l'expérience</th>
                    <th>Sous titre de l'expérience</th>
                    <th>Date de l'expérience</th>
                    <th>Description de l'expérience</th>
                    <th>Modification</th>
                    <th>Suppression</th>
                </tr>
            </thead>
    
            <tbody>
            <?php  while($ligne_experience = $sql -> fetch()) 
                {
            ?>
                <tr>
                    <td><?php echo $ligne_experience['titre_exp']; ?></td>
                    <td><?php echo $ligne_experience['stitre_exp']; ?></td>
                    <td><?php echo $ligne_experience['dates_exp']; ?></td>
                    <td><?php echo $ligne_experience['description_exp']; ?></td>
                    <td><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?> " ><i class="fas fa-edit"></i></a></td>
                    <td><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?> " ><i class="fas fa-trash text-danger"></i></a></td>
                </tr>
                <?php 
                    }  // fin de la boucle while
                ?>
            </tbody>
        
        </table><!-- fin <table> -->
   </div>
    <hr>
    <!-- Insertion d'une nouvelle expérience dans le formulaire  -->
   
       <div class="container-fluid">

        <h1 >Insérer une nouvelle expérience</h1>

            <form class="form_experience" action="experiences.php" method="post">
               <div class="form-group">
                    <label for="titre_exp">Titre de l'expérience</label>                
                    <input type="text" name="titre_exp" placeholder="Nouvelle expérience" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="stitre_exp">Sous Titre de l'expérience</label>                
                    <input type="text" name="stitre_exp" placeholder="Sous titre de l'expérience" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="dates_exp">Date de l'expérience</label>                
                    <input type="text" name="dates_exp" placeholder="Date de l'expérience" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="description_exp">Description de l'expérience</label>                
                    <textarea name="description_exp" class="form-control"></textarea>
               </div>
                <div class="">
                    <button class="btn btn-success" type="submit">Insérer une expérience</button>
                </div>
            </form>
       </div>
   
     <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php require 'inc/footer.inc.php'; ?>