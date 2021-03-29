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
        include("vues/v_sommaire.php");

        $nbFichesACloturer = $pdo->getNbFichesACloturer(affichageMois());
        if ($nbFichesACloturer <= 0) {
            ajouterErreur("Il n'y a pas de fiches à clôturer pour le mois " . affichageMois() . " !");
            include("vues/v_erreurs.php");
        } else {
            $message = "Êtes-vous sûr.e de vouloir clôturer les fiches du mois de " . affichageMois() . " ?"
                    . "<br />Il y aura " . $pdo->getNbFichesACloturer(affichageMois()) . " fiches à clôturer.";
            include("vues/v_messageOuiNon.php");
        }
        break;

    case 'traiterReponseClotureFiches':
        include("vues/v_sommaire.php");

        $nbClotures = $pdo->cloturerFichesFrais($_POST['mois']);

        $message = "$nbClotures fiches ont bien été clôturées.";
        include("Vues/v_message.php");
        break;

    default:
        break;
}
