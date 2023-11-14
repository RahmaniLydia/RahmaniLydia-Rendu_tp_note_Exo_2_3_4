<?php
// BO_client.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_compte_bancaire.php');

class BusinessObjectCompteBancaire {
    public $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function recupererListeComptesBancaires() {
        return $this->bdd->recupererListeComptesBancaires();
    }


}
?>
