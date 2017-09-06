
<?php

    
    $anObject = null;
    require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_client.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/infoplusplus/Info++/MVC/Model/info_ville.php';
    $Villes = new InfoVille();
    
    $client = new InfoClient();
    
    $anObject = $client->getInscription(4);
    
    
    echo "<input name='nom' id='lname' class='inputMarginWidth' placeholder='Nom' value='". $anObject['nom'] ."'></input>";
    echo "<input name='prenom' id='fname' class='inputMarginWidth' placeholder='Prénom' value='". $anObject['prenom'] ."'></input>
    <br> <input name='civic' id='streetadd' class='inputMarginWidthCivic'
        placeholder='No civic' value='". $anObject['no_civique'] ."'></input> <input name='rue' id='sname'
            class='inputMarginWidthRue' placeholder='Rue' value='". $anObject['rue'] ."'></input> <br> <input name='codepostal' id='zip' class='inputMarginWidth'
                placeholder='Code postale' value='". $anObject['code_postal'] ."'></input> <input name='telephone'
                    class='inputMarginWidth' placeholder='Numéro de téléphone' value='". $anObject['telephone'] ."'></input><select
				name='ville' id='villes' class='inputMarginWidth'>". $Villes->getActiveObjectsAsSelect() ."</select>
                    <br> <br> <br>
                    <h4>Votre courriel servira à vous identifier lors de votre prochaine
                    visite</h4>
                    <h5>Le mot de passe doit contenir un chiffre, une lettre et 8
                    caractères au mininum</h5>
                    <input name='email' id='ema' class='inputMarginWidth'
                        placeholder='Adresse courriel' value='". $anObject['courriel'] ."'></input> <input name='emailconfirm'
                            id='emailconf' class='inputMarginWidth'
                                placeholder='Confirmez adresse courriel' onBlur='confirmEmail()' value='". $anObject['courriel'] ."'></input>
                                <br> <input type='password' id='pass' name='password'
                                    class='inputMarginWidth' placeholder='Mot de passe' value='". $anObject['mot_de_passe'] ."'></input> <input
                                    type='password' name='passwordconfirm' id='passwordconf'
                                        class='inputMarginWidth' placeholder='Confirmer mot de passe'
                                            onBlur='confirmPass()' value='". $anObject['mot_de_passe'] ."'></input> <br>
                                            <button class='buttonConfirmer'>Confirmer</button>"
    
    
?>
