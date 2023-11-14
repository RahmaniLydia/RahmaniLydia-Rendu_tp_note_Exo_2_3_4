<?php
// Inclure le fichier de définition de la classe DAO_compte_bancaire
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_compte_bancaire.php');

// Définition de la classe BusinessObjectCompteBancaire
class BusinessObjectCompteBancaire {
    // Propriété pour la connexion à la base de données (DAO_compte_bancaire)
    public $bdd;

    // Constructeur de la classe, prenant une instance de DAO_compte_bancaire comme paramètre
    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    // Fonction pour récupérer la liste des comptes bancaires à partir de l'objet DAO_compte_bancaire
    function recupererListeComptesBancaires() {
        // Appelle la fonction recupererListeComptesBancaires de l'objet DAO_compte_bancaire
        return $this->bdd->recupererListeComptesBancaires();
    }
}
?>
