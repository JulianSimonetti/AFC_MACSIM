<?php

session_start();
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");

include("vues/v_entete.php");

$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();

if (!isset($_REQUEST['uc']) || !$estConnecte) {
    $_REQUEST['uc'] = 'connexion';
}

$uc = $_REQUEST['uc'];

switch ($uc) {
    case 'connexion': {
            include("Controleurs/c_connexion.php");
            break;
        }
    case 'validerFicheFrais': {
            include("Controleurs/c_valideFrais.php");
            break;
        }
    case 'cloturerSaisieFichesFrais': {
            include("Controleurs/c_clotureFichesSaisie.php");
            break;
        }
}

include("vues/v_pied.php");
?>

