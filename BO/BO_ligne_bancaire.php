<?php
// Inclure le fichier de définition de la classe DAO_conseiller_bancaire
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_ligne_bancaire.php');

// Définition de la classe BusinessObjectLigneBancaire
class BusinessObjectLigneBancaire {
    // Propriété pour la connexion à la base de données (DAO_ligne_bancaire)
    public $bdd;

    // Constructeur de la classe, prenant une instance de DAO_ligne_bancaire comme paramètre
    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    // Fonction pour récupérer la liste des lignes de comptes à partir de l'objet DAO_ligne_bancaire
    function recupererListeLignesComptes() {
        // Appelle la fonction recupererListeLignesComptes de l'objet DAO_ligne_bancaire
        return $this->bdd->recupererListeLignesComptes();
    }
}
?>
