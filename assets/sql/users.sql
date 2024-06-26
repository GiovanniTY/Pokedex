-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 26 juin 2024 à 15:33
-- Version du serveur : 11.3.2-MariaDB
-- Version de PHP : 8.3.6

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
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `description`) VALUES
(4, 'Justine', 'justine0912@gmail.com', '$2y$10$aKQPFej9CQx8pcMh5Gs80OrUIf8ILT2Z763s0EUl1SiACGbvhULHO', './storage/default_avatars/bulbizarre.png', 'lorem ipsum blablablalorem ipsum blablablalorem ipsum blablablalorem ipsum blablabla'),
(5, 'Giovanni', 'giovanni@gmail.com', '$2y$10$KrL8pAcRshSkZAa5kAqoIO.hY8PxD3LNhzSUSbMEg9WxPfFWQrA6G', './storage/default_avatars/caninos.png', ''),
(6, 'momoa', 'momoa@gmail.com', '$2y$10$776Y6rRpBNJtyr/qRAg93OgPWmUcqGidgJ7lwTVSorrywL40m8RtW', './storage/default_avatars/pikachu.png', NULL);

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
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
