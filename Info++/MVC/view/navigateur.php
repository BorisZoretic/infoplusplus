<?php
echo "<div class='headerbg'>
<img class='logo' src='images/icones/logo.png' title='logo' alt='logo'>
<div class='topliens'>";

if(!isset($_SESSION['admin'])) {
    header("Location: http://localhost/infoplusplus/Info++/index.php?erreur=2");
    exit();
}
if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['admin']==0) {/*. '(' . count($_SESSION['panier']) . ')';*/
    echo "<div class='nav'><a class='lien' href='panier.php'>Mon panier". "(" . count($_SESSION['panier']) . ")" . "</a>
                <a class='lien' href='logout.php'>Se déconnecter</a> <br>
                <a class='navigation2' href='catalogue.php'>Catalogue</a><a class='navigation2' href='profile.php'>Profil</a>
                <input type='text' class='searchTerm' placeholder='Recherche'>
                <button type='submit' class='searchButton'><label>S</label></button></div>";
}
else if(session_status() == PHP_SESSION_ACTIVE && $_SESSION['admin']==1)
{
    echo "<div class='nav'><a class='lien' href='logout.php'>Se déconnecter</a><br>
                <a class='navigation2' href='service.php'>Service</a>
                <a class='navigation2' href='facture.php'>Facture</a>
                <input type='text' class='searchTerm' placeholder='Recherche'>
                <button type='submit' class='searchButton'><label>S</label></button></div>";
}


echo "</div></div>";


?>