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

-- Volcando estructura para tabla sipinna.cat_derechos_vulnerados
CREATE TABLE IF NOT EXISTS `cat_derechos_vulnerados` (
  `id_derecho` int(11) NOT NULL AUTO_INCREMENT,
  `derecho` varchar(100) NOT NULL,
  PRIMARY KEY (`id_derecho`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.cat_derechos_vulnerados: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_derechos_vulnerados` DISABLE KEYS */;
INSERT INTO `cat_derechos_vulnerados` (`id_derecho`, `derecho`) VALUES
	(1, 'A la vida,a la supervivencia y al desarrollo'),
	(2, 'De prioridad'),
	(3, 'A la identidad'),
	(4, 'A vivir en familia'),
	(5, 'A la igualdad sustantiva'),
	(6, 'A la no discriminacion'),
	(7, 'A vivir en condiciones de bienestar y a un sano desarrollo integral'),
	(8, 'A una vida libre de violencia y a la integridad personal'),
	(9, 'A la protección de la salud y la seguridad social'),
	(10, 'A la inclusión de niñas,niños y adolecentes con discapacidad'),
	(11, 'A la educación'),
	(12, 'Al descanso y al esparcimiento'),
	(13, 'A la libertad de convicciones éticas,pensamiento,conciencia,religion y cultura'),
	(14, 'A la libertad de expresión y de acceso a la información.');
/*!40000 ALTER TABLE `cat_derechos_vulnerados` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
