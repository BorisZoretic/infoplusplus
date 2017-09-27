<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
$anObject = new InfoTaPromotionService();

$promo = $_GET["promo"];
$date_debut = $_GET["date_debut"];
$date_fin = $_GET["date_fin"];
$code = $_GET["code"];
$fk_service = $_GET["fk_service"];

$anObject->setPk_promotion_service(null);
$anObject->setCode($code);
$anObject->setDate_debut($date_debut);
$anObject->setDate_fin($date_fin);
$anObject->setFk_promotion($promo);
$anObject->setFk_service($fk_service);

$anObject->addDBObject();

?>