 <?php require 'connexion.php'; 



 
// insertion d'un formulaire
if (isset($_POST['nom'])) { // si on a reçu un nouveau message
    if ($_POST['nom'] !=''  && $_POST['email'] !='' && $_POST['sujet'] !='' && $_POST['message'] !='' ) {

        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $sujet = addslashes($_POST['sujet']);
        $message = addslashes($_POST['message']);
        $pdoCV -> exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message') ");

       // pour fabriquer l'email que l'on reçoit
    $entete = "From: page papaoumar mbaye <papaoumar.mbaye@laposte.net>\r\n";
    $entete .= "Reply-To: papaoumar.mbaye@laposte.net\r\n";
    $entete .= "MIME-version: 1.0\r\n";
    $entete .= "Content-Type: text/html; charset=\"UTF-8\""."\n";
    $entete .= "Content-Transfer-Encoding: 8bit";


    $corps ="Nouveau message : ".$nom.' vient d\'écrire.';
    $corps .="<br>Nom : <strong>".$nom.'</strong><br> ';
    $corps .="Courriel : <em>".$email.'</em><br>';
    $corps .="Sujet : <em>".$sujet.'</em><br>';
    $corps .="Message. : ".$message.'<br>';

    mail('papaoumar.mbaye@laposte.net','Message de : '.$nom, $corps, $entete);

    $versleclient='Bonjour <br> Merci pour votre message <br>';
    $versleclient.='Je vous contacte très vite ! Merci';
    $versleclient.='<br><a href=\"https://www.pmbaye.fr\">www.pmbaye.fr</a>';

    mail($email, 'Depuis le site www.pmbaye.fr', $versleclient, $entete);


    header("location: index.php");
            exit();

    } // ferme le if n'est pas vide
} // fin de isset($_POST['nom'])





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
<body style="background:#FFEBCD">

    <main><!-- début <main> -->

         <!-- Ici, j'inclus ma page navigation.php -->
         <?php require 'inc/navigation.inc.php'; ?>
    
    
         <div class="jumbotron messages"><!-- début .jumbotron -->
            <h1 class="display-4 text-center">Me contacter <i class="far fa-envelope"></i></h1>
            
            <!-- <hr class="my-4"> -->
            
        </div><!-- fin ..jumbotron -->
        
    
        
           <div class="container-fluid col-lg-6 message"><!-- début .container-fluid -->
          
                <h2 class="text-center">Renseignez les informations suivantes</h2>
    
                    <form class="form_message mt-4" action="messages.php" method="post">
                   <div class="form-row">
                        <div class="form-group col-md-4">
                                <label for="nom">Nom</label>                
                                <input type="text" name="nom" placeholder="Nom" class="form-control" required>    
                        </div>
                    
                        <div class="form-group col-md-4">
                                <label for="email">Email <i class="fas fa-at"></i></label>                
                                <input type="text" name="email" placeholder="xxx@xxx.fr" class="form-control" required>    
                        </div>
                    
                        <div class="form-group col-md-4">
                                <label for="sujet">Sujet</label>                
                                <input type="text" name="sujet" placeholder="Le sujet du message" class="form-control" required>    
                        </div>
                    
                        <div class="form-group col-md-12">
                                <label for="message">Le message</label>                
                                <textarea name="message" class="form-control"></textarea>
                        </div>
                        
                            <div class="mb-4 send">
                                <button class="btn btn-success mb-4 " type="submit">Envoyer</button>
                            </div>
                   </div>
                    </form>
    
           </div><!-- fin .container-fluid -->

    </main><!-- fin </main> -->
   

<?php require 'inc/footer.inc.php'; ?>