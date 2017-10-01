<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
$anObject = new InfoPromotion();

$titre= $_GET["titre"];
$rabais = $_GET["rabais"];

$anObject->setPk_promotion(null);
$anObject->setPromotion_titre($titre);
$anObject->setRabais($rabais);

$anObject->addDBObject();

?>