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

    <!-- Ici, je require ma navigation -->
    <?php require 'inc/navigation.inc.php'; ?>


        <div class="jumbotron home"><!-- début .jumbotron -->
            <h1 class="display-4">Bievenue dans mon site CV www.pmbaye.fr !</h1>
            <p class="lead">Papaoumar Mbaye 24 ans développeur/intégrateur web.</p>
            <hr class="my-4">
            <p>Dans ce site, je vais vous présenter mon CV avec les différentes expériences professionnlles que j'ai pu acquérir, ainsi que les compétences acquises, les formations faites en amont, enfin mes différents loisirs</p>
            <h2>Bonne visite sur le site !!!</h2>
        </div><!-- fin .jumbotron -->

        <img class="language" src="img/language.png" alt="Langage de codes">




<?php require 'inc/footer.inc.php'; ?>