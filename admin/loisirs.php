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


 
// Insertion d'un formulaire
if (isset($_POST['loisir'])) { // si on a reçu un nouveau loisir
    if ($_POST['loisir'] !='' ) {

        $loisir = addslashes($_POST['loisir']);
        $pdoCV -> exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '$id_utilisateur') ");
   
        header("location: ../admin/loisirs.php");
            exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['loisir'])

// suppresion d'un élément de la BDD
if (isset($_GET['id_loisir'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_loisir']; // je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_loisirs WHERE id_loisir = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut le faire avec exec également

    header("location: ../admin/loisirs.php");
    
}   // fin de isset($_GET['id_loisir']) pour la suppresion
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

    <!-- Google fonts Lora -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i" rel="stylesheet">

    <!-- Roboto Google Fonts -->
     <!-- Lien google fonts Roboto Slab -->
     <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"> 

    <?php 
        // requete pour une seule information 
    // $sql = $pdoCV -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
    // $ligne_utilisateur = $sql -> fetch();
    ?>
    <title>Admin Loisirs : <?php echo $ligne_utilisateur['pseudo']; ?></title>
     <!-- ck editor 4 -->
     <script src="../ckeditor.js"></script>
</head>
<body>

   <main>
        <!-- Ici, j'inclus ma page navigation.php avec un require -->
        <?php require 'inc/navigation.inc.php'; ?>
    
        <!-- Mon jumbotron -->
        <div class="jumbotron"><!-- début .jumbotron -->
            <h1 class="display-4">Loisirs <i class="far fa-futbol "></i> <i class="fas fa-tv text-dark"></i> <i class="fas fa-plane"></i></h1>
            <hr class="my-4">
            <p>Admin <?php  echo $ligne_utilisateur['pseudo']; ?></p>
        </div><!-- fin ..jumbotron -->
        
       
        <div class="container-fluid col-lg-6"><!-- début .container-fluid -->
        
            <h1 class="loisir mt-4">Les loisirs </h1>
                <?php 
                    //requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
                    $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs WHERE id_utilisateur = '$id_utilisateur'");
                    $sql -> execute();
                    $nbr_loisirs = $sql -> rowCount();
                ?>
        
            <div class="row"><!-- début .row -->
        
                <div class="col"><!-- début col -->
        
                        <div class="table_loisir"><!-- début .table_loisir -->
                                <table class="table_loisir  " border="1">
                                <caption><?php echo $nbr_loisirs; ?> loisirs </caption>
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Les loisirs</th>
                                            <th>Modifier</th>
                                            <th>Suppression</th>
                                        </tr>
                                    </thead>
                            
                                    <tbody>
                                    <?php  while($ligne_loisir = $sql -> fetch()) 
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $ligne_loisir['loisir']; ?></td>
                                            <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?> " ><i class="fas fa-edit"></i></a></td>
                                            <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>" onclick="return(confirm('Etes-vous certain de vouloir supprimer ce loisir ?'))" ><i class="fas fa-trash text-danger"></i></a></td>
                                        </tr>
                    
                                        <?php 
                                            }  // fin de la boucle while
                                        ?>
                    
                                    </tbody>
                                
                                </table><!-- fin <table> -->
                        </div><!-- fin .table_loisir -->
        
                </div><!-- fin col -->
                
                        <hr>
                        <!-- Insertion d'un nouveau loisir formulaire  -->
                    <div class="col"><!-- début col 2 -->
                            <form action="loisirs.php" method="post">
                            <div class="mt-4">
                                    <label for="loisir">Loisir</label>                
                                    <input class="form-control" type="text" name="loisir" placeholder="Nouveau loisir" required>    
                            </div>
                    
                                <div class="mt-4">
                                    <button class="btn btn-success" type="submit" onclick="return(confirm('Félicitations ! Le losir a bien été inséré'))">Insérer</button>
                                </div>
                            </form>
                    </div><!-- fin col 2 -->
            </div><!-- fin .row -->
        
        </div><!-- fin .container-fluid -->
   </main>




<?php require 'inc/footer.inc.php'; ?>