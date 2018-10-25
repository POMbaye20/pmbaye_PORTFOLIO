<?php require 'connexion.php'; //  ici, je me connecte à la base de données ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Je fais un require de tous les liens (Bootstrap, Font awesome, CSS)  -->
    <?php require 'inc/link.inc.php'; ?>
   
    <title>Les loisirs</title>
  
</head>
<body>

    <!-- Ici, j'inclus ma page navigation.php avec un require -->
    <?php require 'inc/navigation.inc.php'; ?>

    <!-- Mon jumbotron -->

    <div class="jumbotron loisirs "><!-- début .jumbotron -->
        <h1 class="display-4">Mes loisirs <i class="fas fa-music"></i> <i class="fas fa-tv "></i> <i class="fas fa-plane"></i></h1>
        <p class="lead">Voici la liste de mes loisirs</p>
        <hr class="my-4 ">
        <p>Tableau ci-dessous</p>
    </div><!-- fin ..jumbotron -->
    
   
<div class="container-fluid"><!-- début .container-fluid -->

    
        <?php 
            //requête pour afficher la liste des loisirs dans le tableau
            $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs WHERE id_utilisateur=1 ");
            $sql -> execute();
        ?>

    <div class="row"><!-- début .row -->

        <div class="table table-hover "><!-- début col -->

       

                        <table class="table_loisir mx-auto table_loisirs mb-4 bg-dark text-white" border="1">
                        
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>La liste des loisirs</th>
                                    
                                </tr>
                            </thead>
                    
                            <tbody>
                            <?php  while($ligne_loisir = $sql -> fetch()) 
                                {
                            ?>
                                <tr>
                                    <td><?php echo $ligne_loisir['loisir']; ?></td>
                                   
                                </tr>
            
                                <?php 
                                    }  // fin de la boucle while
                                ?>
            
                            </tbody>
                        
                        </table><!-- fin </table> -->
                
        </div><!-- fin col -->
        
              
               
    </div><!-- fin .row -->

</div><!-- fin .container-fluid -->


<?php require 'inc/footer.inc.php'; ?>