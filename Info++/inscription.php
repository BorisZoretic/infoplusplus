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

		<form class="inscription">
			<input name='nom' class='inputMarginWidth' placeholder='Nom'></input>
			<input name='prenom' class='inputMarginWidth' placeholder='Prénom'></input>
			<br>
			<input name='civic' class='inputMarginWidthCivic'
				placeholder='No civic'></input> <input name='rue'
				class='inputMarginWidthRue' placeholder='Rue'></input> <select
				class='inputMarginWidth'>
				<option value="Sherbrooke">Sherbrooke</option>
				<option value="Montréal">Montréal</option>
				<option value="Trois-Rivières">Trois-Rivières</option>
				<option value="Chicoutimi">Chicoutimi</option>
			</select> <br>
			<input name='codepostal' class='inputMarginWidth'
				placeholder='Code postale'></input> <input name='telephone'
				class='inputMarginWidth' placeholder='Numéro de téléphone'></input>

			<br>
			<br>
			<br>
			<h4>Votre courriel servira à vous identifier lors de votre prochaine
				visite</h4>
			<h5>Le mot de passe doit contenir un chiffre, une lettre et 8
				caractères au mininum</h5>
			<input name='email' class='inputMarginWidth'
				placeholder='Adresse courriel'></input> <input name='emailconfirm'
				class='inputMarginWidth' placeholder='Confirmez adresse courriel'></input>
			<br>
			<input type='password' name='password' class='inputMarginWidth'
				placeholder='Mot de passe'></input> <input type='password'
				name='passwordconfirm' class='inputMarginWidth'
				placeholder='Confirmer mot de passe'></input> <br>
			<button class='buttonConfirmer'>Confirmer</button>
		</form>
	</div>
		  
       
      
        <?php
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
</html>