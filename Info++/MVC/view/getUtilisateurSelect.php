
<?php
$anObject = null;
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_client.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ville.php';

$InfoVilles = new InfoVille();
$client = new InfoClient();

$anObject = $client->getInscription(4);


?>
    <script
    	src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'>
    </script>
    <script>

        
        $(document).ready(function() {
        	
            //$('#villes').load('MVC/view/getVilleSelect.php');
            
            
        });
            
            
    </script>
