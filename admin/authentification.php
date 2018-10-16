<?php require 'connexion.php'; 

session_start(); // à mettre dans toutes les pages de l'admin

// traitement pour la connexion à l'admin 
if (isset($_POST['connexion'])) {
    
    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    $sql = $pdoCV -> prepare ("SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' ");
    // Ici, on vérifie email et mot de passe
    $sql -> execute();
    $nbr_utilisateur = $sql -> rowCount(); // on compte si il est dans la BDD ; le compte répond 0 si il n'y est pas et répond 1 si il y est

    if ($nbr_utilisateur == 0) { // il n'y est pas
        echo '<p>Erreur d\'authentification !</p>';
    } else {
        // echo $nbr_utilisateur; // il y est 
        $ligne_utilisateur = $sql ->  fetch();

        $_SESSION['connexion_admin'] = 'connecté'; // connexion pour l'admin

        $_SESSION['id_utilisateur'] = $ligne_utilisateur['id_utilisateur'];
        $_SESSION['email'] = $ligne_utilisateur['email'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];
        $_SESSION['mdp'] = $ligne_utilisateur['mdp'];

        // echo $ligne_utilisateur['nom'];

        header('location:../admin/index.php');
    }

} // fin de if (isset($_POST['connexion']))

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
     <!-- Lien google fonts Roboto Slab -->
     <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"> 
     <!-- Mon style CSS -->
     <link rel="stylesheet" href="css/style.css">

    <title>Admin : authentification</title>
</head>
<body>
    <form action="authentification.php" method="post">
    <h1>Admin : authentification</h1>
    <label for="email">Votre email <i class="fas fa-at"></i></label>
    <input type="email" name="email" class="form-control" placeholder="xxx@xxx.fr" required>

    <label for="mdp">Mot de passe <i class="fas fa-key"></i></label>
    <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
    <button name="connexion" type="submit" class="btn btn-success form-control">Se connecter</button>

    </form>
</body>
</html>