<?php require 'connexion.php'; 
 
// insertion d'un formulaire
if (isset($_POST['nom'])) { // si on a reçu un nouveau message
    if ($_POST['nom'] !=''  && $_POST['email'] !='' && $_POST['sujet'] !='' && $_POST['message'] !='' ) {

        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $sujet = addslashes($_POST['sujet']);
        $message = addslashes($_POST['message']);
        $pdoCV -> exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message') ");

        header("location: ../front/index.php");
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
    <title>Contact</title>
</head>
<body>

     <!-- Ici, j'inclus ma page navigation.php -->
     <?php require 'inc/navigation.inc.php'; ?>


     <div class="jumbotron"><!-- début .jumbotron -->
        <h1 class="display-4 text-center">Me contacter <i class="far fa-envelope"></i></h1>
        
        <!-- <hr class="my-4"> -->
        
    </div><!-- fin ..jumbotron -->
    

    
       <div class="container-fluid col-lg-6"><!-- début .container-fluid -->
      

        <h2>Renseignez les informations suivantes</h2>

            <form class="form_message" action="messages.php" method="post">
               <div class="form-group">
                    <label for="nom">Nom</label>                
                    <input type="text" name="nom" placeholder="Nom" class="form-control" required>    
               </div>
        
                <div class="form-group">
                    <label for="email">Email <i class="fas fa-at"></i></label>                
                    <input type="text" name="email" placeholder="xxx@xxx.fr" class="form-control" required>    
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

       </div><!-- fin .container-fluid -->
   
     <!-- Lien Bootstrap script JS  -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<?php require 'inc/footer.inc.php'; ?>