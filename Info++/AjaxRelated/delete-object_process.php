<?php

$type = $_GET['type'];
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/' .$type.'.php';

if($type == "info_ta_promotion_service"){
	$anObject = new InfoTaPromotionService();
	
	$anID = trim(htmlspecialchars ( $_GET ["pk_promotion_service"] ));
}else if ($type == "info_promotion"){
	require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
	$anObject = new InfoPromotion();
	
	$anID = trim(htmlspecialchars ( $_GET ["pk_promotion"] ));
}

$anObject->deleteDBObject($anID);

?>