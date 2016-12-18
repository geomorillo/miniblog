-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5137
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla miniblog.activitylog
CREATE TABLE IF NOT EXISTS `activitylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `username` varchar(30) NOT NULL,
  `action` varchar(100) NOT NULL,
  `additionalinfo` varchar(500) NOT NULL DEFAULT 'none',
  `ip` varchar(39) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miniblog.activitylog: 0 rows
/*!40000 ALTER TABLE `activitylog` DISABLE KEYS */;
/*!40000 ALTER TABLE `activitylog` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.attempts
CREATE TABLE IF NOT EXISTS `attempts` (
  `ip` varchar(39) NOT NULL,
  `count` int(11) NOT NULL,
  `expiredate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miniblog.attempts: 0 rows
/*!40000 ALTER TABLE `attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `attempts` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.auth_sessions
CREATE TABLE IF NOT EXISTS `auth_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miniblog.auth_sessions: 0 rows
/*!40000 ALTER TABLE `auth_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_sessions` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla miniblog.categorias: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `name`, `url`) VALUES
	(5, 'sdfa', '5'),
	(6, 'asda', '3'),
	(14, 'geo', '2'),
	(15, 'geo', '2'),
	(16, '1', '1');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `byuser` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comentarios_posts` (`id_post`),
  CONSTRAINT `FK_comentarios_posts` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla miniblog.comentarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` (`id`, `byuser`, `contenido`, `fecha`, `id_post`) VALUES
	(1, 'Anonimo', 'hola', '2016-11-22 18:58:41', 8);
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.navbar
CREATE TABLE IF NOT EXISTS `navbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `heading` varchar(100) DEFAULT NULL,
  `secondarytext` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla miniblog.navbar: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `navbar` DISABLE KEYS */;
INSERT INTO `navbar` (`id`, `name`, `url`, `heading`, `secondarytext`) VALUES
	(1, 'HOME', '/', 'MINIBLOG', 'Cool'),
	(24, 'Contactos', '7', 'Contacto', ''),
	(25, 'Servicios', '8', '', '');
/*!40000 ALTER TABLE `navbar` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `byuser` varchar(200) NOT NULL,
  `postedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_recurso` varchar(200) DEFAULT NULL,
  `text` text NOT NULL,
  `readmore` varchar(2) NOT NULL DEFAULT '0',
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_posts_categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla miniblog.posts: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `byuser`, `postedon`, `id_recurso`, `text`, `readmore`, `id_categoria`) VALUES
	(1, 'articulo1', 'xxxxx', '2016-11-06 22:00:36', '12', 'xxxxxx', '', 3),
	(5, 'articulo2', 'geovanny', '2016-11-07 17:53:49', '14', 'aaaaa', '', 6),
	(6, 'articulo3', 'geovanny', '2016-11-07 17:54:18', '15', 'xxxxxx', '', 3),
	(7, 'articulo4', 'geovanny', '2016-11-09 21:04:35', '16', 'chichochicho', '', 5),
	(8, 'articulo5', 'geovanny', '2016-11-19 11:43:04', '12', 'ssss', 'on', 3),
	(9, 'articulo6', 'geovanny', '2016-11-19 11:50:14', '12', 'S', '', 3);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.recursos
CREATE TABLE IF NOT EXISTS `recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='imagenes en general';

-- Volcando datos para la tabla miniblog.recursos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `recursos` DISABLE KEYS */;
INSERT INTO `recursos` (`id`, `url`) VALUES
	(12, 'galeria/molly.png'),
	(14, 'galeria/daniel.jpg'),
	(15, 'galeria/jenny.jpg'),
	(16, 'galeria/matthew.png');
/*!40000 ALTER TABLE `recursos` ENABLE KEYS */;

-- Volcando estructura para tabla miniblog.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `activekey` varchar(15) NOT NULL DEFAULT '0',
  `resetkey` varchar(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla miniblog.users: 0 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
