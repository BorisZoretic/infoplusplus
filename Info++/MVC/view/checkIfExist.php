<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';

$code = $_POST['code'];
$soustotal = $_POST['soustotal'];

$aPromoService = new InfoTaPromotionService();
date_default_timezone_set('America/Montreal');
$date = date('Y-m-d h:i:s');
$soustotal = str_replace("sous-total: ", "", $soustotal);
$soustotal = str_replace("$", "", $soustotal);

$aPromoService->checkIfCodeExist($code, $date, $soustotal);
?>

