<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DO/DO_compte_bancaire.php');
// Classe pour gérer l'accès à la base de données des comptes bancaire
class AccesBDDCompteBancaire {
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
// Fonction pour recupérer la liste des comptes bancaires depuis la base de donnéé
   function recupererListeComptesBancaires() {
        $res = $this->conn->query("SELECT id_compte, id_client, type_compte, solde FROM compte_bancaire");

        $i = 0;
        $comptesBancaires = [];
  // Parcours des résultats et création dobjets CompteBancaire
        foreach ($res as $row) {
            $compteBancaire = new CompteBancaire;
            $compteBancaire->id_compte = $row['id_compte'];
            $compteBancaire->id_client = $row['id_client'];
            $compteBancaire->type_compte = $row['type_compte'];
            $compteBancaire->solde = $row['solde'];
            $comptesBancaires[$i] = $compteBancaire;
            $i++;
        }

        return $comptesBancaires;
    }


}
?>
