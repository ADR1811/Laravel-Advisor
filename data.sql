-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : ven. 16 sep. 2022 à 13:22
-- Version du serveur : 10.9.2-MariaDB-1:10.9.2+maria~ubu2204
-- Version de PHP : 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `data`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `etablissement_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `etablissement_id`, `user_id`, `content`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'TROP BON !!!!!!!!!', 5, '2022-09-16 12:35:18', '2022-09-16 12:35:18'),
(2, 1, 3, 'Je ne recommande pas.', 1, '2022-09-16 12:37:00', '2022-09-16 12:37:00'),
(3, 1, 4, 'Je me suis perdu, où sont les toilettes ?', 5, '2022-09-16 12:38:03', '2022-09-16 12:38:03'),
(4, 1, 2, 'Restaurant où les meilleurs poissons sont préparés.', 5, '2022-09-16 12:38:47', '2022-09-16 12:38:47');

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

CREATE TABLE `etablissements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `user_id`, `nom`, `adresse`, `ville`, `code_postal`, `pays`, `images`, `created_at`, `updated_at`) VALUES
(1, 2, 'Baratie', 'Dans la mer', 'Sambas', '13001', 'East Blue', '{\"image1\":\"public\\/RLBidKW6Tr7IAvjhUDhKcXjqAFYAO9fM0BmK3lYJ.webp\",\"image2\":\"public\\/qnfjEpSStQRaG3AKy6LISF1Gx1yXtAH41LGE3oFD.jpg\",\"image3\":\"public\\/aA2QhEN4dcIi1iHBxPC2KMFiAnOOYYZCG0JVe6dC.jpg\",\"image4\":\"\",\"image5\":\"\"}', '2022-09-16 12:31:19', '2022-09-16 12:31:19'),
(2, 5, 'Corrida Colosseum', 'chemin de la corrida', 'Dressrosa', '7700', 'Nouveau Monde', '{\"image1\":\"public\\/jBTQQzTw2olM4psi36e3kT7XDbCwcpWTVBPiBDE7.webp\",\"image2\":\"public\\/GikXN6d7EGoKCx89NmrD7Nae19R5TVRLjR1NkxbK.jpg\",\"image3\":\"\",\"image4\":\"\",\"image5\":\"\"}', '2022-09-16 12:46:10', '2022-09-16 12:46:10'),
(3, 6, 'Thriller bark', 'Triangle de Florian', 'Thriller bark', '75001', 'West Blue', '{\"image1\":\"public\\/8Ly41IN7tn8Wc41Emx7f3rCh61q60RfzGWeqbLYd.jpg\",\"image2\":\"public\\/xWQCljLVo7vmC3uAs3I1Vd05aWT0jV3OL0KhaA3U.webp\",\"image3\":\"public\\/h3KZskEBGM5x0THVw1gRw83UvDFXE0xq11qzMGpF.webp\",\"image4\":\"public\\/W7zGUn8lTiRT9IbveD5vGfe8ToZOoFKMIEb2aMyL.png\",\"image5\":\"\"}', '2022-09-16 13:21:14', '2022-09-16 13:21:14');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_12_213505_create_etablissements_table', 1),
(6, '2022_09_12_213736_create_commentaires_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Luffy', 'luffy@gmail.com', NULL, '$2y$10$6mtgtLJkBwT2T.2mE44IIu1KdzXufBx9Rt0ZeakEBbaxH6d6dVF6i', 'uBJwlzwdNM1kavKNf6ehNUE2kpiDJ2wjzkgHOnoHaWI7tTs1MwcAFowClhUJ', '2022-09-16 12:20:17', '2022-09-16 12:20:17'),
(2, 'Sanji', 'sanji@gmail.com', NULL, '$2y$10$G3qNSUZLryQpqupRyCRW8OHUDAW1biXfv1sujMgIfcL0L5xNHC6pO', 'RumMQgdQwhUObj2td29eqFtRAN196O1G5hiyBzFUYLHLSWPoKZIMsOLvlZJY', '2022-09-16 12:20:39', '2022-09-16 12:20:39'),
(3, 'Don Krieg', 'donkrieg@gmail.com', NULL, '$2y$10$4G8WQK5ESemaA.hOXGMKRuJyFs7W5vi1X09TnOS2/VOEO.Ky3DmSW', NULL, '2022-09-16 12:36:36', '2022-09-16 12:36:36'),
(4, 'Zorro', 'zorro@gmail.com', NULL, '$2y$10$3ummKDhHFa3NP2RXjmb./.4PeSXBbpUZdwhQMrxhhLmWoJuC/olTW', NULL, '2022-09-16 12:37:35', '2022-09-16 12:37:35'),
(5, 'doflamingo@gmail.com', 'doflamingo@gmail.com', NULL, '$2y$10$3TMTwu4xs56oXsLrdDbHiOmfa0rqI.xM7pM/WHOUOiNX35BxSj/a2', NULL, '2022-09-16 12:42:37', '2022-09-16 12:42:37'),
(6, 'Brook', 'brook@gmail.com', NULL, '$2y$10$0Db5p4rjzXy8wALoAMG3NOphfN7EqkrGk1MNDGEE6uDCWRprtUekK', 'AHH02vWc9NRurViyQfgiutei3GzIC4xGAedTJ0cPBMSnX3sgwbicdQldBD81', '2022-09-16 13:17:37', '2022-09-16 13:17:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaires_etablissement_id_foreign` (`etablissement_id`),
  ADD KEY `commentaires_user_id_foreign` (`user_id`);

--
-- Index pour la table `etablissements`
--
ALTER TABLE `etablissements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `etablissements_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `etablissements`
--
ALTER TABLE `etablissements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_etablissement_id_foreign` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`),
  ADD CONSTRAINT `commentaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `etablissements`
--
ALTER TABLE `etablissements`
  ADD CONSTRAINT `etablissements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
