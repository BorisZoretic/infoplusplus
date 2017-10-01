<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
$anObject = new InfoPromotion();
$primary_key = $_GET["pk"];

$aPromo = $anObject->getObjectFromDB($primary_key);

if (isset($_GET["txt"])){
    $txt = $_GET["txt"];
    
    $anObject->setPk_promotion($aPromo['pk_promotion']);
    $anObject->setPromotion_titre($txt);
    $anObject->setRabais($aPromo['rabais']);
    
}


if (isset($_GET["rab"])){
    $rabais = $_GET["rab"];
    $anObject->setPk_promotion($aPromo['pk_promotion']);
    $anObject->setPromotion_titre($aPromo['promotion_titre']);
    $anObject->setRabais($rabais);
    
}

$anObject->updateDBObject();


?>