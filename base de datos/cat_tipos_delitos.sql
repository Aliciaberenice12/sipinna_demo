-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sipinna
CREATE DATABASE IF NOT EXISTS `sipinna` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sipinna`;

-- Volcando estructura para tabla sipinna.cat_tipos_delitos
CREATE TABLE IF NOT EXISTS `cat_tipos_delitos` (
  `id_delito` int(11) NOT NULL AUTO_INCREMENT,
  `delito` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_delito`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.cat_tipos_delitos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_tipos_delitos` DISABLE KEYS */;
INSERT INTO `cat_tipos_delitos` (`id_delito`, `delito`) VALUES
	(1, 'violencia familiar'),
	(2, 'Omision de Cuidado'),
	(3, 'Abuso sexual contra menores'),
	(4, 'Amenazas'),
	(5, 'Maltrato a persona incapaz'),
	(6, 'Corrupción de menores'),
	(7, 'Trata de personas'),
	(8, 'Narcomenudeo'),
	(9, 'Violación'),
	(10, 'Arma de fuego'),
	(11, 'Estupro'),
	(12, 'Pederastia'),
	(13, 'Robo'),
	(14, 'Contra el medio ambiente'),
	(15, 'Número de delitos');
/*!40000 ALTER TABLE `cat_tipos_delitos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
