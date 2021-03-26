<?php
session_start();
$_SESSION['TVA'] = $_REQUEST['TVA'];
header("Location: detailsI.php?codeInt=".$_SESSION['idIntervention']."");