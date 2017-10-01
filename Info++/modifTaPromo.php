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

    	$('.buttonConfirmer').click(function(){
    		var self = $(this);
    		var form = self.closest("#formModifPromo");

    		var primary_key = self.closest("body").find("#pk");
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
    					$(location).attr('href', 'service.php');
        			}
        		
    			});
        	} else{
				alert('Veuillez remplir tous les champs requis adéquatemment');
        	}
    	});
    </script>
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
    </body>
</html>