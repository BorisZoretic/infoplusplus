<?php
/****************************************************************
 Fichier : inscription_controller.php
 Auteur : 
 Fonctionnalité : 
 Vérification:
 
 ======================================================
 
 Dernière modification:
 
 *****************************************************************/
require_once 'info_client.php';
require_once 'info_utilisateur.php';

/**
 * Description of
 */
class utilisateur_controller
{

    private $infosInscription = [];

    private $InfosUtilisateur;

    private $InfosClient;

    private $InfosAdresse;

    function __construct()
    {
        $this->infosInscription[0] = isset($_POST['nom_client']) ? $_POST['nom_client'] : null;
        $this->infosInscription[1] = isset($_POST['prenom_client']) ? $_POST['prenom_client'] : null;
        $this->infosInscription[2] = isset($_POST['no_civic']) ? $_POST['no_civic'] : null;
        $this->infosInscription[3] = isset($_POST['rue']) ? $_POST['rue'] : null;
        $this->infosInscription[4] = isset($_POST['ville']) ? $_POST['ville'] : null;
        $this->infosInscription[5] = isset($_POST['code_postale']) ? $_POST['code_postale'] : null;
        $this->infosInscription[6] = isset($_POST['numero_telephone']) ? $_POST['numero_telephone'] : null;
        $this->infosInscription[7] = isset($_POST['courriel']) ? $_POST['courriel'] : null;
        $this->infosInscription[8] = isset($_POST['mot_passe']) ? $_POST['mot_passe'] : null;
        
        $this->InfosUtilisateur = new InfoUtilisateur();
        $this->InfosClient = new InfoClient();
        $this->InfosAdresse = new InfoAdresse();
        
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
        
        //Ajout adresse
        $this->InfosAdresse->setPk_adresse($this->InfosAdresse->addDBObject());
        echo $this->InfosAdresse->getPk_adresse();
        /* Infos Client #3*/
        $this->InfosClient->setFk_adresse($this->InfosAdresse->getPk_adresse());   
        
    }

    function ajouterClient()
    {
        $this->InfosClient->setNom($this->infosInscription[0]);
        $this->InfosClient->setPrenom($this->infosInscription[1]);
        $this->InfosClient->setFk_adresse($this->infosInscription[1]);
    }
}



if ($erreur == 0) {
    header("Location: http://localhost/Presentation/VueGestionnaireClient");
    exit();
} else if ($erreur == 1) {
    header("Location: http://localhost/Presentation/VueAjouterClient?erreur=1");
    exit();
}