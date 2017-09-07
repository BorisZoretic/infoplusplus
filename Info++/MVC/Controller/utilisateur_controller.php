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
        
        
        $this->InfosUtilisateur = new InfoUtilisateur();
        $this->InfosClient = new InfoClient();
        $this->InfosAdresse = new InfoAdresse();
        $this->InfosVille = new InfoVille();
        
        
        
    }

    function ajouterClient()
    {
        /* Infos Client #1*/
        $this->InfosClient->setNom($this->infosInscription[0]);
        $this->InfosClient->setPrenom($this->infosInscription[1]);
        
        /* Infos Adresse */
        $this->InfosAdresse->setNo_civique($this->infosInscription[2]);
        $this->InfosAdresse->setRue($this->infosInscription[3]);
        $this->InfosAdresse->setFk_ville($this->infosInscription[4]);
        $this->InfosAdresse->setCode_postal($this->infosInscription[5]);
        
        /* Infos Client #2*/
        $this->InfosClient->setTelephone($this->infosInscription[6]);
        
        /* Infos Utilisateur*/
        $this->InfosUtilisateur->setCourriel($this->infosInscription[7]);
        $this->InfosUtilisateur->setMot_de_passe($this->infosInscription[8]);
        $this->InfosUtilisateur->setAdministration('0');
        //Ajout adresse
        $this->InfosAdresse->setPk_adresse($this->InfosAdresse->addDBObject());
       
        /* Infos Client #3*/
        $this->InfosClient->setFk_adresse($this->InfosAdresse->getPk_adresse());
        $this->InfosClient->setInfolettre($this->infosInscription[9]);
        
        $this->InfosClient->setFk_utilisateur($this->InfosUtilisateur->addDBObject());
        $this->InfosClient->addDBObject();
        
        
    }
}

$inscription = new utilisateur_controller();
$inscription->ajouterClient();

