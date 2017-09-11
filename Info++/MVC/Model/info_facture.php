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
                echo "<h5 class='confirmationFacture'>" . strtoupper ($anObject['no_confirmation']) . "</h5><a class='detailFacture accordion'>Détail</a><h5 class='tarifFacture'>" . $this->getTarif($anObject['pk_facture']) . "$</h5>";
                echo "<div class='panel'>";
                echo "<p>Lorem ipsum...</p>";
                echo "</div>";
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