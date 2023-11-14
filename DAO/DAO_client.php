<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DO/DO_client.php');
// Classe pour gérer l'accès à la base de données des clients
class AccesBDDClient {
    public $conn;

     function __construct() {
        $this->connectionBdd();
    }
// Fonction pour établir une connexion à la base de données
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
// Fonction pour récupérer la liste des clients depuis la base de données
   function recupererListeClient() {
      //  requête our récupérer les données des clients
        $res = $this->conn->query("SELECT id_client, id_conseiller, nom, prenom, adresse, date_de_naissance, numéro_tel, Situation_familiale, Situation_familiale_nbr_enfants FROM client");

        $i = 0;
        $clients = [];
 // Parcours des résultats et création d'objets Client
        foreach ($res as $row) {
            $client = new Client;
            $client->id_client = $row['id_client'];
            $client->id_conseiller = $row['id_conseiller'];
            $client->nom = $row['nom'];
            $client->prenom = $row['prenom'];
            $client->adresse = $row['adresse'];
            $client->date_de_naissance = $row['date_de_naissance'];
            $client->numéro_tel = $row['numéro_tel'];
            $client->Situation_familiale = $row['Situation_familiale'];
            $client->Situation_familiale_nbr_enfants = $row['Situation_familiale_nbr_enfants'];
            $clients[$i] = $client;
            $i++;
        }
         // Retourne la liste des clients

        return $clients;
    }

   function recupererDetailClient($idClient) {
      // Requête pour récupérer les détails d'un client spécifique a un id donné
        $query = "SELECT * FROM client WHERE id_client = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $idClient);
        $stmt->execute();
 // Retourne les détails du client
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
