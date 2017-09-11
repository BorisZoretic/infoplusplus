<?php
session_start();
if (isset($_SESSION['admin']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Info++ - Facture</title>
</head>
    <body>
        <?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
        ?>
    	
    	<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_facture.php';
            $aFacture = new InfoFacture();
            $aFacture->getDynamicBillList();
        ?>
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
    <script>

    $(document).on("click",".accordion",function(){
    	
    		var div = $(this).closest(".divTable").find(".panel");
    		console.log(div);
            /* Toggle between hiding and showing the active panel */
            if (div.css("display") === "block") {
            	div.slideUp();
            } else {
            	div.slideDown();
            }
    
        });
        
    </script>
</html>