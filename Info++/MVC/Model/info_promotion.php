<?php
require_once'info_model.php';

class InfoPromotion extends InfoModel {
	protected $table_name = 'promotion';
	protected $primary_key = "pk_promotion";
	
	protected $pk_promotion = 0;
	protected $promotion_titre = '';
	protected $rabais = 0;
	
	function __construct() {
	}
	
    /**
     * pk_promotion
     * @return int
     */
    public function getPk_promotion(){
        return $this->pk_promotion;
    }

    /**
     * pk_promotion
     * @param int $pk_promotion
     * @return InfoPromotion
     */
    public function setPk_promotion($pk_promotion){
        $this->pk_promotion = $pk_promotion;
        return $this;
    }

    /**
     * promotion_titre
     * @return string
     */
    public function getPromotion_titre(){
        return $this->promotion_titre;
    }

    /**
     * promotion_titre
     * @param string $promotion_titre
     * @return InfoPromotion
     */
    public function setPromotion_titre($promotion_titre){
        $this->promotion_titre = $promotion_titre;
        return $this;
    }

    /**
     * rabais
     * @return double
     */
    public function getRabais(){
        return $this->rabais;
    }

    /**
     * rabais
     * @param double $rabais
     * @return InfoPromotion
     */
    public function setRabais($rabais){
        $this->rabais = $rabais;
        return $this;
    }
    
	function getDynamicAdminList(){
		$aListOfObjects = $this->getListOfActiveBDObjects();
		
		echo "<div class='content'>";
		if ($aListOfObjects != null) {
			foreach ( $aListOfObjects as $anObject ) {
				echo "<div id='tab' class='border divTable service dropdown'>";
				
				echo "<div id='tool' class='imgTool'>
                        <img class='imgTool' src='../images/icones/sys.png'>
                        </div>";
				
				echo "<div id='myDropdown' class='dropdown-content'>

                       <a id='applyService' idPromo='" . $anObject['pk_promotion'] . "'>Appliquer à tous les services</a>
                       <a id='modifyPromo' href='#'>Modifier la promotion</a>
					   <a id='deletePromo' idPromo='" . $anObject['pk_promotion'] . "'>Supprimer la promotion</a>

                       </div>";

				echo "<label id='pkpromo' class='none'>". $anObject['pk_promotion'] ."</label>";
				echo "<label class='titrePromotion'>". $anObject['promotion_titre'] ."</label>";
				echo "<label class='txtRabaisPromotion'>" . ($anObject['rabais'] * 100) . "%</label>";
                echo "<div class='centerDiv'><span>Voulez-vous vraiment supprimer cette promotion?<span><br><a class='cursorPointer confirmationButtons' id='deleteConfirm'>Oui</a><a class='cursorPointer confirmationButtons' id='deleteDeny'>Non</a></div>";

				
				echo "</div>";
			}
		}
		echo "</div>";
	}
    
}

?>