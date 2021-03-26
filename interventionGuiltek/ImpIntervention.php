<?php
require 'Connexion.php';
session_start();

$sql = 'SELECT * FROM demandeur D, faire F, demande B, intervenir J, intervention I '
        . 'WHERE D.codeDem = F.codeDem '
        . 'AND F.codeDemande = B.codeDemande '
        . 'AND B.codeDemande = J.codeDemande '
        . 'AND J.codeInt = I.codeInt '
        . 'AND I.codeInt = "'.$_SESSION['idIntervention'].'";';
$table = $connection->query($sql) or die (print_r($connection->errorInfo()));
$ligne = $table->fetch();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Imprimer fiche intervention</title>
        
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <div class="container">
        <div class="fiche_intervention">
            <div class="row justify-content-md-center">
            <div class="col-md-auto"><h1>Fiche Intervention</h1></div>
            </div>
        <h3>Nature de la demande</h3>
        <table class="table table-bordered border border-dark">
            <tbody>
                <tr>
                    <th class="col-2">Nom du demandeur <br>Adresse <br>Code postal <br>Téléphone <br>Email <br>Utilisateur <br>Mot de passe</th>
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
        
        <h3>Détails de l'intervention</h3>
        
        <table class="table table-bordered border border-dark">
            <tbody>
                <tr>
                        <th class="col-2">Intervenant(s)</th>
                        <td class="col-4"><?php echo $_SESSION['stringintervenant']?></td> 
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
        
        <h3>Produits</h3>
        
        <table class="table table-bordered border border-dark">
            <thead>
                <tr>
                    <th class="col-1">Ref</th>
                    <th class="col-8">Produit</th>
                    <th class="col-1">Qté</th>
                    <th class="col-1">PU HT €</th>
                    <th class="col-1">Total HT €</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sqlpro = 'SELECT * FROM utiliser U, produit P WHERE U.refProd = P.refProd AND codeInt = '.$_SESSION['idIntervention'].' ;';
                    $tablepro = $connection->query($sqlpro) or die (print_r($connection->errorInfo()));
                    $ligneallpro = $tablepro->fetchAll();
                    $totalHT = 0;
                    $totalallHT = 0;
                    foreach($ligneallpro as $lignepro){
                        $totalHT = $lignepro['quantiteProd'] * $lignepro['PU'];
                        $totalallHT = $totalallHT + $totalHT;
                        echo
                        '<tr>
                            <td>'.$lignepro['refProd'].'</td>
                            <td>'.$lignepro['nomProd'].'</td>
                            <td>'.$lignepro['quantiteProd'].'</td>
                            <td>'.$lignepro['PU'].'</td>
                            <td>'.$totalHT.'</td>
                        </tr>';
                    }
                ?>
                <tr>
                    <td colspan="3"></td>
                    <th>Total HT €</th>
                    <td><?php echo $totalallHT ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <th>TVA  %</th>
                    <td><?php if(isset($_SESSION['TVA'])){echo $_SESSION['TVA'] ;} ?></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <th>Total TTC €</th>
                    <td><?php if(isset($_SESSION['TVA'])){echo ($_SESSION['TVA']/100*$totalallHT)+$totalallHT ;} ?></td>
                </tr>
            </tbody>
        </table>
        <div class="row">
        <div class="col-6"><h3>Signature de l'intervenant</h3></div>
        <div class="col-6"><h3>Signature du client</h3></div>
        </div>
        <br>
        <br>
        <br>
        <br>
        </div>
            <a href="<?php echo "detailsI.php?codeInt=".$_SESSION['idIntervention'] ?>" role="button" class="btn btn-primary" >Retour</a>
        </div>
    </body>
</html>