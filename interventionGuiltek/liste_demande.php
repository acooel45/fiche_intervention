<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des demandes</title>
        
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js">
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
    <!-- barre de navigation --> 
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="enregistrerDemande.php">Enregistrer une demande</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="liste_demande.php">Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="creerIntervention.php">Enregistrer une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- liste des demandes -->     
        <div class="container">
            <h1>Liste des demandes</h1>
            
                <div class="list-group form1">
                    
                    <?php
                        require 'Connexion.php';
                        $sql = 'SELECT * FROM demandeur D, faire F, demande B WHERE D.codeDem = F.codeDem AND F.codeDemande = B.codeDemande;';
                        $table = $connection->query($sql) or die (print_r($connection->errorInfo()));
                        $ligneall = $table->fetchAll();
                        $nbligne = $table->rowcount();
                        if($nbligne==0){
                            echo 'aucune demande dans la base de donnée' ;
                        }else{
                        foreach($ligneall as $ligne){
                    ?>
                    <a href="<?php echo "detailsD.php?codeDemande=".$ligne['codeDemande'] ?>" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo 'n°'.$ligne['codeDem'].' '.$ligne['nomDem'] ?></h5>
                        <small><?php echo $ligne['dateDem'] ?></small>
                    </div>
                    <p class="mb-1"><?php echo $ligne['natureDem'] ?></p>
                    </a>
                    <?php
                        }}
                    ?>
                </div>
        </div>
    </body>
    
</html>