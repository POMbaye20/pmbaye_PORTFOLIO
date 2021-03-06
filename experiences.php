<?php require 'connexion.php'; // je me connecte à la base de donnéees pour afficher les données de celle ci ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <!-- Je fais un require de tous les liens (Bootstrap, Font awesome, CSS)  -->
     <?php require 'inc/link.inc.php'; ?>

    <title>Expériences</title>
</head>
<body>

    <main>
        <?php require 'inc/navigation.inc.php'; ?>
    
        <div class="jumbotron experiences"><!-- début .jumbotron -->
            <h1 class="display-4">Expériences <i class="fas fa-briefcase"></i></h1>
            <p class="lead">Acquises dans différents domaines comme la vente en surface lors des périodes de stages, en gare et actuellement dans le développement et intégration web</p>  
        </div><!-- fin ..jumbotron -->
    
    
    <div class="container-fluid col-lg-6 col-md-12"><!-- début container-fluid -->
        
    
        
            <?php 
                //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                $sql = $pdoCV -> prepare("SELECT * FROM t_experiences WHERE id_utilisateur=1");
                $sql -> execute();
               
            ?>
        
        <div class="t_exp">
                <table class="table table-light table-responsive table-hover border border-primary"  border="1"><!-- début <table> -->
                
                    <thead class="experiences">
                        <tr>
                            <th>Entreprise</th>
                            <th>Poste</th>
                            <th>Les dates</th>
                            <th>Description des missions</th>           
                        </tr>
                    </thead>
            
                    <tbody>
                    <?php  while($ligne_experience = $sql -> fetch()) 
                        {
                    ?>
                        <tr>
                            <td><?php echo $ligne_experience['titre_exp']; ?></td>
                            <td><?php echo $ligne_experience['stitre_exp']; ?></td>
                            <td><?php echo $ligne_experience['dates_exp']; ?></td>
                            <td><?php echo $ligne_experience['description_exp']; ?></td>
                        </tr>
    
                        <?php 
                            }  // fin de la boucle while
                        ?>
                    </tbody>
                
                </table><!-- fin </table> -->
        </div>
           

    </div><!-- fin .container-fluid -->

</main>  
<?php require 'inc/footer.inc.php'; ?>