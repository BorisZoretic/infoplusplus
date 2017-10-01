<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
$anObject = new InfoClient();
$primary_key = $_GET["primary_key"];

$aClient = $anObject->getObjectFromDB($primary_key);

$lname = $_GET["lname"];
$fname = $_GET["fname"];
$streetadd = $_GET["streetadd"];
$sname = $_GET["sname"];
$zip = $_GET["zip"];
$phone = $_GET["phone"];
$selector = $_GET["selector"];
$ema = $_GET["ema"];
$pass = $_GET["pass"];

$anObject->setPk_promotion_service($aClient['pk_promotion_service']);
$anObject->setCode($code);
$anObject->setDate_debut($date_debut);
$anObject->setDate_fin($date_fin);
$anObject->setFk_promotion($promo);

$anObject->updateDBObject();

?>