<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <!-- Je fais un require de tous les liens (Bootstrap, Font awesome, CSS)  -->
     <?php require 'inc/link.inc.php'; ?>

    <title>La page d'accueil</title>

    
</head>
<body>

   <main><!-- début <main> -->
        <!-- Ici, je require ma navigation -->
        <?php require 'inc/navigation.inc.php'; ?>
    
    
            <div class="jumbotron home"><!-- début .jumbotron -->
                <h1 class="display-4">www.pmbaye.fr Site Portfolio 2018</h1>                   
            </div><!-- fin .jumbotron -->
    
    
    
       <div class="container col-lg-9">
            <div class="card-deck mt-4 mb-4"><!-- début .card-deck -->
        
                <div class="card the_card"><!-- début 1st card -->
                    <img class="card-img-top" src="img/competences.png" alt="Les compétences">
                        <div class="card-body">
                            <h5 class="card-title">Compétences</h5>
                            <p class="card-text">Les compétences que j'ai pu acquérir au cours de mes expériences professionnelles</p>
                            <a href="competences.php "><p class="card-text "><small class="text-danger ">Voir mes compétences</small></p></a>
                        </div>
                </div><!-- fin 1st card -->
        
        
                <div class="card the_card"><!-- début 2nd card -->
                        <img class="card-img-top" src="img/work-experience.jpg" alt="Experiences professionnelles">
                            <div class="card-body">
                                <h5 class="card-title">Expériences professionnelles</h5>
                                <p class="card-text">Ce que j'ai pu acquérir au cours de mes stages en entreprises, où les différents emplois</p>
                                <a href="experiences.php"><p class="card-text"><small class="text-danger">Voir le tableau</small></p></a>
                            </div>
                </div>
        
        
                <div class="card the_card"><!-- début 3rd card -->
                        <img class="card-img-top" src="img/formations.jpg" alt="Formations">
                            <div class="card-body">
                                <h5 class="card-title">Formations</h5>
                                <p class="card-text">Mes formations effectuées en amont</p>
                                <a href="formations.php"><p class="card-text"><small class="text-danger">Lien vers la page</small></p></a>
                            </div>
                </div><!-- fin 3rd card -->
        
            </div><!-- fin .card-deck -->
       </div>

       <div class="mb-5 text-success">
           <!-- <p>Aller sur la navigation en haut de la page, pour retrouver les autres rubriques</p>
           <p>Egalement une page si vous souhaitez me contacter</p> -->
           
       </div>

   </main><!-- fin </main> -->




<?php require 'inc/footer.inc.php'; ?>