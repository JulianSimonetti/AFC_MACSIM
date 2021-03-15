<?php

if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'choixInitialVisiteur';
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'choixInitialVisiteur': {

            include("vues/v_sommaire.php");
            include("Vues/v_valideFraisChoixVisiteur.php");

            break;
        }
    case 'afficherFicheFraisSelectionnee': {
            $_SESSION['ff_idVisiteur'] = $_REQUEST['lstVisiteur'];
            $_SESSION['ff_mois'] = $_REQUEST['txtMoisFiche'];
            break;
        }
}
