<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';

if (isset($_GET['duplicate']) && $_GET['duplicate']==1 ) {
    $message = "Le nom de service est déjà utilisé";
    echo "<script type='text/javascript'>alert('$message');</script>";
    session_abort();
}

if (isset($_SESSION['admin']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
?>
<title>Info++ - Modification Promotion</title>
</head>
<body>
	
    <?php

        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/model/info_ta_promotion_service.php';
        
        $ta_promo = new InfoTaPromotionService();
        $ta_promo->formPromotionService($_GET['pk_promotion_service']);
    
    ?>
	
	
	
    <?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
    ?>
	<script>
        $(document).ready(function() {
        	//$("#selectPromo").load("MVC/view/getPromoSelect.php");
        });
    	$('.btnUpdate').click(function(){
    	    $('input').click();
    	});
    </script>
        
    </body>
</html>