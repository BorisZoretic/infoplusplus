<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
$anObject = new InfoPromotion();
$primary_key = $_GET["pk"];


	$txt = $_GET["txt"];
	$rabais = $_GET["rab"];
    
	$anObject->setPk_promotion($primary_key);
    $anObject->setPromotion_titre($txt);
    $anObject->setRabais($rabais);
    

	$anObject->updateDBObject();


?>