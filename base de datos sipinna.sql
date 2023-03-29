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


-- Volcando estructura de base de datos para siop_datos
CREATE DATABASE IF NOT EXISTS `siop_datos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `siop_datos`;

-- Volcando estructura para tabla siop_datos.org005_oficinas
CREATE TABLE IF NOT EXISTS `org005_oficinas` (
  `clave_oficina` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento_clave` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion_id` bigint(20) unsigned DEFAULT NULL,
  `nombre_oficina` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `org005_oficinas_clave_oficina_unique` (`clave_oficina`),
  KEY `org005_oficinas_departamento_clave_foreign` (`departamento_clave`),
  KEY `org005_oficinas_ubicacion_id_foreign` (`ubicacion_id`),
  KEY `org005_oficinas_created_by_foreign` (`created_by`),
  KEY `org005_oficinas_updated_by_foreign` (`updated_by`),
  CONSTRAINT `org005_oficinas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `adm003_usuarios` (`id_usuario`) ON UPDATE CASCADE,
  CONSTRAINT `org005_oficinas_departamento_clave_foreign` FOREIGN KEY (`departamento_clave`) REFERENCES `org004_departamentos` (`clave_departamento`) ON UPDATE CASCADE,
  CONSTRAINT `org005_oficinas_ubicacion_id_foreign` FOREIGN KEY (`ubicacion_id`) REFERENCES `org000_ubicaciones` (`id_ubicacion`) ON UPDATE CASCADE,
  CONSTRAINT `org005_oficinas_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `adm003_usuarios` (`id_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla siop_datos.org005_oficinas: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `org005_oficinas` DISABLE KEYS */;
INSERT INTO `org005_oficinas` (`clave_oficina`, `departamento_clave`, `ubicacion_id`, `nombre_oficina`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	('101S', '101S', NULL, 'EJECUTIVO DEL ESTADO', 1, 1, '2022-07-17 14:54:18', '2022-07-17 14:56:40', NULL),
	('11001-1', '11001-1', NULL, 'UNIDAD ADMINISTRATIVA', 1, 1, '2022-07-15 01:02:00', '2022-07-17 22:39:10', NULL),
	('11001-10', '11001-10', NULL, 'DIRECCIÓN GENERAL DE PROYECTIS PROGRAMACIÓN Y PRESUPUESTO DE OBRAS PÚBLICAS', 1, 1, '2022-07-15 01:00:23', '2022-07-15 01:00:23', NULL),
	('11001-11', '11001-11', NULL, 'DIRECCIÓN GENERAL DE CONSTRUCCIÓN DE OBRAS PÚBLICAS', 1, 1, '2022-07-18 01:37:12', '2022-07-18 01:37:12', NULL),
	('11001-2', '11001-2', NULL, 'SUBSECRETARÍA DE OBRAS PÚBLICAS Y COMUNICACIONES', 1, 1, '2022-07-17 11:41:05', '2022-07-17 22:21:38', NULL),
	('11001-3', '11001-3', NULL, 'SUBSECRETARÍA DE INFRAESTRUCTURA', 1, 1, '2022-07-11 13:49:23', '2022-07-17 22:22:09', NULL),
	('11001-4', '11001-4', NULL, 'DIRECCIÓN GENERAL DE TELECOMUNICACIONES Y DESARROLLO DE VÍAS DE COMUNICACIÓN', 1, 1, '2022-07-18 01:38:13', '2022-07-18 01:38:13', NULL),
	('11001-8', '11001-8', NULL, 'DIRECCIÓN GENERAL DE PROYECTOS PROGRAMACION Y PRESUPUESTO DE CARRETERAS Y CAMINOS ESTATALES', 1, 1, '2022-07-15 00:58:17', '2022-07-15 00:58:17', NULL),
	('110O-01', 'TI', 1, 'OFICINA DE GOBIERNO ELECTRÓNICO Y DESARROLLO DE APLICACIONES.', 1, 1, '2022-07-16 02:16:42', '2022-07-18 02:15:55', NULL),
	('112S', '112S', NULL, 'SECRETARÍA DE INFRAESTRUCTURA Y OBRAS PÚBLICAS', 1, 1, '2022-07-10 20:22:27', '2022-07-17 14:57:25', NULL),
	('apoyo', 'apoyo', NULL, 'ÁREA DE APOYO DEL SECRETARIO', 1, 1, '2022-07-15 01:09:36', '2022-07-15 01:09:36', NULL),
	('FONDEN', 'FONDEN', NULL, 'COORDINACIÓN SECTORIAL FONDEN', 1, 1, '2022-07-18 01:55:37', '2022-07-18 01:56:50', NULL),
	('TI', 'TI', NULL, 'DEPARTAMENTO DE TECNOLOGÍAS DE LA INFORMACIÓN', 1, 1, '2022-07-15 01:15:01', '2022-07-18 02:01:16', NULL);
/*!40000 ALTER TABLE `org005_oficinas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
