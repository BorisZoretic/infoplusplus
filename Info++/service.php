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

		<form id="formIns" class="inscription" >
			<div name='imageUpload' id='uploads'>
				<img class='imgHolder' src=''> <input type='file'
					name='fileToUpload' class='imgUpload' id='fileToUp'> <input
					type="button" id='addImg' class='btnUpdate' value='Mettre à jour la photo'>
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
					<input type='checkbox' id='act' name='active' ></input><label>Activer
						dans le catalogue</label>
				</div>

			</div>
			<input type="submit" id="add" name="submit" class='buttonConfirmer2'
				value="Confirmer">
		</form>
	</div>       
        
</div>


<div class="iframe none" id="addTaPromo">
    <div class='formcenter'>
    	
        <h4>Ajouter la période et un code pour appliquer la promotion choisie</h4>
        <h5 class='h5modif'>Le code n'est pas obligatoire et ne sera pas exigé si le champ est vide</h5>
            
		<form id='formModifPromo' class='inscription' method='post'>
		<label id='fk' class='none'></label>
			<div id='uploads'>
			<div class='imgPromoModif'><span class='spanRabais'>0%</span></div>
		<select id='selectPromo' class='selectPromo'></select>
		</div>
			    
			<div class='formPromo'>
				<label class='labelPromo' for='date_debut'>Période de la promotion</label></br>
    			<input id='date_debut' type='date' name='date_debut' placeholder='Date de début' value=''></input>
    			<input id='date_fin' type='date' name='date_fin' placeholder='Date de fin' value=''></input></br></br>
    			<label class='labelPromo' for='code'>Entre un code s'il est requis pour appliquer<br>la promotion lors de la création de la facture</label></br>
    			<input id='code' name='code' value=''></input>
			</div>
			<div id='ajouterPromo' class='buttonConfirmer'><a class='btnBob btnBobAjout'>Ajouter</a></div>
		</form>
	</div>
        
</div>


<div class="iframe none" id="modifService">
    <div class='formcenter'>
    	
        <h4>Ajouter la période et un code pour appliquer la promotion choisie</h4>
        <h5 class='h5modif'>Le code n'est pas obligatoire et ne sera pas exigé si le champ est vide</h5>
        <label id='pkmod' class='none'></label>    
		<form id='formModServ' class='inscription' method='post'></form>
	</div>
        
</div>

<div class="iframe none" id="modifPromo">
       <div class='formcenter'>
       
        <h4>Ajouter la période et un code pour appliquer la promotion choisie</h4>
        <h5 class='h5modif'>Le code n'est pas obligatoire et ne sera pas exigé si le champ est vide</h5>     
        <label id='pkmodPromo' class='none'></label>  
        <form id='formModPromo' class='inscription' method='post'></form>
	</div>
</div>
  
        
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
$.webshims.formcfg = {
en: {
    dFormat: '-',
    dateSigns: '-',
    patterns: {
        d: "yy-mm-dd"
    }
}
};


</script>
        
        <script> 

        //ouverture des modales
        $(document).on("click", "#openiframe", function(e){
            e.stopPropagation;
            $('#somediv').removeClass('none');
        	});

        $(document).on("click", ".buttonPlus", function(e){
            e.stopPropagation;
            
            $('#fk').append($(this).attr('id'));
            
            $('#addTaPromo').removeClass('none');
        	});

//         $(document).on("click", ".buttonPlus", function(){
//         	$(location).attr('href', 'ajoutTaPromo.php?fk_service=' + $(this).attr('id'));
//         	});
                
       


        	
        
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

//DROPDOWN SERVICE
$(document).on("click", "#mod", function(e){
	 e.stopPropagation;
	 var pk_service = $(this).closest(".divTable").find('#pk').text();
	 $('#pkmod').append(pk_service);
	 
	 $('#formModServ').load('MVC/view/getService.php?id='+pk_service);
     $('#modifService').removeClass('none');

     
	 
	
});

