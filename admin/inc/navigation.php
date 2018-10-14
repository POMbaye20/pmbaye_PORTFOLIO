<!-- Ma page pour la navigation avec sa navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-info  "><!-- début .navbar -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand " href="index.php">Page d'accueil <i class="fas fa-home text-light"></i></a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
        <div class="dropdown"><!-- début .dropdown menu déroulant -->
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Rubriques <i class="fas fa-list"></i>
            </button>

            <div class="dropdown-menu">
            <a class="dropdown-item" href="competences.php">Compétences</a>
            <a class="dropdown-item" href="loisirs.php">Loisirs</a>
            <a class="dropdown-item" href="formations.php">Formations</a>
            <a class="dropdown-item" href="experiences.php">Expériences professionnelles</a>
            </div>

        </div><!-- fin .dropdown menu déroulant -->

      <li class="nav-item">
        <a class="nav-link" href="#">Connexion</a>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0"><!-- début form pour la barre de recherche -->
      <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Recherche</button>
    </form>
  </div>
</nav><!-- fin .navbar -->