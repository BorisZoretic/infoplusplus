<?php
if (! isset ( $_SESSION ))
	session_start ();
$anObject = null;
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
	$promos = new InfoPromotion();
	$promos->getActiveObjectsAsSelect(null, "promotion_titre");
	
?>
