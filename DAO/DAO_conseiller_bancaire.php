<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DO/DO_conseiller_bancaire.php');

class AccesBDDConseillerBancaire {
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

    public function recupererListeConseillerBancaire() {
        $res = $this->conn->query("SELECT id_conseiller, id_agence, nom_conseiller, prenom_conseiller FROM conseiller_bancaire");

        $i = 0;
        $conseillersBancaires = [];

        foreach ($res as $row) {
            $conseillerBancaire = new ConseillerBancaire;
            $conseillerBancaire->id_conseiller = $row['id_conseiller'];
            $conseillerBancaire->id_agence = $row['id_agence'];
            $conseillerBancaire->nom_conseiller = $row['nom_conseiller'];
            $conseillerBancaire->prenom_conseiller = $row['prenom_conseiller'];
            $conseillersBancaires[$i] = $conseillerBancaire;
            $i++;
        }

        return $conseillersBancaires;
    }

    public function recupererDetailConseillerBancaire($idConseillerBancaire) {
        $query = "SELECT * FROM conseiller_bancaire WHERE id_conseiller = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $idConseillerBancaire);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
