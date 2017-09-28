-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 11 Août 2017 à 13:43
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd_dani`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `auteur` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `datecreation` datetime NOT NULL,
  `datemodification` datetime NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `auteur`, `titre`, `contenu`, `date`, `datecreation`, `datemodification`, `actif`, `image`) VALUES
(1, 1, 'TestActuAdmin', 'Contenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu ModifiéContenu Modifié', '2017-08-10 09:20:20', '2017-08-10 09:20:20', '2017-08-11 11:02:59', 0, 1),
(2, 2, 'La nuit ne dure pas', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2017-08-11 09:11:39', '2017-08-11 09:11:39', '2017-08-11 10:57:45', 1, 1),
(3, 2, 'La nuit ne dure Toujours pas', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2017-08-11 09:12:03', '2017-08-11 09:12:03', '2017-08-11 09:12:03', 1, 1),
(4, 2, 'LA NUIT ETERNELLE', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2017-08-11 09:12:26', '2017-08-11 09:12:26', '2017-08-11 09:12:26', 1, 1),
(5, 1, 'TestIMAGE ADMIN', 'TestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMINTestIMAGE ADMIN', '2017-08-11 13:11:54', '2017-08-11 13:11:54', '2017-08-11 13:11:54', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `bio`
--

CREATE TABLE `bio` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `bio`
--

INSERT INTO `bio` (`id`, `titre`, `contenu`, `actif`) VALUES
(1, 'TestBioAdmin', 'BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN BIOADMIN modifié', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

CREATE TABLE `cinema` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `moviereleasedate` datetime NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `cinema`
--

INSERT INTO `cinema` (`id`, `titre`, `contenu`, `moviereleasedate`, `actif`) VALUES
(1, 'TestADMINFILM', 'DescriptionADMIN modifié', '2012-01-01 00:00:00', 1),
(2, 'Vol au-dessus d\'un nid de coucou', 'R. P. McMurphy se fait interner dans un hôpital psychiatrique pour échapper à la prison suite à un viol supposé. Il va être touché par la détresse et la solitude des patients. Sous les soins de l\'infirmière Ratched, il s\'oppose vite par sa forte personnalité aux méthodes répressives de cette dernière et décide alors de révolutionner ce petit monde.', '2012-01-01 00:00:00', 1),
(3, 'À la poursuite du diamant vert', 'Joan Wilder, une romancière, doit rapporter à sa sœur, kidnappée en Colombie, une carte que lui a expédiée le mari de cette dernière peu avant qu\'il soit retrouvé mort. Après s\'être trompé d\'autocar à l\'aéroport, elle rencontre un aventurier nommé Jack Colton. Celui-ci devine que la carte décrit la cachette d\'un trésor qu\'ils vont se mettre à chercher ensemble : le diamant vert.', '2013-01-01 00:00:00', 1),
(4, 'Batman, le défi', 'À Gotham City, un couple fortuné, Tucker et Esther Cobblepot (Paul Reubens et Diane Salinger), abandonne son enfant à la naissance en le jetant dans les égouts à cause de sa difformité. Il est recueilli et élevé par les manchots du zoo. Trente-trois ans plus tard, Oswald Cobblepot (Danny DeVito) a grandi dans les égouts et refait surface comme un criminel nommé Le Pingouin. Il kidnappe un industriel millionnaire, Max Shreck (Christopher Walken). À cause des preuves rassemblées par le Pingouin des activités criminelles des affaires de Shreck, ce dernier lui propose de le sortir des égouts et de le faire entrer dans l\'élite de Gotham. Le Pingouin élabore un plan pour faire son entrée dans le monde public en se faisant passer pour un héros. Il fait kidnapper le fils du maire pour ensuite le délivrer lui-même. Malgré la popularité du Pingouin, le millionnaire Bruce Wayne, alias Batman (Michael Keaton), reste sceptique sur ce dernier. Il enquête sur le passé du Pingouin et établit un lien avec un gang de criminels, le Gang du Cirque du Triangle Rouge. Le gang a récemment fait des ravages sur Gotham, entrainant la disparition de plusieurs enfants. Il décide de défendre Gotham contre eux.', '2015-01-01 00:00:00', 1),
(5, 'Jumeaux', 'Deux frères jumeaux complètement différents aussi bien du point de vue physique que moral, issus d\'une expérience génétique, se retrouvent à l\'âge adulte et deviennent inséparables. Julius est l\'homme parfait tandis que Vincent est le reste de l\'expérience...', '2014-01-01 00:00:00', 1),
(6, 'Junior', 'Les recherches du docteur Alex Hesse (Arnold Schwarzenegger), un savant autrichien qui travaille aux Etats-Unis, sont sur le point d\'aboutir, son traitement devrait enfin assurer aux femmes des grossesses sans risques. Mais les autorités estiment qu\'elles ont assez attendu, et interrompent le financement du projet avant qu\'il ait pu être testé sur les humains. Alex songe déjà à rentrer en Europe quand son associé, le gynécologue Larry Arbogast (Danny DeVito), lui suggère de vérifier les bienfaits de son traitement sur sa propre personne', '2016-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `concert`
--

CREATE TABLE `concert` (
  `id` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `concert`
--

INSERT INTO `concert` (`id`, `ville`, `salle`, `date`, `actif`) VALUES
(1, 'TestADMINVille', 'SALLE modifiée', '2022-12-01 00:00:00', 1),
(2, 'Nantes', 'Salle Paul Fort', '2016-08-04 00:00:00', 1),
(3, 'Bordeaux', 'Bordeaux métropole Arena', '2012-08-18 00:00:00', 1),
(4, 'Toulouse', 'Le zénith', '2017-09-05 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `discographie`
--

CREATE TABLE `discographie` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discreleasedate` datetime NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `discographie`
--

