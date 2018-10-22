<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Ma feuille de style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Mon bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Mon font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

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