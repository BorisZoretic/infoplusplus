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
echo $_GET['erreur'];
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
        $this->infosLogin[0] = isset($_POST['courriel']) ? $_POST['courriel'] : "suce";
        $this->infosLogin[1] = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : "suce";
        $this->InfosUtilisateur = new InfoUtilisateur();
        $this->allUsers = $this->InfosUtilisateur->getListOfAllDBObjects();
        echo $_POST['courriel'] . " et " . $_POST['mot_de_passe'];
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

    function getHs()
    {
        return $this->Handshake;
    }
}

$loginControl = new login_controller();
$loginControl->login();

if ($loginControl->getHs() == true) {
    header("Location: http://localhost/infoplusplus/Info++/catalogue.php");
    exit();
}
else{
    header("Location: http://localhost/infoplusplus/Info++/login.php?erreur=1");
    exit();
}

?>