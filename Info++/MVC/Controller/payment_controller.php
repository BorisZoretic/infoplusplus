<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_facture.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_facture_service.php';

class payment_controller
{
    
    private $infosFacture = array();
    private $infosServices = array();
    private $infosTotalRabais = array();
    private $InfosFactureService;
    private $InfosTaFacture;  
    public $idLastFacture;
    function __construct()
    {
       
        $this->infosFacture[0] = $_SESSION['id'];        
        $this->infosFacture[1] = isset($_POST['transId']) ? $_POST['transId'] : null;
          
        if (isset($_POST['services'])){
            for ($i = 0 ; $i < count($_POST['services']);$i++){
                array_push($this->infosServices, $_POST['services'][$i]);
            }
        }

        $this->infosTotalRabais[0] = isset($_POST['tarif']) ? $_POST['tarif'] : null;
        $this->infosTotalRabais[1] = isset($_POST['rabais']) ? $_POST['rabais'] : null;
       
        
        $this->InfosFactureService = new InfoFacture();
        $this->InfosTaFacture = new Infota_facture_service();
        
    }  
       
    
    function getinfosFacture(){
        return $this->infosFacture;
    }
    
    function addFacture(){
        $dateTime = date_create('now')->format('Y-m-d');
        $this->InfosFactureService->setFk_client($this->infosFacture[0]);
        $this->InfosFactureService->setNo_confirmation($this->infosFacture[1]);
        $this->InfosFactureService->setDate_service($dateTime);
        $this->InfosFactureService->setPaiement_status(1);        
        $this->idlastFacture = $this->InfosFactureService->addDBObject();
    }
    
    function addFacture_Service(){
        for ($i = 0 ; $i < count($this->infosServices);$i++){            
            $this->InfosTaFacture->setfk_facture($this->idlastFacture);
            $this->InfosTaFacture->setfk_service($this->infosServices[$i]);
            $this->InfosTaFacture->setmontant_rabais($this->infosTotalRabais[1]);
            $this->InfosTaFacture->settarif_facture($this->infosTotalRabais[0]);
            $this->InfosTaFacture->addDBObject();
        }
    }
   
}

$payment = new payment_controller();
$payment->addFacture();


header("Location: http://localhost/infoplusplus/Info++/catalogue.php");
exit();




?>

