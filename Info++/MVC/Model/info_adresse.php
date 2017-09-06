<?php
require_once'info_adresse.php';

class InfoAdresse extends InfoModel {
	protected $table_name = 'adresse';
	protected $primary_key = "pk_adresse";
	
	protected $pk_adresse = 0;
	protected $no_civique = 0;
	protected $rue = '';
	protected $fk_ville = 0;
	protected $code_postal = '';
	
	function __construct() {
	}
	

    /**
     * pk_adresse
     * @return int
     */
    public function getPk_adresse(){
        return $this->pk_adresse;
    }

    /**
     * pk_adresse
     * @param int $pk_adresse
     * @return InfoService
     */
    public function setPk_adresse($pk_adresse){
        $this->pk_adresse = $pk_adresse;
        return $this;
    }
    
    /**
     * no_civique
     * @return int
     */
    public function getNo_civique(){
        return $this->no_civique;
    }
    
    /**
     * no_civique
     * @param int $no_civique
     * @return InfoService
     */
    public function setNo_civique($no_civique){
        $this->no_civique = $no_civique;
        return $this;
    }
    

    
    
    /**
     * rue
     * @return string
     */
    public function getRue(){
        return $this->rue;
    }

    /**
     * rue
     * @param string $rue
     * @return InfoService
     */
    public function setRue($rue){
        $this->rue = $rue;
        return $this;
    }
    
    /**
     * fk_ville
     * @return int
     */
    public function getFk_ville(){
        return $this->fk_ville;
    }
    
    /**
     * fk_ville
     * @param int $fk_ville
     * @return InfoService
     */
    public function setFk_ville($fk_ville){
        $this->fk_ville = $fk_ville;
        return $this;
    }
    

    /**
     * code_postal
     * @return string
     */
    public function getCode_postal(){
        return $this->code_postal;
    }

    /**
     * code_postal
     * @param string $code_postal
     * @return InfoService
     */
    public function setCode_postal($code_postal){
        $this->code_postal = $code_postal;
        return $this;
    }

    

}

?>