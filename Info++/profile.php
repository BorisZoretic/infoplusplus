
<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Info++ - Profil</title>
</head>
<body>
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
?>
	</div>

	<div class="formcenter">
		<h4>Vos renseignements personnelles</h4>
		<h5>Tous les champs sont obligatoires afin d'enregistrer les modifications.</h5>
       
		
			 <?php
			 echo "<form class='inscription' id='formProfile' onsubmit='return validate()' method='post'
                        action='MVC/Controller/utilisateur_controller.php?mod=1&primary=". $_SESSION['id'] ."'>";
                
                ?>
			
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
		var ck_password = /^[\s\S]{8,32}$/;
		var ck_zip = /^[a-zA-Z][0-9][a-zA-Z]\s?[0-9][a-zA-Z][0-9]$/;
		

	var name = document.getElementById("lname").value;
	var fname = document.getElementById("fname").value;
	var rue = document.getElementById("sname").value;
	var civic = document.getElementById("streetadd").value;
	var phone = document.getElementById("phone").value;
	var zip = document.getElementById("zip").value;
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
	  errors[errors.length] = "Votre courriel est invalide ou contient des caractères interdits.";
	  
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
            	
            	$('#formProfile').load('MVC/view/getUtilisateurSelect.php');

            	var activePage = window.location.href;
            	console.log(activePage);
                //var activePage = url.substring(url.lastIndexOf('/') + 1);
                
                $('.topliens .navigation2').each(function () {
                    var linkPage = this.href;
					console.log(linkPage);
                    if (activePage == linkPage) {
                                               
                    	//$(this).closest("a").removeClass("navigation1");
                        $(this).closest(".navigation2").addClass("navigation1");
                        $(this).closest(".navigation2").removeClass("navigation2");
                    }
                });
            	
                	  
            	
            });


		</script>

</body>
</html>