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
	<label id='pk' class='none'><?php echo $_GET['pk_promotion_service']?></label>
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

    		var primary_key = self.closest("body").find("#pk");
    		var promo = form.find("#selectPromo");
    		
    		var date_debut = form.find("#date_debut");
    		var date_fin = form.find("#date_fin");

    		var code = form.find("#code");

    		if(promo.val() != "Choisissez une promotion" && date_debut.val() != '' &&  date_fin.val() != ''){
    		
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
    					$(location).attr('href', 'modifTaPromo.php?pk_promotion_service=' + primary_key.text());
        			}
        		
    			});
        	} else{
				alert('Veuillez remplir tous les champs requis');
        	}
    	});
    </script>
        
    </body>
</html>