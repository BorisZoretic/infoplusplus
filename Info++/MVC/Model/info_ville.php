<?php
require_once'info_model.php';

class InfoVille extends InfoModel {
	protected $table_name = 'ville';
	protected $primary_key = "pk_ville";
	
	protected $pk_ville = 0;
	protected $ville = 0;
	
	function __construct() {
	}
	

    /**
     * pk_ville
     * @return int
     */
    public function getPk_ville(){
        return $this->pk_ville;
    }

    /**
     * pk_ville
     * @param int $pk_ville
     * @return InfoService
     */
    public function setPk_ville($pk_ville){
        $this->pk_ville = $pk_ville;
        return $this;
    }
    
    /**
     * ville
     * @return int
     */
    public function getVille(){
        return $this->ville;
    }
    
    /**
     * ville
     * @param int $ville
     * @return InfoService
     */
    public function setVille($ville){
        $this->ville = $ville;
        return $this;
    }

}

?>