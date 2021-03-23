<?php

require 'Connexion.php';
session_start();

$dateD = htmlentities($_REQUEST['dateD']);
$dateF = htmlentities($_REQUEST['dateF']);
$duree = htmlentities($_REQUEST['num']);
$natInt = htmlentities($_REQUEST['natureIntervention']);
$etat = htmlentities($_REQUEST['etat']);
$observation = htmlentities($_REQUEST['observation']);
$codeDemande = htmlentities($_REQUEST['demande']);
$_SESSION['idPage'] = htmlentities('idPage');

$sql = 'INSERT INTO intervention (dateDebut, dateFin, dureeInt, natureInt, etat, observations) VALUES (TIMESTAMP("'.$dateD.'"), TIMESTAMP("'.$dateF.'"), '.$duree.', "'.$natInt.'", "'.$etat.'", "'.$observation.'");';
$table = $connection->exec($sql) or die (print_r($connection->errorInfo()));

$sql2 = 'SELECT * FROM intervention WHERE dateDebut = TIMESTAMP("'.$dateD.'") AND dateFin = TIMESTAMP("'.$dateF.'") AND dureeInt = '.$duree.' AND natureInt = "'.$natInt.'" AND etat = "'.$etat.'" AND observations = "'.$observation.'";';
$table2 = $connection->query($sql2) or die (print_r($connection->errorInfo()));
$ligneall = $table2->fetch();

$sql4 = 'INSERT INTO intervenir VALUES ('.$codeDemande.', '.$ligneall['codeInt'].');';
$table3 = $connection->exec($sql4) or die (print_r($connection->errorInfo()));

if(isset($_POST['intervenant'])){
    foreach($_POST['intervenant'] as $intervenant){
        $sql5 = 'INSERT INTO assister VALUES ("'.$intervenant.'", '.$ligneall['codeInt'].');';
        $table5 = $connection->exec($sql5) or die (print_r($connection->errorInfo()));
    }
}

header("Location: validerIntervention.php");