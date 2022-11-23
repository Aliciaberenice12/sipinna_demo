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

-- Volcando estructura para tabla sipinna.tbl_can_reportes
CREATE TABLE IF NOT EXISTS `tbl_can_reportes` (
  `id_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_can_exp` varchar(250) DEFAULT NULL,
  `can_fecha_avance` date DEFAULT NULL,
  `can_tipo_avance` varchar(50) DEFAULT NULL,
  `can_descripcion_avance` varchar(250) DEFAULT NULL,
  `can_estatus_avance` varchar(250) DEFAULT NULL,
  `created_by` date DEFAULT NULL,
  `update_by` date DEFAULT NULL,
  PRIMARY KEY (`id_reporte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_can_reportes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_can_reportes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_can_reportes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
