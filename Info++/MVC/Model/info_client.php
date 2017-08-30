<?php
require_once'info_model.php';

class InfoClient extends InfoModel {
	protected $table_name = 'client';
	protected $primary_key = "pk_client";
	
	protected $pk_client = 0;
	protected $fk_utilisateur = 0;
	protected $prenom = '';
	protected $nom = '';
	protected $fk_adresse = '';
	protected $telephone = '';
	protected $infolettre = '';
	
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
     * fk_utilisateur
     * @return int
     */
    public function getFk_utilisateur(){
        return $this->fk_utilisateur;
    }
    
    /**
     * fk_utilisateur
     * @param int $fk_utilisateur
     * @return InfoService
     */
    public function setFk_utilisateur($fk_utilisateur){
        $this->fk_utilisateur = $fk_utilisateur;
        return $this;
    }
    
    /**
     * fk_adresse
     * @return int
     */
    public function getFk_adresse(){
        return $this->fk_adresse;
    }
    
    /**
     * fk_adresse
     * @param int $fk_adresse
     * @return InfoService
     */
    public function setFk_adresse($fk_adresse){
        $this->fk_adresse = $fk_adresse;
        return $this;
    }
    
    
    
    

    /**
     * prenom
     * @return string
     */
    public function getPrenom(){
        return $this->prenom;
    }

    /**
     * prenom
     * @param string $prenom
     * @return InfoService
     */
    public function setPrenom($prenom){
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * nom
     * @return string
     */
    public function getNom(){
        return $this->nom;
    }

    /**
     * nom
     * @param string $nom
     * @return InfoService
     */
    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }

    /**
     * telephone
     * @return int
     */
    public function getTelephone(){
        return $this->telephone;
    }

    /**
     * telephone
     * @param int $telephone
     * @return InfoService
     */
    public function setTelephone($telephone){
        $this->telephone = $telephone;
        return $this;
    }
    
    /**
     * infolettre
     * @return int
     */
    public function getInfolettre(){
        return $this->infolettre;
    }
    
    /**
     * infolettre
     * @param int $infolettre
     * @return InfoService
     */
    public function setInfolettre($infolettre){
        $this->infolettre = $infolettre;
        return $this;
    }

  
    function getDynamicList(){
        $aListOfObjects = $this->getListOfActiveBDObjects();
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                
                echo "<div class='border'>";
                echo "<img class='excel' src='images/services/coursexcel.png' title='excel' alt='excel'>";
                echo "<h4>". $anObject['prenom'] ."</h4><br>";
                echo "<p class='textExcel'>" . $anObject['nom'] . "</p>";
                echo "<br><p class='tarifExcel'>Tarif :" . $anObject['tarif'] . "$</p><p class='telephoneExcel'>Durée : " . $anObject['telephone'] . "h</p><img class='panier' src='images/icones/panier.png' title='panier' alt='panier'>";
                echo "</div>";
            }
        }
    }

}

?>