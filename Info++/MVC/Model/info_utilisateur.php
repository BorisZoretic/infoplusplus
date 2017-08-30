<?php
require_once'info_model.php';

class InfoUtilisateur extends InfoModel {
	protected $table_name = 'utilisateur';
	protected $primary_key = "pk_utilisateur";
	
	protected $pk_utilisateur = 0;
	protected $courriel = '';
	protected $mot_de_passe = '';
	protected $administration = 0;
	
	function __construct() {  
	}
	

    /**
     * pk_utilisateur
     * @return int
     */
    public function getPk_utilisateur(){
        return $this->pk_utilisateur;
    }

    /**
     * pk_utilisateur
     * @param int $pk_utilisateur
     * @return InfoService
     */
    public function setPk_utilisateur($pk_utilisateur){
        $this->pk_utilisateur = $pk_utilisateur;
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