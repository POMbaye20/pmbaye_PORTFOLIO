<?php require 'connexion.php';  // ici, je require 'connexion.php' qui est connecté à la BDD. 

// La connexion 
session_start(); // à mettre dans toutes les pages de l'admin

if(isset($_SESSION['connexion_admin'])) { // si on est connecté  on récupère les variables de la session    
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $email = $_SESSION['email'];
    $mdp = $_SESSION['mdp'];
    $nom = $_SESSION['nom'];
    // echo $id_utilisateur;
} else {     // si on n'est pas connecté on ne peut pas se connecter
    header('location:authentification.php');
}
// requete pour une seule information 
$sql = $pdoCV -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
$ligne_utilisateur = $sql -> fetch();

// La déconnexion
// pour vider les variables de session destroy dans un if ! 
if (isset($_GET['deconnexion'])) { //  on récupère le terme deconnexion en GET
    
    $_SESSION['connexion_admin'] = '';
    $_SESSION['id_utilisateur'] = '';
    $_SESSION['email'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['mdp'] = '';

    unset($_SESSION['connexion_admin']); // unset() détruit la variable connexion_admin
    session_destroy();

    header('location:authentification.php');
}

// insertion d'un élément dans la base de données
if (isset($_POST['competence'])) { // si on a reçu une nouvelle compétence
    if ($_POST['competence'] !='' && $_POST['niveau'] !='' && $_POST['categorie'] !='' ) {

        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);
        $pdoCV -> exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '$id_utilisateur') ");

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
    <!-- ck editor 4 -->
    <script src="ckeditor/ckeditor.js"></script>
    <title>Admin : Les compétences</title>
    
</head>
<body>

     <!-- Ici, j'inclus ma page naviagtion.php -->
     <?php require 'inc/navigation.inc.php'; ?>


    <!-- Mon jumbotron -->
      <div class="jumbotron"><!-- début .jumbotron -->
        <h1 class="display-4">Compétences <i class="far fa-keyboard"></i></h1>
        <p class="lead">Compétences acquises au cours des formations et expériences </p>
  
    </div><!-- fin ..jumbotron -->


<div class="container-fluid col-lg-6"><!-- début .container-fluid -->


        <h1 class="text-primary">Voir la liste et mettre à jour </h1>
            <?php 
                //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur = '$id_utilisateur' $order");
                $sql -> execute();  // j'exécute la requête
                $nbr_competences = $sql -> rowCount(); // ici, rowCount() indique le nombre d'éléments
            ?>
    

                <div class="table_skills">
                    <table border="1" class="table table-dark">
                    <caption><?php echo $nbr_competences; ?> compétences</caption>
                        <thead>
                            <tr class="table-active">
                                <th>Compétences<a href="competences.php?column=competence&order=asc"> <i class="fas fa-sort-alpha-up"></i></a> | <a href="competences.php?column=competence&order=desc"><i class="fas fa-sort-alpha-down"></i></a></th>
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
                <h1>Nouvelle compétence</h1>
    
                <div class="card"><!-- début .card -->
                    <form action="competences.php" method="post">
                    <div class="competences">
                            <label for="competence">Compétences</label>                
                            <input type="text" name="competence" placeholder="Nouvelle compétence" class="form-control" required>    
                    </div>
                    <div class="niveau">
                            <label for="niveau">Niveau</label>                
                            <input type="text" name="niveau" placeholder="Niveau en chiffre" class="form-control" required>    
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
                </div><!-- fin .card -->

</div><!-- fin .container-fluid -->
   

<?php require 'inc/footer.inc.php'; ?>