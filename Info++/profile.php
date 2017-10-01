
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

            	var url = window.location.href;
                var activePage = url;
                $('.nav a').each(function () {
                    var linkPage = this.href;

                    if (activePage == linkPage) {
                    	$(this).closest("a").removeClass("navigation1");
                        $(this).closest("a").addClass("navigation2");
                    }
                });
            	
            	//$('#villes option[value='+ $('#selector').html() +']').prop('selected',true);
//             	$('.buttonConfirmer').click(function(){
//             		var self = $(this);
//             		var form = self.closest("#formProfile");

//             		var pk_client = ("#pk").text();
//             		var lname = form.find("#lname");
//             		var fname = form.find("#fname");
//             		var streetadd = form.find("#streetadd");
//             		var sname = form.find("#sname");
//             		var zip = form.find("#zip");
//             		var phone = form.find("#phone");
//             		var selector = form.find("#selector");
//             		var ema = form.find("#ema");
//             		var pass = form.find("#pass");
            		
            		
            		
//                 		var data = "";
                		
//                 		$.ajax({method : "POST",
//                 			url : "MVC/Controller/utilisateur_controller.php?nom=" + lname.text() + "&prenom=" + fname.text() + "&civic=" + streetadd.text() + "&rue=" + sname.text() + "&codepostal=" +  zip.text()+ "&telephone=" +  phone.text()+ "&ville=" +  selector.val()+ "&email=" +  ema.text()+ "&password=" +  pass.text()+ "&primary=" +  pk_client.text(),
//                 			data : data,
//                 			beforeSend : function() {
//                 				// TO INSERT - loading animation
//                 			},
//                 			success : function(response) {
            					
//                 			}
                		
//             			});
                	 
//             	});
                	  
            	
            });


		</script>

</body>
</html>