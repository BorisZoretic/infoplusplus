<?php
session_start();
session_destroy();
$_SESSION = array();
setcookie();


if (session_status() != PHP_SESSION_ACTIVE) {  
    header("Location: http://localhost/infoplusplus/Info++/index.php");
    exit();
}
?>