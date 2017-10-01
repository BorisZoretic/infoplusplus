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
        
        $format = 'Y-m-d H:i:s';
        
        $aListOfObjects = $this->getListOfActiveBDObjects();
        $compt = 1;
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                
                
                $date_debut = DateTime::createFromFormat($format, $anObject['date_debut']);
                $date_fin = DateTime::createFromFormat($format, $anObject['date_fin']);
                
                if($anObject['fk_service'] == $pk_service){
                    $promo = $aPromotion->getObjectFromDB($anObject['fk_promotion']);
                    
                    echo "<div class='imagePromo'>";
                    echo "<img id='toolBob' class='imgToolBob' src='../images/icones/sys.png'>";
                    echo "<div id='myDropdownBob' class='dropdown-content'>
                        <a class='paddingContent' href='modifTaPromo.php?pk_promotion_service=" . $anObject['pk_promotion_service'] . "'>Modifier la promotion</a>
                        <a class='paddingContent cursorPointer' id='deletePromoService' idPromoService='".$anObject["pk_promotion_service"]."'>Supprimer la promotion</a>
                        </div>";
                    $titre = str_replace('Rabais', '', $promo['promotion_titre']);
                    $titre = ucfirst($titre);
                    echo "<div class='imgPromo'><span class='spanRabaisPromo'>". $promo['rabais'] * 100 ."%</span><span class='titrePromo'>". $titre ."</span></div>";
                    echo "<div class='none showDate'>".$date_debut->format('Y-m-d')." à " . $date_fin->format('Y-m-d') . "</div>";
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
            
		<form id='formModifPromo' class='inscription' method='post'>
			<div id='uploads'>";
        echo "<div class='imgPromoModif'><span class='spanRabais'>". $promo['rabais'] * 100 ."%</span></div>";
		echo "<select id='selectPromo' class='selectPromo'>";
		$aPromo->getActiveObjectsAsSelect($promo['pk_promotion'], "promotion_titre");
              echo "</select></div>
			    
			<div class='formPromo'>
				<label class='labelPromo' for='date_debut'>Période de la promotion</label></br>
    			<input id='date_debut' type='date' name='date_debut' placeholder='Date de début' value='" . $date_debut->format('Y-m-d') . "'></input>
    			<input id='date_fin' type='date' name='date_fin' placeholder='Date de fin' value='" . $date_fin->format('Y-m-d') . "'></input></br></br>
    			<label class='labelPromo' for='code'>Entre un code s'il est requis pour appliquer<br>la promotion lors de la création de la facture</label></br>
    			<input id='code' name='code' value='".$laPromo['code']."'></input>
    			</div>
    			<div class='buttonConfirmer'><a class='btnBob'>Modifier</a></div>
			</form>
			</div>";
    }

}

/*$anObject = new InfoTaPromotionService();
$aPromoService = $anObject->getObjectFromDB(1);

$anObject->setFk_promotion($aPromoService['pk_promotion_service']);
$anObject->setCode('xD');
$anObject->setDate_debut("2017-05-06");
$anObject->setDate_fin("2017-05-08");
$anObject->setFk_service(2);

$anObject->updateDBObject();*/
?>