//DROPDOWN PROMO
$(document).on("click", "#modPromoService", function(e){
	 e.preventDefault;
	 var pk_promotion_service = $(this).closest("#myDropdownBob").find("#modPromoService").attr('idPromoService')
	 $('#pkmodPromo').append(pk_promotion_service);
	 
	 $('#formModPromo').load('MVC/view/getPromo.php?pk_promotion_service='+pk_promotion_service);
	 
    $('#modifPromo').removeClass('none');
    

	 
	
});

$(document).on("click", "#deac", function(){
	var idService = $(this).closest(".divTable").find("#pk").text(); 
	//$(location).attr('href', 'MVC/view/getService.php?id='+idService+'&deac=1');
	data = '';
	$.ajax({method : "POST",
		url : "MVC/view/getService.php?id="+idService+"&deac=1",
		data : data,
		beforeSend : function() {
			// TO INSERT - loading animation
		},
		success : function(response) {
			updateList();
			
		}
	
	});
});



$(document).on("click", "#deletePromoService", function(){
	$(this).closest(".divMarginTop").find(".centerDiv").toggleClass("showCenter");
	$('#promo_to_delete').text($(this).closest("#myDropdownBob").find("#deletePromoService").attr('idPromoService'));
	//var pk_promo_delete = $(this).closest("#myDropdownBob").find("#deletePromoService").attr('idPromoService');
});

