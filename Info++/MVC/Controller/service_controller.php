<?php
/****************************************************************
 Fichier : service_controller.php
 Auteur :
 Fonctionnalité :
 Vérification:
 
 ======================================================
 
 Dernière modification:
 
 *****************************************************************/
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_service.php';
/**
 * Description of
 */
class service_controller
{
    
    private $infosService = [];
    
    private $InfosServices;
    
    private $allServices = array();
        
    private $Duplicate = false;
    
    function __construct()
    {
       
        
        $this->infosService[0] = isset($_POST['title']) ? $_POST['title'] : null;
        $this->infosService[1] = isset($_POST['description']) ? $_POST['description'] : null;
        $this->infosService[2] = isset($_POST['duree']) ? $_POST['duree'] : null;
        $this->infosService[3] = isset($_POST['tarif']) ? $_POST['tarif'] : null;
        $this->infosService[4] = isset($_POST['active']) ? '1' : '0';
        $this->infosService[5] = isset($_GET['primary']) ? $_GET['primary'] : null;
        $this->infosService[6] = isset($_POST['chgImg']) ? $_POST['chgImg'] : '0';
        
        $this->InfosServices = new InfoService();
       
        
        $this->allServices = $this->InfosServices->getListOfAllDBObjects();
    }
    
    function verifyTitles()
    {
        foreach ($this->allServices as $row) {
            if ($row['service_titre'] == $this->infosService[0]) {
                
                $this->Duplicate = true;
            }
        }
    }
    
    function getDuplicate()
    {
        return $this->Duplicate;
    }
    
    function ajouterService()
    {
        
        if (isset($_GET['mod'])==false){
            $this->verifyTitles();
            $uploadOk = $this->uploadImage();
        }
        elseif($this->infosService[6]=='1'){
           
            $uploadOk = $this->uploadImage();
        }
        else{
            $image = $this->InfosServices->getObjectFromDB($this->infosService[5]);
            
            $uploadOk = $image['image'];
            
        }
        if ($this->getDuplicate() == false && $uploadOk != '0' && isset($_GET['mod'])==false) {       
        
            
            
            /* Infos Service*/
            $this->InfosServices->setService_titre($this->infosService[0]);
            $this->InfosServices->setService_description($this->infosService[1]);
            $this->InfosServices->setDuree($this->infosService[2]);
            $this->InfosServices->setTarif($this->infosService[3]);
            $this->InfosServices->setActif($this->infosService[4]);
            $this->InfosServices->setImage($uploadOk);
            
            
     
            $this->InfosServices->addDBObject();
        }
        
        elseif ($_GET['mod']==1) {
            echo $this->infosService[0];
            if (isset($_GET['primary'])){
                $this->InfosServices->setPk_service($this->infosService[5]);
                $this->InfosServices->setService_titre($this->infosService[0]);
                $this->InfosServices->setService_description($this->infosService[1]);
                $this->InfosServices->setDuree($this->infosService[2]);
                $this->InfosServices->setTarif($this->infosService[3]);
                $this->InfosServices->setActif($this->infosService[4]);
                $this->InfosServices->setImage($uploadOk);
                $this->InfosServices->updateDBObject();
            }
                    
           
            
            
            
        }
    }
    
    function uploadImage(){
         
        $target_dir = "images/services/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                
                $uploadOk = 1;
            } else {
                
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                
                return $uploadOk;
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . "/infoplusplus/Info++/" . $target_file)) {
                    
                    return $target_file;
                } else {
                    
                    return $uploadOk;
                }
            }
    }
}
$addservice = new service_controller();
$addservice->ajouterService();
if($addservice->getDuplicate()==true){
    echo "Dupliqué";
    //header("Location: http://localhost/infoplusplus/Info++/ajoutservice.php?duplicate=1");
    exit();
}
else{
    echo "Ajout fait avec succès";
    //header("Location: http://localhost/infoplusplus/Info++/service.php");
    exit();
}