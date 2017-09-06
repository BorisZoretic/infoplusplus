<?php
if (! isset ( $_SESSION ))
	session_start ();
$anObject = null;
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ville.php';
	$Villes = new InfoVille();
	$Villes->getActiveObjectsAsSelect();
	
?>
