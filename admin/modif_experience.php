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
if (isset($_POST['titre_exp'])) { 

    $titre_exp = addslashes($_POST['titre_exp']);
    $stitre_exp = addslashes($_POST['stitre_exp']);
    $dates_exp = addslashes($_POST['dates_exp']);
    $description_exp = addslashes($_POST['description_exp']);

    $id_experience = $_POST['id_experience'];

    $pdoCV -> exec(" UPDATE t_experiences SET titre_exp = '$titre_exp', stitre_exp='$stitre_exp', dates_exp = '$dates_exp', description_exp = '$description_exp' WHERE id_experience = '$id_experience' ");
    header('location: ../admin/experiences.php');
    exit();
} // fin du (isset($_POST['experience']))




// je récupère l'id de ce que je mets à jour
$id_experience = $_GET['id_experience']; // par son id et avec GET 
$sql = $pdoCV -> query (" SELECT * FROM t_experiences WHERE id_experience='$id_experience' ");
$ligne_experience = $sql -> fetch(); // va récupérer les données 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour d'une expérience</title>
    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">

     <!-- Lien Font Awesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

     <!-- ck editor 4 -->
     <script src="ckeditor/ckeditor.js"></script>

</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>

   <div class="container-fluid col-lg-6"><!-- début de .container-fluid -->

        <h1>Mise à jour d'une expérience <i class="fas fa-pen-alt"></i></h1>
        <!-- Mise à jour d'une nouvelle compétence formulaire  -->
        <div class="form-group"><!-- Début .form-group -->
            <form action="modif_experience.php" method="post">
               <div class="form-group">
                    <label for="titre_exp">Titre de l'expérience </label>                
                    <input type="text" class="form-control" name="titre_exp" value="<?php echo $ligne_experience['titre_exp']; ?>" required>    
               </div>
        
               <div class="form-group">
                    <label for="stitre_exp">Sous titre de l'expérience</label>                
                    <input type="text" class="form-control" name="stitre_exp" value="<?php echo $ligne_experience['stitre_exp']; ?>" required>
               </div>
        
               <div class="form-group">
                    <label for="dates_exp">Date de la expérience</label>                
                    <input type="text" class="form-control" name="dates_exp" value="<?php echo $ligne_experience['dates_exp']; ?>" required>
               </div>
    
               <div class="form-group">
                    <label for="description_exp">Description de l'expérience</label>                
                    <textarea type="text" class="form-control" name="description_exp" id="description_exp"><?php echo $ligne_experience['description_exp']; ?></textarea>
    
                        <script>
                            // Replace the <textarea id="descirption_form"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'description_exp' );
                        </script>
    
               </div>
        
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">MAJ</button>
                    <input type="hidden" name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
                </div>
            </form><!-- fin form -->
        </div><!-- Fin .form-group -->

   </div><!-- fin de .container-fluid -->


 <!-- Lien Bootstrap script JS  -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>