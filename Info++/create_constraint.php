<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'infoplusplus';
$conn = new mysqli($dbhost, $dbuser, $dbpass);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo 'Connected successfully';
}
echo "<br>";

$sql = 'ALTER TABLE `adresse`
        ADD CONSTRAINT `fk_ville_v_fk` FOREIGN KEY (`fk_ville`) REFERENCES `ville` (`pk_ville`) ON DELETE NO ACTION ON UPDATE NO ACTION;';
echo $sql . "<br> ALTER TABLE `bankholiday_payement` ADD CONSTRAINT `bankholiday_payement_p_fk` FOREIGN KEY (`id_payement`)
REFERENCES `payements`(`id_payement`) ON DELETE CASCADE ON UPDATE CASCADE; <br>";
if (!$result = $conn->query($sql)) {
    // Oh no! The query failed.
    echo "<span style='color:red;'>Could not alter table adresse</span>";
    //exit;
}
else{
    echo "<span style='color:green;'>Index for table adresse created successfully</span>\n";
}
    
echo "<br>";

$sql = "ALTER TABLE `infoplusplus`.`client`
        ADD CONSTRAINT `fk_adresse` FOREIGN KEY (`fk_adresse`) REFERENCES `adresse` (`pk_adresse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`fk_utilisateur`) REFERENCES `utilisateur` (`pk_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;";
if (!$result = $conn->query($sql)) {
    // Oh no! The query failed.
    echo "<span style='color:red;'>Could not alter table client</span>";
    //exit;
}
else{
    echo "<span style='color:green;'>Index for table client created successfully</span>\n";
}

echo "<br>";

$sql = "ALTER TABLE `infoplusplus`.`facture`
        ADD CONSTRAINT `fk_client` FOREIGN KEY (`fk_client`) REFERENCES `client` (`pk_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;";
if (!$result = $conn->query($sql)) {
    // Oh no! The query failed.
    echo "<span style='color:red;'>Could not alter table facture</span>";
    //exit;
}
else{
    echo "<span style='color:green;'>Index for table facture created successfully</span>\n";
}

echo "<br>";

$sql = "ALTER TABLE `infoplusplus`.`ta_facture_service`
        ADD CONSTRAINT `fk_facture` FOREIGN KEY (`fk_facture`) REFERENCES `facture` (`pk_facture`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        ADD CONSTRAINT `fk_service1` FOREIGN KEY (`fk_service`) REFERENCES `service` (`pk_service`) ON DELETE NO ACTION ON UPDATE NO ACTION;";
if (!$result = $conn->query($sql)) {
    // Oh no! The query failed.
    echo "<span style='color:red;'>Could not alter table ta_facture_service</span>";
    //exit;
}
else{
    echo "<span style='color:green;'>Index for table ta_facture_service created successfully</span>\n";
}

echo "<br>";

$sql = "ALTER TABLE `infoplusplus`.`ta_promotion_service`
        ADD CONSTRAINT `fk_promotion` FOREIGN KEY (`fk_promotion`) REFERENCES `promotion` (`pk_promotion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        ADD CONSTRAINT `fk_service` FOREIGN KEY (`fk_service`) REFERENCES `service` (`pk_service`) ON DELETE NO ACTION ON UPDATE NO ACTION;";
if (!$result = $conn->query($sql)) {
    // Oh no! The query failed.
    echo "<span style='color:red;'>Could not alter table ta_promotion_service</span>";
    //exit;
}
else{
    echo "<span style='color:green;'>Index for table ta_promotion_service created successfully</span>\n";
}                    