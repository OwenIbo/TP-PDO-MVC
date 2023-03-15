<?php session_start(); ?>
<?php include "vues/header.php";

$uc = empty($_GET['uc']) ? "Accueil" : $_GET['uc'];

switch ($uc) {
	case 'Accueil':
		include('vues/Accueil.php');
		break;
	case 'continents' : 
		break;
}

 include "vues/footer.php";
?>
