<?php require 'connexion.php'; // je me connecte à la base de donnéees pour afficher les données de celle ci ?>


  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     
                                                                            <!-- Mes liens (bootstrap, font awesome, google fonts ) -->
    
    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Lien Font Awesome pour l'insertion des icônes -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Google fonts Montserrat -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> 

    
     <!-- Lien google fonts Roboto Slab -->
     <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">

    <title>Compétences</title>


    <!-- Style de l'animation -->
    <link rel="stylesheet" href="test_animation/style.css">

    

</head>

<body>

    <!-- Ici, je require ma navigation -->
    <?php require 'inc/navigation.inc.php'; 

    
    // requête pour chercher toutes les compétences
    $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur = 1 ORDER BY niveau DESC");
    $sql -> execute();

    ?>
    
        <div class="header jumbotron-fluid jumbotron">
            <h1 class="mb-4">Mes compétences en web <i class="fas fa-code"></i></h1>
        </div>
    
        <!-- ANIMATION -->

    <!-- debut section -->
    
    <section class="row"> 
        
            <?php 
                while($ligne_competence = $sql -> fetch()) {
            ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <!-- cercle de chaque compétence avec son titre en h3 -->
            <h3 class="competence"><?= $ligne_competence['competence']; ?></h3>
            <svg class="radial-progress" data-percentage="<?= $ligne_competence['niveau']; ?>" viewBox="0 0 80 80">
            <!-- la partie du cercle incomplète -->
                <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                <!-- la partie du cercle complète -->
                <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">
                <!-- le niveau est affiché ici -->
                <?= $ligne_competence['niveau']; ?>%</text>
            </svg> 
        </div>
        <?php 
        } // Fin de la boucle while
    ?>

    </section>

   
    <script src="test_animation/script.js"></script>

  <div class="container-fluid bg-info footer-front"><!-- début .container pour le footer -->
      <div class="row"><!-- début .row -->
          <div class="col-sm">
            &copy; www.pmbaye.fr Site Portfolio 2018
          </div>
          <div class="col-sm">
            <h4> Me retrouver sur </h4>
                <a href="https://fr.linkedin.com/in/papaoumar-mbaye-6661b3ab" class="social_network  " target="_blank"> <i class="fab linkedin fa-linkedin-in"></i></a>  
                <a href="https://github.com/POMbaye20" class="social_network " target="_blank"> <i class="fab github fa-github"></i></a>  
          </div>
          <div class="col-sm">
              <p class="contact"><a href="messages.php">Me contacter</a></p>
              <p><i class="far fa-envelope"></i> papaoumar.mbaye@laposte.net</p>
               
          </div>
      </div><!-- fin.row -->
  </div><!-- fin .container pour le footer -->

    
    
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

  </body>
  </html>
   