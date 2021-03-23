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

$sqlDelete = 'DELETE FROM assister WHERE codeInt = '.$_SESSION['idIntervention'].' ;';
$tableDelete = $connection->exec($sqlDelete) or die (print_r($connection->errorInfo()));

$sqlUpdate = 'UPDATE intervention SET dateD = TIMESTAMP("'.$dateD.'"), dateF = TIMESTAMP("'.$dateF.'"), dureeInt = '.$duree.', natureInt = "'.natInt.'", etat = "'.$etat.'", observations = "'.$observation.'" WHERE codeInt = '.$_SESSION['idIntervention'].' ;';
$tableUpdate = $connection->exec($sqlUpdate) or die (print_r($connection->errorInfo()));

if(isset($_POST['intervenant'])){
    foreach($_POST['intervenant'] as $intervenant){
        echo $intervenant.'<br>';
        $sql5 = 'INSERT INTO assister VALUES ("'.$intervenant.'", '.$_SESSION['idIntervention'].');';
        $table5 = $connection->exec($sql5) or die (print_r($connection->errorInfo()));
    }
}

//header("Location: validation.php");