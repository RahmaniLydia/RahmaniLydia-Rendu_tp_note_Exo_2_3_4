-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 nov. 2023 à 08:50
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `info_clients`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `id_agence` int(11) NOT NULL,
  `nom_agence` varchar(50) DEFAULT NULL,
  `adresse_agence` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id_agence`, `nom_agence`, `adresse_agence`) VALUES
(1, 'Agence Paris', '123 Rue de la ville'),
(2, 'Agence Lyon', '45 Avenue des lala'),
(3, 'Agence Marseille', '789 Avenue du soleil'),
(4, 'Agence Marseille', '789 Avenue du soleil');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `id_conseiller` int(11) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `numéro_tel` varchar(50) DEFAULT NULL,
  `Situation_familiale` varchar(50) DEFAULT NULL,
  `Situation_familiale_nbr_enfants` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `id_conseiller`, `nom`, `prenom`, `adresse`, `date_de_naissance`, `numéro_tel`, `Situation_familiale`, `Situation_familiale_nbr_enfants`) VALUES
(1, 1, 'Lord', 'Marie', '78 Boulevard des lis', '1975-03-15', '0123456789', 'Marié', 3),
(2, 2, 'Ludo', 'Lydia', '110 Avenue des love', '1995-06-25', '9876543210', 'Célibataire', 0),
(3, 2, 'Larala', 'Dani', '22 Rue de lou', '1998-09-20', '56722901234', 'Célibataire', 0);

-- --------------------------------------------------------

--
-- Structure de la table `compte_bancaire`
--

CREATE TABLE `compte_bancaire` (
  `id_compte` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `type_compte` varchar(50) DEFAULT NULL,
  `solde` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `compte_bancaire`
--

INSERT INTO `compte_bancaire` (`id_compte`, `id_client`, `type_compte`, `solde`) VALUES
(1, 1, 'Compte Courant', 5000),
(2, 2, 'Compte Épargne', 10000),
(3, 2, 'Compte Courant', 96500);

-- --------------------------------------------------------

--
-- Structure de la table `conseiller_bancaire`
--

CREATE TABLE `conseiller_bancaire` (
  `id_conseiller` int(11) NOT NULL,
  `id_agence` int(11) DEFAULT NULL,
  `nom_conseiller` varchar(50) DEFAULT NULL,
  `prenom_conseiller` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conseiller_bancaire`
--

INSERT INTO `conseiller_bancaire` (`id_conseiller`, `id_agence`, `nom_conseiller`, `prenom_conseiller`) VALUES
(1, 1, 'Dali', 'Lynda'),
(2, 2, 'Rani', 'Celia'),
(3, 3, 'Farah', 'Celia');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_compte`
--

CREATE TABLE `ligne_compte` (
  `id_ligne` int(11) NOT NULL,
  `id_compte` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `date_transaction` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ligne_compte`
--

INSERT INTO `ligne_compte` (`id_ligne`, `id_compte`, `montant`, `date_transaction`) VALUES
(1, 1, 1000, '2023-05-10'),
(2, 2, -500, '2023-05-12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id_agence`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_conseiller` (`id_conseiller`);

--
-- Index pour la table `compte_bancaire`
--
ALTER TABLE `compte_bancaire`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `conseiller_bancaire`
--
ALTER TABLE `conseiller_bancaire`
  ADD PRIMARY KEY (`id_conseiller`),
  ADD KEY `id_agence` (`id_agence`);

--
-- Index pour la table `ligne_compte`
--
ALTER TABLE `ligne_compte`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `id_compte` (`id_compte`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_conseiller`) REFERENCES `conseiller_bancaire` (`id_conseiller`);

--
-- Contraintes pour la table `compte_bancaire`
--
ALTER TABLE `compte_bancaire`
  ADD CONSTRAINT `compte_bancaire_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `conseiller_bancaire`
--
ALTER TABLE `conseiller_bancaire`
  ADD CONSTRAINT `conseiller_bancaire_ibfk_1` FOREIGN KEY (`id_agence`) REFERENCES `agence` (`id_agence`);

--
-- Contraintes pour la table `ligne_compte`
--
ALTER TABLE `ligne_compte`
  ADD CONSTRAINT `ligne_compte_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte_bancaire` (`id_compte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
