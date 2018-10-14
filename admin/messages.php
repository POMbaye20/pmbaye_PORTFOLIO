<?php require 'connexion.php'; 
 
// insertion d'un formulaire
if (isset($_POST['nom'])) { // si on a reçu un nouveau message
    if ($_POST['nom'] !=''  && $_POST['email'] !='' && $_POST['sujet'] !='' && $_POST['message'] !='' ) {

        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $sujet = addslashes($_POST['sujet']);
        $message = addslashes($_POST['message']);
        $pdoCV -> exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message', '1') ");

        header("location: ../admin/messages.php");
            exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['nom'])

// suppresion d'un élément de la BDD
if (isset($_GET['id_message'])) { // on récupère ce que je supprime dans l'url par son id
    $efface = $_GET['id_message']; // je passe l'id dans une variable $efface

    $sql = " DELETE FROM t_messages WHERE id_message = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut le faire avec exec également

    header("location: ../admin/messages.php");
    
}   // fin de isset($_GET['id_message']) pour la suppresion
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
    <title>Admin : Message (contact) </title>
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.php'; ?>


     <div class="jumbotron"><!-- début .jumbotron -->
        <h1 class="display-4">La page consacrée aux messages <i class="far fa-envelope"></i></h1>
        <p class="lead">Page afin de vérifier si je reçois des messages de la part des visiteurs</p>
        <hr class="my-4">
        
    </div><!-- fin ..jumbotron -->
    


<h1>Insertion d'un nouveau message <i class="far fa-envelope"></i></h1>
    <?php 
        //requête popur compter et chercher plusieurs enregistrements on ne peut compter que si on a un prépare
        $sql = $pdoCV -> prepare("SELECT * FROM t_messages");
        $sql -> execute();
        $nbr_messages = $sql -> rowCount();
    ?>

   <div class="table_message">
        <table class="table table-hover" border="1">
        <caption>Mes nouveaux messages <?php echo $nbr_messages; ?> </caption>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    
                </tr>
            </thead>
    
            <tbody>
            <?php  while($ligne_message = $sql -> fetch()) 
                {
            ?>
                <tr>
                    <td><?php echo $ligne_message['nom']; ?></td>
                    <td><?php echo $ligne_message['email']; ?></td>
                    <td><?php echo $ligne_message['sujet']; ?></td>
                    <td><?php echo $ligne_message['message']; ?></td>
                    <td><a href="modif_message.php?id_message=<?php echo $ligne_message['id_message']; ?> " ><i class="fas fa-edit"></i></a></td>
                    <td><a href="messages.php?id_message=<?php echo $ligne_message['id_message']; ?> " ><i class="fas fa-trash text-danger"></i></a></td>
                </tr>
                <?php 
                    }  // fin de la boucle while
                ?>
            </tbody>
        
        </table><!-- fin <table> -->
   </div>
    <hr>
    <!-- Insertion d'un nouveau message de la part d'un visiteur dans le formulaire  -->
   
       <div class="container-fluid">

        <h1 >Envoer un nouveau message</h1>

            <form class="form_message" action="messages.php" method="post">
               <div class="form-group">
                    <label for="nom">Nom</label>                
                    <input type="text" name="nom" placeholder="Nom" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="email">Email</label>                
                    <input type="text" name="email" placeholder="Email @" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="sujet">Sujet</label>                
                    <input type="text" name="sujet" placeholder="Le sujet du message" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="message">Le message</label>                
                    <textarea name="message" class="form-control"></textarea>
               </div>
                <div class="">
                    <button class="btn btn-success" type="submit">Envoyer</button>
                </div>
            </form>
       </div>
   
     <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php require 'inc/footer.php'; ?>