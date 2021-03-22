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
            
            $lesFHF = $FF->getLesInfosFraisHorsForfait();
            

            $etp = $lignes['1']->getQuantite();
            $km = $lignes['2']->getQuantite();
            $nui = $lignes['3']->getQuantite();
            $rep = $lignes['4']->getQuantite();

            $etat = $FF->getLibelleEtat();
            $nbJustificatifs = $FF->getNbJustificatifs();
            $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();


            include("vues/v_sommaire.php");
            include("vues/v_valideFraisCorpsFiche.php");
            unset($FF);
            break;
        }
    case'enregModifFF': {
            $FF = new FicheFrais($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois']);
            $FF->initInfosFicheSansLesFrais();
            $FF->ajouterUnFraisForfaitise('ETP', (int)$_POST['txtEtape']);
            $FF->ajouterUnFraisForfaitise('KM', (int)$_POST['txtKm']);
            $FF->ajouterUnFraisForfaitise('NUI', (int)$_POST['txtNuitee']);
            $FF->ajouterUnFraisForfaitise('REP', (int)$_POST['txtRepas']);
            
            $resMAJ = $FF->mettreAJourLesFraisForfaitises($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois']);
            
            $etat = $FF->getLibelleEtat();
            $nbJustificatifs = $FF->getNbJustificatifs();
            $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();
            
            $lignes = $FF->getLesFraisForfaitises();

            $etp = $lignes['1']->getQuantite();
            $km = $lignes['2']->getQuantite();
            $nui = $lignes['3']->getQuantite();
            $rep = $lignes['4']->getQuantite();
            
            include("vues/v_sommaire.php");
            include("vues/v_valideFraisCorpsFiche.php");
            break;
        }
}
