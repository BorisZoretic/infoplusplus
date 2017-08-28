<?php
require_once'info_model.php';

class InfoTaPromotionService extends InfoModel {
	protected $table_name = 'ta_promotion_service';
	protected $primary_key = "pk_promotion_service";
	
	protected $pk_promotion_service = 0;
	protected $fk_promotion = 0;
	protected $fk_service = 0;
	protected $date_debut = '';
	protected $date_fin = '';
	protected $code = '';
	
	function __construct() {
	}
	
    /**
     * pk_promotion_service
     * @return int
     */
    public function getPk_promotion_service(){
        return $this->pk_promotion_service;
    }

    /**
     * pk_promotion_service
     * @param int $pk_promotion_service
     * @return InfoTaPromotionService
     */
    public function setPk_promotion_service($pk_promotion_service){
        $this->pk_promotion_service = $pk_promotion_service;
        return $this;
    }

    /**
     * fk_promotion
     * @return int
     */
    public function getFk_promotion(){
        return $this->fk_promotion;
    }

    /**
     * fk_promotion
     * @param int $fk_promotion
     * @return InfoTaPromotionService
     */
    public function setFk_promotion($fk_promotion){
        $this->fk_promotion = $fk_promotion;
        return $this;
    }

    /**
     * fk_service
     * @return int
     */
    public function getFk_service(){
        return $this->fk_service;
    }

    /**
     * fk_service
     * @param int $fk_service
     * @return InfoTaPromotionService
     */
    public function setFk_service($fk_service){
        $this->fk_service = $fk_service;
        return $this;
    }

    /**
     * date_debut
     * @return string
     */
    public function getDate_debut(){
        return $this->date_debut;
    }

    /**
     * date_debut
     * @param string $date_debut
     * @return InfoTaPromotionService
     */
    public function setDate_debut($date_debut){
        $this->date_debut = $date_debut;
        return $this;
    }

    /**
     * date_fin
     * @return string
     */
    public function getDate_fin(){
        return $this->date_fin;
    }

    /**
     * date_fin
     * @param string $date_fin
     * @return InfoTaPromotionService
     */
    public function setDate_fin($date_fin){
        $this->date_fin = $date_fin;
        return $this;
    }

    /**
     * code
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * code
     * @param string $code
     * @return InfoTaPromotionService
     */
    public function setCode($code){
        $this->code = $code;
        return $this;
    }
    
    function getDynamicPromotionService($pk_service){
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
        
        $aPromotion = new InfoPromotion();
        
        $aListOfObjects = $this->getListOfActiveBDObjects();
        $compt = 1;
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                echo "<div>";
                
                if($anObject['fk_service'] == $pk_service){
                    $aPromotion = $aPromotion->getObjectFromDB($anObject['fk_promotion']);
                    if($aPromotion['rabais'] == 0.10){
                        echo "<img class='imgPromo' src='images/promotions/10.png' title='imgPromo10' alt='imgPromo10'>";
                    }else if($aPromotion['rabais'] == 0.15){
                        echo "<img class='imgPromo' src='images/promotions/15.png' title='imgPromo15' alt='imgPromo15'>";
                    }else if($aPromotion['rabais'] == 0.20){
                        echo "<img class='imgPromo' src='images/promotions/20.png' title='imgPromo20' alt='imgPromo20'>";
                    }else if($aPromotion['rabais'] == 0.25){
                        echo "<img class='imgPromo' src='images/promotions/25.png' title='imgPromo25' alt='imgPromo25'>";
                    }
                }
                
                echo "</div>";
            }
        }
    }

}

?>