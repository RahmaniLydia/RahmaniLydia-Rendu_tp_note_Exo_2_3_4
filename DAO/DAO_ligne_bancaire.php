<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DO/DO_ligne_compte.php');

class AccesBDDLigneCompte {
    public $conn;

   function __construct() {
        $this->connectionBdd();
    }

   function connectionBdd() {
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
// Fonction pour recupérer la liste des lignes comptes depuis la base de données
   function recupererListeLignesComptes() {
        $res = $this->conn->query("SELECT id_ligne, id_compte, id_conseiller, montant, date_transaction FROM ligne_compte");

        $i = 0;
        $lignesComptes = [];

        foreach ($res as $row) {
            $ligneCompte = new LigneCompte;
            $ligneCompte->id_ligne = $row['id_ligne'];
            $ligneCompte->id_compte = $row['id_compte'];
            $ligneCompte->id_conseiller = $row['id_conseiller'];
            $ligneCompte->montant = $row['montant'];
            $ligneCompte->date_transaction = $row['date_transaction'];
            $lignesComptes[$i] = $ligneCompte;
            $i++;
        }

        return $lignesComptes;
    }


}
?>
