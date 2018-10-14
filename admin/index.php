<?php require 'connexion.php'; ?>
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

    <title>Document</title>
</head>
<body>

    <!-- Ici, j'inclus ma page naviagtion.php -->
    <?php require 'inc/navigation.php'; ?>


     <div class="jumbotron"><!-- début .jumbotron -->
        <h1 class="display-4">Bienvenue dans mon site Portfolio (CV)</h1>
        <p class="lead">Étant développeur intégrateur web, je vais vous présenter dans ce site mon parcours avant d'en arriver là, avec mes formations et mes expériences professionnelles</p>
        <hr class="my-4">
        <p>Bonne visite !!! <i class="fas fa-smile"></i></p>
    </div><!-- fin ..jumbotron -->


    <a href="formations.php" class="btn btn-warning btn-lg " role="button" aria-pressed="true">Liens vers mes formations</a>
    <a href="experiences.php" class="btn btn-secondary btn-lg " role="button" aria-pressed="true">Allez vers mes expériences professionneles</a>
    <a href="#" class="btn btn-danger btn-lg " role="button" aria-pressed="true">Voir mon profil et coordonnées</a>


  


    
<!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



<?php require 'inc/footer.php'; ?>