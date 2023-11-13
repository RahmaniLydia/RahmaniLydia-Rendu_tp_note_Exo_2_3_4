<?php
// BO_client.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_client.php');

class BusinessObjectClient {
    public $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function recupererListeClients() {
        return $this->bdd->recupererListeClient();
    }

    public function recupererDetailClient($idClient) {
        return $this->bdd->recupererDetailClient($idClient);
    }


}
?>
