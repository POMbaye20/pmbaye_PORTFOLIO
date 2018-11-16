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

    <!-- Ici, je fais un require de mes liens cdn -->
    <?php require 'inc/link.inc.php'; ?>

    <title>Contact</title>
</head>
<body>

    <main><!-- début <main> -->

         <!-- Ici, j'inclus ma page navigation.php -->
         <?php require 'inc/navigation.inc.php'; ?>
    
    
         <div class="jumbotron messages"><!-- début .jumbotron -->
            <h1 class="display-4 text-center">Me contacter <i class="far fa-envelope"></i></h1>
            
            <!-- <hr class="my-4"> -->
            
        </div><!-- fin ..jumbotron -->
        
    
        
           <div class="container-fluid col-lg-6 message"><!-- début .container-fluid -->
          
                <h2>Renseignez les informations suivantes</h2>
    
                    <form class="form_message mt-4" action="messages.php" method="post">
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
                        <div class="mb-4">
                            <button class="btn btn-success mb-4" type="submit">Envoyer</button>
                        </div>
                    </form>
    
           </div><!-- fin .container-fluid -->

    </main><!-- fin </main> -->
   

<?php require 'inc/footer.inc.php'; ?>