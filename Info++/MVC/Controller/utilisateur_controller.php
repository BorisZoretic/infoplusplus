<?php
/****************************************************************
 Fichier : utilisateur_controller.php
 Auteur : 
 Fonctionnalité : 
 Vérification:
 
 ======================================================
 
 Dernière modification:
 
 *****************************************************************/
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_client.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_utilisateur.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_adresse.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ville.php';

/**
 * Description of
 */
class utilisateur_controller
{

    private $infosInscription = [];

    private $InfosUtilisateur;

    private $InfosClient;

    private $InfosAdresse;

    private $InfosVille;

    private $allUsers = array();

    private $Duplicate = false;

    function __construct()
    {
        $this->infosInscription[0] = isset($_POST['nom']) ? $_POST['nom'] : null;
        $this->infosInscription[1] = isset($_POST['prenom']) ? $_POST['prenom'] : null;
        $this->infosInscription[2] = isset($_POST['civic']) ? $_POST['civic'] : null;
        $this->infosInscription[3] = isset($_POST['rue']) ? $_POST['rue'] : null;
        $this->infosInscription[4] = isset($_POST['ville']) ? $_POST['ville'] : null;
        $this->infosInscription[5] = isset($_POST['codepostal']) ? $_POST['codepostal'] : null;
        $this->infosInscription[6] = isset($_POST['telephone']) ? $_POST['telephone'] : null;
        $this->infosInscription[7] = isset($_POST['email']) ? $_POST['email'] : null;
        $this->infosInscription[8] = isset($_POST['password']) ? $_POST['password'] : null;
        $this->infosInscription[9] = isset($_POST['infolettre']) ? '1' : '0';
        $this->infosInscription[10] = isset($_POST['primary']) ? $_POST['primary'] : null;
        $this->InfosUtilisateur = new InfoUtilisateur();
        $this->InfosClient = new InfoClient();
        $this->InfosAdresse = new InfoAdresse();
        $this->InfosVille = new InfoVille();
        
        $this->allUsers = $this->InfosUtilisateur->getListOfAllDBObjects();
    }

    function verifyEmails()
    {
        foreach ($this->allUsers as $row) {
            if ($row['courriel'] == $this->infosInscription[7]) {
                
                $this->Duplicate = true;
                if (isset($_POST['primary'])){                    
                    $this->InfosUtilisateur->getObjectFromDB($this->infosInscription[10]);
                    $this->InfosClient->getClientWithUserFK($this->infosInscription[10]);
                    $this->InfosAdresse->getObjectFromDB($this->InfosClient->getFk_adresse());
                    $this->InfosVille->getObjectFromDB($this->InfosAdresse->getFk_ville());    
                }
                
                
               
            }
        }
    }

    function getDuplicate()
    {
        return $this->Duplicate;
    }

    function ajouterClient()
    {
        $this->verifyEmails();
        if ($this->getDuplicate() == false) {
            
            /* Infos Client #1 */
            $this->InfosClient->setNom($this->infosInscription[0]);
            $this->InfosClient->setPrenom($this->infosInscription[1]);
            
            /* Infos Adresse */
            $this->InfosAdresse->setNo_civique($this->infosInscription[2]);
            $this->InfosAdresse->setRue($this->infosInscription[3]);
            $this->InfosAdresse->setFk_ville($this->infosInscription[4]);
            $this->InfosAdresse->setCode_postal($this->infosInscription[5]);
            
            /* Infos Client #2 */
            $this->InfosClient->setTelephone($this->infosInscription[6]);
            
            /* Infos Utilisateur */
            $this->InfosUtilisateur->setCourriel($this->infosInscription[7]);
            $this->InfosUtilisateur->setMot_de_passe($this->infosInscription[8]);
            $this->InfosUtilisateur->setAdministration('0');
            // Ajout adresse
            $this->InfosAdresse->setPk_adresse($this->InfosAdresse->addDBObject());
            
            /* Infos Client #3 */
            $this->InfosClient->setFk_adresse($this->InfosAdresse->getPk_adresse());
            $this->InfosClient->setInfolettre($this->infosInscription[9]);
            
            $this->InfosClient->setFk_utilisateur($this->InfosUtilisateur->addDBObject());
            $this->InfosClient->addDBObject();
        }
        elseif ($_GET['mod']==1) {
            /* Infos Client #1 */
            $this->InfosClient->setNom($this->infosInscription[0]);
            $this->InfosClient->setPrenom($this->infosInscription[1]);            
            $this->InfosClient->setTelephone($this->infosInscription[6]);           
            $this->InfosClient->setInfolettre($this->infosInscription[9]);            
            $this->InfosClient->updateDBObject();
            
            /* Infos Adresse */
            $this->InfosAdresse->setNo_civique($this->infosInscription[2]);
            $this->InfosAdresse->setRue($this->infosInscription[3]);
            $this->InfosAdresse->setFk_ville($this->infosInscription[4]);
            $this->InfosAdresse->setCode_postal($this->infosInscription[5]);
            $this->InfosAdresse->updateDBObject();
            
            
            /* Infos Utilisateur */
            $this->InfosUtilisateur->setCourriel($this->infosInscription[7]);
            $this->InfosUtilisateur->setMot_de_passe($this->infosInscription[8]);
            $this->InfosUtilisateur->updateDBObject();
                        
            
            
        }
    }
}

$inscription = new utilisateur_controller();
$inscription->ajouterClient();
if($inscription->getDuplicate()==true && isset($_GET['mod'])==false ){
    header("Location: http://localhost/infoplusplus/Info++/inscription.php?duplicate=1");
    exit();
}
elseif(isset($_GET['mod'])==true ){
    header("Location: http://localhost/infoplusplus/Info++/catalogue.php");
    exit();
}
else{
header("Location: http://localhost/infoplusplus/Info++/index.php");
exit();
}
