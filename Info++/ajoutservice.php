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
<title>Info++ - Ajout Service</title>
</head>
<body>
	
            <?php
       
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
            
            ?>
	
	<div class="formcenter">
		<h4>Complétez le formulaire pour ajouter un service</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<form id="formIns" class="inscription" onsubmit="return validate()" method="post"
			action="http://localhost/infoplusplus/Info++/MVC/Controller/service_controller.php">
			<div id='uploads'><img class='imgHolder' src=''>
			<input type='file' name='fileToUpload' class='imgUpload' id='fileToUpload'>
			<input type="button" class='btnUpdate' value='Mettre à jour la photo'></div>
			<div id='formServ'>
			<input id="titre" name='title' class='inputMarginWidthService' placeholder='Titre'></input>
			<br>
			<textarea type="textarea" id="desc" name='description' class='inputMarginWidthServiceDesc' placeholder='Description'></textarea>
			<br> <input name='duree' id="dur" class='inputMarginWidthService'
				placeholder='Durée'></input> <input id="tar" name='tarif'
				class='inputMarginWidthService' placeholder='Tarif'></input>
				</div>
			<input type="submit" id="add" class='buttonConfirmer' value="Confirmer">
		</form>
	</div>






	<script type="text/javascript">
    function confirmEmail() {
        var email = document.getElementById("ema").value;
        var confemail = document.getElementById("emailconf").value;
        if(email != confemail) {
            alert('Les adresses courriels sont différentes.');
            document.getElementById("ema").value = "";
            document.getElementById("emailconf").value = "";
            document.getElementById("ema").focus(); 
        }
    }

    function confirmPass() {
        var pwd = document.getElementById("pass").value;
        var confpwd = document.getElementById("passwordconf").value;
        if(pwd != confpwd) {
            alert('Les mots de passe sont différents.');
            document.getElementById("pass").value = "";
            document.getElementById("passwordconf").value = "";
            document.getElementById("pass").focus(); 
        }
    }



    
    	
   
    	function validate(){
    	 	var ck_name = /^[a-zA-Z]+$/;
    		var ck_fname = /^[a-zA-Z]+$/;
    		var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
    		var ck_rue = /^[a-zA-Z]+$/;
    		var ck_civic = /^[0-9]*$/;
    		var ck_phone = /^\(?(?:[0-9]{3})\)?(?:[ .-]?)(?:[0-9]{3})(?:[ .-]?)(?:[0-9]{4}$)/;
    		var ck_password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!$%@#£€*?&]{8,}$/;
    		var ck_zip = /^[a-zA-Z][0-9][a-zA-Z]\s?[0-9][a-zA-Z][0-9]$/;
    		
    	var name = document.getElementById("nom").value;
    	var fname = document.getElementById("pnom").value;
    	var rue = document.getElementById("street").value;
    	var civic = document.getElementById("streetnum").value;
    	var phone = document.getElementById("phone").value;
    	var zip = document.getElementById("postal").value;
    	var email = document.getElementById("ema").value;   	
    	var password = document.getElementById("pass").value;
    	var villes = document.getElementById("villes").value;
    	var errors = [];
    	 
    	 if (!ck_name.test(name)) {
    	  errors[errors.length] = "Votre nom ne peut contenir de chiffres ou symboles autres que '-'.";
    	  
    	 }
    	 if (!ck_fname.test(fname)) {
       	  errors[errors.length] = "Votre prénom ne peut contenir de chiffres ou symboles autres que '-'.";
       	
        	 }
    	 if (!ck_rue.test(rue)) {
          	  errors[errors.length] = "La rue ne doit contenir que des lettres.";
          	
          	 }
    	 if (!ck_civic.test(civic)) {
         	  errors[errors.length] = "Le numéro civique ne doit contenir que des chiffres.";
         	
         	 }
    	 if (!ck_phone.test(phone)) {
          	  errors[errors.length] = "Le numéro de téléphone doit être de format '819-123-4567'.";
          	
          	 }
    	 if (!ck_zip.test(zip)) {
        	  errors[errors.length] = "Le code postale doit être de format 'J1E 2R4'.";
        	 
        	 }
    	 if (!ck_email.test(email)) {
    	  errors[errors.length] = "Votre courriel contient des caractères interdits.";
    	  
    	 }    	 
    	 if (!ck_password.test(password)) {
    	  errors[errors.length] = "Votre mot de passe ne respecte pas les conditions.";
    	 
    	 }
    	 if (villes==0) {
    	  errors[errors.length] = "Sélectionnez une ville.";
    	  
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
    </script>
        
    </body>
</html>