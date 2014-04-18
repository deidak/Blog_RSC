-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE IF NOT EXISTS `billet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `contenu` text CHARACTER SET latin1 NOT NULL,
  `publie` int(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;# MySQL a retourné un résultat vide (aucune ligne).


-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;# MySQL a retourné un résultat vide (aucune ligne).


-- --------------------------------------------------------

--
-- Structure de la table `tag_billet`
--

CREATE TABLE IF NOT EXISTS `tag_billet` (
  `tag_id` int(11) NOT NULL,
  `billet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;# MySQL a retourné un résultat vide (aucune ligne).
