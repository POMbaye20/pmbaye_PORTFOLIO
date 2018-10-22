<?php require 'connexion.php';  // ici, je require 'connexion.php' qui est connecté à la BDD. 



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Lien Bootstrap -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Lien Font Awesome pour insérer des icônes  -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
  

    <title>Mes compétences</title>
    
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>


    <!-- Jumbotron -->
   <div class="jumbotron competences"><!-- début .jumbotron -->
            <h1 class="display-4">Compétences acquises </h1>
            <p class="lead">Je vais vous montrer ici les compétences que j'ai pu acquérir au cours de mes formations précédentes </p>
            <hr class="my-4">
            <p>Dans ce site, je vais vous présenter mon CV avec les différentes expériences professionnlles que j'ai pu acquérir, ainsi que les compétences acquises, les formations faites en amont, enfin mes différents loisirs</p>
    </div><!-- fin .jumbotron -->



<div class="container-fluid col-lg-6"><!-- début .container-fluid -->


        <h1 class="text-dark text-center">Langages de codes acquis <i class="fas fa-check text-success"></i></h1>
            <?php 
                
                $sql = $pdoCV -> prepare("SELECT * FROM t_competences ");
                $sql -> execute();  // j'exécute la requête
                $nbr_competences = $sql -> rowCount(); // ici, rowCount() indique le nombre d'éléments
            ?>
    

                <div class="table_skills">
                    <table border="1" class="table table-striped">
                    
                        <thead>
                            <tr class="table-active">
                                <th>Les compétences</th>
                                <th>Niveau</th>
                                <th>Catégorie</th>
                               
                            </tr>
                        </thead><!-- fin <thead> -->
                
                        <tbody>
                        <?php  while($ligne_competence = $sql -> fetch()) 
                            {
                        ?>
                            <tr>
                                <td><?php echo $ligne_competence['competence']; ?></td>
                                <td><?php echo $ligne_competence['niveau']; ?></td>
                                <td><?php echo $ligne_competence['categorie']; ?></td>
                             
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
   

