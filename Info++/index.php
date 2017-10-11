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

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_CA/sdk.js#xfbml=1&version=v2.10&appId=1954371348221676";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function test(){
    FB.login(function(response) {
    	  if (response.status === 'connected') {
    		  //$(location).attr('href', 'catalogue.php');
    	  } else {
    	    // The person is not logged into this app or we are unable to tell. 
    	  }
    	});
}
</script>

	<div class="headerbg">
		<img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
		<div class='topliens'>
            <?php
            if (session_status() == PHP_SESSION_ACTIVE) {                
                echo "<a class='lien' href='panier.php'>Mon panier</a>  
                <a class='lien' href='profile.php'>Mon profil</a>                  
                <a class='lien' href='logout.php'>Se déconnecter</a>";
            } else {
                echo "<a class='lien' href='index.php'>S'identifier</a>";
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
			<!--  <button class='loginBtn loginBtn--facebook'>Login with facebook</button> -->

		</form>
		<div onlogin='test()' class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
	</div>
	
	

		  
       
      
        <?php
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
        
    </body>
</html>