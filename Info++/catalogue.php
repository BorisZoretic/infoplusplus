<?php
session_start();
if (isset($_SESSION['admin']) == false){
    header("Location: http://localhost/infoplusplus/Info++/login.php?erreur=2");
    exit();
}
include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/header.php';
?>

<title>Info++ - Catalogue</title>
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
	
		<?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
            $aService = new InfoService();
            $aService->getDynamicList();
        ?>
        <?php 
            require_once $_SERVER ["DOCUMENT_ROOT"] . '/infoplusplus/Info++/system/footer.php';
        ?>
    </body>
</html>