<?php require 'connexion.php'; // je me connecte à la base de donnéees pour afficher les données de celle ci ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <!-- Je fais un require de tous les liens (Bootstrap, Font awesome, CSS)  -->
     <?php require 'inc/link.inc.php'; ?>

    <title>Formations</title>
</head>
<body>

   <main>
        <?php require 'inc/navigation.inc.php'; ?>
    
        <div class="jumbotron formations "><!-- début .jumbotron -->
            <h1 class="display-4">Formations <i class="fas fa-graduation-cap"></i></h1>
            <p class="lead">Les formations que j'ai faite avant d'intégrer l'univers du web, y compris celle-là que je fais actuellement</p>
            <!-- <hr class="my-4"> -->
            <!-- <p>Voir le tableau des formations ci-dessous</p> -->
        </div><!-- fin ..jumbotron -->
    
    
    <div class="container-fluid col-lg-6 col-md-12"><!-- début container-fluid -->
        
            <?php 
                //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                $sql = $pdoCV -> prepare("SELECT * FROM t_formations WHERE id_utilisateur=1 ");
                $sql -> execute();
               
            ?>
        
        <div class="table_formation">
                <table class="table table-light table-responsive bg-dark text-white" border="1">
                
                    <thead>
                        <tr class="text-primary">
                            <th>Titre</th>
                            <th>Sous titre</th>
                            <th>Date </th>
                            <th>Description</th>
                           
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
   </main>

<?php require 'inc/footer.inc.php'; ?>