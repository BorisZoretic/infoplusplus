<?php
require_once'info_model.php';

class InfoService extends InfoModel {
	protected $table_name = 'service';
	protected $primary_key = "pk_service";
	
	protected $pk_service = 0;
	protected $service_titre = '';
	protected $service_description = '';
	protected $duree = 0;
	protected $tarif = 0;
	protected $actif = 1;
	protected $image = '';
	
	function __construct() {
	}
	

    /**
     * pk_service
     * @return int
     */
    public function getPk_service(){
        return $this->pk_service;
    }

    /**
     * pk_service
     * @param int $pk_service
     * @return InfoService
     */
    public function setPk_service($pk_service){
        $this->pk_service = $pk_service;
        return $this;
    }

    /**
     * service_titre
     * @return string
     */
    public function getService_titre(){
        return $this->service_titre;
    }
    

    /**
     * service_titre
     * @param string $service_titre
     * @return InfoService
     */
    public function setService_titre($service_titre){
        $this->service_titre = $service_titre;
        return $this;
    }
    
    /**
     * image
     * @param string $image
     * @return InfoService
     */
    public function setImage($image){
        $this->image = $image;
        return $this;
    }
    
    /**
     * image
     * @return string
     */
    public function getImage(){
        return $this->image;
    }

    /**
     * service_description
     * @return string
     */
    public function getService_description(){
        return $this->service_description;
    }

    /**
     * service_description
     * @param string $service_description
     * @return InfoService
     */
    public function setService_description($service_description){
        $this->service_description = $service_description;
        return $this;
    }

    /**
     * duree
     * @return int
     */
    public function getDuree(){
        return $this->duree;
    }

    /**
     * duree
     * @param int $duree
     * @return InfoService
     */
    public function setDuree($duree){
        $this->duree = $duree;
        return $this;
    }

    /**
     * tarif
     * @return double
     */
    public function getTarif(){
        return $this->tarif;
    }

    /**
     * tarif
     * @param double $tarif
     * @return InfoService
     */
    public function setTarif($tarif){
        $this->tarif = $tarif;
        return $this;
    }

    /**
     * actif
     * @return int
     */
    public function getActif(){
        return $this->actif;
    }

    /**
     * actif
     * @param int $actif
     * @return InfoService
     */
    public function setActif($actif){
        $this->actif = $actif;
        return $this;
    }
    
    function getDynamicList(){
        $aListOfObjects = $this->getListOfActiveBDObjects();
        if ($aListOfObjects != null) {
            echo "<div class='allpage'><div class='serviceForPanier'></div></div>";
            foreach ( $aListOfObjects as $anObject ) {
                if ($anObject['actif']==1) {
                    echo "<div class='border divTable'>";
                    echo "<p id='pk_service' style='display:none'>" . $anObject['pk_service'] . "</p>";
                    echo "<img class='excel' src='" . $anObject['image'] . "' title='" . $anObject['image'] . "' alt='" . $anObject['image'] . "'>";
                    echo "<h4>". $anObject['service_titre'] ."</h4><br>";
                    echo "<p class='textExcel'>" . $anObject['service_description'] . "</p>";
                    echo "<br><img class='panier' src='images/icones/panier.png' title='panier' alt='panier'><span class='dureeExcel'>Durée : " . $anObject['duree'] . "h</span><span class='tarifExcel'>Tarif :" . $anObject['tarif'] . "$</span>";
                    echo "</div>";
                }
            }
        }
    }
    
