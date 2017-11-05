<?php
require_once'info_model.php';

class Infota_facture_service extends InfoModel {
	protected $table_name = 'ta_facture_service';
	protected $primary_key = "pk_ta_facture_service";
	
	protected $pk_facture_service = 0;
	protected $fk_facture = 0;
	protected $fk_service = '';
	protected $tarif_facture = 0;
	protected $montant_rabais = '';
	
	function __construct() {
	}
	
	
	
	function getDynamicBillList(){
	    require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_client.php';
	
	    $aClient = new InfoClient();
	    $nameClient = '';
	    
	    $format = 'Y-m-d H:i:s';
	    
        $aListOfObjects = $this->getListOfActiveBDObjects();
        
        
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                $infoClient = array();
                $infoClient = $aClient->getAdresseAndClient($anObject['fk_facture']);
                
                $date = DateTime::createFromFormat($format, $anObject['fk_service']);
                
                echo "<div class='borderta_facture_service divTable'>";
                echo "<h4 class='idta_facture_service'>" . $anObject['pk_ta_facture_service'] . "</h4><h5 class='dateta_facture_service'>" . $date->format('Y/m/d') . "</h5>";
                echo "<h4 class='nameta_facture_service'>" . $infoClient['prenom'] . " " . $infoClient['nom'] . "</h4>";
                echo "<div class='none' id='infoClient'><span class='spanNomta_facture_service'>" . $infoClient['prenom'] . " " . $infoClient['nom'] . "</span><span class='spanTelta_facture_service'>" . $infoClient['telephone'] ."</span><br><br><span class='spanAdresseta_facture_service'>" . $infoClient['no_civique'] . " " . $infoClient['rue'] . ", " . $infoClient['ville'] . ", " . $infoClient['code_postal'] . "</span></div>";
                echo "<h5 class='confirmationta_facture_service'>" . strtoupper ($anObject['montant_rabais']) . "</h5><h5 class='tarifta_facture_service'>" . $this->getTarif($anObject['pk_ta_facture_service']) . "$</h5>";
                echo "<div class='panel'>";
                $this->displayta_facture_serviceContent($anObject['pk_ta_facture_service']);
                echo "</div>";
                echo "<a class='detailta_facture_service accordion'>Détail</a>";
                echo "</div>";
            }
        }
    }
    
    function getTarif($pk_ta_facture_service){
        include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
        
        $sql = "SELECT SUM(tfs.tarif_ta_facture_service)
        FROM ta_ta_facture_service_service tfs
        JOIN ta_facture_service f ON f.pk_ta_facture_service = tfs.fk_ta_facture_service
        WHERE f.pk_ta_facture_service = '" . $pk_ta_facture_service . "'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $aRowName => $aValue) {
                    return $aValue;
                }
            }
            
            $conn->close();
        }
        $conn->close();
        return 0;
        
    }
    
    function displayta_facture_serviceContent($pk_ta_facture_service){
        include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
        
        $sql = "SELECT s.service_titre, s.tarif, tfs.montant_rabais, tfs.fk_service
                FROM ta_ta_facture_service_service tfs
                JOIN service s ON s.pk_service = tfs.fk_service
                WHERE tfs.fk_ta_facture_service = " . $pk_ta_facture_service;
        
        $result = $conn->query($sql);
        
        $compt = 1;
        if ($result->num_rows > 0) {
            $toDiplay = array();
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $aRowName => $aValue) {
                    $tarif = '';
                    $rabais = '';
                    if($aRowName == "montant_rabais"){
                        echo "<br class='br2'>";
                    } else if($aRowName == "fk_service" && $row['montant_rabais'] != "0.00"){
                        $this->displayPromotion($aValue);
                    } else if ($aRowName == "fk_service" && $row['montant_rabais'] == "0.00"){
                    	//do nothing
                    }
                    
                    if ($aRowName == "service_titre" && $compt == 1){
                        echo "<br class= 'br'>";
                        $compt++;
                    } else if ($aRowName == "service_titre" && $compt != 1){
                        echo "<br class= 'br3'>";
                    }
                    
                    if ($aRowName != "fk_service"){
                        echo "<span class='";
                        if($aRowName == "tarif"){
                            echo "tarifDisplay";
                            $tarif = '$';
                        } else if($aRowName == "montant_rabais"){
                            echo "rabaisDisplay";
                            if($aValue == "0.00"){
                                echo " none";
                            }
                            $rabais = "-";
                            $tarif = '$';
                        }else{
                            echo "titreDisplay";
                        }
                        echo "'>" . $rabais . $aValue . $tarif . "</span>";
                    }
                }
                //echo "<br class='br2'>";
            }
            
            //echo "<span class='titreDisplay'>" . $toDiplay['service_titre'] . "</span>";
            
            $conn->close();
        }else{
            $conn->close();
        }
    }
    
    function displayPromotion($pk_service){
        include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
        
        $sql = "SELECT p.promotion_titre, p.rabais
                                        FROM ta_promotion_service tps
                                        JOIN service s ON s.pk_service = tps.fk_service
                                        JOIN promotion p ON p.pk_promotion = tps.fk_promotion
                                        WHERE s.pk_service = " . $pk_service ;
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $toDiplay = array();
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $aRowName => $aValue) {
                    if($aRowName == "promotion_titre"){
                        $percent = round((float)$row['rabais'] * 100 ) . '%';
                        echo "<span class='promoDisplay'>" . $aValue . " (" . $percent . ")</span><br class='br2'>";
                    }
                }
            }
            $conn->close();
        }else{
            $conn->close();
        }
    }


    /**
     * pk_ta_facture_service
     * @return int
     */
    public function getPk_ta_facture_service(){
        return $this->pk_ta_facture_service;
    }

    /**
     * pk_ta_facture_service
     * @param int $pk_ta_facture_service
     * @return Infota_facture_service
     */
    public function setPk_ta_facture_service($pk_ta_facture_service){
        $this->pk_ta_facture_service = $pk_ta_facture_service;
        return $this;
    }

    /**
     * fk_facture
     * @return int
     */
    public function getfk_facture(){
        return $this->fk_facture;
    }

    /**
     * fk_facture
     * @param int $fk_facture
     * @return Infota_facture_service
     */
    public function setfk_facture($fk_facture){
        $this->fk_facture = $fk_facture;
        return $this;
    }

    /**
     * fk_service
     * @return string
     */
    public function getfk_service(){
        return $this->fk_service;
    }

    /**
     * fk_service
     * @param string $fk_service
     * @return Infota_facture_service
     */
    public function setfk_service($fk_service){
        $this->fk_service = $fk_service;
        return $this;
    }

    /**
     * tarif_facture
     * @return int
     */
    public function gettarif_facture(){
        return $this->tarif_facture;
    }

    /**
     * tarif_facture
     * @param int $tarif_facture
     * @return Infota_facture_service
     */
    public function settarif_facture($tarif_facture){
        $this->tarif_facture = $tarif_facture;
        return $this;
    }

    /**
     * montant_rabais
     * @return string
     */
    public function getmontant_rabais(){
        return $this->montant_rabais;
    }

    /**
     * montant_rabais
     * @param string $montant_rabais
     * @return Infota_facture_service
     */
    public function setmontant_rabais($montant_rabais){
        $this->montant_rabais = $montant_rabais;
        return $this;
    }

}

?>