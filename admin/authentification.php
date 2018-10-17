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
     <link rel="stylesheet" href="css/admin.css">

    <title>Admin : authentification</title>
</head>
<body>


    <section style="height: 100vh;"><!-- début de la section -->

        <div style="background-image: url(images/arka.jpg); background-attachment: fixed; background-size: cover; width: 100%; height: 100vh; position: relative;" >

            <div class="baslik"><!-- début de .baslik -->
                <b style="font-size: 101px; text-align: center; margin-bottom: -21px; display: block;">Admin</b>
                <span style="font-size: 19px; text-align: center; display: block; margin-bottom: 25px;"><i class="fas fa-sign-in-alt"></i></span>
            </div><!-- fin de  de .baslik -->

            <section><!-- début de la section avec le <form> -->

                <form method="post" action="authentification.php"><!-- début <form> -->
                    <div class="arkalogin">
                        <div class="loginbaslik text-center">Se connecter ici</div>
                        <hr style="border: 1px solid #ccc;">

                        <i class="fas fa-at"></i>
                        <input class="giris" type="text" name="email" placeholder="Votre email">

                        <i class="fas fa-key"></i>
                        <input class="giris" type="password" name="mdp" placeholder="Votre mot de passe">
                        
                        <a href="https://dogukankeskin.com" target="blank"><input class="butonlogin" type="submit" name="connexion" value="Se connecter"></a>
                    </div>
                </form><!-- fin </form> -->

            </section><!-- fin de la section avec le formulaire </form> -->
            
            <br>

            <span style="font-size: 23px; text-align: center; display: block; color: #E6E6E6;">Bienvenue dans ton admin ! <i class="fas fa-user"></i></span>

            <span style="font-size: 24px; text-align: center; display: block; color: #fff; font-weight: bold; margin-bottom: 34px;">Connexion ! <i class="fas fa-sign-in-alt"></i></span>

            <span style="font-size: 17px; text-align: center; display: block; color: #fff;">Site Portfolio en cours </span>

        </div>

    </section><!-- fin de la section -->
    
</body>
</html>