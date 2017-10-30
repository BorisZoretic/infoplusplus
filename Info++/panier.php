<?php
session_start();
if (isset($_SESSION['id']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>

<title>Info++ - Panier</title>
</head>
<body>
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
?>
	
		<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_panier.php';
            $aPanier = new InfoPanier();
            $aPanier->getDynamicList();
        ?>
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
    
    <script>
    $(document).on("click", "#clickRetirer", function(e){
        var pk = $(this).attr("idObj");
        var div = $("#content");
        
		data = "pk_service=" + pk;
		
    	$.ajax({method : "POST",
			url : "MVC/view/removeFromArraySession.php",
			data : data,
			beforeSend : function() {
				// TO INSERT - loading animation
			},
			success : function(response) {
				div.html(response);
				var count = div.find("#count");
				$("a#panierAJAX").html("Mon panier ( " + count.text() + " )");
			}
		
		});
    });
    </script>
    
</html>