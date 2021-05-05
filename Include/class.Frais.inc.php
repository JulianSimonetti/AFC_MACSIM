<?php

/**
 * Classe Frais
 *
 */
abstract class Frais {

    protected $idVisiteur;
    protected $moisFicheFrais;
    protected $numFrais;

    /**
     * Constructeur de la classe.
     *
     *  Rappel : en PHP le constructeur est toujours nommé
     *          __construct().
     *
     */
    public function __construct($unIdVisiteur, $unMoisFicheFrais, $unNumFrais) {
        $this->idVisiteur = $unIdVisiteur;
        $this->moisFicheFrais = $unMoisFicheFrais;
        $this->numFrais = $unNumFrais;
    }

    /**
     * Retourne l'id du visiteur.
     *
     * @return string L'id du visiteur.
     */
    public function getIdVisiteur() {
        return $this->idVisiteur;
    }

    /**
     * Retourne le mois de la fiche de frais.
     *
     * @return string Le mois de la fiche.
     */
    public function getMoisFiche() {
        return $this->moisFicheFrais;
    }

    /**
     * Retourne le numéro du frais (de la ligne).
     *
     * @return int Le numéro du frais.
     */
    public function getNumFrais() {
        return $this->numFrais;
    }

    abstract public function getMontant();
}

final class FraisForfaitise extends Frais {

    protected $laCategorieFraisForfaitises;
    protected $quantite;

    public function __construct($unIdVisiteur, $unMoisFicheFrais, $unNumFrais, $quantite, $uneCategorie) {
        parent::__construct($unIdVisiteur, $unMoisFicheFrais, $unNumFrais);
        $this->laCategorieFraisForfaitises = $uneCategorie;
        $this->quantite = $quantite;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getCategorie() {
        return $this->laCategorieFraisForfaitises;
    }
    
    public function getMontant() {
        $unPdo = PdoGsb::getPdoGsb();
        return $this->getQuantite() * $this->getCategorie()->getMontant();
    }
}

final class FraisHorsForfait extends Frais {

    protected $numFrais;
    protected $libelle;
    protected $date;
    protected $montant;
    protected $action;

    public function __construct($unIdVisiteur, $unMoisFicheFrais, $unNumFrais, $unLibelle, $uneDate, $unMontant, $uneAction = 'O') {
        parent::__construct($unIdVisiteur, $unMoisFicheFrais, $unNumFrais);
        $this->numFrais = $unNumFrais;
        $this->libelle = $unLibelle;
        $this->date = $uneDate;
        $this->montant = $unMontant;
        $this->action = $uneAction;
    }

    public function getNumFrais() {
        return $this->numFrais;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getDate() {
        return $this->date;
    }

    public function getMontant() {
        return $this->montant;
    }

    public function getAction() {
        return $this->action;
    }

}
