<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/model/info_ta_promotion_service.php';

$ta_promo = new InfoTaPromotionService();
$ta_promo->formPromotionService($_GET['pk_promotion_service']);

?>