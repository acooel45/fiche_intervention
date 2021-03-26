<?php

require 'Connexion.php';
session_start();
$nomProd = htmlentities($_REQUEST['listPro']);
$quantite = htmlentities($_REQUEST['Quan']);
$PU = htmlentities($_REQUEST['PU']);
$sql2 = 'SELECT refProd FROM produit WHERE nomProd="'.$nomProd.'";';
$table = $connection->query($sql2) or die (print_r($connection->errorInfo()));
$resu = $table->fetch();
$sql = 'INSERT INTO utiliser VALUES ('.$_SESSION['idIntervention'].', "'.$resu['refProd'].'", '.$quantite.', '.$PU.');';

$table = $connection->exec($sql) or die (print_r($connection->errorInfo()));

header("Location: detailsI.php?codeInt=".$_SESSION['idIntervention']."");