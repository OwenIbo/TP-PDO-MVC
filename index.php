<?php session_start();
include "vues/header.php";
include "modeles/Continent.php";
include "modeles/monPdo.php";

$uc = empty($_GET['uc']) ? "Accueil" : $_GET['uc'];

switch ($uc) {
	case 'Accueil':
		include('vues/Accueil.php');
		break;
	case 'continents' : 
		include('Controllers/continentController.php');
		break;
}

 include "vues/footer.php";
?>
