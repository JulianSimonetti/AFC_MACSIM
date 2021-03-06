<?php

require_once ("include/class.Frais.inc.php");
require_once ("include/class.FicheFrais.inc.php");

if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'choixInitialVisiteur';
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'choixInitialVisiteur':

        include("vues/v_sommaire.php");
        include("Vues/v_valideFraisChoixVisiteur.php");

        break;
    case 'afficherFicheFraisSelectionnee':
        include("vues/v_sommaire.php");
        $_SESSION['ff_idVisiteur'] = $_REQUEST['lstVisiteur'];
        $_SESSION['ff_mois'] = $_REQUEST['txtMoisFiche'];

        $FF = new FicheFrais($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois']);
        $FF->initAvecInfosBDD();
        if ($FF->getCodeEtat() == "00") {
            ajouterErreur($_SESSION['ff_idVisiteur'] . " n'a pas rempli de fiche de frais pour le " . $_SESSION['ff_mois']);
            include("vues/v_erreurs.php");
        } else {
            $lignes = $FF->getLesFraisForfaitises();

            $lesFHF = $FF->getLesInfosFraisHorsForfait();


            $etp = $lignes['1']->getQuantite();
            $km = $lignes['2']->getQuantite();
            $nui = $lignes['3']->getQuantite();
            $rep = $lignes['4']->getQuantite();

            $etat = $FF->getLibelleEtat();
            $nbJustificatifs = $FF->getNbJustificatifs();
            $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();
            $montantTotal = $FF->calculerLeMontantValide();

            include("vues/v_valideFraisCorpsFiche.php");
            unset($FF);
            if (!estDansPeriodeValidation()) {
                estVerrouille();
            }
        }
        break;

    case 'enregModifFF':
        $FF = new FicheFrais($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois']);
        $FF->initInfosFicheSansFF();
        $FF->ajouterUnFraisForfaitise('ETP', (int) $_POST['txtEtape']);
        $FF->ajouterUnFraisForfaitise('KM', (int) $_POST['txtKm']);
        $FF->ajouterUnFraisForfaitise('NUI', (int) $_POST['txtNuitee']);
        $FF->ajouterUnFraisForfaitise('REP', (int) $_POST['txtRepas']);

        $resMAJ = $FF->mettreAJourLesFraisForfaitises();

        $etat = $FF->getLibelleEtat();
        $nbJustificatifs = $FF->getNbJustificatifs();
        $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();
        $montantTotal = $FF->calculerLeMontantValide();

        $lignes = $FF->getLesFraisForfaitises();

        $etp = $lignes['1']->getQuantite();
        $km = $lignes['2']->getQuantite();
        $nui = $lignes['3']->getQuantite();
        $rep = $lignes['4']->getQuantite();

        include("vues/v_sommaire.php");
        include("vues/v_valideFraisCorpsFiche.php");
        break;
    case 'enregModifFHF':
        $FF = new FicheFrais($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois']);
        $FF->initAvecInfosBDDSansFHF();

        $countFHF = $_POST['countFHF'];
        for ($i = 5; $i <= $countFHF + 4;  $i++) {
            $FF->ajouterUnFraisHorsForfait((int) $_POST['numFHF_N'.$i], $_POST['txtLibelle_N'.$i], $_POST['txtDate_N'.$i], (float) $_POST['txtMontant_N'.$i], $_POST['Choix' . $_POST['numFHF']]);
        }

//        $FF->ajouterUnFraisHorsForfait((int) $_POST['numFHF'], $_POST['txtLibelle'], $_POST['txtDate'], (float) $_POST['txtMontant'], $_POST['Choix' . $_POST['numFHF']]);

        if ($FF->controlerNbJustificatifs()) {
            $resMAJ = $FF->mettreAJourLesFraisHorsForfait();
        } else {
            $resMAJ = "Le nombre de justificatifs est incorrect.";
        }

        $lignes = $FF->getLesFraisForfaitises();

        $lesFHF = $FF->getLesInfosFraisHorsForfait();


        $etp = $lignes['1']->getQuantite();
        $km = $lignes['2']->getQuantite();
        $nui = $lignes['3']->getQuantite();
        $rep = $lignes['4']->getQuantite();

        $etat = $FF->getLibelleEtat();
        $nbJustificatifs = $FF->getNbJustificatifs();
        $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();
        $montantTotal = $FF->calculerLeMontantValide();


        include("vues/v_sommaire.php");
        include("vues/v_valideFraisCorpsFiche.php");
        unset($FF);

        break;

    case 'validerFicheFrais':
        include("vues/v_sommaire.php");
        $FF = new FicheFrais($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois']);
        $FF->initAvecInfosBDD();
        if ($FF->getCodeEtat() != "CL") {
            switch ($FF->getCodeEtat()) {
                case 'RB':
                    ajouterErreur("La fiche de frais de " . $_SESSION['ff_idVisiteur'] . " du " . $_SESSION['ff_mois'] . " a d??j?? ??t?? rembours??e");
                    include("vues/v_erreurs.php");
                    break;
                case 'VA':
                    ajouterErreur("La fiche de frais de " . $_SESSION['ff_idVisiteur'] . " du " . $_SESSION['ff_mois'] . " a d??j?? ??t?? valid??e");
                    include("vues/v_erreurs.php");
                    break;
                default :
                    ajouterErreur("La fiche de frais de " . $_SESSION['ff_idVisiteur'] . " du " . $_SESSION['ff_mois'] . " n'est pas clotur??e");
                    include("vues/v_erreurs.php");
                    break;
            }
        } else {

            $FF->valider();


            $lignes = $FF->getLesFraisForfaitises();

            $lesFHF = $FF->getLesInfosFraisHorsForfait();


            $etp = $lignes['1']->getQuantite();
            $km = $lignes['2']->getQuantite();
            $nui = $lignes['3']->getQuantite();
            $rep = $lignes['4']->getQuantite();

            $etat = $FF->getLibelleEtat();
            $nbJustificatifs = $FF->getNbJustificatifs();
            $lesQuantites = $FF->getLesQuantitesDeFraisForfaitises();
            $montantTotal = $FF->calculerLeMontantValide();

            $message = "La fiche a ??t?? valid??e avec succ??s.";
            include("vues/v_message.php");
            include("vues/v_valideFraisCorpsFiche.php");
            estVerrouille();
            unset($FF);
        }

        break;

    default:
        break;
}
    
