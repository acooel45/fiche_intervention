<?php 
require 'Connexion.php';
$idInt = $_GET["codeInt"];
$sql = 'SELECT * FROM intervention I, assister A, intervenant J WHERE I.codeInt = A.codeInt AND A.emailIn = J.emailIn AND I.codeInt = '.$idInt.';';
$table = $connection->query($sql) or die (print_r($connection->errorInfo()));
$ligne = $table->fetch();

$sql3 = 'SELECT * FROM assister A, intervenant J WHERE A.emailIn = J.emailIn AND codeInt = '.$idInt.';';
$table3 = $connection->query($sql3) or die (print_r($connection->errorInfo()));
$ligneall3 = $table3->fetchAll();
$nbligne2 = $table3->rowcount();
if($nbligne2 > 0){
    $stringintervenant = '';
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
                        <li class="nav-item">
                            <a class="nav-link active" href="modifierIntervention.php">Modifier une intervention</a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
        
    <!-- tableau des détails de l'intervention séléctionné --> 
        <h1>Détails intervention n°<?php echo $idInt?></h1>
        
        <table class="table table-bordered">
            <tbody>
                <tr>
                        <th class="col-2">Intervenant(s)</th>
                        <td class="col-4"><?php echo $stringintervenant?></td> 
                        <th class="col-1">Date début</th>
                        <td class="col-1"><?php echo $ligne['dateDebut'] ?></td>
                        <th class="col-1">Date fin</th>
                        <td class="col-1"><?php echo $ligne['dateFin'] ?></td>
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
        
        <a href="<?php echo "modif2Inter.php?codeInt=".$idInt ?>" role="button" class="btn btn-primary" >Modifier</a>
    </body>
    
</html>