    function getService($idservice){
        $anObject = $this->getObjectFromDB($idservice);       
                echo "<div name='imageUpload' id='uploads'><img class='imgHolder' src='". $anObject['image'] ."'>";
                echo "<input type='file' name='fileToUpload' class='imgUpload' id='fileToUp2'>";
                echo "<input type='button' id='ImageMod' class='btnUpdate' value='Mettre à jour la photo'></div>";
                echo "<input id='changeImage' name='chgImg' class='none' value=''>";
                echo "<div id='formServ'>";
                echo "<input id='titre' name='title' class='inputMarginWidthService' value='". $anObject['service_titre'] ."' required='true'></input>";
                echo "<br>";
                echo "<textarea type='textarea' id='desc' name='description' class='inputMarginWidthServiceDesc' placeholder='Description' required='true'>" . $anObject['service_description'] . "</textarea>
                <br> ";
                echo "<input type='number' min='1' max='1000' name='duree' id='dur' class='inputMarginWidthService2'
                    value='" . $anObject['duree'] . "' required='true'></input>";
                echo "<input type='number' min='1' max='1000' id='tar' name='tarif'
                        class='inputMarginWidthService2' value='" . $anObject['tarif'] . "' required='true'></input><br>";
                if ($anObject['actif']=='1'){
                    echo "<div class='inputMarginWidthService3' ><input type='checkbox' id='act' checked='checked' name='active' ></input><label>Activer dans le catalogue</label></div>";
                }
                else{
                echo "<div class='inputMarginWidthService3' ><input type='checkbox' id='act' name='active'></input><label>Activer dans le catalogue</label></div>
                        
                        </div>";
                }
                echo "<input type='submit' id='modServiceSubmit' name='submit' class='buttonConfirmer' value='Modifier'>";
            
        
    }
    
    function getDynamicAdminList(){
        require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_promotion_service.php';
        
        $aPromotionService = new InfoTaPromotionService();
        
        $aListOfObjects = $this->getListOfActiveBDObjects();
        echo "<div class='content'>";
        if ($aListOfObjects != null) {
            foreach ( $aListOfObjects as $anObject ) {
                if ($anObject['actif']==1) {
                    echo "<div id='tab' class='border divTable service dropdown'>";
                }
                else {
                    echo "<div id='tab' class='border divTable service dropdown deac'>";
                }
                echo "<label id='pk' class='none'>". $anObject['pk_service'] ."</label>";
                echo "<div id='tool' class='imgTool'>                        
                        <img class='imgTool' src='../images/icones/sys.png'>
                        </div>";
                if ($anObject['actif']==1) {
                    echo "<div id='myDropdown' class='dropdown-content'>               
                        <a id='mod' href='#'>Modifier le service</a>
                        <a id='deac'href='#'>Désactiver le service</a>
                        </div>";
                }
                else {
                    echo "<div id='myDropdown' class='dropdown-content'>
                        <a id='mod' href='#'>Modifier le service</a>
                        <a id='deac'href='#'>Activer le service</a>
                        </div>";
                }
                echo "<img class='excel' src='" . $anObject['image'] . "' title='" . $anObject['image'] . "' alt='" . $anObject['image'] . "'>";
                
                echo "<h4>". $anObject['service_titre'] ."</h4><br>";
                echo "<p class='textExcel'>" . $anObject['service_description'] . "</p>";
                echo "<br><span class='dureeExcel'>Durée : " . $anObject['duree'] . "h</span><span class='tarifExcel'>Tarif :" . $anObject['tarif'] . "$</span>";
                
                echo "<div class='divMarginTop'>";
                echo "<p class='promotion'>Promotion: </p>";
                $aPromotionService->getDynamicPromotionService($anObject['pk_service']);
                //echo "<img class='imgPromo' src='images/promotions/grid.png' title='grid' alt='grid'>";
                echo "<button class='buttonPlus' id='". $anObject['pk_service'] ."'>+</button>";
                echo "<img class='mediasSociaux' src='images/icones/medias sociaux.jpeg' title='mediasSociaux' alt='mediasSociaux'>";
                echo "<div class='centerDiv'><label class='none' id='promo_to_delete'></label><span>Voulez-vous vraiment supprimer cette promotion?<span><br><a class='cursorPointer confirmationButtons' id='deleteConfirm'>Oui</a><a class='cursorPointer confirmationButtons' id='deleteDeny'>Non</a></div>";
                
                echo "</div>";
                
                echo "</div>";
            }
        }
        echo "</div>";
    }

}

?>