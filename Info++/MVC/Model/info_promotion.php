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
    
}

?>