<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_facture.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ta_facture_service.php';

class payment_controller
{
    
    private $infosFacture = array();
    private $infosTa_Facture = array();
    private $InfosFactureService;
        
    function __construct()
    {
        
        $payment = $_POST['transId'];
        
        
        
        $this->infosFacture[0] = $_SESSION['id'];        
        $this->infosFacture[1] = isset($_POST['transId']) ? $_POST['transId'] : null;
          
        if (isset($_POST['services'])){
            for ($i = 0 ; $i < count($_POST['services']);$i++){
                array_push($this->infosTa_Facture, $_POST['services'][$i]);
            }
        }
         
        $this->InfosFactureService = new InfoFacture();
        
        
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
    }
   
}

$payment = new payment_controller();
$payment->addFacture();


header("Location: http://localhost/infoplusplus/Info++/catalogue.php");
exit();




?>

