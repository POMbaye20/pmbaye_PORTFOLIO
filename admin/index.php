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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Lien CSS Bootstrap en CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <!-- Lien Font Awesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Lien google fonts Roboto Slab -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"> 

    <!-- Java Script -->
    <script src="js/script.js"></script>

    <title>La page d'accueil</title>
</head>
<body>

    <!-- Ici, j'inclus ma page naviagtion.php -->
    <?php require 'inc/navigation.inc.php'; ?>

    
  


     <div class="jumbotron"><!-- début .jumbotron -->
     <h1 class="display-4">Welcome <?php echo $ligne_utilisateur['pseudo']; ?> !!</h1>
        <p class="lead">Développeur /Intégrateur Web au PoleS</p>
        <hr class="my-4">
      
    </div><!-- fin .jumbotron -->

    



     <!-- Diaporama Slider -->

  <h2 class="titre mb-4">Présentation des rubriques</h2>


<div class="container-fluid"><!-- début .container-fluid -->
<div class="row">
    <div class="col-sm">
    <div class=" diaporama mb-4">
    
    <div class="col-lg-8 col-md-12 col-sm-12 m-auto">
      <div id="carousel01" class="carousel slide" data-ride="carousel"> 
            <!-- ici on place les indicateurs -->
            <ol class="carousel-indicators">
                <li data-target="#carousel01" data-slide-to="0" class="active"></li>
                <li data-target="#carousel01" data-slide-to="1"></li>
                <li data-target="#carousel01" data-slide-to="2"></li>
                <li data-target="#carousel01" data-slide-to="3"></li>
            </ol>
  
            <!-- le diapo est dans une div avec un id et sa class et sa data-ride -->
            <div class="carousel-inner"> <!-- tous les img du diapo sont dans une div class carousel-inner -->
                <div class="carousel-item active">
                    <img src="img/welcome.png" alt="Bienvenue" class="w-100 d-block">
                    <!-- et ici on met la légende de la photo -->
                    <div class="carousel-caption d-none d-md-block">
                     
                    </div>
                </div>
  
                <div class="carousel-item">
                    <img src="img/langages.jpg" alt="Mes compétences acquises" class="w-100 d-block">
                    <!-- la légende de la photo -->
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-dark font-weight-bold">Compétences</h5>

                    </div>
                </div>
  
  
                <div class="carousel-item">
                    <img src="img/hobbies.jpg" alt="Loisirs" class="w-100 d-block">
                    <!-- la légende de la photo -->
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Loisirs</h5>
                        
                    </div>
                </div>
  
  
                <div class="carousel-item">
                    <img src="img/formations.jpg" alt="Formations" class="w-100 d-block">
                    <!-- la légende de la photo -->
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-dark font-weight-bold">Formations</h5>
                        
                    </div>
                </div>
  
  
            </div><!-- fin .carousel-inner -->
  
  
            <!-- ici nous plaçons les contrôles du diaporama -->
            <a href="#carousel01" role="button" class="carousel-control-prev" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédent</span>
            </a>
            <!-- sr = screen reader -->
            <a href="#carousel01" role="button" class="carousel-control-next" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Suivant</span>
            </a>
        </div> <!-- fin diapo -->
    </div> <!-- fin de div largeur -->
  
  </div><!-- fin rangée Diaporama -->
    </div>
    <div class="col-sm">
      <p>Dans le menu déroulant situé dans la navigation, vous trouverez les difféentes rubriques du CV</p>
      <p>Également en aperçu dans le slider situé à gauche de la page</p>
    </div>
    
  </div>
   
                                    <!-- Bouton d'accès vers les pages importantes  -->
    
        <div class="btn-group">
            <button type="button" class="btn btn-primary" a href="formations.php">Formations</button>
            <button type="button" class="btn btn-danger" a href="competences.php">Compétences</button>
            <button type="button" class="btn btn-success" a href="experiences.php">Expériences</button>
        </div> 

</div><!-- fin .container-fluid -->

  


<!-- Ici, j'inclus mon footer (footer.php)  -->
<?php require 'inc/footer.inc.php'; ?>