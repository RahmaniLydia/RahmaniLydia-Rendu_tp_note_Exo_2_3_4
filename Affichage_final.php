<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/BO/BO_client.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/BO/BO_conseiller_bancaire.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Liste des Clients et Conseillers</title>
    <link href="stylee.css" rel="stylesheet">
</head>

<body>
    <h1>Liste des Clients et Conseillers</h1>

    <?php
    // affichage_final.php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/TP_noté_rendu/BO/BO_agence.php');
  echo '<style>.h2-vert { color: green; }</style>';
    $bddClient = new AccesBDDClient;
    $boClient = new BusinessObjectClient($bddClient);

    $bddConseiller = new AccesBDDConseillerBancaire;
    $boConseiller = new BusinessObjectConseillerBancaire($bddConseiller);

    // Gestion de l'affichage de la liste des clients et des détails d'un client
    if (isset($_GET['idClient'])) {
        // Si un ID est fourni, afficher les détails du client
        $idClient = $_GET['idClient'];
        $clientDetails = $boClient->recupererDetailClient($idClient);

        if ($clientDetails) {
            // Afficher tous les détails du client
            echo '<h2 class="h2-vert">Détails du Client</h2>';
            foreach ($clientDetails as $key => $value) {
                echo '<p>' . $key . ': ' . $value . '</p>';
            }

            // Ajouter un lien pour revenir à la liste des clients
            echo '<p><a href="affichage_final.php">Retour à la liste des clients</a></p>';
        } else {
            // Le cas où le client n'est pas trouvé
            echo 'Client non trouvé.';
        }
    } elseif (isset($_GET['idConseiller'])) {
        // Si un ID est fourni, afficher les détails du conseiller
        $idConseiller = $_GET['idConseiller'];
        $conseillerDetails = $boConseiller->recupererDetailConseillerBancaireAvecComptes($idConseiller);

        if ($conseillerDetails) {
            // Afficher tous les détails du conseiller

            echo '<h2 class="h2-vert">Détails du Conseiller Bancaire</h2>';
            echo '<p>Nom du conseiller: ' . $conseillerDetails[0]['nom_conseiller'] . ' ' . $conseillerDetails[0]['prenom_conseiller'] . '</p>';

            // Afficher la section des clients gérés par le conseiller avec les détails de leurs comptes
    echo '<h3 class="h2-vert">Clients et Comptes gérés:</h3>';
    foreach ($conseillerDetails as $row) {
        // Afficher le lien vers le détail du client avec son ID
        echo '<p>Client: <a href="?idClient=' . $row['id_client'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</a></p>';

        // Afficher les détails du compte associé au client
        echo '<p>Compte: ' . $row['type_compte'] . ', Solde: ' . $row['solde'] . '</p>';
    }

            // Ajouter un lien pour revenir à la liste des conseillers
            echo '<p><a href="affichage_final.php">Retour à la liste des conseillers</a></p>';
        } else {
            // Le cas où le conseiller n'est pas trouvé
            echo 'Conseiller non trouvé.';
        }
    } else {
      // Si aucun ID n'est fourni, afficher la liste des clients et la liste des conseillers
  $listeClients = $boClient->recupererListeClients();
  $listeConseillers = $boConseiller->recupererListeConseillers();

  // Afficher la liste des clients

  echo '<h2 class="h2-vert">Liste des Clients</h2>';
  echo '<ul>';
  foreach ($listeClients as $client) {
      // Afficher un lien vers les détails du client avec son ID
      echo '<li><a href="?idClient=' . $client->id_client . '">' . $client->nom . ' ' . $client->prenom . '</a></li>';

  }
  echo '</ul>';

  // Afficher la liste des conseillers avec un lien vers leurs détails
  echo '<h2 class="h2-vert">La liste des conseillers avec un lien vers la liste des comptes clients gérés par eux</h2>';
  echo '<ul>';
  foreach ($listeConseillers as $conseiller) {
      // Afficher un lien vers les détails du conseiller avec son ID
      echo '<li><a href="?idConseiller=' . $conseiller->id_conseiller . '">' . $conseiller->nom_conseiller . ' ' . $conseiller->prenom_conseiller . '</a></li>';
  }
  echo '</ul>';
}
    ?>

</body>

</html>
