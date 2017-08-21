<?php
include $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
    	<title>Connexion</title>
	</head>
    <body>
    <div class="headerbg">
    <img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
    <a href=""> </a>
    </div>
    
        <form class="loginbox">
    		 <label for='courriel'>Courriel</label><br><input name='courriel' class='' placeholder='Courriel'></input>
    		 <br><label for='motPasse'>Mot de passe</label><br><input name='motPasse' class='' placeholder='Mot de passe'></input>
    
    		 <button class='buttonConnexion'></button>
    	</form>

		 
  
    <?php 
        include $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
        require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
    ?>
    </body>
</html>