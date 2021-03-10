<?php

if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'choixInitialVisiteur';
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'choixInitialVisiteur': {
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
            $visiteur = $pdo->getInfosVisiteur($login, $mdp);
            if (!is_array($visiteur)) {
                ajouterErreur("Gégé on a perdu la liste");
                include("vues/v_erreurs.php");
            } else {
                $nom = $visiteur['nom'];
                include("vues/v_sommaire.php");
                include("Vues/formValidFrais.htm");
            }

            break;
        }
    case 'afficherFicheFraisSelectionnee': {
            break;
        }
}
