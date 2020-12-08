-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 08 déc. 2020 à 22:55
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `wdesk`
--

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
                            `id` int(11) NOT NULL,
                            `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
                            `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
                            `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
                            `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
                            `enabled` tinyint(1) NOT NULL,
                            `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                            `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                            `last_login` datetime DEFAULT NULL,
                            `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
                            `password_requested_at` datetime DEFAULT NULL,
                            `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'admin', 'admin', 'decide1983@gmail.com', 'decide1983@gmail.com', 1, NULL, '$2y$13$jb6JWpPG6Vmfl8sKUf6bp.Wvu0vjpXSWSa3pFh6b/.PIs/uYZdaKa', '2020-12-08 22:41:49', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}'),
(3, 'user', 'user', 'decide66@hotmail.com', 'decide66@hotmail.com', 1, NULL, '$2y$13$1/RunRzjCVp0kSAG.Kf7Z.y6oZyxXP0beoZwQQg229zGnSBNJvvcq', '2019-04-25 18:18:04', NULL, NULL, 'a:0:{}'),
(4, 'julien', 'julien', 'julien@ecotoner.fr', 'julien@ecotoner.fr', 1, NULL, '$2y$13$EyiaB2uUjAKfGNbAS/c02ejOaGj2dx.rbBelWSiVXddHVFXi43B0G', '2018-12-28 15:33:20', NULL, NULL, 'a:0:{}'),
(5, 'testuser', 'testuser', 'bruno@ecotoner.fr', 'bruno@ecotoner.fr', 1, NULL, '$2y$13$rFuOXy38o7Za/uTvxM/upu/YOyVt2fwd4UVFoJGidChe3ToEynCWC', '2018-12-28 16:02:50', NULL, NULL, 'a:0:{}'),
(6, 'moi', 'moi', 'decide66@ff.com', 'decide66@ff.com', 1, NULL, '$2y$13$oYdjFEEamXI/7dwgHMfR8.gxNuUiO4qO6XK.8BllgJURthyAyZF5y', '2019-04-25 18:50:50', NULL, NULL, 'a:0:{}'),
(7, 'azerty', 'azerty', 'azerty@azerty.fr', 'azerty@azerty.fr', 1, NULL, '$2y$13$aCWJ7yutxyK84XvYi4C8suqKmt30AtYjbUaW1V6XkZIefgQHVdrv.', '2019-04-25 18:51:23', NULL, NULL, 'a:0:{}'),
(8, 'babibabou', 'babibabou', 'admin@local.com', 'admin@local.com', 1, NULL, '$2y$13$TFMXA3/JKuPhG2XVEX65CumRn3qJM7jYPMa7SG3lKKI5QNBInzSmC', '2019-06-16 17:40:32', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
                          `id` int(11) NOT NULL,
                          `society` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
                          `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                          `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
                          `date` date NOT NULL,
                          `treated` tinyint(1) DEFAULT NULL,
                          `ip_address` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
                          `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ticket`
--

INSERT INTO `ticket` (`id`, `society`, `phone`, `comment`, `date`, `treated`, `ip_address`, `user_id`) VALUES
(1, 'labo', '145', 'le navigateur plante et se coupe après 5min d\'utilisation', '2019-04-25', 1, '(en0)192.168.0.47', 7),
(3, 'tst', '123', 'zfeqezfze', '2019-04-26', NULL, '(en0)192.168.0.47', 1),
(4, 'dqsqd', '23434325355', 'zef zef z  rzR \r\nZ  r \r\nr qgtgs \r\net', '2019-06-16', NULL, '(en0)192.168.0.47', 8),
(5, 'bureau 1', '145', 'Le pc ne s\'allume plus', '2020-12-08', NULL, '', 1),
(6, 'bureau 14', '23', 'firefox plante sur les pages web', '2020-12-08', 1, '', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
    ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
    ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
