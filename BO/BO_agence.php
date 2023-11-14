<?php
// BO_client.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_agence.php');

class BusinessObjectAgence {
    public $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function recupererListeAgence() {
        return $this->bdd->recupererListeAgence();
    }

    
}
?>
