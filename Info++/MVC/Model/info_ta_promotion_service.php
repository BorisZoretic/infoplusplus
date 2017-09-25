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
                
                if($anObject['fk_service'] == $pk_service){
                    $aPromotion = $aPromotion->getObjectFromDB($anObject['fk_promotion']);
                    echo "<div class='imagePromo'>";
                    echo "<img id='toolBob' class='imgToolBob' src='../images/icones/sys.png'>";
                    echo "<div id='myDropdownBob' class='dropdown-content'>
                        <a class='paddingContent' href='modifTaPromo.php?pk_promotion_service=" . $anObject['pk_promotion_service'] . "'>Modifier la promotion</a>
                        <a class='paddingContent' href='#'>Supprimer la promotion</a>
                        </div>";
                    if($aPromotion['rabais'] == 0.10){
                        echo "<img class='imgPromo' src='images/promotions/10.png' title='imgPromo10' alt='imgPromo10'>";
                    }else if($aPromotion['rabais'] == 0.15){
                        echo "<img class='imgPromo' src='images/promotions/15.png' title='imgPromo15' alt='imgPromo15'>";
                    }else if($aPromotion['rabais'] == 0.20){
                        echo "<img class='imgPromo' src='images/promotions/20.png' title='imgPromo20' alt='imgPromo20'>";
                    }else if($aPromotion['rabais'] == 0.25){
                        echo "<img class='imgPromo' src='images/promotions/25.png' title='imgPromo25' alt='imgPromo25'>";
                    }
                    echo "</div>";
                }
                
            }
        }
    }
    
    function formPromotionService($pk_promotion_service){
        $laPromo = $this->getObjectFromDB($pk_promotion_service);
        
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_promotion.php';
        
        $aPromo = new InfoPromotion();
        $promo = $aPromo->getObjectFromDB($laPromo["fk_promotion"]);
        
        $format = 'Y-m-d H:i:s';
        $date_debut = DateTime::createFromFormat($format, $laPromo['date_debut']);
        $date_fin = DateTime::createFromFormat($format, $laPromo['date_fin']);
        
        echo "<div class='formcenter'>
        <h4>Ajouter la période et un code pour appliquer la promotion choisie</h4>
        <h5 class='h5modif'>Le code n'est pas obligatoire et ne sera pas exigé si le champ est vide</h5>
            
		<form id='formIns' class='inscription' onsubmit='return validate()' method='post'
			action='http://localhost/infoplusplus/Info++/MVC/Controller/service_controller.php'>
			<div id='uploads'>";
                if($promo['rabais'] == 0.10){
                    echo "<img class='imgPromoModif' src='images/promotions/10.png' title='imgPromo10' alt='imgPromo10'>";
                }else if($promo['rabais'] == 0.15){
                    echo "<img class='imgPromoModif' src='images/promotions/15.png' title='imgPromo15' alt='imgPromo15'>";
                }else if($promo['rabais'] == 0.20){
                    echo "<img class='imgPromoModif' src='images/promotions/20.png' title='imgPromo20' alt='imgPromo20'>";
                }else if($promo['rabais'] == 0.25){
                    echo "<img class='imgPromoModif' src='images/promotions/25.png' title='imgPromo25' alt='imgPromo25'>";
                }
		echo "<select id='selectPromo' class='selectPromo'>";
		$aPromo->getActiveObjectsAsSelect($promo['pk_promotion'], "promotion_titre");
              echo "</select></div>
			    
			<div class='formPromo'>
				<label class='labelPromo' for='date_debut'>Période de la promotion</label></br>
    			<input type='date' name='date_debut' placeholder='Date de début' value='" . $date_debut->format('Y-m-d') . "'></input>
    			<input type='date' name='date_fin' placeholder='Date de fin' value='" . $date_fin->format('Y-m-d') . "'></input></br></br>
    			<label class='labelPromo' for='code'>Entre un code s'il est requis pour appliquer<br>la promotion lors de la création de la facture</label></br>
    			<input name='code' value='".$laPromo['code']."'></input>
    			</div>
    			<input type='submit' id='add' class='buttonConfirmer' value='Confirmer'>
    			</form>
			</div>";
    }

}

?>