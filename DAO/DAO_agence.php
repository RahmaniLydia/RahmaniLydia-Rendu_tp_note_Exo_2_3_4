<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DO/DO_agence.php');

class AccesBDDAgence {
    public $conn;

    public function __construct() {
        $this->connectionBdd();
    }

    private function connectionBdd() {
        $serveur = "localhost";
        $baseDeDonnees = "info_clients";
        $utilisateur = "root";
        $motDePasse = "";

        try {
            $connString = "mysql:host=" . $serveur . ";dbname=" . $baseDeDonnees . ";charset=utf8";
            $this->conn = new PDO($connString, $utilisateur, $motDePasse);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function recupererListeAgence() {
        $res = $this->conn->query("SELECT id_agence, nom_agence, adresse_agence FROM agence");

        $i = 0;
        $agences = [];

        foreach ($res as $row) {
            $agence = new Agence;
            $agence->id_agence = $row['id_agence'];
            $agence->nom_agence = $row['nom_agence'];
            $agence->adresse_agence = $row['adresse_agence'];
            $agences[$i] = $agence;
            $i++;
        }

        return $agences;
    }


}
?>
