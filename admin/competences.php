<?php require 'connexion.php';

// insertion d'un élément dans la base
if (isset($_POST['competence'])) { // si on a reçu une nouvelle competence
    if ($_POST['competence'] !='' && $_POST['niveau'] !='' && $_POST['categorie'] !='' ) {

        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);
        $pdoCV -> exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1') ");

        header("location: ../admin/competences.php");
            exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['competence'])

// suppresion d'un élément de la BDD
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
    <title>Admin : Les compétences</title>
</head>
<body>
<h1>Les compétences et insertion d'une nouvelle compétence</h1>
    <?php 
        //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_competences" . $order);
        $sql -> execute();  // j'exécute la requête
        $nbr_competences = $sql -> rowCount();
    ?>

    


    <div class="voir">
        <table border="1">
        <caption>La liste des compétences : <?php echo $nbr_competences; ?></caption>
            <thead>
                <tr>
                    <th>Les compétences<a href="competences.php?column=competence&order=asc"> Croissant</a> | <a href="competences.php?column=competence&order=desc">Décroissant</a></th>
                    <th>Niveau<a href="competences.php?column=niveau&order=asc"> Croissant</a> | <a href="competences.php?column=niveau&order=desc">Décroissant</a></th>
                    <th>Catégorie<a href="competences.php?column=categorie&order=asc"> Croissant</a> | <a href="competences.php?column=categorie&order=desc">Décroissant</a></th>
                    <th>Modifier</th>
                    <th>Suppression</th>
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
                    <td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> " >modif</a></td>
                    <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?> " >suppr</a></td>
                </tr>
                <?php 
                    }  // fin de la boucle while
                ?>
            </tbody><!-- fin <tbody> -->
        
        </table><!-- fin <table> -->
    </div>
    <hr>
    <!-- Insertion d'une nouvelle compétence formulaire  -->
    <form action="competences.php" method="post">
       <div class="#">
            <label for="competence">Compétences</label>                
            <input type="text" name="competence" placeholder="Nouvelle compétence" required>    
       </div>
       <div class="#">
            <label for="niveau">Niveau</label>                
            <input type="text" name="niveau" placeholder="niveau en chiffre" required>    
       </div>
       <div class="#">
            <label for="categorie">Catégorie</label>                
            <select name="categorie">
                <option value=Développement>Développement</option>
                <option value="Infographie">Infographie</option>
                <option value="Gestion de projet">Gestion de projet</option>
            </select>    
       </div>
        <div class="">
            <button type="submit">Insérer une compétence</button>
        </div>
    </form><!-- Fin dui formulaire -->

</body>
</html>