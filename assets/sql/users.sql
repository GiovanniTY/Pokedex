-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 27 juin 2024 à 19:33
-- Version du serveur : 11.3.2-MariaDB
-- Version de PHP : 8.3.6

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pokedex`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(250) NOT NULL,
  `username` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `password` varchar(500) NOT NULL,
  `avatar` varchar(250) DEFAULT './storage/default_avatars/pikachu.png',
  `description` text DEFAULT NULL,
  `role` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `description`, `role`) VALUES
(5, 'Giovanni', 'giovanni@gmail.com', '$2y$10$pRWQRHD.VmFEq5uXDMQR6Obqoya5zixN1Bz6TxrmhhQ/kmHS8UnDu', './storage/default_avatars/caninos.png', NULL, 'admin'),
(9, 'dylan', 'dylan@gmail.com', '$2y$10$PANUFTYAPBsWXBtRkq8PzujEHM30r1e8KQY5CJmZuge8kAa99CAgm', './storage/default_avatars/pikachu.png', NULL, 'admin'),
(11, 'Justine', 'justine@gmail.com', '$2y$10$M4a7C/4rvIj3jI9L/.aYr.MVMVt.JHyW0aJYqdHcS9C2D6N3LDym6', './storage/default_avatars/caninos.png', NULL, 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
