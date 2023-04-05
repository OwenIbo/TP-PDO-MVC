<?php ob_start();
session_start();
include ("vues/header.php");
include ("modeles/Continent.php");
include ("modeles/monPdo.php");
include ("vues/messagesFlash.php");
include("modeles/Nationalite.php");

$uc = empty($_GET['uc']) ? "Accueil" : $_GET['uc'];

switch ($uc) {
	case 'Accueil':
		include('vues/Accueil.php');
		break;
	case 'continent' : 
		include('Controllers/continentController.php');
		break;
	case 'nationalite' :
		include('Controllers/nationaliteController.php');
		break;
}

 include "vues/footer.php";
?>
