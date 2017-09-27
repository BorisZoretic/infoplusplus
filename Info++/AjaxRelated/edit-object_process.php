<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
$anObject = new InfoTaPromotionService();
$primary_key = $_GET["primary_key"];

$aPromoService = $anObject->getObjectFromDB($primary_key);

$promo = $_GET["promo"];
$date_debut = $_GET["date_debut"];
$date_fin = $_GET["date_fin"];
$code = $_GET["code"];

$anObject->setPk_promotion_service($aPromoService['pk_promotion_service']);
$anObject->setCode($code);
$anObject->setDate_debut($date_debut);
$anObject->setDate_fin($date_fin);
$anObject->setFk_promotion($promo);

$anObject->updateDBObject();

?>