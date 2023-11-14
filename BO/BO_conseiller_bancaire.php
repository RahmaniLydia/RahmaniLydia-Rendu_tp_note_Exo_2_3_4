<?php
// Inclure le fichier de définition de la classe DAO_conseiller_bancaire
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/DAO/DAO_conseiller_bancaire.php');

// Définition de la classe BusinessObjectConseillerBancaire
class BusinessObjectConseillerBancaire {
    // Propriété pour la connexion à la base de données (DAO_conseiller_bancaire)
    public $bdd;

    // Constructeur de la classe, prenant une instance de DAO_conseiller_bancaire comme paramètre
    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    // Fonction pour récupérer la liste des conseillers bancaires à partir de l'objet DAO_conseiller_bancaire
    function recupererListeConseillers() {
        // Appelle la fonction recupererListeConseillerBancaire de l'objet DAO_conseiller_bancaire
        return $this->bdd->recupererListeConseillerBancaire();
    }

    // Fonction pour récupérer les détails d'un conseiller bancaire avec ses comptes à partir de l'objet DAO_conseiller_bancaire
    function recupererDetailConseillerBancaireAvecComptes($idConseiller) {
        // Appelle la fonction recupererDetailConseillerBancaireAvecComptes de l'objet DAO_conseiller_bancaire avec l'id du conseiller en paramètre
        return $this->bdd->recupererDetailConseillerBancaireAvecComptes($idConseiller);
    }
}
?>
