<?php
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>
<title>Connexion</title>
</head>
<body>
	<div class="headerbg">
		<img class="logo" src="images/icones/logo.png" title="logo" alt="logo">
		<div class='topliens'>
            <?php
            if (session_status() == PHP_SESSION_ACTIVE) {/*. '(' . count($_SESSION['panier']) . ')';*/
                echo "<a class='lien' href='panier.php'>Mon panier</a>              
                <a class='lien' href='logout.php'>Se déconnecter</a>";
            } else {        
                echo "<a class='lien' href='login.php'>S'identifier</a>";
            }
            ?>
    	</div>    	
	</div>
	
		<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicList();
        ?>
        <!-- <div class="border">
        	<img class="excel" src="images/services/coursexcel.png" title="excel" alt="excel">
           	<h4>Excel débutant</h4><br>
           	<p class="textExcel">Ce cours a pour objectif de vous initier au chiffrier <br>Excel, pour vous permettre de créer des classeurs <br>et de les mettre en forme professionnellement.</p>
           	<br><p class="tarifExcel">Tarif : 200$</p><p class="dureeExcel">Durée : 20h</p><img class="panier" src="images/icones/panier.png" title="panier" alt="panier">
    	</div>
    	
    	<div class="border">
    		<img class="excel" src="images/services/coursexcel.png" title="excel" alt="excel">
           	<h4>Excel intermédiaire</h4>
    	</div>-->
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
</html>