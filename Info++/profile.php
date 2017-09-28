
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
       
		<form class="inscription" id="formProfile" method="post"
			action="http://localhost/infoplusplus/Info++/MVC/Controller/utilisateur_controller.php?mod=1">
			 <?php
        
                echo "<label name='primary' id='pk' class='none'>". $_SESSION['id'] . "</label>";
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
            	
            	//$('#villes option[value='+ $('#selector').html() +']').prop('selected',true);
            	  
            	
            });

//         	$('.buttonConfirmer').click(function(){
//         		var self = $(this);
//         		var form = self.closest("#formProfile");

//         		var pk_client = ("#pk").text();
//         		var lname = form.find("#lname");
//         		var fname = form.find("#fname");
//         		var streetadd = form.find("#streetadd");
//         		var sname = form.find("#sname");
//         		var zip = form.find("#zip");
//         		var phone = form.find("#phone");
//         		var selector = form.find("#selector");
//         		var ema = form.find("#ema");
//         		var pass = form.find("#pass");
        		
        		
//             		var data = "";
            		
//             		$.ajax({method : "POST",
//             			url : "AjaxRelated/edit-client_process.php?lname=" + lname.text() + "&fname=" + fname.text() + "&streetadd=" + streetadd.text() + "&sname=" + sname.text() + "&zip=" +  zip.text()+ "&phone=" +  phone.text()+ "&selector=" +  selector.val()+ "&ema=" +  ema.text()+ "&pass=" +  pass.text()+ "&primary_key=" +  pk_client.text(),
//             			data : data,
//             			beforeSend : function() {
//             				// TO INSERT - loading animation
//             			},
//             			success : function(response) {
//         					//$(location).attr('href', 'service.php');
//             			}
            		
//         			});
//             	} else{
//     				alert('Veuillez remplir tous les champs requis');
//             	}
//         	});

		</script>

</body>
</html>