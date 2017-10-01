<?php

$type = $_GET['type'];
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/' .$type.'.php';

if ($type == "info_service"){
	$anObject = new InfoService();
} else if($type == "info_promotion"){
	$anObject = new InfoPromotion();
}
$anObject->getDynamicAdminList();

?>