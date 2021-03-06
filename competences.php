<?php require 'connexion.php';  // ici, je require 'connexion.php' qui est connecté à la BDD. 



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <!-- Ici je fais un require de mes liens -->
    <?php require 'inc/link.inc.php'; ?>

    <title>Mes compétences</title>
    
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>


    <!-- Jumbotron -->
   <div class="jumbotron competences"><!-- début .jumbotron -->
            <h1 class="display-4">Compétences acquises <i class="fas fa-code"></i></h1>
            <p class="lead">Je vais vous montrer ici les compétences que j'ai pu acquérir au cours de mes formations précédentes </p>
            <hr class="my-4">
            <p>Dans ce site, je vais vous présenter mon CV avec les différentes expériences professionnlles que j'ai pu acquérir, ainsi que les compétences acquises, les formations faites en amont, enfin mes différents loisirs</p>
    </div><!-- fin .jumbotron -->



<div class="container-fluid col-lg-6"><!-- début .container-fluid -->


        <h1 class="text-dark text-center">Langages de codes acquis <i class="fab fa-html5 html"></i> <i class="fab fa-css3 css"></i> </h1>
            <?php 
                
                $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur=1");
                $sql -> execute();  // j'exécute la requête
                $nbr_competences = $sql -> rowCount(); // ici, rowCount() indique le nombre d'éléments
            ?>
    

                <div class="table_skills">
                    <table border="1" class="table table-striped">
                    
                        <thead>
                            <tr class="table-active">
                                <th>Langages de développement</th>
                                <th>Compétences acquises en %</th>
                                
                               
                            </tr>
                        </thead><!-- fin <thead> -->
                
                        <tbody>
                        <?php  while($ligne_competence = $sql -> fetch()) 
                            { // début de la boucle while du tableau
                        ?>
                            <tr>
                                <td><?php echo $ligne_competence['competence']; ?></td>
                                <td><?php echo $ligne_competence['niveau']; ?> %</td>
                                
                             
                            </tr>
                            <?php 
                                }  // fin de la boucle while du tableau
                            ?>
                        </tbody><!-- fin </tbody> -->
                    
                    </table><!-- fin </table> -->
                </div>
                <hr>
                
</div><!-- fin .container-fluid -->

<?php require 'inc/footer.inc.php'; ?>
   

