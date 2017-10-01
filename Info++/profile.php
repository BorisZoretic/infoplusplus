
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
			 echo "<form class='inscription' id='formProfile' method='post'
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

            	var activePage = window.location.href;
            	console.log(activePage);
                //var activePage = url.substring(url.lastIndexOf('/') + 1);
                
                $('.topliens .navigation2').each(function () {
                    var linkPage = this.href;
					console.log(linkPage);
                    if (activePage == linkPage) {
                        console.log("tbk");                        
                    	//$(this).closest("a").removeClass("navigation1");
                        $(this).closest(".navigation2").addClass("navigation1");
                        $(this).closest(".navigation2").removeClass("navigation2");
                    }
                });
            	
                	  
            	
            });


		</script>

</body>
</html>