INSERT INTO `discographie` (`id`, `titre`, `contenu`, `discreleasedate`, `actif`) VALUES
(1, 'TestDiscAdmin', 'DescriptionADMIN', '2012-01-01 00:00:00', 1),
(2, '1970 dani', 'La Petite qui revient de loin / Et nous avons parlé de toi / On en perd un peu / À celle qui m\'a pris ma poupée / Vive l\'enfance / Lady Lune / Mon homme à moi… c\'est toi / Seule dans les beaux quartiers / Je suis la cigale / Darling dollar / Émile dit Mimile', '2012-01-01 00:00:00', 1),
(3, '1977 : Les Migrateurs', 'Les Migrateurs / Le Mec / Sans savoir qu\'il a mon cœur / Les Banques et les femmes / Le Garçon manqué / Tu ne demandes pas au matin de faire le lever du soleil / Le Jour où l\'on fait sa valise / J\'ai le bleu / Sale gosse / T\'as pas le droit / Des gens pas méchants / Savez-vous patiner', '2013-01-01 00:00:00', 1),
(4, '1969 : 45 Tours', 'Un p\'tit boy, c\'est gentil / La Jaquette à Toto', '2014-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datecreation` datetime NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `titre`, `datecreation`, `actif`, `adresse`) VALUES
(1, 'Test', '2017-08-10 12:33:27', 1, 'audio.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datecreation` datetime NOT NULL,
  `datemodification` datetime NOT NULL,
  `actif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`, `email`, `datecreation`, `datemodification`, `actif`) VALUES
(1, 'Admin', 'admin', 'Admin@rancunestudio.net', '2017-08-10 09:16:32', '2017-08-10 09:16:32', 1),
(2, 'Auteur', 'auteur', 'auteur@rancunestudio.net', '2017-08-10 09:17:03', '2017-08-10 09:17:03', 1),
(3, 'Editeur', 'editeur', 'editeur@rancunestudio.net', '2017-08-10 09:17:20', '2017-08-10 11:35:29', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E6655AB140` (`auteur`),
  ADD KEY `IDX_23A0E66C53D045F` (`image`);

--
-- Index pour la table `bio`
--
ALTER TABLE `bio`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `discographie`
--
ALTER TABLE `discographie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `bio`
--
ALTER TABLE `bio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `concert`
--
ALTER TABLE `concert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `discographie`
--
ALTER TABLE `discographie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6655AB140` FOREIGN KEY (`auteur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `FK_23A0E66C53D045F` FOREIGN KEY (`image`) REFERENCES `image` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
