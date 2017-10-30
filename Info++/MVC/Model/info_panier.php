<?php
if(!isset($_SESSION)){session_start();}
class InfoPanier {
	
	function __construct() {
	}
	
    function getDynamicList(){
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
        
        $aService = new InfoService();
        $aListOfObjects = $aService->getListOfActiveBDObjects();
        $sousTotal = 0;
        $allRabais = 0;
        $total = 0;
        $compt = 1;
        if ($aListOfObjects != null) {
            echo "<div id='content'>";
            echo "<label class='none' id='count'>".count($_SESSION['panier']) ."</label>";
            foreach($_SESSION['panier'] as $id) {
                foreach ( $aListOfObjects as $anObject ) {
                    if($id == $anObject['pk_service']){
                        echo "<div class='border divTable'>";
                        echo "<img class='excel' src='" . $anObject['image'] . "' title='" . $anObject['image'] . "' alt='" . $anObject['image'] . "'>";
                        echo "<span class='servicePanier'><h4>". $anObject['service_titre'] ."</h4></span>";
                        echo "<span class='tarifPanier'>Tarif: " . $anObject['tarif'] . "$</span><br><br>";
                        
                        $allPromo = $this->getListOfAllDBObjectsWhere("fk_service", "=", $anObject['pk_service']);
                        
                        if($allPromo != null){
                            foreach($allPromo as $aPromo){
                                $rabais = $aPromo['rabais'] * 100;
                                $totalRabais = $aPromo['rabais'] * $anObject['tarif'];
                                echo "<br><span class='rabaisPanier'>".$aPromo['promotion_titre']. " (" . $rabais . "%)</span><span class='montantRabaisPanier'>- ".number_format((float)$totalRabais, 2, '.', '')."$</span>";
                                $allRabais += $totalRabais;
                            }
                            echo "<br>";
                        }
                        echo "<span class='retirerPanier '><a idObj='". $anObject['pk_service'] ."' id='clickRetirer'>Retirer</a></span>";
                        echo "</div>";
                        $sousTotal+=$anObject['tarif'];
                        
                        if(sizeof($_SESSION['panier']) <= $compt){
                            $sousTotal -= $allRabais;
                            echo "<div class='divTotal divTable'>";
                            //echo "<div class='divRabaisAditionnel divTable'></div>";
                            echo "<span class='sousTotal'>sous-total: ".number_format((float)$sousTotal, 2, '.', '')."$</span><br>";
                            echo "<span class='rabaisAdditionnel'>rabais aditionnel: ".number_format((float)0, 2, '.', '')."$</span><br><br>";
                            echo "<div class='divTotal divTable'><span class='borderTotal'></span></div>";
                            
                            echo "<span class='total'>Total: ".number_format((float)$total, 2, '.', '')."$</span>";
                            echo "<div class='divTotal divTable'><span class='borderTotal'></span></div>";
                            echo "</div>";
                        }
                        $compt++;
                    }
                }
            }
            echo "</div>";
        }
    }
    
    public function getListOfAllDBObjectsWhere($argument,$operation, $value) {
        include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
        
        $internalAttributes = get_object_vars ( $this);
        
        $sql = "SELECT * FROM ta_promotion_service tps
                JOIN promotion p ON p.pk_promotion = tps.fk_promotion WHERE ".$argument. " ".$operation." ".$value." ";
            
        
        
        
        $result = $conn->query ( $sql );
        
        if ($result->num_rows > 0) {
            $localObjects = array ();
            while ( $row = $result->fetch_assoc () ) {
                $anObject = Array ();
                $anObject ["primary_key"] = "pk_promotion_service";
                $anObject ["table_name"] = "ta_promotion_service";
                foreach ( $row as $aRowName => $aValue ) {
                    $anObject [$aRowName] = $aValue;
                }
                
                $localObjects [$row ["pk_promotion_service"]] = $anObject;
            }
            
            $conn->close ();
            return $localObjects;
        }
        $conn->close ();
        return null;
    }
    
}

?>