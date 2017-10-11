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
		echo "<a href='#' id='openiframe' class='ajoutService'>Ajouter un service</a>";
		
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicAdminList();
        ?>

        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
<div class="iframe none" id="somediv">
        <div class="formcenter">
		<h4>Complétez le formulaire pour ajouter un service</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<form id="formIns" class="inscription" onsubmit="return validate()">
			<div name='imageUpload' id='uploads'>
				<img class='imgHolder' src=''> <input type='file'
					name='fileToUpload' class='imgUpload' id='fileToUp'> <input
					type="button" class='btnUpdate' value='Mettre à jour la photo'>
			</div>
			<div id='formServ'>
				<input id="titre" name='title' class='inputMarginWidthService'
					placeholder='Titre' required="true"></input> <br>
				<textarea type="textarea" id="desc" name='description'
					class='inputMarginWidthServiceDesc' placeholder='Description' required="true"></textarea>
				<br> <input type='number' min='1' max='1000' name='duree' id="dur"
					class='inputMarginWidthService2' placeholder='Durée' required="true"></input> <input
					type='number' min='1' max='1000' id="tar" name='tarif'
					class='inputMarginWidthService2' placeholder='Tarif' required="true"></input><br>
				<div class='inputMarginWidthService3'>
					<input type='checkbox' id='act' name='active' required="true"></input><label>Activer
						dans le catalogue</label>
				</div>

			</div>
			<input type="submit" id="add" name="submit" class='buttonConfirmer'
				value="Confirmer">
		</form>
	</div>       
        
</div>
<!--         <script -->
<!-- 			  src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" -->
<!-- 			  integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" -->
<!-- 			  crossorigin="anonymous"></script> -->
        <script> 

        $(document).on("click", "#openiframe", function(e){
            e.stopPropagation;
            $('#somediv').removeClass('none');
        	});
        
       

//         	function opendialog(page) {
        	
//         	  var $dialog = $('#somediv')
//         	  .html('<iframe id="frame" style="border: 0px; " src="' + page + '" width="100%" height="100%"></iframe>')
//         	  .dialog({
//         	    title: "Ajout",
//         	    autoOpen: false,
//         	    dialogClass: 'dialog_fixed,ui-widget-header',
//         	    modal: true,
//         	    height: 600,
//         	    minWidth: 600,
//         	    minHeight: 400,
//         	    draggable:true,
//         	    close: function () { $(this).remove(); },
//         	    buttons: { "Ok": function () {       
            	      
//             	    $(this).dialog("close");
//             	    location.reload(); } }
//         	  });        	 
//         	  $dialog.dialog('open');
//         	} 



        	
        
$(document).on("click", "#tool", function(e){
	e.stopPropagation();
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
	$(this).closest(".divMarginTop").find(".centerDiv").toggleClass("showCenter");
});

$(document).on("click", "#deleteConfirm", function(){
	console.log($(this).closest(".divMarginTop").find("#deletePromoService").attr('idPromoService'));
	data = '';
	$.ajax({method : "POST",
		url : "AjaxRelated/delete-object_process.php?type=info_ta_promotion_service&pk_promotion_service=" + $(this).closest(".divMarginTop").find("#deletePromoService").attr('idPromoService'),
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
	$(this).closest(".divMarginTop").find(".centerDiv").toggleClass("showCenter");
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

	$( "#myDropdown" ).each(function( index ) {
		  if($(this).hasClass("showAbsolute")){
			$(this).removeClass("showAbsolute");
		  	$(this).closest(".divTable").find("#tool").removeClass("show");
		  }
		});
	});


function updateList(){
	$
	.ajax({
		method : "GET",
		url : "MVC/View/getObjectDynamicTable.php?type=info_service",
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




$(document).ready(function() {
	$('.btnUpdate').click(function(){
	    $('input').click();
	});


	var activePage = window.location.pathname;
	console.log(activePage);
    //var activePage = url.substring(url.lastIndexOf('/') + 1);
    
    $('.topliens .navigation2').each(function () {
        var linkPage = this.pathname;
		console.log(linkPage);
        if (activePage == linkPage) {
                                    
        	//$(this).closest("a").removeClass("navigation1");
            $(this).closest(".navigation2").addClass("navigation1");
            $(this).closest(".navigation2").removeClass("navigation2");
        }
    });

    $('.buttonConfirmer').click(function(e){
    	e.preventDefault();
		var self = $(this);
		var form = $("#formIns");
	
		var formData = new FormData();
		jQuery.each(jQuery('#fileToUp')[0].files, function(i, file) {
		    formData.append('file-'+i, file);
		});
		var titre = form.find('#titre').val();
		var desc = form.find("#desc").val();
		var dur = form.find("#dur").val();
		var tar = form.find("#tar").val();
		var act = form.find("#act").val();
		var img = formData;
		alert(titre + " " + desc  + " " + dur  + " " + tar + " " + act  + " " + img);
		
			var data = {
	       			title:titre,
	       			description:desc,
	       			duree:dur,
	       			tarif:tar,
	       			active:act,
	       			fileToUpload:img
	       			};
    		
    		$.ajax({method : "POST",
    			url : "MVC/Controller/service_controller.php",
    			data : data,
    			async: false,
		       	cache: false,
		       	contentType: false,
		       	enctype: 'multipart/form-data',
		       	processData: false,
    			beforeSend : function() {
    				// TO INSERT - loading animation
    			},
    			success : function(response) {
        			console.log(response);
        			
					//$(location).attr('href', 'service.php');
    			},
    			error : function(xhr, title, trace) {
        			console.error(title + trace);
    			}
        			
    		
			});
    	
	});

	
	
});




</script>
    </body>
    
    

</html>