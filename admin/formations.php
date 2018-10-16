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
 
// insertion d'un formulaire
if (isset($_POST['titre_form'])) { // si on a reçu une nouvelle formation
    if ($_POST['titre_form'] !=''  && $_POST['stitre_form'] !='' && $_POST['dates_form'] !='' && $_POST['description_form'] !='' ) {

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

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>


     <div class="jumbotron"><!-- début .jumbotron -->
        <h1 class="display-4">Bienvenue dans ma page de formation <i class="fas fa-graduation-cap"></i></h1>
        <p class="lead">Dans cette page, je vais présenter les différentes formations effectuées avec leurs périodes</p>
        <hr class="my-4">
        <p>Voici mon tableau des différentes formations ci - dessous</p>
    </div><!-- fin ..jumbotron -->
    


<h1>Les formations et insertion d'une nouvelle formation</h1>
    <?php 
        //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_formations");
        $sql -> execute();
        $nbr_formations = $sql -> rowCount();
    ?>

   <div class="bg-dark">
        <table class="table table-dark" border="1">
        <caption>Mes formations : <?php echo $nbr_formations; ?> </caption>
            <thead>
                <tr class="text-primary">
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
                    <td><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation']; ?> " ><i class="fas fa-trash text-danger"></i></a></td>
                </tr>
                <?php 
                    }  // fin de la boucle while
                ?>
            </tbody>
        
        </table><!-- fin <table> -->
   </div>
    <hr>
    <!-- Insertion d'une nouvelle formations dans le formulaire  -->
   
       <div class="form_formation">

        <h1>Insérer une nouvelle formation</h1>

            <form class="form_formation" action="formations.php" method="post">
               <div class="form-group">
                    <label for="titre_form">Titre de la formation</label>                
                    <input type="text" name="titre_form" placeholder="Nouvelle formation" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="stitre_form">Sous Titre de la formation</label>                
                    <input type="text" name="stitre_form" placeholder="Sous titre de la formation" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="dates_form">Date de la formation</label>                
                    <input type="text" name="dates_form" placeholder="Date de la formation" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="description_form">Description de la formation</label>                
                    <textarea name="description_form" class="form-control"></textarea>
               </div>
                <div class="">
                    <button class="btn btn-success" type="submit">Insérer une formation</button>
                </div>
            </form>
       </div>
   
     <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php require 'inc/footer.inc.php'; ?>