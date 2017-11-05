<?php
$anObject = null;
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_panier.php';
$aPanier = new InfoPanier();
$aPanier->getDynamicList();


?>
