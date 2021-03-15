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
            
            $etp = null;
            $nui = null;
            $rep = null;
            $km = null;
            
            foreach ($lignes as &$uneLigne) {
                switch ($uneLigne['CFF_ID']) {
                    case 'ETP':
                        $etp = $uneLigne['LFF_QTE'];
                        break;
                    case 'NUI':
                        $nui = $uneLigne['LFF_QTE'];
                        break;
                    case 'REP':
                        $rep = $uneLigne['LFF_QTE'];
                        break;
                    case 'KM':
                        $km = $uneLigne['LFF_QTE'];
                        break;
                }
            }
            $etat = $FF->getLibelleEtat();
            $nbJustificatifs = $FF->getNbJustificatifs();
            $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();
            
            
            include("vues/v_sommaire.php");
            include("vues/v_valideFraisCorpsFiche.php");
            
            unset($FF);
            
            break;
        
        }
}
