<?php
require_once'info_model.php';

class InfoFacture extends InfoModel {
	protected $table_name = 'facture';
	protected $primary_key = "pk_facture";
	
	protected $pk_facture = 0;
	protected $fk_client = 0;
	protected $date_service = '';
	protected $paiement_status = 0;
	protected $no_confirmation = '';
	
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
                $infoClient = $aClient->getObjectFromDB($anObject['fk_client']);
                
                $date = DateTime::createFromFormat($format, $anObject['date_service']);
                
                echo "<div class='borderFacture divTable'>";
                echo "<h4 class='idFacture'>" . $anObject['pk_facture'] . "</h4><h5 class='dateFacture'>" . $date->format('Y/m/d') . "</h5>";
                echo "<h4 class='nameFacture'>" . $infoClient['prenom'] . " " . $infoClient['nom'] . "</h4>";
                echo "<h5 class='confirmationFacture'>" . strtoupper ($anObject['no_confirmation']) . "</h5><h5 class='tarifFacture'>" . $this->getTarif($anObject['pk_facture']) . "$</h5>";
                echo "<div class='panel'>";
                $this->displayFactureContent($anObject['pk_facture']);
                echo "</div>";
                echo "<a class='detailFacture accordion'>Détail</a>";
                echo "</div>";
            }
        }
    }
    
    function getTarif($pk_facture){
        include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
        
        $sql = "SELECT SUM(tfs.tarif_facture)
        FROM ta_facture_service tfs
        JOIN facture f ON f.pk_facture = tfs.fk_facture
        WHERE f.pk_facture = '" . $pk_facture . "'";
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
    
    function displayFactureContent($pk_facture){
        include $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/database_connect.php';
        
        $sql = "SELECT s.service_titre, s.tarif, tfs.montant_rabais, tfs.fk_service
                FROM ta_facture_service tfs
                JOIN service s ON s.pk_service = tfs.fk_service
                WHERE tfs.fk_facture = " . $pk_facture;
        
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
     * pk_facture
     * @return int
     */
    public function getPk_facture(){
        return $this->pk_facture;
    }

    /**
     * pk_facture
     * @param int $pk_facture
     * @return InfoFacture
     */
    public function setPk_facture($pk_facture){
        $this->pk_facture = $pk_facture;
        return $this;
    }

    /**
     * fk_client
     * @return int
     */
    public function getFk_client(){
        return $this->fk_client;
    }

    /**
     * fk_client
     * @param int $fk_client
     * @return InfoFacture
     */
    public function setFk_client($fk_client){
        $this->fk_client = $fk_client;
        return $this;
    }

    /**
     * date_service
     * @return string
     */
    public function getDate_service(){
        return $this->date_service;
    }

    /**
     * date_service
     * @param string $date_service
     * @return InfoFacture
     */
    public function setDate_service($date_service){
        $this->date_service = $date_service;
        return $this;
    }

    /**
     * paiement_status
     * @return int
     */
    public function getPaiement_status(){
        return $this->paiement_status;
    }

    /**
     * paiement_status
     * @param int $paiement_status
     * @return InfoFacture
     */
    public function setPaiement_status($paiement_status){
        $this->paiement_status = $paiement_status;
        return $this;
    }

    /**
     * no_confirmation
     * @return string
     */
    public function getNo_confirmation(){
        return $this->no_confirmation;
    }

    /**
     * no_confirmation
     * @param string $no_confirmation
     * @return InfoFacture
     */
    public function setNo_confirmation($no_confirmation){
        $this->no_confirmation = $no_confirmation;
        return $this;
    }

}

?>