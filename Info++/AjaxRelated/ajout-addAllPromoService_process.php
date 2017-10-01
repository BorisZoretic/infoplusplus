<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
$anObject = new InfoTaPromotionService();
$aService = new InfoService();
$aListOfService = $aService->getListOfAllDBObjects();

$promo = $_GET["pk_promotion"];

$anObject->setPk_promotion_service(null);
$anObject->setFk_promotion($promo);
$anObject->setCode("");

$anObject->setDate_debut($_GET["date_debut"]);
$anObject->setDate_fin($_GET["date_fin"]);

if($aListOfService != null){
	foreach ($aListOfService as $service){
		$anObject->setFk_service($service['pk_service']);
		$anObject->addDBObject();
	}
}

?>