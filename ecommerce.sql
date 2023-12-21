-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 21 déc. 2023 à 20:57
-- Version du serveur : 10.11.6-MariaDB-1:10.11.6+maria~deb10
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `cartview`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `cartview` (
`itemsprice` double
,`countitems` bigint(21)
,`cart_id` int(11)
,`cart_users_id` int(11)
,`cart_items_id` int(11)
,`cart_created_at` timestamp
,`cart_updated_at` timestamp
,`id` int(11)
,`name` varchar(100)
,`name_ar` varchar(100)
,`description` varchar(255)
,`description_ar` varchar(255)
,`image` varchar(255)
,`count` int(11)
,`active` tinyint(4)
,`price` float
,`discount` smallint(6)
,`category_id` int(11)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `name_ar`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Cameras', 'كاميرات', 'camera.svg', '2023-12-11 12:31:56', '2023-12-11 18:09:22'),
(2, 'Clothing', 'ملابس', 'dress.svg', '2023-12-11 12:31:56', NULL),
(3, 'Electronics', 'إلكترونيات', 'laptop.svg', '2023-12-11 12:33:30', NULL),
(4, 'Mobile Phones', 'هواتف محمولة', 'mobile.svg', '2023-12-11 12:33:30', NULL),
(5, 'Shoes', 'أحذية', 'shoes.svg', '2023-12-11 12:34:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `favorite`
--

INSERT INTO `favorite` (`id`, `users_id`, `items_id`, `created_at`, `updated_at`) VALUES
(3, 2, 1, '2023-12-19 11:40:22', '2023-12-19 11:40:22');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `description_ar` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `price` float NOT NULL,
  `discount` smallint(6) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `name`, `name_ar`, `description`, `description_ar`, `image`, `count`, `active`, `price`, `discount`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'DSLR Camera', 'كاميرا DSLR', 'High-quality DSLR camera', 'كاميرا DSLR عالية الجودة', 'nikon.png', 15, 1, 1800, 15, 1, '2023-12-11 12:53:23', NULL);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `itemsview`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `itemsview` (
`item_id` int(11)
,`item_name` varchar(100)
,`item_name_ar` varchar(100)
,`item_description` varchar(255)
,`item_description_ar` varchar(255)
,`item_image` varchar(255)
,`item_count` int(11)
,`item_active` tinyint(4)
,`item_price` float
,`item_discount` smallint(6)
,`item_category_id` int(11)
,`item_created_at` timestamp
,`item_updated_at` timestamp
,`category_id` int(11)
,`category_name` varchar(100)
,`category_name_ar` varchar(100)
,`category_image` varchar(255)
,`category_created_at` timestamp
,`category_updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `myfavorite`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `myfavorite` (
`favorite_id` int(11)
,`favorite_users_id` int(11)
,`favorite_items_id` int(11)
,`favorite_created_at` timestamp
,`favorite_updated_at` timestamp
,`id` int(11)
,`name` varchar(100)
,`name_ar` varchar(100)
,`description` varchar(255)
,`description_ar` varchar(255)
,`image` varchar(255)
,`count` int(11)
,`active` tinyint(4)
,`price` float
,`discount` smallint(6)
,`category_id` int(11)
,`created_at` timestamp
,`updated_at` timestamp
,`users_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `verifycode` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `telephone`, `verifycode`, `approve`, `created_at`, `updated_at`) VALUES
(2, 'ayoubgaouet', 'gaouetayoub1@gmail.com', '$2y$10$TG0IPHPuYpK4TJ0KkoZ47.o62.2ZMd1D9.zkHjoLGyAOkC5YBs2Ui', '514789645', 62951, 1, '2023-12-11 17:07:45', '2023-12-11 17:08:06'),
(3, 'ouma', 'ouma@gmail.com', '$2y$10$oYku27UeVUaGWK3G7FZ6ceL96iQVsJVFYXbgrImB8I/Qsh8YLSrTe', '121212121', 98618, 1, '2023-12-19 11:42:11', '2023-12-19 11:42:30');

-- --------------------------------------------------------

--
-- Structure de la vue `cartview`
--
DROP TABLE IF EXISTS `cartview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ayoub`@`localhost` SQL SECURITY DEFINER VIEW `cartview`  AS SELECT sum(`items`.`price`) AS `itemsprice`, count(`cart`.`items_id`) AS `countitems`, `cart`.`id` AS `cart_id`, `cart`.`users_id` AS `cart_users_id`, `cart`.`items_id` AS `cart_items_id`, `cart`.`created_at` AS `cart_created_at`, `cart`.`updated_at` AS `cart_updated_at`, `items`.`id` AS `id`, `items`.`name` AS `name`, `items`.`name_ar` AS `name_ar`, `items`.`description` AS `description`, `items`.`description_ar` AS `description_ar`, `items`.`image` AS `image`, `items`.`count` AS `count`, `items`.`active` AS `active`, `items`.`price` AS `price`, `items`.`discount` AS `discount`, `items`.`category_id` AS `category_id`, `items`.`created_at` AS `created_at`, `items`.`updated_at` AS `updated_at` FROM (`cart` join `items` on(`cart`.`items_id` = `items`.`id`)) GROUP BY `cart`.`users_id`, `cart`.`items_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `itemsview`
--
DROP TABLE IF EXISTS `itemsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ayoub`@`localhost` SQL SECURITY DEFINER VIEW `itemsview`  AS SELECT `items`.`id` AS `item_id`, `items`.`name` AS `item_name`, `items`.`name_ar` AS `item_name_ar`, `items`.`description` AS `item_description`, `items`.`description_ar` AS `item_description_ar`, `items`.`image` AS `item_image`, `items`.`count` AS `item_count`, `items`.`active` AS `item_active`, `items`.`price` AS `item_price`, `items`.`discount` AS `item_discount`, `items`.`category_id` AS `item_category_id`, `items`.`created_at` AS `item_created_at`, `items`.`updated_at` AS `item_updated_at`, `categories`.`id` AS `category_id`, `categories`.`name` AS `category_name`, `categories`.`name_ar` AS `category_name_ar`, `categories`.`image` AS `category_image`, `categories`.`created_at` AS `category_created_at`, `categories`.`updated_at` AS `category_updated_at` FROM (`items` join `categories` on(`categories`.`id` = `items`.`category_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `myfavorite`
--
DROP TABLE IF EXISTS `myfavorite`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ayoub`@`localhost` SQL SECURITY DEFINER VIEW `myfavorite`  AS SELECT `favorite`.`id` AS `favorite_id`, `favorite`.`users_id` AS `favorite_users_id`, `favorite`.`items_id` AS `favorite_items_id`, `favorite`.`created_at` AS `favorite_created_at`, `favorite`.`updated_at` AS `favorite_updated_at`, `items`.`id` AS `id`, `items`.`name` AS `name`, `items`.`name_ar` AS `name_ar`, `items`.`description` AS `description`, `items`.`description_ar` AS `description_ar`, `items`.`image` AS `image`, `items`.`count` AS `count`, `items`.`active` AS `active`, `items`.`price` AS `price`, `items`.`discount` AS `discount`, `items`.`category_id` AS `category_id`, `items`.`created_at` AS `created_at`, `items`.`updated_at` AS `updated_at`, `users`.`id` AS `users_id` FROM ((`favorite` join `users` on(`users`.`id` = `favorite`.`users_id`)) join `items` on(`items`.`id` = `favorite`.`items_id`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_id` (`items_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_id` (`items_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
