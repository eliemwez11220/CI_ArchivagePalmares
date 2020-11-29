-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 13 nov. 2020 à 09:26
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `archivage_palmares_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_assets`
--

CREATE TABLE `tb_school_assets` (
  `id_asset` int(11) NOT NULL,
  `asset_name` varchar(40) NOT NULL,
  `asset_username` varchar(50) DEFAULT NULL,
  `asset_password` varchar(60) DEFAULT NULL,
  `asset_email` varchar(50) DEFAULT NULL,
  `departement` varchar(50) DEFAULT NULL,
  `asset_type` varchar(75) DEFAULT NULL,
  `date_ajout` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_connected` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) DEFAULT '1',
  `fonction` varchar(50) NOT NULL DEFAULT 'administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_assets`
--

INSERT INTO `tb_school_assets` (`id_asset`, `asset_name`, `asset_username`, `asset_password`, `asset_email`, `departement`, `asset_type`, `date_ajout`, `date_connected`, `status`, `fonction`) VALUES
(1, 'Sylvie', 'sylvie', '$2y$12$WiKJ/EzaC3ACdOoatnzgD.p3dcX6dZX/EYv49lC5BFF3rwYNJj45y', 'sylvie@school.com', 'Administration', 'utilisateur', '2020-11-13 07:56:11', '2019-11-23 05:37:32', '1', 'administratif'),
(2, 'Admin systeme', 'admin', '$2y$12$97qRcd3L7/du0TkDiZ8xguLN1BQscLmRpb3vPTWHDMqVaW1l3pbFC', 'admin@gmail.com', 'Administration', 'administrator', '2020-11-13 08:24:54', '2020-02-23 08:57:33', '1', 'administrator'),
(4, 'lea mohamed', 'mohamed', '$2y$12$2yC4fMTWp.qbRQCW8qtuW.eMjsUf0uOK/UNSsTmvMEXxr5jrvqOGS', 'mohamed@gmail.com', 'Enseignement', 'utilisateur', '2020-11-10 12:10:46', '2020-11-10 12:10:46', '1', 'administratif');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_cotations`
--

CREATE TABLE `tb_school_cotations` (
  `cotation_id` int(11) NOT NULL,
  `etudiant_sid` varchar(50) NOT NULL,
  `cours_sid` varchar(50) NOT NULL,
  `cote_periode1` int(11) NOT NULL,
  `cote_periode2` int(11) NOT NULL,
  `cote_examen1` int(11) NOT NULL,
  `cote_examen2` int(11) NOT NULL,
  `premier_semestre` int(11) NOT NULL,
  `deuxieme_semestre` int(11) NOT NULL,
  `total_max` int(11) NOT NULL,
  `annee_scolaire` varchar(25) NOT NULL,
  `cote_periode3` int(11) NOT NULL,
  `cote_periode4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_cotations`
--

INSERT INTO `tb_school_cotations` (`cotation_id`, `etudiant_sid`, `cours_sid`, `cote_periode1`, `cote_periode2`, `cote_examen1`, `cote_examen2`, `premier_semestre`, `deuxieme_semestre`, `total_max`, `annee_scolaire`, `cote_periode3`, `cote_periode4`) VALUES
(59, 'EM01', 'Mt 1', 23, 30, 60, 64, 113, 154, 267, '2019-2020', 30, 60),
(60, 'EM02', 'Mt 2', 27, 20, 57, 54, 104, 131, 235, '2019-2020', 20, 57),
(61, 'EM03', 'Fr 2', 29, 25, 50, 56, 104, 131, 235, '2019-2020', 25, 50),
(62, 'EM04', 'Bio5', 12, 14, 29, 34, 55, 77, 132, '2019-2020', 14, 29),
(63, 'EM05', 'Ph4', 4, 6, 20, 26, 30, 52, 82, '2019-2020', 6, 20);

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_cours`
--

CREATE TABLE `tb_school_cours` (
  `cours_id` int(11) NOT NULL,
  `intitule` varchar(75) NOT NULL,
  `vol_hor` varchar(25) NOT NULL,
  `enseignant_sid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_enseignants`
--

CREATE TABLE `tb_school_enseignants` (
  `enseignant_id` int(11) NOT NULL,
  `matricule_enseignant` int(10) NOT NULL,
  `nom_enseignant` int(11) NOT NULL,
  `grade_enseignant` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_etudiants`
--

CREATE TABLE `tb_school_etudiants` (
  `etudiant_id` int(11) NOT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `nom_complet` varchar(75) DEFAULT NULL,
  `genre` varchar(10) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(50) DEFAULT NULL,
  `adresse` text,
  `contact` varchar(15) DEFAULT NULL,
  `nom_pere` varchar(75) DEFAULT NULL,
  `nom_mere` varchar(75) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `promo_sid` varchar(50) DEFAULT NULL,
  `annee_scolaire` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_etudiants`
--

INSERT INTO `tb_school_etudiants` (`etudiant_id`, `matricule`, `nom_complet`, `genre`, `date_naissance`, `lieu_naissance`, `adresse`, `contact`, `nom_pere`, `nom_mere`, `email`, `statut`, `promo_sid`, `annee_scolaire`) VALUES
(51, 'EM01', 'ILUNGA BWALIA', 'MASCULIN', '0000-00-00', 'LIKASI', '24, SAPINIER', '990478717', 'Ilunga', 'Monga Ilunga', 'Ilus@gmail.com', 'online', 'G1 INFO', '2019-2020'),
(52, 'EM02', 'TSHIBWABWA  NTUMBA', 'FEMININ', '0000-00-00', 'TSHIKAPA', '17, lulua', '810014517', 'TSHIKAPA', 'MBOMBO TSHIswaka', 'tshis.nt@gmail.com', 'online', 'G1 INFO', '2019-2020'),
(53, 'EM03', 'MWAPE KAPOPO', 'MASCULIN', '0000-00-00', 'LUBUMBASHI', '20, chemin publique', '990214785', 'Ilunga', 'wivine Ilunga', NULL, 'online', 'G1 INFO', '2019-2020'),
(54, 'EM04', 'KASONGO KAMULETE', 'MASCULIN', '0000-00-00', 'LUBUMBASHI', '17, du marché', '995,725,147', 'KASONNGO MBAYO', NULL, 'kas@gmail.com', 'online', 'G1 INFO', '2019-2020'),
(55, 'EM05', 'TSHILOBO KABEYA', 'MASCULIN', '0000-00-00', 'LUBUMBASHI', '01, bongonga', '085 25 453 68', 'TSHILOBO KABEDI', 'MWAMBA', 'Kabeyats@gmail.com', 'online', 'G1 INFO', '2019-2020'),
(56, 'EM06', 'ilunga numbi', 'MASCULIN', '0000-00-00', 'LUBUMBASHI', '14, lupopo', '089 52 452 62', 'SALOMON', 'SOLANGE ASUMANI', '25numbi@gmail.com', 'online', 'G1 INFO', '2019-2020'),
(57, 'EM07', 'NSHIMBA WA KASANDA', 'MASCULIN', '0000-00-00', 'LIKASI', '25, du 26 mai', '081 361 85 61', 'TSHIZANGA SIFA', NULL, NULL, 'online', 'G1 INFO', '2019-2020'),
(62, 'EM12', 'MULU MWABI', 'FEMININ', '0000-00-00', 'kolwezi', '124, salongo', '084 245 55 88', 'MWABI ZAINA', NULL, NULL, 'online', 'G1 INFO', '2019-2020');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_options`
--

CREATE TABLE `tb_school_options` (
  `id_option` int(11) NOT NULL,
  `nom_option` varchar(50) DEFAULT NULL,
  `section_sid` varchar(75) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_options`
--

INSERT INTO `tb_school_options` (`id_option`, `nom_option`, `section_sid`, `date_created`) VALUES
(1, 'RESEAUX INFORMATIQUES', 'INFORMATIQUE', '2020-02-23 05:38:00'),
(2, 'CONCEPTION DES SYSTEMES INFOS', 'INFORMATIQUE', '2020-02-23 05:38:00'),
(4, 'ANALYSE ET PROGRAMMATION', 'INFORMATIQUE', '2020-02-23 05:38:00'),
(5, 'COMPTABILITE', 'SCOFI', '2020-02-23 05:38:00'),
(6, 'MARKETING', 'SCOFI', '2020-02-23 05:38:00'),
(10, 'FISCALITE', 'SCOFI', '2020-11-10 16:40:51');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_periodes`
--

CREATE TABLE `tb_school_periodes` (
  `id` int(11) NOT NULL,
  `annee_scolaire` varchar(10) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_periodes`
--

INSERT INTO `tb_school_periodes` (`id`, `annee_scolaire`, `date_created`) VALUES
(1, '2019-2020', '2019-02-25 19:45:04'),
(2, '2018-2019', '2018-02-25 19:45:04'),
(3, '2020-2021', '2020-02-25 19:45:04');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_promotions`
--

CREATE TABLE `tb_school_promotions` (
  `promo_id` int(11) NOT NULL,
  `nom_promo` varchar(50) DEFAULT NULL,
  `effectif_etudiant` int(11) DEFAULT NULL,
  `departement_sid` varchar(75) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_promotions`
--

INSERT INTO `tb_school_promotions` (`promo_id`, `nom_promo`, `effectif_etudiant`, `departement_sid`, `date_created`) VALUES
(1, 'G1 INFO', 0, 'Informatique', '2020-02-22 10:59:06'),
(7, 'G2 INFO', 0, 'Informatique', '2020-02-22 10:59:06'),
(9, 'G3 INFO', 0, 'Informatique', '2020-02-22 10:59:06'),
(10, 'L1 CSI', 0, 'Informatique', '2020-02-22 10:59:06'),
(11, 'L1 RI', 0, 'Informatique', '2020-02-22 10:59:06'),
(12, 'L2 RI', 0, 'Informatique', '2020-02-22 10:59:06'),
(13, 'L2 CSI', 0, 'Informatique', '2020-02-22 10:59:06');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_resultats`
--

CREATE TABLE `tb_school_resultats` (
  `resultat_id` int(11) NOT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `annee_scolaire` varchar(10) DEFAULT NULL,
  `promotion` varchar(50) DEFAULT NULL,
  `nom_option` varchar(50) DEFAULT NULL,
  `departement` varchar(50) DEFAULT NULL,
  `session` varchar(50) DEFAULT NULL,
  `pourcentage` float DEFAULT NULL,
  `cote_obtenue` int(11) DEFAULT NULL,
  `mention` varchar(50) DEFAULT NULL,
  `date_pub` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_resultats`
--

INSERT INTO `tb_school_resultats` (`resultat_id`, `matricule`, `annee_scolaire`, `promotion`, `nom_option`, `departement`, `session`, `pourcentage`, `cote_obtenue`, `mention`, `date_pub`) VALUES
(1, 'EM01', '2018-2019', 'G1 INFO', 'RESEAUX', 'INFORMATIQUE', '1ere session', 39.1, 750, 'Echec', '2020-11-11 08:03:03'),
(2, 'EM02', '2019-2020', 'G1 INFO', 'CONCEPTION', 'INFORMATIQUE', '1ere session', 61.52, 580, 'Satisfaction', '2020-11-11 08:03:03'),
(15, 'EM03', '2019-2020', 'G1 INFO ', 'CONCEPTION', 'INFORMATIQUE', '1ere session', 57.69, 1500, 'Satisfaction', '2020-11-11 09:14:12'),
(16, 'EM04', '2019-2020', 'G1 INFO', 'RESEAUX', 'INFORMATIQUE', '1ere session', 96.15, 2500, 'Satsfaction', '2020-11-11 09:14:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tb_school_assets`
--
ALTER TABLE `tb_school_assets`
  ADD PRIMARY KEY (`id_asset`),
  ADD UNIQUE KEY `asset_username` (`asset_username`,`asset_email`);

--
-- Index pour la table `tb_school_cotations`
--
ALTER TABLE `tb_school_cotations`
  ADD PRIMARY KEY (`cotation_id`);

--
-- Index pour la table `tb_school_cours`
--
ALTER TABLE `tb_school_cours`
  ADD PRIMARY KEY (`cours_id`);

--
-- Index pour la table `tb_school_enseignants`
--
ALTER TABLE `tb_school_enseignants`
  ADD PRIMARY KEY (`enseignant_id`),
  ADD UNIQUE KEY `matricule_enseignant` (`matricule_enseignant`);

--
-- Index pour la table `tb_school_etudiants`
--
ALTER TABLE `tb_school_etudiants`
  ADD PRIMARY KEY (`etudiant_id`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `tb_school_options`
--
ALTER TABLE `tb_school_options`
  ADD PRIMARY KEY (`id_option`),
  ADD UNIQUE KEY `nom_option` (`nom_option`);

--
-- Index pour la table `tb_school_periodes`
--
ALTER TABLE `tb_school_periodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `annee_scolaire` (`annee_scolaire`);

--
-- Index pour la table `tb_school_promotions`
--
ALTER TABLE `tb_school_promotions`
  ADD PRIMARY KEY (`promo_id`),
  ADD UNIQUE KEY `nom_promo` (`nom_promo`);

--
-- Index pour la table `tb_school_resultats`
--
ALTER TABLE `tb_school_resultats`
  ADD PRIMARY KEY (`resultat_id`),
  ADD KEY `matricule` (`matricule`),
  ADD KEY `annee_scolaire` (`annee_scolaire`),
  ADD KEY `promotion` (`promotion`),
  ADD KEY `nom_option` (`nom_option`),
  ADD KEY `departement` (`departement`),
  ADD KEY `session` (`session`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tb_school_assets`
--
ALTER TABLE `tb_school_assets`
  MODIFY `id_asset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `tb_school_cotations`
--
ALTER TABLE `tb_school_cotations`
  MODIFY `cotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `tb_school_cours`
--
ALTER TABLE `tb_school_cours`
  MODIFY `cours_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_school_enseignants`
--
ALTER TABLE `tb_school_enseignants`
  MODIFY `enseignant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_school_etudiants`
--
ALTER TABLE `tb_school_etudiants`
  MODIFY `etudiant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `tb_school_options`
--
ALTER TABLE `tb_school_options`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `tb_school_periodes`
--
ALTER TABLE `tb_school_periodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tb_school_promotions`
--
ALTER TABLE `tb_school_promotions`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `tb_school_resultats`
--
ALTER TABLE `tb_school_resultats`
  MODIFY `resultat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
