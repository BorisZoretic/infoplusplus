<?php
require_once'info_client.php';

class InfoClient extends InfoModel {
	protected $table_name = 'client';
	protected $primary_key = "pk_client";
	
	protected $pk_client = 0;
	protected $fk_utilisateur = '';
	protected $prenom = '';
	protected $nom = 0;
	protected $fk_adresse;
	protected $telephone;
	protected $infolettre;
	
	function __construct() {
	}
	

    /**
     * pk_client
     * @return int
     */
    public function getPk_client(){
        return $this->pk_client;
    }

    /**
     * pk_client
     * @param int $pk_client
     * @return InfoService
     */
    public function setPk_client($pk_client){
        $this->pk_client = $pk_client;
        return $this;
    }
    
    
    
    

    /**
     * courriel
     * @return string
     */
    public function getCourriel(){
        return $this->courriel;
    }

    /**
     * courriel
     * @param string $courriel
     * @return InfoService
     */
    public function setCourriel($courriel){
        $this->courriel = $courriel;
        return $this;
    }

    /**
     * mot_de_passe
     * @return string
     */
    public function getMot_de_passe(){
        return $this->mot_de_passe;
    }

    /**
     * mot_de_passe
     * @param string $mot_de_passe
     * @return InfoService
     */
    public function setMot_de_passe($mot_de_passe){
        $this->mot_de_passe = $mot_de_passe;
        return $this;
    }

    /**
     * administration
     * @return int
     */
    public function getAdministration(){
        return $this->administration;
    }

    /**
     * administration
     * @param int $administration
     * @return InfoService
     */
    public function setAdministration($administration){
        $this->administration = $administration;
        return $this;
    }

  
    function getDynamicList(){
        $aListOfObjects = $this->getListOfActiveBDObjects();
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                
                echo "<div class='border'>";
                echo "<img class='excel' src='images/services/coursexcel.png' title='excel' alt='excel'>";
                echo "<h4>". $anObject['courriel'] ."</h4><br>";
                echo "<p class='textExcel'>" . $anObject['mot_de_passe'] . "</p>";
                echo "<br><p class='tarifExcel'>Tarif :" . $anObject['tarif'] . "$</p><p class='administrationExcel'>Durée : " . $anObject['administration'] . "h</p><img class='panier' src='images/icones/panier.png' title='panier' alt='panier'>";
                echo "</div>";
            }
        }
    }

}

?>