<?php
require 'Connexion.php';
session_start();

$dateD = htmlentities($_REQUEST['dateD']);
$dateF = htmlentities($_REQUEST['dateF']);
$duree = htmlentities($_REQUEST['num']);
$natInt = htmlentities($_REQUEST['natureIntervention']);
$etat = htmlentities($_REQUEST['etat']);
$observation = htmlentities($_REQUEST['observation']);
$_SESSION['idPage'] = htmlentities($_REQUEST['idPage']);

$sql = 'SELECT count(*) FROM assister WHERE codeInt = '.$_SESSION['idIntervention'].' ;';
$table = $connection->query($sql) or die (print_r($connection->errorInfo()));
$resu = $table->fetch();
echo $resu['count(*)'];

$sqlDelete = 'DELETE FROM assister WHERE codeInt = '.$_SESSION['idIntervention'].' ;';

if($resu['count(*)'] !=0){
    $table2 = $connection->exec($sqlDelete) or die (print_r($connection->errorInfo()));
}

$sqlUpdate = 'UPDATE intervention SET dateDebut = TIMESTAMP("'.$dateD.'"), dateFin = TIMESTAMP("'.$dateF.'"), dureeInt = '.$duree.', natureInt = "'.$natInt.'", etat = "'.$etat.'", observations = "'.$observation.'" WHERE codeInt = '.$_SESSION['idIntervention'].' ;';

$table3 = $connection->exec($sqlUpdate) or die (print_r($connection->errorInfo()));

if(isset($_POST['intervenant'])){
    foreach($_POST['intervenant'] as $intervenant){
        echo $intervenant.'<br>';
        $sql5 = 'INSERT INTO assister VALUES ("'.$intervenant.'", '.$_SESSION['idIntervention'].');';
        $table5 = $connection->exec($sql5) or die (print_r($connection->errorInfo()));
    }
}

header("Location: validation.php");