<?php
// Inclure le fichier de définition de la classe ConseillerBancaire
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DO/DO_conseiller_bancaire.php');


class AccesBDDConseillerBancaire {

    public $conn;


    function __construct() {
        $this->connectionBdd();
    }


    function connectionBdd() {
        // Informations de connexion à la base de données
        $serveur = "localhost";
        $baseDeDonnees = "info_clients";
        $utilisateur = "root";
        $motDePasse = "";

        // Tentative de connexion à la base de données avec PDO
        try {
            $connString = "mysql:host=" . $serveur . ";dbname=" . $baseDeDonnees . ";charset=utf8";
            $this->conn = new PDO($connString, $utilisateur, $motDePasse);
        } catch (PDOException $e) {
            // En cas d'échec, affiche une erreur
            die("Erreur : " . $e->getMessage());
        }
    }

    // Fonction pour récupérer la liste des conseillers bancaires depuis la base de données
    function recupererListeConseillerBancaire() {
        // Exécution d'une requête SQL pour récupérer les conseillers bancaires
        $res = $this->conn->query("SELECT id_conseiller, id_agence, nom_conseiller, prenom_conseiller FROM conseiller_bancaire");

        $i = 0;
        $conseillersBancaires = [];

        // Parcours des résultats pour créer des objets ConseillerBancaire
        foreach ($res as $row) {
            $conseillerBancaire = new ConseillerBancaire;
            $conseillerBancaire->id_conseiller = $row['id_conseiller'];
            $conseillerBancaire->id_agence = $row['id_agence'];
            $conseillerBancaire->nom_conseiller = $row['nom_conseiller'];
            $conseillerBancaire->prenom_conseiller = $row['prenom_conseiller'];
            $conseillersBancaires[$i] = $conseillerBancaire;
            $i++;
        }

        // Retourne la liste des conseillers bancaires
        return $conseillersBancaires;
    }

    // Fonction pour récupérer les détails d'un conseiller bancaire avec ses comptes
    function recupererDetailConseillerBancaireAvecComptes($idConseillerBancaire) {
        // Requête SQL pour récupérer les détails d'un conseiller bancaire avec ses comptes
        $query = "SELECT cb.id_conseiller, cb.id_agence, cb.nom_conseiller, cb.prenom_conseiller, c.id_client, c.nom, c.prenom, compte.id_compte, compte.type_compte, compte.solde
                FROM conseiller_bancaire cb
                LEFT JOIN client c ON cb.id_conseiller = c.id_conseiller
                LEFT JOIN compte_bancaire compte ON c.id_client = compte.id_client
                WHERE cb.id_conseiller = :id";

        // Préparation de la requête avec PDO
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $idConseillerBancaire);
        $stmt->execute();

        // Retourne tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
