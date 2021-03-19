<?php 
require 'Connexion.php';
$idDemande = $_GET["codeDemande"];
$sql = 'SELECT * FROM demandeur D, faire F, demande B WHERE D.codeDem = F.codeDem AND F.codeDemande = B.codeDemande AND B.codeDemande = '.$idDemande.';';
$table = $connection->query($sql) or die (print_r($connection->errorInfo()));
$ligne = $table->fetch();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Détails demande</title>
        
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
                            <a class="nav-link active" href="liste_demande.php">Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="creerIntervention.php">Enregistrer une intervention</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="modifierIntervention.php">Modifier une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
        <h1>Détails demande n°<?php echo $idDemande?></h1>
        <table class="table table-bordered">
            <tbody>
                <tr>
                        <th class="col-2">Demandeur <br>contact, téléphone ...</th>
                        <td class="col-6"><?php echo $ligne['nomDem'].'<br>'.$ligne['adresseDem'].'<br>'.$ligne['CPDem'].'<br>'.$ligne['telDem'].'<br>'.$ligne['emailDem'].'<br>'.$ligne['utilisateurDem'].'<br>'.$ligne['mdpDem'] ?></td>
                        <th class="col-2">Date de la demande</th>
                        <td class="col-2"><?php echo $ligne['dateDem'] ?></td>
                </tr>
                <tr>
                        <th class="col-2">Equipement <br>matériel, logiciel</th>
                        <td class="col-10" colspan="4"><?php echo $ligne['Equipement'] ?></td>
                </tr>
                <tr>
                        <th class="col-2">Nature de la demande</th>
                        <td class="col-10" colspan="4"><?php echo $ligne['natureDem'] ?></td>
                </tr>
            </tbody>
        </table>
        <h3>Liste intervention</h3>
        <div class="list-group form1">
                    
                    <?php
                        require 'Connexion.php';
                        $sql2 = 'SELECT * FROM demande D, intervenir R, intervention I WHERE D.codeDemande = R.codeDemande AND R.codeInt = I.codeInt AND D.codeDemande = '.$idDemande.';';
                        $table2 = $connection->query($sql2) or die (print_r($connection->errorInfo()));
                        $ligneall2 = $table2->fetchAll();
                        $nbligne = $table2->rowcount();
                        if($nbligne==0){
                            echo 'aucune intervention dans la base de données' ;
                        }else{
                        foreach($ligneall2 as $ligne2){
                            $sql3 = 'SELECT * FROM assister A, intervenant J WHERE A.emailIn = J.emailIn AND codeInt = '.$ligne2['codeInt'].';';
                            $table3 = $connection->query($sql3) or die (print_r($connection->errorInfo()));
                            $ligneall3 = $table3->fetchAll();
                            $nbligne2 = $table3->rowcount();
                            if($nbligne2 > 0){
                                $stringintervenant = 'intervenant: ';
                                foreach($ligneall3 as $ligne3){
                                    $stringintervenant = $stringintervenant.$ligne3['nomIn'].' ';
                                }
                            }
                    ?>
                    <a href="<?php echo "detailsI.php?codeInt=".$ligne2['codeInt'] ?>" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $ligne2['natureInt'] ?></h5>
                        <small>Date début: <?php echo $ligne2['dateDebut'] ?></small>
                        <small>Date fin: <?php echo $ligne2['dateFin'] ?></small>
                    </div>
                    <p class="mb-1"><?php echo $stringintervenant ?></p>
                    </a>
                    <?php
                        }}
                    ?>
        </div>
    </body>
    
</html>