
<?php
session_start();
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
                <a class='lien' href='logout.php'>Se dÃ©connecter</a>";
            } else {
                echo "<a class='lien' href='login.php'>S'identifier</a>";
                header("Location: http://localhost/infoplusplus/Info++/login.php");
                exit();
            }
            
            ?>
    	</div>
	</div>

	<div class="formcenter">
		<h4>Remplissez le formulaire pour crÃ©er votre profil</h4>
		<h5>Tous les champs sont obligatoires</h5>

		<form class="inscription" id="formProfile" method="post"
			action="http://localhost/infoplusplus/Info++/MVC/Controller/utilisateur_controller.php"></form>
	</div>





	<script type="text/javascript">
    function confirmEmail() {
        var email = document.getElementById("ema").value;
        var confemail = document.getElementById("emailconf").value;
        if(email != confemail) {
            alert('Les adresses courriels sont diffÃ©rentes.');
            document.getElementById("ema").value = "";
            document.getElementById("emailconf").value = "";
            document.getElementById("ema").focus(); 
        }
    }

    function confirmPass() {
        var pwd = document.getElementById("pass").value;
        var confpwd = document.getElementById("passwordconf").value;
        if(pwd != confpwd) {
            alert('Les mots de passe sont diffÃ©rents.');
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
            	
        		$('#villes').val($('#selector').html()).change();
            	  
            	
            });

		</script>

</body>
</html>