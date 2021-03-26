<?php

require 'Connexion.php';
session_start();
$ref = htmlentities($_REQUEST['ref']);
$nomProd = htmlentities($_REQUEST['nomProd']);
$_SESSION['idPage'] = "ajouterProduit";

$sql = 'INSERT INTO produit VALUES ("'.$ref.'", "'.$nomProd.'");';

$table = $connection->exec($sql) or die (print_r($connection->errorInfo()));

header("Location: validation.php");