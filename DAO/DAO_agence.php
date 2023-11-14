<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DO/DO_agence.php');

// Une classe pour gérer l'accès à la base de données des agences
class AccesBDDAgence {
    public $conn;

    // Le constructeur de la classe
   function __construct() {
        $this->connectionBdd();
    }

    // Fonction pour établir une connexion à la base de données
   function connectionBdd() {
        // Paramètres de connexion
        $serveur = "localhost";
        $baseDeDonnees = "info_clients";
        $utilisateur = "root";
        $motDePasse = "";

        // Tentative de connexion à la base de données
        try {
            $connString = "mysql:host=" . $serveur . ";dbname=" . $baseDeDonnees . ";charset=utf8";
            $this->conn = new PDO($connString, $utilisateur, $motDePasse);
        } catch (PDOException $e) {
            // affiche un message et termine le script En cas derreur
            die("Erreur : " . $e->getMessage());
        }
    }

    // Fonction pour recupérer la liste des agences depuis la base de données
   function recupererListeAgence() {
        // Exécute une requête SQL pour récupérer les données des agences
        $res = $this->conn->query("SELECT id_agence, nom_agence, adresse_agence FROM agence");

        $i = 0;
        $agences = [];

        // Parcours des résultats et création dobjets Agence
        foreach ($res as $row) {
            $agence = new Agence;
            $agence->id_agence = $row['id_agence'];
            $agence->nom_agence = $row['nom_agence'];
            $agence->adresse_agence = $row['adresse_agence'];
            $agences[$i] = $agence;
            $i++;
        }

        // Retourne la liste des agences
        return $agences;
    }
}
?>
