-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 06 mars 2020 à 11:44
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `posted_at` datetime NOT NULL,
  `valid` tinyint(1) UNSIGNED NOT NULL,
  `report` tinyint(1) UNSIGNED NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `posted_at`, `valid`, `report`, `author`, `post_id`, `user_id`) VALUES
(2, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-01 08:15:08', 1, 1, '2cutefish', 1, NULL),
(3, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-02 08:10:12', 1, 0, 'Boafarer', 1, NULL),
(6, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-16 12:20:13', 0, 0, NULL, 1, 3),
(7, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-16 05:10:12', 1, 0, NULL, 1, 4),
(8, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-09 00:00:00', 1, 0, NULL, 2, 4),
(9, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-17 07:08:33', 1, 0, NULL, 2, 5),
(10, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-09 08:10:30', 1, 0, 'Sparkchic', 2, NULL),
(11, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-17 15:16:12', 1, 0, 'Sparkchic', 3, NULL),
(12, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-24 13:12:05', 1, 0, NULL, 3, 2),
(13, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-24 13:12:05', 1, 0, 'Requitype', 3, NULL),
(14, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-08 01:03:19', 0, 0, NULL, 6, 5),
(15, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-31 19:12:17', 0, 1, 'Acinisman', 6, NULL),
(16, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-23 14:30:36', 1, 0, NULL, 5, 1),
(17, 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-09 10:35:31', 1, 0, NULL, 6, 6),
(45, 'ultimatest', '2020-03-03 12:02:05', 1, 0, 'Et la ?', 1, NULL),
(46, 'Ce site est vraiment de la bombe\r\n', '2020-03-03 12:02:20', 1, 0, 'Florent', 1, NULL),
(47, 'Ce site est vraiment de la bombe\r\n', '2020-03-03 12:03:03', 1, 0, 'Florent', 1, NULL),
(48, '<p> je suis un paragraphe test<em> Test</em></p>', '2020-03-03 17:23:50', 1, 0, '<h1>Florent</h1>', 1, NULL),
(49, '<script type=\"text/javascript\">\r\n   function Message() {\r\n       var msg=\"Message sur la ligne 1.nMessage sur la ligne 2.n...\";\r\n       console.log(msg)\r\n       alert(msg);\r\n   }\r\n</script>', '2020-03-03 17:26:35', 1, 0, '<h1>Florent</h1>', 1, NULL),
(50, 'Coucocu l\'affichage', '2020-03-03 21:17:12', 1, 0, 'zeze', 1, NULL),
(51, 'Aller ok je t\'ajoute avec les autres\'s', '2020-03-03 21:20:09', 1, 0, 'Ajoutemoi', 1, NULL),
(52, 'Aller ok je t\'ajoute avec les autres\'s', '2020-03-03 21:28:20', 1, 0, 'Ajoutemoi', 1, NULL),
(53, 'Aller ok je t\'ajoute avec les autres\'s', '2020-03-03 21:28:33', 1, 0, 'Ajoutemoi', 1, NULL),
(54, 'Aller ok je t\'ajoute avec les autres\'s', '2020-03-03 21:29:13', 1, 0, 'Ajoutemoi', 1, NULL),
(55, 'Ok test', '2020-03-03 21:33:10', 1, 0, 'test', 1, NULL),
(56, 'Ok test', '2020-03-03 21:33:52', 1, 0, 'test', 1, NULL),
(57, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:22', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(58, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:25', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(59, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:27', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(60, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:30', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(61, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:31', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(62, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:33', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(63, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:35', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(64, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:37', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(65, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:38', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(66, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:39', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(67, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:40', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(68, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:40', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(69, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:41', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(70, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:43', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(71, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:48', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(72, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:49', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(73, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:50', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(74, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:51', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(75, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:51', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(76, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:52', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(77, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:53', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(78, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:53', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(79, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:55', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(80, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:56', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(81, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:57', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(82, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:49:58', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(83, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:50:00', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(84, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:50:01', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(85, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:50:02', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(86, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:50:03', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(87, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:50:04', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(88, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:50:05', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(89, 'LA masse de commentaires inutiles !!!!!', '2020-03-03 22:50:35', 1, 0, 'Allez c\'est partis pour rajouter ', 1, NULL),
(90, 'tessst', '2020-03-04 16:11:23', 1, 0, 'Alors ALors ', 1, NULL),
(91, 'tessst', '2020-03-04 16:11:40', 1, 0, 'Alors ALors ', 1, NULL),
(92, 'Enfinnnnn', '2020-03-04 16:29:07', 1, 0, 'Dernier test', 1, NULL),
(93, 'Blah', '2020-03-04 16:29:53', 1, 0, 'enfin presque ....', 1, NULL),
(94, 'Mais que voila', '2020-03-05 11:03:42', 1, 0, 'Alors test message', 1, NULL),
(95, 'Mais que voila', '2020-03-05 11:04:46', 1, 0, 'Alors test message', 1, NULL),
(96, 'zaeqfqfqf', '2020-03-05 11:05:20', 1, 0, 'Alors test message', 1, NULL),
(97, 'Test de redirectionnnnnnnn', '2020-03-05 16:08:33', 1, 0, 'Allé encore un', 1, NULL),
(98, 'Je suis Gautier', '2020-03-05 21:36:56', 1, 1, 'Gautier', 4, NULL),
(99, '', '2020-03-05 21:37:02', 1, 1, '', 4, NULL),
(100, 'zfqzfqzf', '2020-03-05 21:37:14', 1, 1, 'qfazq', 4, NULL),
(101, 'fzqfFqfqfqSFqsf', '2020-03-05 21:37:20', 1, 1, '', 4, NULL),
(102, 'AHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHhhhhhhhhhhhhhhhhhhhh;;;;;\r\n', '2020-03-05 21:37:31', 1, 1, '', 4, NULL),
(103, 'Coucou', '2020-03-06 12:21:44', 1, 0, 'Florent', 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `sent_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `full_name`, `email`, `subject`, `content`, `sent_at`) VALUES
(1, 'Albert Demonaco', 'albert@gmail.com', 'Peut-on vous subventionner ?', 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2020-01-02 00:00:00'),
(2, 'Shrek', 'shrek@orange.fr', 'J\'ai un chateau en espagne', 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2019-12-05 05:19:03'),
(3, 'Le voisin de site AHaH', 'voisin@gmail.cooooom', 'Y\'en a pas ', 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.', '2021-05-07 23:17:22'),
(4, 'Le chat de shrodinger', 'shrocat@free.fr', 'Etat de santé', 'Pour le moment tout va bien, enfin je crois.', '2020-01-16 06:13:12'),
(5, 'Florent : Test', 'bralocaz@gmail.com', 'ceci est un test', 'Encore un ajout', '2020-03-06 12:04:56');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `name`, `alt`) VALUES
(1, 'alaska.jpg', 'image de présenation du livre billet pour l\'alaska'),
(2, 'chapter1.jpg', 'image du chapitre un, front de mer'),
(3, 'chapter2.jpg', 'image du chapitre deux maison sur ilot'),
(4, 'chapter3.jpg', 'image chapitre 3 rock pret de la mer'),
(5, 'chapter4.jpg', 'image du chapitre quatre ocean et nuages'),
(6, 'chapter5.jpg', 'image chapitre cinq phare sous les vagues'),
(7, 'chapter6.jpg', 'image chapitre six mer calme');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `signed_at` datetime NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `newsletter_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id`, `full_name`, `email`, `signed_at`, `user_id`) VALUES
(1, 'Albert Demonaco', 'albert@gmail.com', '2020-01-02 00:00:00', NULL),
(2, 'Shrek', 'albert@gmail.com', '2020-01-03 00:00:00', 3),
(3, 'Le chat de shrodinger', 'albert@gmail.com', '2020-01-02 00:00:00', NULL),
(4, 'AnthRaven', 'albert@gmail.com', '2020-01-04 00:00:00', NULL),
(5, 'SightSimacti', 'albert@gmail.com', '2020-05-02 00:00:00', NULL),
(6, 'zdqd : zreqdzd', 'bralocaz@gmail.com', '2020-03-06 11:38:57', NULL),
(7, 'zdqd : zreqdzd', 'bralocaz@gmail.com', '2020-03-06 11:39:18', NULL),
(8, 'For : Jean', 'bralocaz@gmail.com', '2020-03-06 12:13:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `posted_at` datetime NOT NULL,
  `draft` tinyint(1) UNSIGNED NOT NULL,
  `like_count` int(10) UNSIGNED NOT NULL,
  `view_count` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `created_at`, `posted_at`, `draft`, `like_count`, `view_count`, `image_id`) VALUES
(1, 'Chapitre 1: Les hivers', 'Non ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.\r\n\r\nCoactique aliquotiens nostri pedites ad eos persequendos scandere clivos sublimes etiam si lapsantibus plantis fruticeta prensando vel dumos ad vertices venerint summos, inter arta tamen et invia nullas acies explicare permissi nec firmare nisu valido gressus: hoste discursatore rupium abscisa volvente, ruinis ponderum inmanium consternuntur, aut ex necessitate ultima fortiter dimicante, superati periculose per prona discedunt.\r\n\r\nNam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam (sed nihil est quod illi non persequantur argutiis): partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.\r\n\r\nIam in altera philosophiae parte. quae est quaerendi ac disserendi, quae logikh dicitur, iste vester plane, ut mihi quidem videtur, inermis ac nudus est. tollit definitiones, nihil de dividendo ac partiendo docet, non quo modo efficiatur concludaturque ratio tradit, non qua via captiosa solvantur ambigua distinguantur ostendit; iudicia rerum in sensibus ponit, quibus si semel aliquid falsi pro vero probatum sit, sublatum esse omne iudicium veri et falsi putat.\r\n\r\nQuis enim aut eum diligat quem metuat, aut eum a quo se metui putet? Coluntur tamen simulatione dumtaxat ad tempus. Quod si forte, ut fit plerumque, ceciderunt, tum intellegitur quam fuerint inopes amicorum. Quod Tarquinium dixisse ferunt, tum exsulantem se intellexisse quos fidos amicos habuisset, quos infidos, cum iam neutris gratiam referre posset.\r\n\r\nEt est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.\r\n\r\nHac ita persuasione reducti intra moenia bellatores obseratis undique portarum aditibus, propugnaculis insistebant et pinnis, congesta undique saxa telaque habentes in promptu, ut si quis se proripuisset interius, multitudine missilium sterneretur et lapidum.\r\n\r\nSed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam. ut enim Simonides lyricus docet, beate perfecta ratione vieturo ante alia patriam esse convenit gloriosam.\r\n\r\nOmitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico.\r\n\r\nIsdem diebus Apollinaris Domitiani gener, paulo ante agens palatii Caesaris curam, ad Mesopotamiam missus a socero per militares numeros immodice scrutabatur, an quaedam altiora meditantis iam Galli secreta susceperint scripta, qui conpertis Antiochiae gestis per minorem Armeniam lapsus Constantinopolim petit exindeque per protectores retractus artissime tenebatur.', '2020-01-01 07:13:20', '2020-01-01 07:13:20', 0, 124, 543545, 2),
(2, 'Chapitre 2 : Rencontres', 'Non ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.\r\n\r\nCoactique aliquotiens nostri pedites ad eos persequendos scandere clivos sublimes etiam si lapsantibus plantis fruticeta prensando vel dumos ad vertices venerint summos, inter arta tamen et invia nullas acies explicare permissi nec firmare nisu valido gressus: hoste discursatore rupium abscisa volvente, ruinis ponderum inmanium consternuntur, aut ex necessitate ultima fortiter dimicante, superati periculose per prona discedunt.\r\n\r\nNam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam (sed nihil est quod illi non persequantur argutiis): partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.\r\n\r\nIam in altera philosophiae parte. quae est quaerendi ac disserendi, quae logikh dicitur, iste vester plane, ut mihi quidem videtur, inermis ac nudus est. tollit definitiones, nihil de dividendo ac partiendo docet, non quo modo efficiatur concludaturque ratio tradit, non qua via captiosa solvantur ambigua distinguantur ostendit; iudicia rerum in sensibus ponit, quibus si semel aliquid falsi pro vero probatum sit, sublatum esse omne iudicium veri et falsi putat.\r\n\r\nQuis enim aut eum diligat quem metuat, aut eum a quo se metui putet? Coluntur tamen simulatione dumtaxat ad tempus. Quod si forte, ut fit plerumque, ceciderunt, tum intellegitur quam fuerint inopes amicorum. Quod Tarquinium dixisse ferunt, tum exsulantem se intellexisse quos fidos amicos habuisset, quos infidos, cum iam neutris gratiam referre posset.\r\n\r\nEt est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.\r\n\r\nHac ita persuasione reducti intra moenia bellatores obseratis undique portarum aditibus, propugnaculis insistebant et pinnis, congesta undique saxa telaque habentes in promptu, ut si quis se proripuisset interius, multitudine missilium sterneretur et lapidum.\r\n\r\nSed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam. ut enim Simonides lyricus docet, beate perfecta ratione vieturo ante alia patriam esse convenit gloriosam.\r\n\r\nOmitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico.\r\n\r\nIsdem diebus Apollinaris Domitiani gener, paulo ante agens palatii Caesaris curam, ad Mesopotamiam missus a socero per militares numeros immodice scrutabatur, an quaedam altiora meditantis iam Galli secreta susceperint scripta, qui conpertis Antiochiae gestis per minorem Armeniam lapsus Constantinopolim petit exindeque per protectores retractus artissime tenebatur.', '2020-01-09 11:07:11', '2020-01-03 16:08:25', 0, 0, 0, 3),
(3, 'Chapitre 3 : Le froid est mordant', 'Non ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.\r\n\r\nCoactique aliquotiens nostri pedites ad eos persequendos scandere clivos sublimes etiam si lapsantibus plantis fruticeta prensando vel dumos ad vertices venerint summos, inter arta tamen et invia nullas acies explicare permissi nec firmare nisu valido gressus: hoste discursatore rupium abscisa volvente, ruinis ponderum inmanium consternuntur, aut ex necessitate ultima fortiter dimicante, superati periculose per prona discedunt.\r\n\r\nNam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam (sed nihil est quod illi non persequantur argutiis): partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.\r\n\r\nIam in altera philosophiae parte. quae est quaerendi ac disserendi, quae logikh dicitur, iste vester plane, ut mihi quidem videtur, inermis ac nudus est. tollit definitiones, nihil de dividendo ac partiendo docet, non quo modo efficiatur concludaturque ratio tradit, non qua via captiosa solvantur ambigua distinguantur ostendit; iudicia rerum in sensibus ponit, quibus si semel aliquid falsi pro vero probatum sit, sublatum esse omne iudicium veri et falsi putat.\r\n\r\nQuis enim aut eum diligat quem metuat, aut eum a quo se metui putet? Coluntur tamen simulatione dumtaxat ad tempus. Quod si forte, ut fit plerumque, ceciderunt, tum intellegitur quam fuerint inopes amicorum. Quod Tarquinium dixisse ferunt, tum exsulantem se intellexisse quos fidos amicos habuisset, quos infidos, cum iam neutris gratiam referre posset.\r\n\r\nEt est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.\r\n\r\nHac ita persuasione reducti intra moenia bellatores obseratis undique portarum aditibus, propugnaculis insistebant et pinnis, congesta undique saxa telaque habentes in promptu, ut si quis se proripuisset interius, multitudine missilium sterneretur et lapidum.\r\n\r\nSed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam. ut enim Simonides lyricus docet, beate perfecta ratione vieturo ante alia patriam esse convenit gloriosam.\r\n\r\nOmitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico.\r\n\r\nIsdem diebus Apollinaris Domitiani gener, paulo ante agens palatii Caesaris curam, ad Mesopotamiam missus a socero per militares numeros immodice scrutabatur, an quaedam altiora meditantis iam Galli secreta susceperint scripta, qui conpertis Antiochiae gestis per minorem Armeniam lapsus Constantinopolim petit exindeque per protectores retractus artissime tenebatur.', '2020-01-03 00:08:15', '2020-01-06 18:22:19', 0, 313, 5463, 4),
(4, 'Chapitre 4 : Sauve qui peut', 'Non ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.\r\n\r\nCoactique aliquotiens nostri pedites ad eos persequendos scandere clivos sublimes etiam si lapsantibus plantis fruticeta prensando vel dumos ad vertices venerint summos, inter arta tamen et invia nullas acies explicare permissi nec firmare nisu valido gressus: hoste discursatore rupium abscisa volvente, ruinis ponderum inmanium consternuntur, aut ex necessitate ultima fortiter dimicante, superati periculose per prona discedunt.\r\n\r\nNam quibusdam, quos audio sapientes habitos in Graecia, placuisse opinor mirabilia quaedam (sed nihil est quod illi non persequantur argutiis): partim fugiendas esse nimias amicitias, ne necesse sit unum sollicitum esse pro pluribus; satis superque esse sibi suarum cuique rerum, alienis nimis implicari molestum esse; commodissimum esse quam laxissimas habenas habere amicitiae, quas vel adducas, cum velis, vel remittas; caput enim esse ad beate vivendum securitatem, qua frui non possit animus, si tamquam parturiat unus pro pluribus.\r\n\r\nIam in altera philosophiae parte. quae est quaerendi ac disserendi, quae logikh dicitur, iste vester plane, ut mihi quidem videtur, inermis ac nudus est. tollit definitiones, nihil de dividendo ac partiendo docet, non quo modo efficiatur concludaturque ratio tradit, non qua via captiosa solvantur ambigua distinguantur ostendit; iudicia rerum in sensibus ponit, quibus si semel aliquid falsi pro vero probatum sit, sublatum esse omne iudicium veri et falsi putat.\r\n\r\nQuis enim aut eum diligat quem metuat, aut eum a quo se metui putet? Coluntur tamen simulatione dumtaxat ad tempus. Quod si forte, ut fit plerumque, ceciderunt, tum intellegitur quam fuerint inopes amicorum. Quod Tarquinium dixisse ferunt, tum exsulantem se intellexisse quos fidos amicos habuisset, quos infidos, cum iam neutris gratiam referre posset.\r\n\r\nEt est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.\r\n\r\nHac ita persuasione reducti intra moenia bellatores obseratis undique portarum aditibus, propugnaculis insistebant et pinnis, congesta undique saxa telaque habentes in promptu, ut si quis se proripuisset interius, multitudine missilium sterneretur et lapidum.\r\n\r\nSed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam. ut enim Simonides lyricus docet, beate perfecta ratione vieturo ante alia patriam esse convenit gloriosam.\r\n\r\nOmitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico.\r\n\r\nIsdem diebus Apollinaris Domitiani gener, paulo ante agens palatii Caesaris curam, ad Mesopotamiam missus a socero per militares numeros immodice scrutabatur, an quaedam altiora meditantis iam Galli secreta susceperint scripta, qui conpertis Antiochiae gestis per minorem Armeniam lapsus Constantinopolim petit exindeque per protectores retractus artissime tenebatur.', '2020-01-04 00:00:00', '2020-01-04 00:00:00', 1, 0, 0, 5),
(5, 'Chapitre 5 : Ouf sauvés', 'Eodem tempore etiam Hymetii praeclarae indolis viri negotium est actitatum, cuius hunc novimus esse textum. cum Africam pro consule regeret Carthaginiensibus victus inopia iam lassatis, ex horreis Romano populo destinatis frumentum dedit, pauloque postea cum provenisset segetum copia, integre sine ulla restituit mora.\r\n\r\nTantum autem cuique tribuendum, primum quantum ipse efficere possis, deinde etiam quantum ille quem diligas atque adiuves, sustinere. Non enim neque tu possis, quamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupilium potuit consulem efficere, fratrem eius L. non potuit. Quod si etiam possis quidvis deferre ad alterum, videndum est tamen, quid ille possit sustinere.\r\n\r\nInter haec Orfitus praefecti potestate regebat urbem aeternam ultra modum delatae dignitatis sese efferens insolenter, vir quidem prudens et forensium negotiorum oppido gnarus, sed splendore liberalium doctrinarum minus quam nobilem decuerat institutus, quo administrante seditiones sunt concitatae graves ob inopiam vini: huius avidis usibus vulgus intentum ad motus asperos excitatur et crebros.\r\n\r\nNon ergo erunt homines deliciis diffluentes audiendi, si quando de amicitia, quam nec usu nec ratione habent cognitam, disputabunt. Nam quis est, pro deorum fidem atque hominum! qui velit, ut neque diligat quemquam nec ipse ab ullo diligatur, circumfluere omnibus copiis atque in omnium rerum abundantia vivere? Haec enim est tyrannorum vita nimirum, in qua nulla fides, nulla caritas, nulla stabilis benevolentiae potest esse fiducia, omnia semper suspecta atque sollicita, nullus locus amicitiae.\r\n\r\nDein Syria per speciosam interpatet diffusa planitiem. hanc nobilitat Antiochia, mundo cognita civitas, cui non certaverit alia advecticiis ita adfluere copiis et internis, et Laodicia et Apamia itidemque Seleucia iam inde a primis auspiciis florentissimae.\r\n\r\nEt olim licet otiosae sint tribus pacataeque centuriae et nulla suffragiorum certamina set Pompiliani redierit securitas temporis, per omnes tamen quotquot sunt partes terrarum, ut domina suscipitur et regina et ubique patrum reverenda cum auctoritate canities populique Romani nomen circumspectum et verecundum.\r\n\r\nSed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam. ut enim Simonides lyricus docet, beate perfecta ratione vieturo ante alia patriam esse convenit gloriosam.\r\n\r\nEt hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.\r\n\r\nAdvenit post multos Scudilo Scutariorum tribunus velamento subagrestis ingenii persuasionis opifex callidus. qui eum adulabili sermone seriis admixto solus omnium proficisci pellexit vultu adsimulato saepius replicando quod flagrantibus votis eum videre frater cuperet patruelis, siquid per inprudentiam gestum est remissurus ut mitis et clemens, participemque eum suae maiestatis adscisceret, futurum laborum quoque socium, quos Arctoae provinciae diu fessae poscebant.\r\n\r\nIis igitur est difficilius satis facere, qui se Latina scripta dicunt contemnere. in quibus hoc primum est in quo admirer, cur in gravissimis rebus non delectet eos sermo patrius, cum idem fabellas Latinas ad verbum e Graecis expressas non inviti legant. quis enim tam inimicus paene nomini Romano est, qui Ennii Medeam aut Antiopam Pacuvii spernat aut reiciat, quod se isdem Euripidis fabulis delectari dicat, Latinas litteras oderit?\r\n\r\nSed (saepe enim redeo ad Scipionem, cuius omnis sermo erat de amicitia) querebatur, quod omnibus in rebus homines diligentiores essent; capras et oves quot quisque haberet, dicere posse, amicos quot haberet, non posse dicere et in illis quidem parandis adhibere curam, in amicis eligendis neglegentis esse nec habere quasi signa quaedam et notas, quibus eos qui ad amicitias essent idonei, iudicarent. Sunt igitur firmi et stabiles et constantes eligendi; cuius generis est magna penuria. Et iudicare difficile est sane nisi expertum; experiendum autem est in ipsa amicitia. Ita praecurrit amicitia iudicium tollitque experiendi potestatem.\r\n\r\nVita est illis semper in fuga uxoresque mercenariae conductae ad tempus ex pacto atque, ut sit species matrimonii, dotis nomine futura coniunx hastam et tabernaculum offert marito, post statum diem si id elegerit discessura, et incredibile est quo ardore apud eos in venerem uterque solvitur sexus.\r\n\r\nQuanta autem vis amicitiae sit, ex hoc intellegi maxime potest, quod ex infinita societate generis humani, quam conciliavit ipsa natura, ita contracta res est et adducta in angustum ut omnis caritas aut inter duos aut inter paucos iungeretur.\r\n\r\nThalassius vero ea tempestate praefectus praetorio praesens ipse quoque adrogantis ingenii, considerans incitationem eius ad multorum augeri discrimina, non maturitate vel consiliis mitigabat, ut aliquotiens celsae potestates iras principum molliverunt, sed adversando iurgandoque cum parum congrueret, eum ad rabiem potius evibrabat, Augustum actus eius exaggerando creberrime docens, idque, incertum qua mente, ne lateret adfectans. quibus mox Caesar acrius efferatus, velut contumaciae quoddam vexillum altius erigens, sine respectu salutis alienae vel suae ad vertenda opposita instar rapidi fluminis irrevocabili impetu ferebatur.\r\n\r\nUnde Rufinus ea tempestate praefectus praetorio ad discrimen trusus est ultimum. ire enim ipse compellebatur ad militem, quem exagitabat inopia simul et feritas, et alioqui coalito more in ordinarias dignitates asperum semper et saevum, ut satisfaceret atque monstraret, quam ob causam annonae convectio sit impedita.\r\n\r\nTantum autem cuique tribuendum, primum quantum ipse efficere possis, deinde etiam quantum ille quem diligas atque adiuves, sustinere. Non enim neque tu possis, quamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupilium potuit consulem efficere, fratrem eius L. non potuit. Quod si etiam possis quidvis deferre ad alterum, videndum est tamen, quid ille possit sustinere.\r\n\r\nExsistit autem hoc loco quaedam quaestio subdifficilis, num quando amici novi, digni amicitia, veteribus sint anteponendi, ut equis vetulis teneros anteponere solemus. Indigna homine dubitatio! Non enim debent esse amicitiarum sicut aliarum rerum satietates; veterrima quaeque, ut ea vina, quae vetustatem ferunt, esse debet suavissima; verumque illud est, quod dicitur, multos modios salis simul edendos esse, ut amicitiae munus expletum sit.\r\n\r\nVbi curarum abiectis ponderibus aliis tamquam nodum et codicem difficillimum Caesarem convellere nisu valido cogitabat, eique deliberanti cum proximis clandestinis conloquiis et nocturnis qua vi, quibusve commentis id fieret, antequam effundendis rebus pertinacius incumberet confidentia, acciri mollioribus scriptis per simulationem tractatus publici nimis urgentis eundem placuerat Gallum, ut auxilio destitutus sine ullo interiret obstaculo.\r\n\r\nEt hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.\r\n\r\nEt interdum acciderat, ut siquid in penetrali secreto nullo citerioris vitae ministro praesente paterfamilias uxori susurrasset in aurem, velut Amphiarao referente aut Marcio, quondam vatibus inclitis, postridie disceret imperator. ideoque etiam parietes arcanorum soli conscii timebantur.', '2020-01-23 11:35:45', '2020-01-23 11:35:45', 1, 0, 0, 6),
(6, 'Chapitre 6 : L\'entracte', 'Post quorum necem nihilo lenius ferociens Gallus ut leo cadaveribus pastus multa huius modi scrutabatur. quae singula narrare non refert, me professione modum, quod evitandum est, excedamus.\r\n\r\nSuperatis Tauri montis verticibus qui ad solis ortum sublimius attolluntur, Cilicia spatiis porrigitur late distentis dives bonis omnibus terra, eiusque lateri dextro adnexa Isauria, pari sorte uberi palmite viget et frugibus minutis, quam mediam navigabile flumen Calycadnus interscindit.\r\n\r\nHas autem provincias, quas Orontes ambiens amnis imosque pedes Cassii montis illius celsi praetermeans funditur in Parthenium mare, Gnaeus Pompeius superato Tigrane regnis Armeniorum abstractas dicioni Romanae coniunxit.', '2020-01-24 06:28:14', '2020-01-24 06:28:14', 0, 66, 0, 7);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `username`) VALUES
(1, 'anth@gmail.com', 'anth2624', 'AnthRaven'),
(2, 'sight@orange.fr', 'sight24621', 'SightSimacti'),
(3, 'agag@free.fr', 'agag8543235', 'Agagorma'),
(4, 'kapt@wanadoo.fr', 'Kapt131', 'Kaptaine'),
(5, 'chua@gmail.com', 'cha83245', 'Chualian'),
(6, 'sugh@marchanddefleur.fr', 'sugh03!9.', 'Sughrog');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
