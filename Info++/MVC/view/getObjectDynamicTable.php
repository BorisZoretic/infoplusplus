<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';

$anObject = new InfoService();

$anObject->getDynamicAdminList();

?>