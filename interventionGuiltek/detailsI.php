<?php 
require 'Connexion.php';
$idInt = $_GET["codeInt"];
$sql = 'SELECT * FROM intervenir K, intervention I WHERE K.codeInt = I.codeInt AND I.codeInt = '.$idInt.';';
$table = $connection->query($sql) or die (print_r($connection->errorInfo()));
$ligne = $table->fetch();

$sql3 = 'SELECT * FROM assister A, intervenant J WHERE A.emailIn = J.emailIn AND codeInt = '.$idInt.';';
$table3 = $connection->query($sql3) or die (print_r($connection->errorInfo()));
$ligneall3 = $table3->fetchAll();
$nbligne2 = $table3->rowcount();
$stringintervenant = '';
if($nbligne2 > 0){
    foreach($ligneall3 as $ligne3){
        $stringintervenant = $stringintervenant.$ligne3['nomIn'].'<br>';
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Détails Intervention</title>
        
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
                            <a class="nav-link active" href="liste_demande.php">Liste des demandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="creerIntervention.php">Enregistrer une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
        
    <!-- tableau des détails de l'intervention séléctionné --> 
    <div class="container">
        <h1>Détails intervention n°<?php echo $idInt?></h1>
        
        <table class="table table-bordered">
            <tbody>
                <tr>
                        <th class="col-2">Intervenant(s)</th>
                        <td class="col-4"><?php echo $stringintervenant?></td> 
                        <th class="col-1">Date début</th>
                        <td class="col-1"><?php echo date('Y-m-d', strtotime($ligne['dateDebut'])) ?></td>
                        <th class="col-1">Date fin</th>
                        <td class="col-1"><?php echo date('Y-m-d', strtotime($ligne['dateFin'])) ?></td>
                        <th class="col-1">Durée</th>
                        <td class="col-1"><?php echo $ligne['dureeInt'].' h' ?></td>
                </tr>
                <tr>
                        <th class="col-2">Nature de l'intervention</th>
                        <td class="col-10" colspan="8"><?php echo $ligne['natureInt'] ?></td>
                </tr>
                <tr>
                        <th class="col-2">Etat après intervention</th>
                        <td class="col-10" colspan="8"><?php echo $ligne['etat'] ?></td>
                </tr>
                <tr>
                        <th class="col-2">Observation</th>
                        <td class="col-10" colspan="8"><?php echo $ligne['observations'] ?></td>
                </tr>
            </tbody>
        </table>
        
        <!--bouton retour et modifier -->
        <a href="<?php echo "detailsD.php?codeDemande=".$ligne['codeDemande'] ?>" role="button" class="btn btn-primary" >Retour</a>
        <a href="<?php echo "modifIntervention.php?codeInt=".$idInt ?>" role="button" class="btn btn-primary" >Modifier</a>
        
        <h1>Produits</h1>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="col-1">Ref</th>
                    <th class="col-8">Produit</th>
                    <th class="col-1">Qté</th>
                    <th class="col-1">PU HT</th>
                    <th class="col-1">Total HT</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                ?>
                <tr>
                    <td colspan="3"></td>
                    <th>Total HT</th>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <th>TVA  %</th>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <th>Total TTC</th>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    </body>
    
</html>