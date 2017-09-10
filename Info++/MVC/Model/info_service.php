<?php
require_once'info_model.php';

class InfoService extends InfoModel {
	protected $table_name = 'service';
	protected $primary_key = "pk_service";
	
	protected $pk_service = 0;
	protected $service_titre = '';
	protected $service_description = '';
	protected $duree = 0;
	protected $tarif = 0;
	protected $actif = 1;
	
	function __construct() {
	}
	

    /**
     * pk_service
     * @return int
     */
    public function getPk_service(){
        return $this->pk_service;
    }

    /**
     * pk_service
     * @param int $pk_service
     * @return InfoService
     */
    public function setPk_service($pk_service){
        $this->pk_service = $pk_service;
        return $this;
    }

    /**
     * service_titre
     * @return string
     */
    public function getService_titre(){
        return $this->service_titre;
    }

    /**
     * service_titre
     * @param string $service_titre
     * @return InfoService
     */
    public function setService_titre($service_titre){
        $this->service_titre = $service_titre;
        return $this;
    }

    /**
     * service_description
     * @return string
     */
    public function getService_description(){
        return $this->service_description;
    }

    /**
     * service_description
     * @param string $service_description
     * @return InfoService
     */
    public function setService_description($service_description){
        $this->service_description = $service_description;
        return $this;
    }

    /**
     * duree
     * @return int
     */
    public function getDuree(){
        return $this->duree;
    }

    /**
     * duree
     * @param int $duree
     * @return InfoService
     */
    public function setDuree($duree){
        $this->duree = $duree;
        return $this;
    }

    /**
     * tarif
     * @return double
     */
    public function getTarif(){
        return $this->tarif;
    }

    /**
     * tarif
     * @param double $tarif
     * @return InfoService
     */
    public function setTarif($tarif){
        $this->tarif = $tarif;
        return $this;
    }

    /**
     * actif
     * @return int
     */
    public function getActif(){
        return $this->actif;
    }

    /**
     * actif
     * @param int $actif
     * @return InfoService
     */
    public function setActif($actif){
        $this->actif = $actif;
        return $this;
    }
    
    function getDynamicList(){
        $aListOfObjects = $this->getListOfActiveBDObjects();
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                
                echo "<div class='border divTable'>";
                echo "<img class='excel' src='" . $anObject['image'] . "' title='" . $anObject['image'] . "' alt='" . $anObject['image'] . "'>";
                echo "<h4>". $anObject['service_titre'] ."</h4><br>";
                echo "<p class='textExcel'>" . $anObject['service_description'] . "</p>";
                echo "<br><img class='panier' src='images/icones/panier.png' title='panier' alt='panier'><span class='dureeExcel'>Durée : " . $anObject['duree'] . "h</span><span class='tarifExcel'>Tarif :" . $anObject['tarif'] . "$</span>";
                echo "</div>";
            }
        }
    }
    
    function getDynamicAdminList(){
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
        
        $aPromotionService = new InfoTaPromotionService();
        
        $aListOfObjects = $this->getListOfActiveBDObjects();
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                echo "<div class='border divTable'>";
                echo "<img class='excel' src='" . $anObject['image'] . "' title='" . $anObject['image'] . "' alt='" . $anObject['image'] . "'>";
                
                echo "<h4>". $anObject['service_titre'] ."</h4><br>";
                echo "<p class='textExcel'>" . $anObject['service_description'] . "</p>";
                echo "<br><span class='dureeExcel'>Durée : " . $anObject['duree'] . "h</span><span class='tarifExcel'>Tarif :" . $anObject['tarif'] . "$</span>";
                
                echo "<div class='divMarginTop'>";
                echo "<p class='promotion'>Promotion: </p>";
                $aPromotionService->getDynamicPromotionService($anObject['pk_service']);
                echo "<img class='imgPromo' src='images/promotions/grid.png' title='grid' alt='grid'>";
                echo "<button class='buttonPlus'>+</button>";
                echo "<img class='mediasSociaux' src='images/icones/medias sociaux.jpeg' title='mediasSociaux' alt='mediasSociaux'>";
                
                echo "</div>";
                
                echo "</div>";
            }
        }
    }

}

?>