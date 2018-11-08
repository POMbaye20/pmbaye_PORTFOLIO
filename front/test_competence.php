<?php require 'connexion.php';  // ici, je require 'connexion.php' qui est connecté à la BDD. ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Ici je fais un require de mes liens -->
    <?php require 'inc/link.inc.php'; ?>

    <link rel="stylesheet" href="css/style_competence.css">

    <title>Test compétence</title>
</head>

<main>
    <body>
    
    
         <!-- Ici, j'inclus ma page navigation.php -->
         <?php require 'inc/navigation.inc.php'; ?>
    
    
        <!-- Jumbotron -->
       <div class="jumbotron competences"><!-- début .jumbotron -->
                <h1 class="display-4">Compétences acquises <i class="far fa-keyboard"></i></h1>
                <p class="lead">Je vais vous montrer ici les compétences que j'ai pu acquérir au cours de mes formations précédentes </p>
                <hr class="my-4">
                <p>Dans ce site, je vais vous présenter mon CV avec les différentes expériences professionnlles que j'ai pu acquérir, ainsi que les compétences acquises, les formations faites en amont, enfin mes différents loisirs</p>
        </div><!-- fin .jumbotron -->

           <h1 class="text-dark text-center">Langages de codes acquis <i class="fas fa-check text-success"></i></h1>
            <?php 
                
                $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur=1");
                $sql -> execute();  // j'exécute la requête
                $nbr_competences = $sql -> rowCount(); // ici, rowCount() indique le nombre d'éléments
            ?>

             <?php  while($ligne_competence = $sql -> fetch()) 
                            {
                        ?>

            	<div id="demo">
                    <div class="circlechart" data-percentage="<?=$ligne_competence['niveau']; ?>"></div>
	            </div>


                            
                            <?php 
                                }  // fin de la boucle while du tableau
                            ?>
                       



</main>


<script src="js/script.js"></script>


    <?php require 'inc/footer.inc.php'; ?>