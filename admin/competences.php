<?php require 'connexion.php';  // ici, je require 'connexion.php' qui est connecté à la BDD. 

// insertion d'un élément dans la base de données
if (isset($_POST['competence'])) { // si on a reçu une nouvelle compétence
    if ($_POST['competence'] !='' && $_POST['niveau'] !='' && $_POST['categorie'] !='' ) {

        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);
        $pdoCV -> exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1') ");

        header("location: ../admin/competences.php");
            exit(); 

    } // ferme le if(isset($_POST['competence'])) (n'est pas vide)
} // fin de isset($_POST['competence'])

// suppresion d'un élément de la base de données
if (isset($_GET['id_competence'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_competence']; // je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_competences WHERE id_competence = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut le faire avec exec également

    header("location: ../admin/competences.php");
    
}   // fin de isset($_GET['id_competence']) pour la suppresion

// ******************* TRI PAR ORDRE CROISSANT ET DECROISSANT *******************

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){	// début de if(isset($_GET['order']))

	if($_GET['column'] == 'competence'){
		$order = ' ORDER BY competence';
	}

	elseif($_GET['column'] == 'niveau'){
		$order = ' ORDER BY niveau';
	}

	
	elseif($_GET['column'] == 'categorie'){
		$order = ' ORDER BY categorie';
    }
    
    if($_GET['order'] == 'asc'){
		$order.= ' ASC';
	}

	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}


}	//  fin de if(isset($_GET['order']) && isset($_GET['column']))


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
    <!-- Java Script -->
    <script src="js/script.js"></script>
    <title>Admin : Les compétences</title>
    
</head>
<body>

     <!-- Ici, j'inclus ma page naviagtion.php -->
     <?php require 'inc/navigation.inc.php'; ?>


    <!-- Mon jumbotron -->
      <div class="jumbotron"><!-- début .jumbotron -->
        <h1 class="display-4">Bienvenue dans la page compétences <i class="far fa-keyboard"></i></h1>
        <p class="lead">Dans cette page, je vais présenter les compétences que j'ai pu acquérir</p>
        <hr class="my-4">
        <p>Ci - dessous, voici les différentes compétences que j'ai pu acquérir dans ce domaine</p>
    </div><!-- fin ..jumbotron -->


<h1 class="text-primary">Les compétences et insertion d'une nouvelle compétence</h1>
    <?php 
        //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_competences" . $order);
        $sql -> execute();  // j'exécute la requête
        $nbr_competences = $sql -> rowCount(); // ici, rowCount() indique le nombre d'éléments
    ?>

    


   

        <div class="table_skills">
            <table border="1" class="table table-dark">
            <caption>La liste des compétences : <?php echo $nbr_competences; ?></caption>
                <thead>
                    <tr class="table-active">
                        <th>Les compétences<a href="competences.php?column=competence&order=asc"> <i class="fas fa-sort-alpha-up"></i></a> | <a href="competences.php?column=competence&order=desc"><i class="fas fa-sort-alpha-down"></i></a></th>
                        <th>Niveau<a href="competences.php?column=niveau&order=asc"> <i class="far fa-arrow-alt-circle-up"></i></a> | <a href="competences.php?column=niveau&order=desc"><i class="far fa-arrow-alt-circle-down"></i></a></th>
                        <th>Catégorie<a href="competences.php?column=categorie&order=asc"> <i class="far fa-arrow-alt-circle-up"></i></a> | <a href="competences.php?column=categorie&order=desc"><i class="far fa-arrow-alt-circle-down"></i></a></th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
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
                        <td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> " ><i class="fas fa-edit"></i></a></td>
                        <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> " ><i class="fas fa-trash text-danger"></i></a></td>
                    </tr>
                    <?php 
                        }  // fin de la boucle while
                    ?>
                </tbody><!-- fin <tbody> -->
            
            </table><!-- fin <table> -->
        </div>
        <hr>

        <!-- Formulaire d'insertion d'une nouvelle compétence  -->
        <h1>Insérer une nouvelle compétence</h1>

        <form action="competences.php" method="post">
           <div class="competences">
                <label for="competence">Compétences</label>                
                <input type="text" name="competence" placeholder="Nouvelle compétence" class="form-control" required>    
           </div>
           <div class="niveau">
                <label for="niveau">Niveau</label>                
                <input type="text" name="niveau" placeholder="niveau en chiffre" class="form-control" required>    
           </div>
           <div class="categorie">
                <label for="categorie">Catégorie</label>                
                <select name="categorie" class="custom-select my-1 mr-sm-2">
                    <option value=Développement >Développement</option>
                    <option value="Infographie">Infographie</option>
                    <option value="Gestion de projet">Gestion de projet</option>
                </select>    
           </div>
            <div class="">
                <button class="btn btn-success" type="submit">Insérer une compétence</button>
            </div>
        </form><!-- Fin du formulaire -->

   

   <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php require 'inc/footer.inc.php'; ?>