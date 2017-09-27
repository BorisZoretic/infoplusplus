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
	<label id='fk' class='none'><?php echo $_GET['fk_service']?></label>
    <?php
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
    ?>
	
	<div class='formcenter'>
        <h4>Ajouter la période et un code pour appliquer la promotion choisie</h4>
        <h5 class='h5modif'>Le code n'est pas obligatoire et ne sera pas exigé si le champ est vide</h5>
            
		<form id='formModifPromo' class='inscription' method='post'>
			<div id='uploads'>
			<img class='imgPromoModif' src='images/promotions/10.png' title='imgPromo10' alt='imgPromo10'>
		<select id='selectPromo' class='selectPromo'></select>
		</div>
			    
			<div class='formPromo'>
				<label class='labelPromo' for='date_debut'>Période de la promotion</label></br>
    			<input id='date_debut' type='date' name='date_debut' placeholder='Date de début' value=''></input>
    			<input id='date_fin' type='date' name='date_fin' placeholder='Date de fin' value=''></input></br></br>
    			<label class='labelPromo' for='code'>Entre un code s'il est requis pour appliquer<br>la promotion lors de la création de la facture</label></br>
    			<input id='code' name='code' value=''></input>
			</div>
			<a class='buttonConfirmer'>Ajouter</a>
		</form>
	</div>
	
	
    <?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
    ?>
	<script>
        $(document).ready(function() {
        	$("#selectPromo").load("MVC/view/getPromoSelect.php");
        	
        });
    	$('.btnUpdate').click(function(){
    	    $('input').click();
    	});

    	$('#selectPromo').change(function(){
    		/*var self = $(this);

    		var newValue = $(this).val();
    		
			var image = self.closest("#formModifPromo").find(".imgPromoModif");

			if(newValue == 0.10){
				image.attr('src', 'images/promotions/10.png');
            }else if(newValue == 0.15){
            	image.attr('src', 'images/promotions/15.png');
            }else if(newValue == 0.20){
            	image.attr('src', 'images/promotions/20.png');
            }else if(newValue == 0.25){
            	image.attr('src', 'images/promotions/25.png');
            }*/

			//alert(newValue);
    		
    	});

    	$('.buttonConfirmer').click(function(){
    		var self = $(this);
    		var form = self.closest("#formModifPromo");

    		var fk_service = self.closest("body").find("#fk");
    		var promo = form.find("#selectPromo");
    		
    		var date_debut = form.find("#date_debut");
    		var date_fin = form.find("#date_fin");

    		var code = form.find("#code");

    		if(promo.val() != "Choisissez une promotion" && date_debut.val() != '' &&  date_fin.val() != ''){
    		
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
    					//$(location).attr('href', 'service.php');
        			}
        		
    			});
        	} else{
				alert('Veuillez remplir tous les champs requis');
        	}
    	});
    </script>
        
    </body>
</html>