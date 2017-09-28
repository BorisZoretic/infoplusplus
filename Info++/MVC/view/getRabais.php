<?php
$anObject = null;
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';

$anObject = new InfoPromotion();
$id = $_GET['id'];
$anObject = $anObject->getObjectFromDB($id);


echo $anObject['rabais'] * 100;

?>
