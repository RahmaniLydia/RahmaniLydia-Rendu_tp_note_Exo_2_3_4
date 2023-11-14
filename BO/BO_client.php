<?php
// Inclure le fichier de définition de la classe DAO_client
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_client.php');

// Définition de la classe BusinessObjectClient
class BusinessObjectClient {
    // Propriété pour la connexion à la base de données (DAO_client)
    public $bdd;

    // Constructeur de la classe, prenant une instance de DAO_client comme paramètre
    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    // Fonction pour récupérer la liste des clients à partir de l'objet DAO_client
    function recupererListeClients() {
        // Appelle la fonction recupererListeClient de l'objet DAO_client
        return $this->bdd->recupererListeClient();
    }

    // Fonction pour récupérer les détails d'un client à partir de l'objet DAO_client
    function recupererDetailClient($idClient) {
        // Appelle la fonction recupererDetailClient de l'objet DAO_client avec l'id du client en paramètre
        return $this->bdd->recupererDetailClient($idClient);
    }
}
?>
