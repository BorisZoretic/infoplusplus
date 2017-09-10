<?php


if (isset($_GET['erreur']) && $_GET['erreur']==1) {
    $message = "Le nom d\'utilisateur ou le mot de passe est erronné.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    session_abort();
}

if (isset($_GET['erreur']) && $_GET['erreur']==2 ) {
    $message = "Vous devez vous connecter.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    session_abort();
}



include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Info++ - Connexion</title>
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

	<div class="center">
		<h4>
			Veuillez vous identifier pour avoir <br>la possibilité d'acheter des
			informations
		</h4>
		<form
			action="http://localhost/infoplusplus/Info++/MVC/Controller/login_controller.php"
			method="post" class="loginbox">
			<input name='courriel' class='inputMarginWidth'
				placeholder='Courriel'></input> <br>
			<input type="password" name='mot_de_passe' class='inputMarginWidth'
				placeholder='Mot de passe'></input> <br>
			<a class="motPasseOublie" href="">Mot de passe oublié</a> <br>
			<button class='buttonConnexion' type="submit">Connexion</button>
			<a href="inscription.php"><button class='buttonConnexion' type="button">S'inscrire</button></a>
			<br>
			<button class='loginBtn loginBtn--facebook'>Login with facebook</button>

		</form>
	</div>
	
	

		  
       
      
        <?php
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
        
        
    </body>
</html>