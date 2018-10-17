<?php require 'connexion.php'; 

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
 
// insertion d'un formulaire
if (isset($_POST['prenom'])) { // si on a reçu un nouveau loisir
    if ($_POST['prenom'] !='' && $_POST['nom'] !='' &&  $_POST['email'] !='' && $_POST['telephone'] !='' && $_POST['portable'] !='' && $_POST['mdp'] !='' && $_POST['pseudo'] !='' && $_POST['age'] !='' && $_POST['anniversaire'] !='' && $_POST['genre'] !='' && $_POST['civilite'] !=''  && $_POST['adresse'] !='' && $_POST['code_postal'] !='' && $_POST['ville'] !='' && $_POST['pays'] !='' && $_POST['commentaire'] !='' ) {

        $prenom = addslashes($_POST['prenom']);
        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $telephone = addslashes($_POST['telephone']);
        $portable = addslashes($_POST['portable']);
        $mdp = addslashes($_POST['mdp']);
        $pseudo = addslashes($_POST['pseudo']);
        $age = addslashes($_POST['age']);
        $anniversaire = addslashes($_POST['anniversaire']);
        $genre = addslashes($_POST['genre']);
        $civilite = addslashes($_POST['civilite']);
        $adresse = addslashes($_POST['adresse']);
        $code_postal = addslashes($_POST['code_postal']);
        $ville = addslashes($_POST['ville']);
        $pays = addslashes($_POST['pays']);
        $commentaire = addslashes($_POST['commentaire']);
        $pdoCV -> exec(" INSERT INTO t_utilisateurs VALUES (NULL, '$prenom', '$nom', '$email', '$telephone', '$portable', '$mdp',  '$pseudo', '$age', '$anniversaire', '$genre', '$civilite',  '$adresse', '$code_postal', '$ville', '$pays', '$commentaire', '1') "); // requête d'insertion

        header("location: ../admin/utilisateurs.php");
            exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['prenom'])

// suppresion d'un élément de la BDD
if (isset($_GET['id_utilisateur'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_utilisateur']; // je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_utilisateurs WHERE id_utilisateur = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut le faire avec exec également

    header("location: ../admin/utilisateurs.php");
    
}   // fin de isset($_GET['id_utilisateur']) pour la suppresion


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Lien Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Admin : Profil utilisateurs</title>
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>

<h1>Utilisateurs et informations</h1>
    <?php 
        //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_utilisateurs ");
        $sql -> execute();
        $nbr_utilisateurs = $sql -> rowCount();
    ?>

   <div class="voir">
        <table border="1">
        <caption>Profil <i class="fas fa-users"></i> <?php echo $nbr_utilisateurs; ?> </caption>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Portable</th>
                    <!-- <th>MDP</th> -->
                    <th>Pseudo</th>
                    <th>Age</th>
                    <th>Anniversaire</th>
                    <th>Genre</th>
                    <th>Civilité</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>Commentaire</th>
                    <!-- <th>Modifier</th>
                    <th>Supprimer</th> -->
                </tr>
            </thead>
    
            <tbody>
            <?php  while($ligne_utilisateur = $sql -> fetch()) 
                {
            ?>
                <tr>
                
                    <td><?php echo $ligne_utilisateur['prenom']; ?></td>
                    <td><?php echo $ligne_utilisateur['nom']; ?></td>
                    <td><?php echo $ligne_utilisateur['email']; ?></td>
                    <td><?php echo $ligne_utilisateur['telephone']; ?></td>
                    <td><?php echo $ligne_utilisateur['portable']; ?></td>
                    <!-- <td><?php echo $ligne_utilisateur['mdp']; ?></td> -->
                    <td><?php echo $ligne_utilisateur['pseudo']; ?></td>
                    <td><?php echo $ligne_utilisateur['age']; ?></td>
                    <td><?php echo $ligne_utilisateur['anniversaire']; ?></td>
                    <td><?php echo $ligne_utilisateur['genre']; ?></td>
                    <td><?php echo $ligne_utilisateur['civilite']; ?></td>
                    <td><?php echo $ligne_utilisateur['adresse']; ?></td>
                    <td><?php echo $ligne_utilisateur['code_postal']; ?></td>
                    <td><?php echo $ligne_utilisateur['ville']; ?></td>
                    <td><?php echo $ligne_utilisateur['pays']; ?></td>
                    <td><?php echo $ligne_utilisateur['commentaire']; ?></td>
               
                </tr>
                <?php 
                    }  // fin de la boucle while
                ?>
            </tbody>
        
        </table><!-- fin <table> -->

  
     <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>