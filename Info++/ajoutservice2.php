<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';


if (isset($_GET['duplicate']) && $_GET['duplicate'] == 1) {
    $message = "Le nom de service est déjà utilisé";
    echo "<script type='text/javascript'>alert('$message');</script>";
    session_abort();
}

if (isset($_SESSION['admin']) == false) {
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
?>
<title>Info++ - Ajout Service</title>
</head>
<body>
	
        
	
	<div class="formcenter">
		<h4>Complétez le formulaire pour ajouter un service</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<form id="formIns" class="inscription" onsubmit="return validate()"
			enctype="multipart/form-data" method="post"
			action="http://localhost/infoplusplus/Info++/MVC/Controller/service_controller.php">
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






	<script type="text/javascript">

   
    	function validate(){
    	 	
    		var ck_num = /^[0-9]*$/;
    		
    		
    	var duree = document.getElementById("dur").value;
    	var tarif = document.getElementById("tar").value;

    	var errors = [];
    	 
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

        
        		
        	$('.btnUpdate').click(function(){
        	    $('input').click();
        	});

//         	$('#fileToUp').change( function(event) {
//         		var tmppath = URL.createObjectURL(event.target.files[0]);
//         		    $(".imgHolder").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));        		    
        		  
//         		});

?>
<title>Info++ - Ajout Service</title>
</head>
<body>
	
            
	
	<div class="formcenter">
		<h4>Complétez le formulaire pour ajouter un service</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<form id="formIns" class="inscription" onsubmit="return validate()"
			enctype="multipart/form-data" method="post"
			action="http://localhost/infoplusplus/Info++/MVC/Controller/service_controller.php">
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






	<script type="text/javascript">

   
    	function validate(){
    	 	
    		var ck_num = /^[0-9]*$/;
    		
    		
    	var duree = document.getElementById("dur").value;
    	var tarif = document.getElementById("tar").value;

    	var errors = [];
    	 
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
        	$('.btnUpdate').click(function(){
        	    $('input').click();
        	});

        	
        	

        	$('.buttonConfirmer').click(function(e){
            	e.preventDefault();
        		var self = $(this);
        		var form = $("#formIns");

        		var titre = form.find('#titre').text();
        		var desc = form.find("#desc").text();
        		var dur = form.find("#dur").val();
        		var tar = form.find("#tar").val();
        		var act = form.find("#act").val();
        		//var img = files;
        		
        		
       			var data = {
       	       			titre:titre,
       	       			desc:desc,
       	       			dur:dur,
       	       			tar:tar,
       	       			act:act
       	       			
       	       			};
            		
            		$.ajax({method : "POST",
            			url : "MVC/Controller/service_controller.php",
            			data : data,
            			beforeSend : function() {
            				// TO INSERT - loading animation
            			},
            			success : function(response) {
        					$(location).attr('href', 'service.php');
            			}
            		
        			});
            	
        	});


    		</script>

</body>
</html>