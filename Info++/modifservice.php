<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';

if (isset($_GET['id']) == false) {
    header("Location: http://localhost/infoplusplus/Info++/service.php");
}


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
<title>Info++ - Ajout Service</title>
</head>
<body>
	
            <?php
       
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
            echo "<label id='pk' class='none'>". $_GET['id'] ."</label>";
            ?>
	
	<div class="formcenter">
		<h4>Complétez le formulaire pour modifier un service</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<?php
		echo "<form id='formIns' class='inscription' enctype='multipart/form-data' method='post'
    action='http://localhost/infoplusplus/Info++/MVC/Controller/service_controller.php?mod=1&primary=". $_GET['id'] ."'></form>";
            ?>
	</div>
 





	<script type="text/javascript">

	//onsubmit='return validate()'
    	function validate(){
    	 	
    		var ck_num = /^[0-9]*$/;
    		var ck_empty /^$|\s+/;

		var desc = document.getElementById("desc").value;
		var titre = document.getElementById("titre").value;
    	var duree = document.getElementById("dur").value;
    	var tarif = document.getElementById("tar").value;

    	var errors = [];
    	if (!ck_empty.test(desc)) {
      	  errors[errors.length] = "Entrez une description";
      	  
      	 }
    	if (!ck_empty.test(titre)) {
        	  errors[errors.length] = "Entrez un titre";
        	  
        	 }
    	 if (!ck_num.test(duree)) {
    	  errors[errors.length] = "La durée doit être numérique.";
    	  
    	 }
    	 if (!ck_num.test(tarif)) {
       	  errors[errors.length] = "Le tarif doit être numérique.";
       	
        	 }
    	 
    	 if (errors.length > 0) {

    	  reportErrors(errors);
    	  return false;
    	 }
    	  return true;
    	}
    	
    	function reportErrors(errors){
    	 var msg = "Entrez des données valides...\n";
    	 for (var i = 0; i<errors.length; i++) {
    	 var numError = i + 1;
    	  msg += "\n" + numError + ". " + errors[i];
    	}
    	 alert(msg);
    	}
        
   
      
	</script>
      
        <?php
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
        	<script>
        	$(document).off().on("click", ".btnUpdate", function(){
        	$("#changeImage").attr("value","1");
       		 $("input").click();
       		 
       	});

			$(document).ready(function() {

				
	    
				
				var idService = $("#pk").text();
				
            	$('#formIns').load('MVC/view/getService.php?id='+idService);
            	
            	//$('#villes option[value='+ $('#selector').html() +']').prop('selected',true);
            	  
            	
            });
        	
    </script>
        
    </body>
</html>