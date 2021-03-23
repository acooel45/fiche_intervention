<?php

require 'Connexion.php';
session_start();

$nomDemandeur = htmlentities($_REQUEST['nomDem']);
$date = htmlentities($_REQUEST['date']);
$adresseDemandeur = htmlentities($_REQUEST['adresseDem']);
$CP = htmlentities($_REQUEST['CPDem']);
$telephoneDemandeur = htmlentities($_REQUEST['telDem']);
$email = htmlentities($_REQUEST['emailDem']);
$utilisateurDemandeur = htmlentities($_REQUEST['utilisateurDem']);
$mdpDemandeur = htmlentities($_REQUEST['mdpDemandeur']);
$equipement = htmlentities($_REQUEST['Equipement']);
$natureDemande = htmlentities($_REQUEST['natureDemande']);
$_SESSION['idPage'] = htmlentities('idPage');

$sqlfaire = 'SELECT codeDem FROM demandeur WHERE nomDem = "'.$nomDemandeur.'" AND emailDem = "'.$email.'";';
$sqlfaire2 = 'SELECT codeDemande FROM demande WHERE natureDem = "'.$natureDemande.'" AND Equipement = "'.$equipement.'";';

$sql = 'INSERT INTO Demandeur (nomDem, adresseDem, CPDem, telDem, emailDem, utilisateurDem, mdpDem) VALUES("'.$nomDemandeur.'","'.$adresseDemandeur.'","'.$CP.'","'.$telephoneDemandeur.'","'.$email.'","'.$utilisateurDemandeur.'","'.$mdpDemandeur.'"); ';

$sql2 = 'INSERT INTO demande (natureDem, Equipement) VALUES ("'.$natureDemande.'","'.$equipement.'"); ';

$sqlfaire = 'SELECT codeDem FROM demandeur WHERE nomDem = "'.$nomDemandeur.'" AND emailDem = "'.$email.'";';
$sqlfaire2 = 'SELECT codeDemande FROM demande WHERE natureDem = "'.$natureDemande.'" AND Equipement = "'.$equipement.'";';

$table = $connection->exec($sql) or die (print_r($connection->errorInfo()));
$table2 = $connection->exec($sql2) or die (print_r($connection->errorInfo()));

$table3 = $connection->query($sqlfaire) or die (print_r($connection->errorInfo()));
$table4 = $connection->query($sqlfaire2) or die (print_r($connection->errorInfo()));

$ligne = $table3->fetch();
$ligne2 = $table4->fetch();

$sql3 = 'INSERT INTO Faire VALUES ("'.$ligne2['codeDemande'].'","'.$ligne['codeDem'].'","'.$date.'");';

$table5 = $connection->exec($sql3) or die (print_r($connection->errorInfo()));

header("Location: validerDemande.php");