<?php require 'connexion.php'; 
 
// insertion d'un formulaire
if (isset($_POST['loisir'])) { // si on a reçu un nouveau loisir
    if ($_POST['loisir'] !='' ) {

        $loisir = addslashes($_POST['loisir']);
        $pdoCV -> exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1') ");

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
    <title>Admin : Les loisirs</title>
</head>
<body>

     <!-- Ici, j'inclus ma page naviagtion.php -->
     <?php require 'inc/navigation.php'; ?>

<h1>Les loisirs et insertion d'un nouveau loisir</h1>
    <?php 
        //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs");
        $sql -> execute();
        $nbr_loisirs = $sql -> rowCount();
    ?>

   <div class="voir">
        <table border="1">
        <caption>La liste des loisirs : <?php echo $nbr_loisirs; ?> </caption>
            <thead>
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
                    <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?> " ><i class="fas fa-trash"></i></a></td>
                </tr>
                <?php 
                    }  // fin de la boucle while
                ?>
            </tbody>
        
        </table><!-- fin <table> -->
   </div>
    <hr>
    <!-- Insertion d'un nouveau loisir formulaire  -->
    <form action="loisirs.php" method="post">
       <div class="#">
            <label for="loisir">Loisir</label>                
            <input type="text" name="loisir" placeholder="Nouveau loisir" required>    
       </div>
        <div class="">
            <button class="btn btn-primary" type="submit">Insérer un loisir</button>
        </div>
    </form>
     <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>