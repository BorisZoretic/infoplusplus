<?php
session_start();

$pk_service = $_POST['pk_service'];

array_push($_SESSION['panier'], $pk_service);

?>

