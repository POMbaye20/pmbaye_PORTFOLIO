<?php require 'connexion.php'; // je me connecte à la base de donnéees pour afficher les données de celle ci ?>


  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     
    <!-- Mes liens (bootstrap, font awesome, google fonts ) -->
    
    <?php require 'inc/link.inc.php'; ?>

    <title>Compétences</title>


</head>

<body>

<main>
        <!-- Ici, je require ma navigation -->
        <?php require 'inc/navigation.inc.php'; 
    
        
        // requête pour chercher toutes les compétences
        $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur = 1 ORDER BY niveau DESC");
        $sql -> execute();
    
        ?>
        
            <div class="header jumbotron-fluid jumbotron">
                <h1 class="mb-4">Mes compétences en web <i class="fas fa-code"></i> </h1>
            </div>
        
            <!-- ANIMATION -->
    
        <!-- debut section -->
        
        <section class="row"> 
            
                <?php 
                    while($ligne_competence = $sql -> fetch()) {
                ?>
                   
                   <h3><?= $ligne_competence['competence'] ?></h3>
                   <div class="circle" id="circle-a" >
                        <input type=hidden id=variableAPasser value=<?= $ligne_competence['niveau'] ?>/>
	                    <strong class="niveau"><?= $ligne_competence['niveau'] ?></strong>
                    </div>
                   

                  
            <?php 
            } // Fin de la boucle while
        ?>
    
        </section>
</main>


    <?php require 'inc/footer.inc.php'; ?>
   