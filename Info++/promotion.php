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

	$(document).on("click", ".btnConfrimPromo", function(){

		var self = $(this);
		var form = self.closest("#formAddPromo");

		var titre = form.find("#titre");
		var rabais = form.find("#rabais");

		if(titre.val() != "" && rabais.val() != '' && $.isNumeric(rabais.val())){
			var data = "";
			var rabaisConvert = (rabais.val()/100);
			console.log("titre=" + titre.val() + "&rabais=" + rabaisConvert);
    		$.ajax({method : "POST",
    			url : "AjaxRelated/ajout-promo_process.php?titre=" + titre.val() + "&rabais=" + rabaisConvert,
    			data : data,
    			beforeSend : function() {
    				// TO INSERT - loading animation
    			},
    			success : function(response) {
    				//self.closest(".content").find("toRemove").remove();
    				updateList();
    			}
    		
			});
			} else{
				alert('Veuillez remplir tous les champs requis adéquatemment');
        	}
		
		
		});
	
	$(document).on("click", ".ajoutService", function(e){
		var toAppend = "<div id='tab' class='border divTable service dropdown toRemove'>";
		toAppend += "<form id='formAddPromo' class='inscription' method='post'>";
		toAppend += "<input style='margin-left:-123px' id='titre' name='titre' value='' placeholder='Titre de la promotion'></input>";
		toAppend += "<input class='spacingInput' id='rabais' name='rabais' value='' placeholder='Rabais %'></input>";
		toAppend += "<div class='buttonConfirmer btnConfrimPromo'><a class='aConfirmPromo'>Confirmer</a></div>";
		toAppend += "</form></div>";
		
		$(".content").append(toAppend);
		});


	function updateList(){
		$
		.ajax({
			method : "GET",
			url : "MVC/View/getObjectDynamicTable.php?type=info_promotion",
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

	$(document).on("click", "#deletePromo", function(){
		$(this).closest("#tab").find(".centerDiv").toggleClass("showCenter");
		$(this).closest("#tab").find(".centerDiv").toggleClass("confirmationBonus");
		
	});

	$(document).on("click", "#deleteConfirm", function(){
		console.log($(this).closest("#tab").find("#deletePromo").attr('idPromo'));
		data = '';
		$.ajax({method : "POST",
			url : "AjaxRelated/delete-object_process.php?type=info_promotion&pk_promotion=" + $(this).closest("#tab").find("#deletePromo").attr('idPromo'),
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

	$(document).on("click", "#applyService", function(){
		$(location).attr('href', 'ajoutTaPromoCascade.php?pk_promotion=' + $(this).attr('idPromo'));
	});

	$(document).on("click", "#deleteDeny", function(){
		$(this).closest("#tab").find(".centerDiv").toggleClass("showCenter");
	});


   $(document).on("click", "#modifyPromo", function () {
	  
		var label = $(this).closest("#tab").find("label.titrePromotion");
		var label2 = $(this).closest("#tab").find("label.txtRabaisPromotion");
		
        var txt = label.text();	       
        label.replaceWith("<input class='titrePromotion' value='"+txt+"'/>");
        
        var txt2 = label2.text();
        txt2 = txt2.replace('%', '');	       
        label2.replaceWith("<input class='txtRabaisPromotion' value='"+txt2+"'/>");

        $(this).closest("#tab").append("<div class='buttonConfirmer btnModifPromo'><a class='aConfirmPromo'>Confirmer</a></div>");
    });

   $(document).on("click", ".btnModifPromo", function () {
		  
		var inputTitre = $(this).closest("#tab").find("input.titrePromotion");
		var inputRabais = $(this).closest("#tab").find("input.txtRabaisPromotion");

		var rabais = (inputRabais.val()/100);
		var data = '';
		$.ajax({method : "POST",
			url : "AjaxRelated/edit-promo_process.php?txt=" + inputTitre.val() + "&rab=" + rabais + "&pk=" + $(this).closest("#tab").find("#modifyPromo").attr('idPromo'),
			data : data,
			beforeSend : function() {
				// TO INSERT - loading animation
			},
			success : function(response) {
				updateList();
			}
		
		});
       

   });

	    
    $(document).ready(function() {    	

    	var activePage = window.location.href;
    	console.log(activePage);
        //var activePage = url.substring(url.lastIndexOf('/') + 1);
        
        $('.topliens .navigation2').each(function () {
            var linkPage = this.href;
			console.log(linkPage);
            if (activePage == linkPage) {
                console.log("tbk");                        
            	//$(this).closest("a").removeClass("navigation1");
                $(this).closest(".navigation2").addClass("navigation1");
                $(this).closest(".navigation2").removeClass("navigation2");
            }
        });        	  
    	
    });

	</script>
</body>
    
    

</html>