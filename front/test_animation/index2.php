<?php require '../connexion.php'; ?>

<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Animation de niveau avec cercle</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<main>


  <div class="row">
    <h1>Animation de niveau avec cercle</h1>
    <p>Scrollez pour voir ...</p>
  </div>

            <?php 
                $sql = $pdoCV -> prepare("SELECT * FROM t_competences ");
                $ligne_competence = $sql -> execute();  // j'exécute la requête
            ?>


    <div class="arrow down"></div>
    <section class="row"> 

        <!-- cercle 1 -->
        <svg class="radial-progress" data-percentage="82" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo $ligne_competence['competence'];  ?></text>
        </svg> 
        
        <!-- cercle 2 -->        
        <svg class="radial-progress" data-percentage="33" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 147.3406954533613;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo $ligne_competence['niveau'];  ?></text>
        </svg> 
        
        <!-- cercle 3 -->       
        <svg class="radial-progress" data-percentage="71" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 63.774330867872806;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">71%</text>
        </svg> 
        
        <!-- cercle 4 -->        
        <svg class="radial-progress" data-percentage="24" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 167.13272917097697;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">24%</text>
        </svg> 
        
        <!-- cercle 5 -->        
        <svg class="radial-progress" data-percentage="100" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 0;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">100%</text>
        </svg> 
        
        <!-- cercle 6 -->        
        <svg class="radial-progress" data-percentage="0" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 219.91148575129;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">0%</text>
        </svg> 
    </section>
    
    <div class="arrow up"></div>
</main>
<!-- lien CDN jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script> 

<!-- lienn script perso -->
<script src="script.js"></script>

</body>
</html>
