<?php

require_once ("include/class.Frais.inc.php");
require_once ("include/class.FicheFrais.inc.php");

if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demanderConfirmationClotureFiches';
}
$action = $_REQUEST['action'];

$pdo = PdoGsb::getPdoGsb();

switch ($action) {
    case 'demanderConfirmationClotureFiches':
        $message = "Êtes-vous sûr.e de vouloir clôturer les fiches du mois de " . affichageMois() . " ?"
                . "<br />Il y aura " . $pdo->getNbFichesACloturer(affichageMois()) . " fiches à clôturer.";

        break;

    case 'traiterReponseClotureFiches':
        include("vues/v_sommaire.php");

        $pdo->

        $message = "Les fiches ont bien été clôturées.";
        include("Vues/v_message.php");
        break;

    default:
        break;
}
