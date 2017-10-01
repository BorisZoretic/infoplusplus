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

$(document).on("hover", ".imgPromo", function(){
	$(this).find(".none").toggleClass("showDate");
	});

$(document).ready(function(){
    $( ".imagePromo" ).hover(
    		  function() {
    		    $( this ).find('.none').removeClass( "none" );
    		  }, function() {
    		    $( this ).find('.showDate').addClass( "none" );
    		  }
    		);
});

$(document).on("click", "#toolBob", function(e){
	e.stopPropagation();
	$(this).closest(".imagePromo").find("#myDropdownBob").toggleClass("showBob");
	$(this).closest(".imagePromo").find("#toolBob").toggleClass("showBob");
	});


$(document).on("click", "#mod", function(){
	var idService = $(this).closest(".divTable").find("#pk").text(); 
	$(location).attr('href', 'modifservice.php?id='+idService);
});

$(document).on("click", "#deac", function(){
	var idService = $(this).closest(".divTable").find("#pk").text(); 
	$(location).attr('href', 'MVC/view/getService.php?id='+idService+'&deac=1');
});


$(document).on("click", "#deletePromoService", function(){
	$(this).closest(".divMarginTop").find(".center").toggleClass("showCenter");
});

$(document).on("click", "#deleteConfirm", function(){
	console.log($(this).closest(".divMarginTop").find("#deletePromoService").attr('idPromoService'));
	data = '';
	$.ajax({method : "POST",
		url : "AjaxRelated/delete-object_process.php?pk_promotion_service=" + $(this).closest(".divMarginTop").find("#deletePromoService").attr('idPromoService'),
		data : data,
		beforeSend : function() {
			// TO INSERT - loading animation
		},
		success : function(response) {
			updateList();
			//$(location).attr('href', 'service.php');
		}
	
	});
});

$(document).on("click", "#deleteDeny", function(){
	$(this).closest(".divMarginTop").find(".center").toggleClass("showCenter");
});


$(document).on("click", ".buttonPlus", function(){
	$(location).attr('href', 'ajoutTaPromo.php?fk_service=' + $(this).attr('id'));
	});

$(document).on("click", ".content", function(){
	$( "#myDropdownBob" ).each(function( index ) {
		  if($(this).hasClass("showBob")){
			$(this).removeClass("showBob");
		  	$(this).closest(".imagePromo").find("#toolBob").removeClass("showBob");
		  }
		});
	});


function updateList(){
	$
	.ajax({
		method : "GET",
		url : "MVC/View/getObjectDynamicTable.php",
		beforeSend : function() {
			// TO INSERT - loading animation
		},
		beforeSend : function() {
			/*$('.tblObject tbody')
					.append(
							"<span id='download'>Telechargement..</span>");*/
		},
		success : function(response) {
			//$('#download').remove();
			$('.content').html("");
			$('.content').append(response);
		}
	});
}



</script>
    </body>
    
    

</html>