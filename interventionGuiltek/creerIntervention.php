<html>
    <head>
        <meta charset="UTF-8">
        <title>Enregistrer Intervention</title>
        
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
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
                            <a class="nav-link active" href="liste_demande.php" >Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="creerIntervention.php" >Enregistrer une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- formulaire pour enregistrer une intervention -->     
        <div class="container">
            <h1>Enregistrer Intervention</h1>
            <form method="post" class="form1 row g-3" action="cInterventionBO.php">
                <input type="hidden" name="idPage" id="idPage" value="creerIntervention">
                    <h3>Selectionner la demande</h3>
                    <select class="form-select" size="4" aria-label="size 4 select example" id="demande" name="demande" required>
                            <?php 
                                require 'Connexion.php';
                                $sql2 = 'SELECT * FROM demande D, faire F, demandeur E WHERE E.codeDem = F.codeDem AND F.codeDemande = D.codeDemande;';
                                $table2 = $connection->query($sql2) or die (print_r($connection->errorInfo()));
                                $ligneall2 = $table2->fetchAll();
                                $nbligne2 = $table2->rowcount();
                                if($nbligne2 == 0){
                                    echo 'aucune demande dans la base de donnée';
                                }else{
                                    foreach($ligneall2 as $ligne2){
                                        ?>
                                        <option value="<?php echo $ligne2['codeDemande'] ?>"> <?php echo 'n°'.$ligne2['codeDemande'].' '.$ligne2['nomDem'] ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    
                        <div class="col-8">
                            <h3>Intervenant(s)</h3>
                            <?php 
                                require 'Connexion.php';
                                $sql = 'SELECT * FROM intervenant ;';
                                $table = $connection->query($sql) or die (print_r($connection->errorInfo()));
                                $ligneall = $table->fetchAll();
                                $nbligne = $table->rowcount();
                                $a = 0;
                                if($nbligne > 0){
                                foreach($ligneall as $ligne){
                                    $a = $a + 1;
                                    echo 
                                    '<fieldset>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="'.$ligne['emailIn'].'"  name="intervenant[]">
                                        <label class="form-check-label" for="'.$ligne['emailIn'].'">'.$ligne['nomIn'].'</label>
                                    </div>
                                    </fieldset>';

                                }}
                            ?>
                        </div>
                    
                        <div class="col-2">
                            <h3>Date début</h3>
                            <input type="date" id="dateD" name="dateD" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        
                        <div class="col-2">
                            <h3>Date fin</h3>
                            <input type="date" id="dateF" name="dateF">
                        </div>
                        
                        <div class="col-12">
                            <h3>Durée de l'intervention(en heures):</h3>
                            <input id="num" name="num" type="number" min="0" value="0">
                        </div>
                
                        <h3>Nature de l'intervention</h3>
                
                        <div class="col-12">
                            <textarea class="form-control" id="natureIntervention" name="natureIntervention" style="height: 130px" required></textarea>
                        </div>
                        
                        <h3>Etat après intervention</h3>

                        <div class="col-12">
                            <textarea class="form-control" id="Etat" name="etat" style="height: 130px"></textarea>
                        </div>

                        <h3>Observations</h3>
                    
                        <div class="col-12">
                            <textarea class="form-control" id="observation" name="observation" style="height: 130px"></textarea>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>

            </form>
            
        </div>
    </body>
</html>