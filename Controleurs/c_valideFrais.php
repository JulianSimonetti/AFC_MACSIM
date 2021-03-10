<?php

if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'choixInitialVisiteur';
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'choixInitialVisiteur': {
            include("Vues/formValidFrais.htm");
            break;
        }
    case 'afficherFicheFraisSelectionnee': {
            break;
        }
}
