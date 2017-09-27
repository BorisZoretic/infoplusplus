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
		echo "<a href='ajoutservice.php'class='ajoutService'>Ajouter un service</a>";
		
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicAdminList();
        ?>

        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
        <script> 
$(document).on("click", "#tool", function(){
	$(this).closest(".divTable").find("#myDropdown").toggleClass("showAbsolute");
	$(this).closest(".divTable").find("#tool").toggleClass("show");
	});

$(document).on("click", "#toolBob", function(){
	$(this).closest(".imagePromo").find("#myDropdownBob").toggleClass("showBob");
	$(this).closest(".imagePromo").find("#toolBob").toggleClass("showBob");
	});

$(document).on("click", "#deletePromoService", function(){
	console.log($(this).attr('idPromoService'));
	data = '';
	$.ajax({method : "POST",
		url : "AjaxRelated/delete-object_process.php?pk_promotion_service=" + $(this).attr('idPromoService'),
		data : data,
		beforeSend : function() {
			// TO INSERT - loading animation
		},
		success : function(response) {
			$(location).attr('href', 'service.php');
		}
	
	});
	});





$(document).on("click", ".buttonPlus", function(){
	$(location).attr('href', 'ajoutTaPromo.php?fk_service=' + $(this).attr('id'));
	});


</script>
    </body>
    
    

</html>