<?php
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Service</title>
</head>
<body>
	<div class="headerbg">
		<img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
		<div class='topliens'>
            <?php
            if (session_status() == PHP_SESSION_ACTIVE) {/*. '(' . count($_SESSION['panier']) . ')';*/
                echo "<a class='lien' href='panier.php'>Mon panier</a>              
                <a class='lien' href='logout.php'>Se d�connecter</a>";
            } else {        
                echo "<a class='lien' href='login.php'>S'identifier</a>";
            }
            ?>
    	</div>    	
	</div>
	
		<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicAdminList();
        ?>
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
</html>