$(document).on("click", "#deleteConfirm", function(){
	
	console.log($(this).closest(".divMarginTop").find("#deletePromoService").attr('idPromoService'));
	data = '';
	$.ajax({method : "POST",
		url : "AjaxRelated/delete-object_process.php?type=info_ta_promotion_service&pk_promotion_service=" + $('#promo_to_delete').text(),
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


// 	$('#ImageMod').click(function(){
// 		$("#changeImage").attr("value","1");
// 	    $('input').click();
// 	});


	$("#selectPromo").load("MVC/view/getPromoSelect.php");
	
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

    //SUBMIT ADD SERVICE
    $("#formIns").submit(function(e){
    	e.preventDefault();
		var self = $(this);
		var form = $("#formIns")[0];
	
		var formData = new FormData(form);
		
    		
    		$.ajax({method : "POST",
    			url : "MVC/Controller/service_controller.php",
    			data : formData,
    			async: false,
		       	cache: false,
		       	contentType: false,
		       	
		       	processData: false,
    			beforeSend : function() {
    				// TO INSERT - loading animation
    			},
    			success : function(response) {
        			console.log(response);
        			$('#somediv').addClass('none');
        			updateList();
    			},
    			error : function(xhr, title, trace) {
        			console.error(title + trace);
    			}
        			
    		
			});
    	
	});

	
    	
    $('#addImg').bind('click', function(e){
        
        $('#fileToUp').click();
    });

    $(document).on("click",'#ImageMod', function(e){
    	$("#changeImage").attr("value","1");
        $('#fileToUp2').click();
    });

	$('#fileToUp2').on('click', function(e){
        e.stopPropagation();
        
    });
  


//SUBMIT MOD PROMO
	$("#formModPromo").submit(function(e){
		e.preventDefault();
		
		var self = $(this);
		var form = self.closest("#formModPromo");
		
		var primary_key = self.closest("body").find("#pkmodPromo");
		var promo = form.find("#selectPromo");
		
		var date_debut = form.find("#date_debut");
		var date_fin = form.find("#date_fin");

		var code = form.find("#code");

		if(promo.val() != "Choisissez une promotion" && date_debut.val() != '' &&  date_fin.val() != '' && date_debut.val() < date_fin.val()){
		
    		var data = "";
    		var lol = "promo=" + promo.val() + "&date_debut=" + date_debut.val() + "&date_fin=" + date_fin.val() + "&code=" + code.val() + "&primary_key=" + primary_key.text();
        	console.log(lol);
    		$.ajax({method : "POST",
    			url : "AjaxRelated/edit-object_process.php?promo=" + promo.val() + "&date_debut=" + date_debut.val() + "&date_fin=" + date_fin.val() + "&code=" + code.val() + "&primary_key=" +  primary_key.text(),
    			data : data,
    			beforeSend : function() {
    				// TO INSERT - loading animation
    			},
    			success : function(response) {
    				$('#pkmodPromo').text("");
    				$('#modifPromo').addClass('none');    
					updateList();
    			}
    		
			});
    	} else{
			alert('Veuillez remplir tous les champs requis adéquatemment');
    	}
	});

	$('#selectPromo').change(function(){
		
		var self = $(this);

		var newValue = $(this).val();
		
		var span = self.closest("#formModifPromo").find(".spanRabais");

		var data = '';
		$.ajax({method : "POST",
			url : "MVC/view/getRabais.php?id=" + newValue,
			data : data,
			beforeSend : function() {
				// TO INSERT - loading animation
			},
			success : function(response) {
				span.html(response + "%");
			}
		
		});
		
	});

	 $(document).on('change','#selectPromo',function(){
		
		var self = $(this);

		var newValue = $(this).val();
		
		var span = self.closest("#formModPromo").find(".spanRabais");

		var data = '';
		$.ajax({method : "POST",
			url : "MVC/view/getRabais.php?id=" + newValue,
			data : data,
			beforeSend : function() {
				// TO INSERT - loading animation
			},
			success : function(response) {
				span.html(response + "%");
			}
		
		});
		
	});

	//SUBMIT MODIF SERVICE
	$("#formModServ").submit(function(e){
		e.preventDefault();
		
		var self = $(this);
		var form = $("#formModServ")[0];
	
		var formData = new FormData(form);
		var pk_service = self.closest(".formcenter").find("#pkmod").text();
		

    		
    		$.ajax({method : "POST",
    			url : "MVC/Controller/service_controller.php?mod=1&primary="+pk_service,
    			data : formData,
    			async: false,
		       	cache: false,
		       	contentType: false,
		       	
		       	processData: false,
    			beforeSend : function() {
    				// TO INSERT - loading animation
    			},
    			success : function(response) {
        			console.log(response);
        			$('#pkmod').text("");
        			$('#modifService').addClass('none');
        			updateList();
    			},
    			error : function(xhr, title, trace) {
        			console.error(title + trace);
    			}
        			
    		
			});
	});

	

	//SUBMIT ADD PROMO
	$('#ajouterPromo').click(function(){
		
		var self = $(this);
		var form = self.closest("#formModifPromo");

		var fk_service = self.closest("#formModifPromo").find("#fk");
		var promo = form.find("#selectPromo");
		
		var date_debut = form.find("#date_debut");
		var date_fin = form.find("#date_fin");

		var code = form.find("#code");
		
		if(promo.val() != "Choisissez une promotion" && date_debut.val() != '' &&  date_fin.val() != '' && date_debut.val() < date_fin.val()){
		
    		var data = "";
    		/*var lol = "promo=" + promo.val() + "&date_debut=" + date_debut.val() + "&date_fin=" + date_fin.val() + "&code=" + code.val() + "&primary_key=" + primary_key.text();
        	console.log(lol);*/
    		$.ajax({method : "POST",
    			url : "AjaxRelated/ajout-object_process.php?promo=" + promo.val() + "&date_debut=" + date_debut.val() + "&date_fin=" + date_fin.val() + "&code=" + code.val() + "&fk_service=" +  fk_service.text(),
    			data : data,
    			beforeSend : function() {
    				// TO INSERT - loading animation
    			},
    			success : function(response) {
        			console.log(response);
        			$('#addTaPromo').addClass('none');
					updateList();
    			}
    		
			});
    	} else{
			alert('Veuillez remplir tous les champs requis adéquatemment');
    	}
	});



	$(function() {
	     $( "#date_fin" ).datepicker({ dateFormat: 'yy-mm-dd'}); 
	});
	$(function() {
	     $( "#date_debut" ).datepicker({ dateFormat: 'yy-mm-dd'}); 
	});

	
	
});

</script>



</script>
    </body>
    
    

</html>