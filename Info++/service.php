<?php
session_start();
if (isset($_SESSION['admin']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Info++ - Service</title>
</head>
<body>
	<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
?>
	
		<?php
		require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/gestion_service.php';
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicAdminList();
        ?>

        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
        <script> 
$(document).on("click", ".divTable", function(){
	$(this).closest(".divTable").find("#myDropdown").toggleClass("show");
	});

</script>
    </body>
    
    

</html>