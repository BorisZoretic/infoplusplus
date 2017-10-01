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
	<label id='pk' class='none'><?php echo $_GET['pk_promotion']?></label>
    <?php
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
    ?>
	
	<div class='formcenter'>
        <h4>Ajouter la période</h4>
            
		<form id='formModifPromo' class='inscription' method='post'>
			<div class='formPeriod'>
    			<input id='date_debut' type='date' name='date_debut' placeholder='Date de début' value=''></input>
    			<input id='date_fin' type='date' name='date_fin' placeholder='Date de fin' value=''></input></br></br>
			</div>
			<div class='buttonConfirmer'><a class='btnBob btnBobAjout'>Ajouter</a></div>
		</form>
	</div>
	
	
    <?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
    ?>
	<script>
    	$('.btnUpdate').click(function(){
    	    $('input').click();
    	});

    	$('.buttonConfirmer').click(function(){
    		var self = $(this);
    		var form = self.closest("#formModifPromo");

    		var pk_promotion = self.closest("body").find("#pk");
    		
    		var date_debut = form.find("#date_debut");
    		var date_fin = form.find("#date_fin");


    		if(date_debut.val() != '' &&  date_fin.val() != '' && date_debut.val() < date_fin.val()){
    		
    			console.log("pk_promotion=" + pk_promotion.val() + "&date_debut=" + date_debut.val() + "&date_fin=" + date_fin.val());
    			data = '';
    			$.ajax({method : "POST",
    				url : "AjaxRelated/ajout-addAllPromoService_process.php?pk_promotion=" + pk_promotion.text() + "&date_debut=" + date_debut.val() + "&date_fin=" + date_fin.val(),
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
        
    </body>
</html>