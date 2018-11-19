<!-- Ma page pour la navigation avec sa navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-fixed-top"><!-- début .navbar -->

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand " href="index.php"><i class="fas fa-home text-light"></i></a><!-- Lien vers la page d'accueil index.php avecf son icône font awesome -->

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03"><!-- début de .collapse navbar-collapse -->
    
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0"><!-- début <ul> -->
                <div class="dropdown"><!-- début .dropdown menu déroulant -->
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                        Rubriques <i class="fas fa-list"></i>
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="competences.php">Compétences</a>
                    <a class="dropdown-item" href="experiences.php">Expériences professionnelles</a>
                    <a class="dropdown-item" href="formations.php">Formations</a>
                    <a class="dropdown-item" href="loisirs.php">Loisirs</a>
                    </div>
                </div><!-- fin .dropdown menu déroulant -->

                
                <li class="nav-item right">
                <a class="nav-link text-white  " href="../admin/index.php?deconnexion=oui" > <?php echo $ligne_utilisateur['pseudo']; ?> Se déconnecter<i class="fas fa-sign-out-alt text-danger"></i></a>
                </li>
                
            </ul><!--  fin </ul> -->


    </div><!-- fin de .collapse navbar-collapse -->

</nav><!-- fin .navbar -->