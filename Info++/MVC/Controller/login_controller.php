<?php
/****************************************************************
 Fichier : login_controller.php
 Auteur :
 Fonctionnalité :
 Vérification:
 
 ======================================================
 
 Dernière modification:
 
 *****************************************************************/
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_client.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_utilisateur.php';

// Start the session
session_start();

if(isset($_GET['erreur']))
{
    $message = "Le nom d\'utilisateur ou le mot de passe est erronné.";
    echo "<script type='text/javascript'>alert('$message');</script>";
}

/**
 * Description of
 */
class login_controller
{

    private $infosLogin = array();

    private $InfosUtilisateur;

    private $Handshake = false;

    private $allUsers = array();

    function __construct()
    {
        if (isset($_GET['userID'])==false){
            $this->infosLogin[0] = isset($_POST['courriel']) ? $_POST['courriel'] : null;
            $this->infosLogin[1] = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : null;
        } else {
            $this->infosLogin[0] = $_GET['courriel'];
            $this->infosLogin[1] = $_GET['mot_de_passe'];
            echo $this->infosLogin[0] . " " . $this->infosLogin[1];
            
        }
        $this->InfosUtilisateur = new InfoUtilisateur();
        $this->allUsers = $this->InfosUtilisateur->getListOfAllDBObjects();
       
    }

    function login()
    {
        
        foreach ($this->allUsers as $row) {
            if ($row['courriel'] == $this->infosLogin[0] && $row['mot_de_passe'] == $this->infosLogin[1]) {
                echo "success";
                $this->Handshake = true;
            }
        }
    }
    
    function getInfosUtilisateur(){
        return $this->InfosUtilisateur;
    }
    
    function getInfosLogin(){
        return $this->infosLogin;
    }
    
   

    function getHs()
    {
        return $this->Handshake;
    }
}

    $loginControl = new login_controller();
    $loginControl->login();

    if ($loginControl->getHs() == true) {
        $iduser = $loginControl->getInfosUtilisateur()->getPk($loginControl->getInfosLogin()[0]);
        $typeuser = $loginControl->getInfosUtilisateur()->getAdmin($loginControl->getInfosLogin()[0]);
        $_SESSION['id'] = $iduser;
        $_SESSION['admin'] = $typeuser;
        $_SESSION['panier'] = array();
        echo $typeuser;
        if ($_SESSION['admin'] == 1){
            header("Location: http://localhost/infoplusplus/Info++/service.php");
        }else{
            header("Location: http://localhost/infoplusplus/Info++/catalogue.php");
            exit();
        }
    } else{
        header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=1");
        exit();
    }


?>