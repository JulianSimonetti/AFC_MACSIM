<?php

require_once ("include/class.Frais.inc.php");
require_once ("include/class.FicheFrais.inc.php");

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
            
            $FF = new FicheFrais($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois']);
            $FF->initAvecInfosBDD();
            $lignes = $FF->getLesFraisForfaitises();
            $etat = $FF->getLibelleEtat();
            $nbJustificatifs = $FF->getNbJustificatifs();
            $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();
            
            
            include("vues/v_sommaire.php");
            include("vues/v_valideFraisCorpsFiche.php");
            
            unset($FF);
            
            break;
        
        }
}
