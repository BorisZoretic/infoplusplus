<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';

if (isset($_GET['duplicate']) && $_GET['duplicate']==1 ) {
    $message = "L\'adresse courriel est déjà utilisé par un autre utilisateur.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    session_abort();
}
?>
<title>Info++ - Inscription</title>
</head>
<body>
	<div class="headerbg">
		<img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
		<div class='topliens'>
            <?php
       
                echo "<a class='lien' href='index.php'>S'identifier</a>";
            
            ?>
    	</div>
	</div>

	<div class="formcenter">
		<h4>Remplissez le formulaire pour créer votre profil</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<form id="formIns" class="inscription" onsubmit="return validate()" method="post"
			action="http://localhost/infoplusplus/Info++/MVC/Controller/utilisateur_controller.php">
			<input id="nom" name='nom' class='inputMarginWidth' placeholder='Nom' required="required"></input>
			<input id="pnom" name='prenom' class='inputMarginWidth' placeholder='Prénom' required="required"></input>
			<br> <input name='civic' id="streetnum" class='inputMarginWidthCivic'
				placeholder='No' required="required"></input> <input id="street" name='rue'
				class='inputMarginWidthRue' placeholder='Rue' required="required"></input> <select
				name="ville" id="villes" class='inputMarginWidth' required="required">

			</select> <br> <input name='codepostal' id='postal' class='inputMarginWidth'
				placeholder='Code postale' required="required"></input> <input name='telephone' id='phone'
				class='inputMarginWidth' placeholder='Numéro de téléphone' required="required"></input>

			<br> <br> <br>
			<h4>Votre courriel servira à vous identifier lors de votre prochaine
				visite</h4>
			<h5>Le mot de passe doit contenir un chiffre, une lettre et 8
				caractères au mininum</h5>
			<input name='email' id="ema" class='inputMarginWidth'
				placeholder='Adresse courriel' required="required"> </input> <input name='emailconfirm'
				id="emailconf" class='inputMarginWidth'
				placeholder='Confirmez adresse courriel' required="required"></input>
			<br> <input type='password' id="pass" name='password'
				class='inputMarginWidth' placeholder='Mot de passe' required="required"></input> <input
				type='password' name='passwordconfirm' id="passwordconf"
				class='inputMarginWidth' placeholder='Confirmer mot de passe'
				 required="required"></input> <br> <div class='inputMarginWidthService3' ><input type='checkbox' name='infolettre'></input><label>Recevoir l'infolettre</label></div>
                
                      
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
            return false;
        }
        return true;
    }

    function confirmPass() {
        var pwd = document.getElementById("pass").value;
        var confpwd = document.getElementById("passwordconf").value;
        if(pwd != confpwd) {
            alert('Les mots de passe sont différents.');
            document.getElementById("pass").value = "";
            document.getElementById("passwordconf").value = "";
            document.getElementById("pass").focus(); 
            return false;
        }
        return true;
    }



    
    	
   
    	function validate(){
    		  if (confirmEmail() !=true || confirmPass() !=true){
    				return false;
    	        }
    	            
    		var ck_name = /^[A-zÀ-ÿ ]+$/; 
    		var ck_fname = /^[A-zÀ-ÿ ]+$/;
    		var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
    		var ck_rue = /^[A-zÀ-ÿ ]+$/;
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
        $(document).ready(function() {
        	$("#villes").load("MVC/view/getVilleSelect.php");
        });
    </script>
        
    </body>
</html>