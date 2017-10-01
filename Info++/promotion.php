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
		echo "<a class='ajoutService'>Ajouter une promotion</a>";
		
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
            $aPromotion = new InfoPromotion();
            $aPromotion->getDynamicAdminList();
        ?>

        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
        
	<script> 

	$(document).on("click", "#tool", function(e){
		e.stopPropagation();
		$(this).closest(".divTable").find("#myDropdown").toggleClass("showAbsolute");
		$(this).closest(".divTable").find("#tool").toggleClass("show");
		});
	
	$(document).on("click", ".content", function(){

		$( "#myDropdown" ).each(function( index ) {
			  if($(this).hasClass("showAbsolute")){
				$(this).removeClass("showAbsolute");
			  	$(this).closest(".divTable").find("#tool").removeClass("show");
			  }
			});
		});

	$(document).on("click", ".buttonConfirmer", function(){

		var self = $(this);
		var form = self.closest("#formModifPromo");

		var titre = self.closest("body").find("#pk");
		var rabais = form.find("#selectPromo");

		
		
		});
	
	$(document).on("click", ".ajoutService", function(e){
		var toAppend = "<div id='tab' class='border divTable service dropdown'>";
		toAppend += "<form id='formAddPromo' class='inscription' method='post'>";
		toAppend += "<input style='margin-left:-123px' id='titre' name='titre' value='' placeholder='Titre de la promotion'></input>";
		toAppend += "<input class='spacingInput' id='rabais' name='rabais' value='' placeholder='Rabais %'></input>";
		toAppend += "<div class='buttonConfirmer btnConfrimPromo'><a class='aConfirmPromo'>Confirmer</a></div>";
		toAppend += "</form></div>";
		
		$(".content").append(toAppend);
		});


	</script>
</body>
    
    

</html>