<?php

require_once './Include/class.pdogsb.inc.php';
require_once './Include/fct.inc.php';
require_once './Include/class.Frais.inc.php';

final class FicheFrais {

    private static $pdo;
    private $idVisiteur;
    private $moisFiche;
    private $nbJustificatifs = 0;
    private $montantValide = 0;
    private $dateDerniereModif;
    private $idEtat;
    private $libelleEtat;

    /**
     * On utilise 2 collections pour stocker les frais :
     * plus efficace car on doit extraire soit les FF soit les FHF.
     * Avec une seule collection on serait toujours obligé de parcourir et
     * de tester le type de tous les frais avant de les extraires.
     *
     */
    private $lesFraisForfaitises = []; // Un tableau asociatif de la forme : <idCategorie>, <objet FraisForfaitise>
    private $lesFraisHorsForfait = [];

    /**
     * Un tableau des numéros de ligne des frais forfaitisés.
     * Les lignes de frais forfaitisés sont numérotées en fonction de leur catégorie.
     * Le tableau est static ce qui évite de le déclarer dans chaque instance de
     * FicheFrais.
     *
     */
    static private $tabNumLigneFraisForfaitise = ['ETP' => 1,
        'KM' => 2,
        'NUI' => 3,
        'REP' => 4];

    function __construct($unIdVisiteur, $unMoisFiche) {
        self::$pdo = PdoGsb::getPdoGsb();
        $this->idVisiteur = $unIdVisiteur;
        $this->moisFiche = $unMoisFiche;
    }

    public function initAvecInfosBDD() {
        $this->initInfosFicheSansLesFrais();
        $this->initLesFraisForfaitises();
        $this->initLesFraisHorsForfait();
    }

    public function initAvecInfosBDDSansFF() {
        $this->initInfosFicheSansLesFrais();
        $this->initLesFraisHorsForfait();
    }

    public function initAvecInfosBDDSansFHF() {
        $this->initInfosFicheSansLesFrais();
        $this->initLesFraisForfaitises();
    }

    public function initInfosFicheSansLesFrais() {
        $resFiche = self::$pdo->getInfosFiche($this->idVisiteur, $this->moisFiche);
        if ($resFiche) {
            $this->nbJustificatifs = $resFiche['FICHE_NB_JUSTIFICATIFS'];
            $this->montantValide = $resFiche['FICHE_MONTANT_VALIDE'];
            $this->dateDerniereModif = $resFiche['FICHE_DATE_DERNIERE_MODIF'];
            $this->idEtat = $resFiche['EFF_ID'];
            $this->libelleEtat = $resFiche['EFF_LIBELLE'];
        } else {
            $this->nbJustificatifs = 0;
            $this->montantValide = 0;
            $this->dateDerniereModif = (new DateTime())->format('Y-m-d');
            $this->idEtat = '00';
        }
    }

    public function initLesFraisForfaitises() {
        $lesLignes = self::$pdo->getLignesFF($this->idVisiteur, $this->moisFiche);
        foreach ($lesLignes as &$uneLigne) {
            $this->lesFraisForfaitises['' . self::$tabNumLigneFraisForfaitise[trim($uneLigne['CFF_ID'])]] = new FraisForfaitise($this->idVisiteur, $this->moisFiche, self::$tabNumLigneFraisForfaitise[trim($uneLigne['CFF_ID'])], $uneLigne['LFF_QTE'], $uneLigne['CFF_ID']);
        }
    }

    public function initLesFraisHorsForfait() {
        $lesLignes = self::$pdo->getLignesFHF($this->idVisiteur, $this->moisFiche);
        foreach ($lesLignes as &$uneLigne) {
            $this->lesFraisHorsForfait['' . $uneLigne['FRAIS_NUM']] = new FraisHorsForfait($this->idVisiteur, $this->moisFiche, $uneLigne['FRAIS_NUM'], $uneLigne['LFHF_LIBELLE'], $uneLigne['LFHF_DATE'], $uneLigne['LFHF_MONTANT']);
        }
    }

    public function getLibelleEtat() {
        return $this->libelleEtat;
    }

    public function getNbJustificatifs() {
        return $this->nbJustificatifs;
    }

