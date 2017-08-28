<?php
/****************************************************************
		Fichier : inscription_controller.php
		Auteur : 
		Fonctionnalité : 
			Vérification:
			
			======================================================
			
			Dernière modification:
			
*****************************************************************/

require_once '';
require_once'info_utilisateur.php';
/**
 * Description of 
 *
 */
class utilisateur_controller {
   private $infosInscription=[];
   private $InfosUtilisateur;
           
   function __construct() {
        $this->infosInscription[0] = isset($_POST['nom_client']) ? $_POST['nom_client'] : null;
        $this->infosInscription[1] = isset($_POST['prenom_client']) ? $_POST['prenom_client'] : null;
        $this->infosInscription[2] = isset($_POST['no_civic']) ? $_POST['no_civic'] : null;
        $this->infosInscription[3] = isset($_POST['rue']) ? $_POST['rue'] : null;
        $this->infosInscription[4] = isset($_POST['code_postale']) ? $_POST['code_postale'] : null;
        $this->infosInscription[5] = isset($_POST['numero_telephone']) ? $_POST['numero_telephone'] : null;
        $this->infosInscription[6] = isset($_POST['courriel']) ? $_POST['courriel'] : null;
        $this->infosInscription[7] = isset($_POST['mot_passe']) ? $_POST['mot_passe'] : null;
        $this->InfosUtilisateur = new InfoUtilisateur();
       
        
   }
   
   
   function ajouterClient(){
       return $this->gestionnaireClient->ajouterClient($this->infosInscription);
   }
   
}



$controlAjoutClient = new ControleurAjouterClient();
$erreur = $controlAjoutClient->ajouterClient();

if($erreur == 0)
{ 
    header("Location: http://localhost/Presentation/VueGestionnaireClient");
    exit;
}
else if($erreur == 1){
    header("Location: http://localhost/Presentation/VueAjouterClient?erreur=1");
    exit;
}