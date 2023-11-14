<?php
// BO_client.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_conseiller_bancaire.php');

class BusinessObjectLigneBancaire {
    public $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function recupererListeLignesComptes() {
        return $this->bdd->recupererListeLignesComptes();
    }


}
?>
