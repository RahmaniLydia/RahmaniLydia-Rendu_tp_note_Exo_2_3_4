<?php
// Inclure le fichier de définition de la classe DAO_agence
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_agence.php');

// Définition de la classe BusinessObjectAgence
class BusinessObjectAgence {
    // Propriété pour la connexion à la base de données (DAO_agence)
    public $bdd;

    // Constructeur de la classe, prenant une instance de DAO_agence comme paramètre
    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    // Fonction pour récupérer la liste des agences à partir de l'objet DAO_agence
    function recupererListeAgence() {
        // Appelle la fonction recupererListeAgence de l'objet DAO_agence
        return $this->bdd->recupererListeAgence();
    }
}
?>
