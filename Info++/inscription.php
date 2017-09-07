<?php
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Inscription</title>
</head>
<body>
	<div class="headerbg">
		<img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
		<div class='topliens'>
            <?php
            if (session_status() == PHP_SESSION_ACTIVE) { /* . '(' . count($_SESSION['panier']) . ')'; */
                echo "<a class='lien' href='panier.php'>Mon panier</a>
                <a class='lien' href='profile.php'>Mon profil</a>                    
                <a class='lien' href='logout.php'>Se déconnecter</a>";
            } else {
                echo "<a class='lien' href='login.php'>S'identifier</a>";
            }
            
            ?>
    	</div>
	</div>

	<div class="formcenter">
		<h4>Remplissez le formulaire pour créer votre profil</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<form class="inscription" method="post"
			action="http://localhost/infoplusplus/Info++/MVC/Controller/utilisateur_controller.php">
			<input name='nom' class='inputMarginWidth' placeholder='Nom'></input>
			<input name='prenom' class='inputMarginWidth' placeholder='Prénom'></input>
			<br> <input name='civic' class='inputMarginWidthCivic'
				placeholder='No'></input> <input name='rue'
				class='inputMarginWidthRue' placeholder='Rue'></input> <select
				name="ville" id="villes" class='inputMarginWidth'>

			</select> <br> <input name='codepostal' class='inputMarginWidth'
				placeholder='Code postale'></input> <input name='telephone'
				class='inputMarginWidth' placeholder='Numéro de téléphone'></input>

			<br> <br> <br>
			<h4>Votre courriel servira à vous identifier lors de votre prochaine
				visite</h4>
			<h5>Le mot de passe doit contenir un chiffre, une lettre et 8
				caractères au mininum</h5>
			<input name='email' id="ema" class='inputMarginWidth'
				placeholder='Adresse courriel'></input> <input name='emailconfirm'
				id="emailconf" class='inputMarginWidth'
				placeholder='Confirmez adresse courriel' onBlur="confirmEmail()"></input>
			<br> <input type='password' id="pass" name='password'
				class='inputMarginWidth' placeholder='Mot de passe'></input> <input
				type='password' name='passwordconfirm' id="passwordconf"
				class='inputMarginWidth' placeholder='Confirmer mot de passe'
				onBlur="confirmPass()"></input> <br>
			<button class='buttonConfirmer'>Confirmer</button>
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