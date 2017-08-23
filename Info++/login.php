<?php
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Connexion</title>
</head>
<body>
	<div class="headerbg">
		<img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
		<div class='topliens'>
            <?php
            if (session_status() == PHP_SESSION_ACTIVE) {/*. '(' . count($_SESSION['panier']) . ')';*/
                echo "<a class='lien' href='panier.php'>Mon panier</a>              
                <a class='lien' href='logout.php'>Se déconnecter</a>";
            } else {        
                echo "<a class='lien' href='login.php'>S'identifier</a>";
            }
            ?>
    	</div>    	
	</div>
	
	        <div class="center">
           	<h4>Veuillez vous identifier pour avoir <br>la possibilité d'acheter des informations</h4>
            <form class="loginbox">
        		 <input name='courriel' class='inputMarginWidth' placeholder='Courriel'></input>
        		 <br><input name='motPasse' class='inputMarginWidth' placeholder='Mot de passe'></input>
        		 <br><a class="motPasseOublie" href="">Mot de passe oublié</a>
        		 <br><button class='buttonConnexion'>Connexion</button><button class='buttonConnexion'>S'inscrire</button>
        		 <br><button class='loginBtn loginBtn--facebook'>Login with facebook</button>

        		 <br><button class='loginBtn loginBtn--facebook'>YOLO</button>

        		 <br><button class='loginBtn loginBtn--facebook'>test</button>

        	</form>
    	</div>
		  
       
      
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
</html>