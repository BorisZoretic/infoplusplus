
<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Info++ - Profil</title>
</head>
<body>
	<div class="headerbg">
		<img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
		<div class='topliens'>
            <?php
            if(!isset($_SESSION['admin'])) {
                header("Location: http://localhost/infoplusplus/Info++/login.php?erreur=2");
                exit();
            }
            if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['admin']==0) {/*. '(' . count($_SESSION['panier']) . ')';*/
                echo "<a class='lien' href='panier.php'>Mon panier</a>                              
                <a class='lien' href='logout.php'>Se déconnecter</a> <br>
                <a class='navigation1' href='catalogue.php'>Catalogue</a><a class='navigation2' href='profile.php'>Profil</a>
                <input type='text' class='searchTerm' placeholder='Recherche'>
                <button type='submit' class='searchButton'><label>S</label></button></div>";
            } 
            else if(session_status() == PHP_SESSION_ACTIVE && $_SESSION['admin']==1)
            {
                echo "<a class='lien' href='logout.php'>Se déconnecter</a><br>
                <a class='navigation1' href='service.php'>Service</a>
                <a class='navigation2' href='404.php'>Facture</a>               
                <input type='text' class='searchTerm' placeholder='Recherche'>
                <button type='submit' class='searchButton'><label>S</label></button></div>";
            }

            ?>
    	</div>    	
	</div>
	</div>

	<div class="formcenter">
		<h4>Vos renseignements personnelles</h4>
		<h5>Tous les champs sont obligatoires afin d'enregistrer les modifications.</h5>

		<form class="inscription" id="formProfile" method=""
			action=""></form>
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
            	
            	$('#formProfile').load('MVC/view/getUtilisateurSelect.php');
            	
            	//$('#villes option[value='+ $('#selector').html() +']').prop('selected',true);
            	  
            	
            });

		</script>

</body>
</html>