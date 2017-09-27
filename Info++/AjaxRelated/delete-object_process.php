<?php

require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
$anObject = new InfoTaPromotionService();

$anID = trim(htmlspecialchars ( $_GET ["pk_promotion_service"] ));

$anObject->deleteDBObject($anID);

?>