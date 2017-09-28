<?php
$anObject = null;
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';


$InfoService = new InfoService();

if (isset($_GET['deac']) == false){
$anObject = $InfoService->getService($_GET['id']);
}


if (isset($_GET['deac'])){
    $anObject = $InfoService->getObjectFromDB($_GET['id']);
    $field = 'actif';
    $id = $_GET['id'];
    if ($anObject['actif']==1){
        
        $InfoService->updateObjectDynamically($field, '0', $_GET['id']);
    }
    else {
        
        $InfoService->updateObjectDynamically($field, '1', $_GET['id']);
    }
    
    header("Location: http://localhost/infoplusplus/Info++/service.php");
    exit();
}


?>