    /**
     *
     * Ajoute à la fiche de frais un frais forfaitisé (une ligne) dont
     * l'id de la catégorie et la quantité sont passés en paramètre.
     * Le numéro de la ligne est automatiquement calculé à partir de l'id de
     * sa catégorie.
     *
     * @param string $idCategorie L'ide de la catégorie du frais forfaitisé.
     * @param int $quantite Le nombre d'unité(s).
     */
    public function ajouterUnFraisForfaitise($idCategorie, $quantite) {
        $NouveauFrais = new FraisForfaitise($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois'], $this->getNumLigneFraisForfaitise($idCategorie), $quantite, $idCategorie);
        $this->lesFraisForfaitises['' . self::$tabNumLigneFraisForfaitise[$idCategorie]] = $NouveauFrais;
    }

    /**
     *
     * Ajoute à une fiche de frais une ligne de frais hors forfait.
     *
     * @param string $idCategorie L'ide de la catégorie du frais forfaitisé.
     * @param int $numFrais Le numéro de la ligne de frais hors forfait.
     * @param string $libelle Le libellé du frais.
     * @param string $date La date du frais, sous la forme AAAA-MM-JJ.
     * @param float $montant Le montant du frais.
     * @param string $action L'action à réaliser éventuellement sur le frais.
     */
    public function ajouterUnFraisHorsForfait($numFrais, $libelle, $date, $montant, $action = NULL) {
        $NouveauFrais = new FraisHorsForfait($_SESSION['ff_idVisiteur'], $_SESSION['ff_mois'], $numFrais, $libelle, $date, $montant, $action);
        $this->lesFraisHorsForfait[$numFrais] = $NouveauFrais;
    }

    /**
     *
     * Retourne la collection des frais forfaitisés de la fiche de frais.
     *
     * @return array La collections des frais forfaitisés.
     */
    public function getLesFraisForfaitises() {

        return $this->lesFraisForfaitises;
    }

    /**
     *
     * Retourne un tableau contenant les quantités pour chaque ligne de frais
     * forfaitisé de la fiche de frais.
     *
     * @return array Le tableau demandé.
     */
    public function getLesQuantitesDeFraisForfaitises() {
        $quantites = [];
        foreach ($this->lesFraisForfaitises as &$unFrais) {
            array_push($quantites, $unFrais->getQuantite());
        }
        return $quantites;
    }

    /**
     *
     * Retourne la collection des frais forfaitisés de la fiche de frais.
     *
     * @return array la collections des frais forfaitisés.
     */
    public function getLesFraisHorsForfait() {
        return $this->lesFraisHorsForfait;
    }

    /**
     *
     * Retourne un tableau associatif d'informations sur les frais hors forfait
     * de la fiche de frais :
     * - le numéro du frais (numFrais),
     * - son libellé (libelle),
     * - sa date (date),
     * - son montant (montant),
     * - Son action (action).
     * @return array Le tableau demandé.
     */
    public function getLesInfosFraisHorsForfait() {
        $lignes = array();
        if (count($this->lesFraisHorsForfait) > 0) {
            foreach ($this->lesFraisHorsForfait as &$unFrais) {
                $uneLigne = array();
                $uneLigne['NUM'] = $unFrais->getNumFrais();
                $uneLigne['LIB'] = $unFrais->getLibelle();
                $uneLigne['DATE'] = $unFrais->getDate();
                $uneLigne['MONTANT'] = $unFrais->getMontant();
                $uneLigne['ACTION'] = $unFrais->getAction();

                $lignes[$unFrais->getNumFrais()] = $uneLigne;
            }
            ksort($lignes);
            return $lignes;
        } else {
            return false;
        }
    }

    /**
     *
     * Retourne le numéro de ligne d'un frais forfaitisé dont l'identifiant de
     * la catégorie est passé en paramètre.
     * Chaque fiche de frais comporte systématiquement 4 lignes de frais forfaitisés.
     * Chaque ligne de frais forfaitisé correspond à une catégorie de frais forfaitisé.
     * Les lignes de frais forfaitisés d'une fiche sont numérotées de 1 à 4.
     * Ce numéro dépend de la catégorie de frais forfaitisé :
     * - ETP : 1,
     * - KM  : 2,
     * - NUI : 3,
     * - REP : 4.
     *
     * @param string $idCategorieFraisForfaitise L'identifiant de la catégorie de frais forfaitisé.
     * @return int Le numéro de ligne du frais.
     *
     */
    private function getNumLigneFraisForfaitise($idCategorieFraisForfaitise) {
        return self::$tabNumLigneFraisForfaitise[$idCategorieFraisForfaitise];
    }

    /**
     *
     * Contrôle que les quantités de frais forfaitisés passées en paramètre
     * dans un tableau sont bien des numériques entiers et positifs.
     * Cette méthode s'appuie sur la fonction lesQteFraisValides().
     *
     * @return booléen Le résultat du contrôle.
     */
    public function controlerQtesFraisForfaitises() {
        return lesQteFraisValides(getLesQuantitesDeFraisForfaitises());
    }

    /**
     *
     * Met à jour dans la base de données les quantités des lignes de frais forfaitisées.
     *
     * @return bool Le résultat de la mise à jour.
     *
     */
    public function mettreAJourLesFraisForfaitises($unIdVisiteur, $unMois) {
        try {
            self::$pdo->setLesQuantitesFraisForfaitises($unIdVisiteur, $unMois, $this->lesFraisForfaitises);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        return true;
    }

    Public function SetNbJustificatifs($unNbJustificatif) {
        $this->nbJustificatifs = $unNbJustificatif;
    }

    Public function controlerNbJustificatifs() {
        Return s_int($this->nbJustificatifs);
    }

}
