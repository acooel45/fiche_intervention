<?php 
require 'Connexion.php';
session_start();
$_SESSION['idIntervention'] = $_GET["codeInt"];
$sql = 'SELECT * FROM intervenir K, intervention I WHERE K.codeInt = I.codeInt AND I.codeInt = '.$_SESSION['idIntervention'].';';
$table = $connection->query($sql) or die (print_r($connection->errorInfo()));
$ligne = $table->fetch();

$sql3 = 'SELECT * FROM assister A, intervenant J WHERE A.emailIn = J.emailIn AND codeInt = '.$_SESSION['idIntervention'].';';
$table3 = $connection->query($sql3) or die (print_r($connection->errorInfo()));
$ligneall3 = $table3->fetchAll();
$nbligne2 = $table3->rowcount();
$_SESSION['stringintervenant'] = '';
if($nbligne2 > 0){
    foreach($ligneall3 as $ligne3){
        $_SESSION['stringintervenant'] = $_SESSION['stringintervenant'].$ligne3['nomIn'].'<br>';
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
                            <a class="nav-link active" href="ajoutProduit.php" >Enregistrer un produit</a>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
        
    <!-- tableau des détails de l'intervention séléctionné --> 
    <div class="container">
        <h1>Détails intervention n°<?php echo $_SESSION['idIntervention']?></h1>
        
        <table class="table table-bordered">
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
        
        <!--bouton retour et modifier -->
        <a href="<?php echo "detailsD.php?codeDemande=".$ligne['codeDemande'] ?>" role="button" class="btn btn-primary" >Retour</a>
        <a href="<?php echo "modifIntervention.php?codeInt=".$_SESSION['idIntervention'] ?>" role="button" class="btn btn-primary" >Modifier</a>
        
        <!--tableau des produits -->
        <h1>Produits</h1>
        
        <table class="table table-bordered">
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
                    <td colspan="3"><form action="modifTVA.php"><h4>Modifier la TVA:</h4><input id="TVA" name="TVA" type="number" min="0" value="0" step="0.01" required><button type="submit" class="btn btn-primary">Modifier TVA</button></form></td>
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
        <form action='ajoutProduitBO2.php?codeInt="<?php echo $_SESSION['idIntervention'] ?>"' method="post" class="form1 row g-3">
        <label for="listPro" class="form-label">Ajouter produit :</label>
            <input class="form-control" list="datalistOptions" id="listPro" name="listPro" placeholder="Tapez pour chercher le produit" >
            <datalist id="datalistOptions">
                <?php 
                    $sqlpro2 = 'SELECT * FROM produit ;';
                    $tablepro2 = $connection->query($sqlpro2) or die (print_r($connection->errorInfo()));
                    $ligneallpro2 = $tablepro2->fetchAll();
                    foreach($ligneallpro2 as $lignepro2){
                        echo '<option value="'.$lignepro2['nomProd'].'">';
                    }
                ?>
            </datalist>
            
            <div class='col-2'>
            <h3>Quantité:</h3>
            <input id="Quan" name="Quan" type="number" min="0" value="0" required>
            </div>
            <div class='col-2'>
            <h3>Prix Unitaire:</h3>
            <input id="PU" name="PU" type="number" min="0" value="0" step="0.01" required>
            </div>
            <div class='col-2'>
                <button type="submit" class="btn btn-primary">Ajouter produit</button>
            </div>
        </form>
        <br>
        <a href="ImpIntervention.php" role="button" class="btn btn-primary" >Imprimer la fiche d'intervention</a>
    </div>
    </body>
    
</html>