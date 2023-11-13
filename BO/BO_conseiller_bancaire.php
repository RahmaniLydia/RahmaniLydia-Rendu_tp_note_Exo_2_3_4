<?php // BO_conseiller_bancaire.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_conseiller_bancaire.php');

class BusinessObjectConseillerBancaire {
    public $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function recupererListeConseillers() {
        return $this->bdd->recupererListeConseillerBancaire();
    }

    public function recupererDetailConseillerBancaire($idConseiller) {
        return $this->bdd->recupererDetailConseillerBancaire($idConseiller);
    }
}
 ?>
