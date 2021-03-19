<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifier Intervention</title>
        
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        
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
                            <a class="nav-link active" href="creerIntervention.php" >Enregistrer une intervention</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="modifierIntervention.php">Modifier une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1>Modifier Intervention</h1>
            <form method="post" class="form1 row g-3" action="modif2Inter.php">
                    <h3>Selectionner l'intervention à modifier</h3>
                        <select class="form-select" size="4" aria-label="size 4 select example" id="demande" name="demande">
                            <?php 
                                require 'Connexion.php';
                                $sqli = 'SELECT * FROM intervention;';
                                $tablei = $connection->query($sqli) or die (print_r($connection->errorInfo()));
                                $nblignei = $tablei->rowcount();
                                $sql2 = 'SELECT * FROM intervention I, assister A, intervenant J WHERE I.codeInt = A.codeInt AND A.emailIn = J.emailIn ;';
                                $table2 = $connection->query($sql2) or die (print_r($connection->errorInfo()));
                                $ligneall2 = $table2->fetchAll();
                                $nbligne2 = $table2->rowcount();
                                if($nblignei == 0){
                                    echo 'aucune intervention dans la base de donnée';
                                }else{
                                    foreach($ligneall2 as $ligne2){
                                        ?>
                                        <option value="<?php echo $ligne2['codeInt'] ?>"> <?php echo 'intervention n°'.$ligne2['codeInt'].' '.$ligne2['natureInt'] ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>

            </form>
            
        </div>
    </body>
</html>