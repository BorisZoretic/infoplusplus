<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_panier.php';

$pk_service = $_POST['pk_service'];

if (($key = array_search($pk_service, $_SESSION['panier'])) !== false) {
    unset($_SESSION['panier'][$key]);
    
}

$aPanier = new InfoPanier();
$aPanier->getDynamicList();
?>

