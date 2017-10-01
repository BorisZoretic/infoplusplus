<?php
session_start();
if (isset($_SESSION['admin']) == false){
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>

<title>Info++ - Catalogue</title>
</head>
<body>
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/view/navigateur.php';
?>
	
		<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicList();
        ?>
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
    
     <script> 

            $(document).ready(function() {
            	
            

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
    
</html>