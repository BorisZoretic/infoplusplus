<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';

$pk_service = $_POST['pk_service'];

$aService = new InfoService();

$theService = $aService->getObjectFromDB($pk_service);

if ($theService != null){
    echo "<span class='spanServiceForPanierTitle'>" . $theService['service_titre'] . "</span>";
    echo "<span class='spanServiceForPanierTarif'>" . $theService['tarif'] . "</span>";
    echo "<span class='spanServiceForPanierVendeur'>Vous ne serez plus jamais nul en " . $theService['service_titre'] . "</span>";
    echo "<input type='submit' id='add' name='submit' class='buttonAjoutPanier' value='Ajouter au panier'>";
    echo "<label id='pk_service' class='none'>" . $pk_service . "</label>";
}




?>

