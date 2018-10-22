<?php require 'connexion.php'; // je me connecte à la base de donnéees pour afficher les données de celle ci ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <!-- Je fais un require de tous les liens (Bootstrap, Font awesome, CSS)  -->
     <?php require 'inc/link.inc.php'; ?>

    <title>Mes formations</title>
</head>
<body>

    <?php require 'inc/navigation.inc.php'; ?>

    <div class="jumbotron loisirs"><!-- début .jumbotron -->
        <h1 class="display-4">Formations <i class="fas fa-graduation-cap"></i></h1>
        <p class="lead">Bienvenue dans ma page formation où je vais vous lister les différentes formations que j'ai faite</p>
        <hr class="my-4">
        <p>Voir le tableau des formations ci-dessous</p>
    </div><!-- fin ..jumbotron -->


<div class="container-fluid col-lg-6 col-md-12"><!-- début container-fluid -->
    

    <h1 class="text-center">Formations</h1>
        <?php 
            //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
            $sql = $pdoCV -> prepare("SELECT * FROM t_formations");
            $sql -> execute();
           
        ?>
    
    <div class="">
            <table class="table table-light table-responsive" border="1">
            
                <thead>
                    <tr class="text-primary">
                        <th>Titre de la formation</th>
                        <th>Sous titre de la formation</th>
                        <th>Date de la formation <i class="fas fa-calendar-alt"></i></th>
                        <th>Description de la formation</th>
                       
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
                        
                    </tr>
                    <?php 
                        }  // fin de la boucle while
                    ?>
                </tbody>
            
            </table><!-- fin <table> -->
    </div>
       

</div><!-- fin .container-fluid -->

<?php require 'inc/footer.inc.php'; ?>