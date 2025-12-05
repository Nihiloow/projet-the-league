-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : ven. 05 déc. 2025 à 09:01
-- Version du serveur : 5.7.44
-- Version de PHP : 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `the_league`
--

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `team_1` int(11) NOT NULL,
  `team_2` int(11) NOT NULL,
  `winner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `name`, `date`, `team_1`, `team_2`, `winner`) VALUES
(1, 'Owls vs Parrots', '2024-01-04 12:07:30', 1, 2, 1),
(2, 'Panthers vs Sparrow', '2024-01-10 12:07:30', 3, 4, 4),
(3, 'Vendetta vs Owls', '2024-01-17 12:07:30', 5, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `url`, `alt`) VALUES
(1, 'https://kornog-dev.github.io/league-images/teams/angry-owls.png', 'Logo Angry Owls'),
(2, 'https://kornog-dev.github.io/league-images/teams/chatty-parrots.png', 'Logo Chatty Parrots'),
(3, 'https://kornog-dev.github.io/league-images/teams/sparrow.png', 'Logo Sparrow'),
(4, 'https://kornog-dev.github.io/league-images/teams/vendetta.png', 'Logo Vendetta'),
(5, 'https://kornog-dev.github.io/league-images/teams/panthers.png', 'Logo Panthers'),
(6, 'https://kornog-dev.github.io/league-images/players/Berkov.png', 'Berkov Portrait'),
(7, 'https://kornog-dev.github.io/league-images/players/Britus.png', 'Britus portrait'),
(8, 'https://kornog-dev.github.io/league-images/players/Dundy.png', 'Dundy portrait'),
(9, 'https://kornog-dev.github.io/league-images/players/Garrin.png', 'Garrin portrait'),
(10, 'https://kornog-dev.github.io/league-images/players/Gayj.png', 'Gayj portrait'),
(11, 'https://kornog-dev.github.io/league-images/players/Ladso.png', 'Ladso portrait'),
(12, 'https://kornog-dev.github.io/league-images/players/Mayan.png', 'Mayan portrait'),
(13, 'https://kornog-dev.github.io/league-images/players/Nerdex.png', 'Nerdex portrait'),
(14, 'https://kornog-dev.github.io/league-images/players/RedWitch.png', 'RedWitch portrait'),
(15, 'https://kornog-dev.github.io/league-images/players/Soltan.png', 'Soltan portrait'),
(16, 'https://kornog-dev.github.io/league-images/players/Speck.png', 'Speck portrait'),
(17, 'https://kornog-dev.github.io/league-images/players/Stonk.png', 'Stonk portrait'),
(18, 'https://kornog-dev.github.io/league-images/players/Vicrane.png', 'Vicrane portrait'),
(19, 'https://kornog-dev.github.io/league-images/players/Vrixo.png', 'Vrixo portrait'),
(20, 'https://kornog-dev.github.io/league-images/players/Wofin.png', 'Wofin portrait');

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `bio` varchar(1023) NOT NULL,
  `portrait` int(11) NOT NULL,
  `team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `players`
--

INSERT INTO `players` (`id`, `nickname`, `bio`, `portrait`, `team`) VALUES
(1, 'Berkov', 'TBD', 6, 4),
(2, 'Britus', 'TBD', 7, 2),
(3, 'Dundy', 'TBD', 8, 2),
(4, 'Garrin', 'TBD', 9, 4),
(5, 'Gayj', 'TBD', 10, 5),
(6, 'Ladso', 'TBD', 11, 1),
(7, 'Mayan', 'TBD', 12, 5),
(8, 'Nerdex', 'TBD', 13, 2),
(9, 'RedWitch', 'TBD', 14, 1),
(10, 'Soltan', 'TBD', 15, 1),
(11, 'Speck', 'TBD', 16, 3),
(12, 'Stonk', 'TBD', 17, 4),
(13, 'Vicrane', 'TBD', 18, 3),
(14, 'Wofin', 'TBD', 20, 3),
(15, 'Vrixo', 'TBD', 19, 5);

-- --------------------------------------------------------

--
-- Structure de la table `player_performance`
--

CREATE TABLE `player_performance` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `game` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `assists` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `player_performance`
--

INSERT INTO `player_performance` (`id`, `player`, `game`, `points`, `assists`) VALUES
(1, 6, 1, 13, 3),
(2, 9, 1, 11, 7),
(3, 10, 1, 12, 2),
(4, 2, 1, 5, 12),
(5, 3, 1, 7, 3),
(6, 8, 1, 9, 6),
(7, 11, 2, 11, 1),
(8, 13, 2, 8, 3),
(9, 14, 2, 10, 2),
(10, 1, 2, 11, 4),
(11, 4, 2, 13, 5),
(12, 12, 2, 8, 11),
(13, 5, 3, 5, 11),
(14, 7, 3, 8, 8),
(15, 15, 3, 12, 4),
(16, 6, 3, 6, 5),
(17, 9, 3, 7, 4),
(18, 10, 3, 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1023) NOT NULL,
  `logo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `logo`) VALUES
(1, 'Angry Owls', 'A team of angry owls', 1),
(2, 'Chatty Parrots', 'A team of chatty parrots', 2),
(3, 'Panthers', 'A team of panthers', 5),
(4, 'Sparrow', 'The spies from the east', 3),
(5, 'Vendetta', 'A knack for revenge', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_1` (`team_1`),
  ADD KEY `team_2` (`team_2`),
  ADD KEY `winner` (`winner`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portrait` (`portrait`),
  ADD KEY `team` (`team`);

--
-- Index pour la table `player_performance`
--
ALTER TABLE `player_performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game` (`game`),
  ADD KEY `player` (`player`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logo` (`logo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `player_performance`
--
ALTER TABLE `player_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`team_1`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`team_2`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `games_ibfk_3` FOREIGN KEY (`winner`) REFERENCES `teams` (`id`);

--
-- Contraintes pour la table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`portrait`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`team`) REFERENCES `teams` (`id`);

--
-- Contraintes pour la table `player_performance`
--
ALTER TABLE `player_performance`
  ADD CONSTRAINT `player_performance_ibfk_1` FOREIGN KEY (`game`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `player_performance_ibfk_2` FOREIGN KEY (`player`) REFERENCES `players` (`id`);

--
-- Contraintes pour la table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`logo`) REFERENCES `media` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
