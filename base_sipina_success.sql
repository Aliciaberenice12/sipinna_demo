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

-- Volcando estructura para tabla sipinna.cat_estados
CREATE TABLE IF NOT EXISTS `cat_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.cat_estados: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_estados` DISABLE KEYS */;
INSERT INTO `cat_estados` (`id_estado`, `estado`) VALUES
	(1, 'Veracruz'),
	(2, 'Aguascalientes'),
	(3, 'Baja California'),
	(4, 'Baja California Sur'),
	(5, 'Campeche'),
	(6, 'Chiapas'),
	(7, 'Chihuahua'),
	(8, 'Coahuila');
/*!40000 ALTER TABLE `cat_estados` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.cat_municipios
CREATE TABLE IF NOT EXISTS `cat_municipios` (
  `id_municipio` int(11) DEFAULT NULL,
  `municipio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.cat_municipios: ~212 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_municipios` DISABLE KEYS */;
INSERT INTO `cat_municipios` (`id_municipio`, `municipio`) VALUES
	(1, 'Acajete'),
	(2, 'Acatlán'),
	(3, ' Acayucan'),
	(4, 'Actopan'),
	(5, ' Acula'),
	(6, 'Acultzingo'),
	(7, 'Camarón de Tejeda'),
	(8, 'Alpatláhuac'),
	(9, 'Alto Lucero de Gutiérrez Barrios'),
	(10, ' Altotonga'),
	(11, ' Alvarado'),
	(12, ' Amatitlán'),
	(13, 'Naranjos Amatlán'),
	(14, 'Amatlán de los Reyes'),
	(15, 'Angel R. Cabada'),
	(16, 'La Antigua'),
	(17, 'Apazapan'),
	(18, 'Aquila'),
	(19, 'Astacinga'),
	(20, 'Atlahuilco'),
	(21, 'Atoyac'),
	(22, 'Atzacan'),
	(23, 'Atzalan'),
	(24, 'Tlaltetela'),
	(25, 'Ayahualulco'),
	(26, 'Banderilla'),
	(27, 'Benito Juárez'),
	(28, 'Boca del Río'),
	(29, 'Calcahualco'),
	(30, 'Camerino Z. Mendoza'),
	(31, 'Carrillo Puerto'),
	(32, 'Catemaco'),
	(33, 'Cazones'),
	(34, 'Cerro Azul'),
	(35, 'Citlaltépetl'),
	(36, 'Coacoatzintla'),
	(37, 'Coahuitlán'),
	(38, 'Coatepec'),
	(39, 'Coatzacoalcos'),
	(40, 'Coatzintla'),
	(41, 'Coetzala'),
	(42, 'Colipa'),
	(43, 'Comapa'),
	(44, 'Córdoba'),
	(45, 'Cosamaloapan de Carpio'),
	(46, 'Cosautlán de Carvajal'),
	(47, 'Coscomatepec'),
	(48, 'Cosoleacaque'),
	(49, 'Cotaxtla'),
	(50, 'Coxquihui'),
	(51, 'Mariano Escobedo'),
	(52, 'Martínez de la Torre'),
	(53, 'Mecatlán'),
	(54, 'Mecayapan'),
	(55, 'Medellín'),
	(56, 'Miahuatlán'),
	(57, 'Las Minas'),
	(58, 'Minatitlán'),
	(59, 'Misantla'),
	(60, 'Mixtla de Altamirano'),
	(61, 'Chacaltianguis'),
	(62, 'Chalma'),
	(63, 'Chiconamel'),
	(64, 'Chiconquiaco'),
	(65, 'Chicontepec'),
	(66, 'Chinameca'),
	(67, 'Chinampa de Gorostiza'),
	(68, 'Las Choapas'),
	(69, 'Chocamán'),
	(70, 'Chontla'),
	(71, 'Chumatlán'),
	(72, 'Emiliano Zapata'),
	(73, 'Espinal'),
	(74, 'Filomeno Mata'),
	(75, 'Fortín'),
	(76, 'Gutiérrez Zamora'),
	(77, 'Hidalgotitlán'),
	(78, 'Huatusco'),
	(79, 'Huayacocotla'),
	(80, 'Hueyapan de Ocampo'),
	(81, 'Huiloapan'),
	(82, 'Ignacio de la Llave'),
	(83, 'Ilamatlán'),
	(84, 'Isla'),
	(85, 'Ixcatepec'),
	(86, 'Ixhuacán de los Reyes'),
	(87, 'Ixhuatlán del Café'),
	(88, 'Ixhuatlancillo'),
	(89, 'Ixhuatlán del Sureste'),
	(90, 'Ixhuatlán de Madero'),
	(91, 'Ixmatlahuacan'),
	(92, 'Ixtaczoquitlán'),
	(93, 'Jalacingo'),
	(94, 'Xalapa'),
	(95, 'Jalcomulco'),
	(96, 'Jáltipan'),
	(97, 'Jamapa'),
	(98, 'Jesús Carranza'),
	(99, 'Xico'),
	(100, 'Jilotepec'),
	(101, 'Juan Rodríguez Clara'),
	(102, 'Juchique de Ferrer'),
	(103, 'Landero y Coss'),
	(104, 'Lerdo de Tejada'),
	(105, 'Magdalena'),
	(106, 'Maltrata'),
	(107, 'Manlio Fabio Altamirano'),
	(108, 'Coyutla'),
	(109, 'Cuichapa'),
	(110, 'Cuitláhuac'),
	(111, 'Moloacán'),
	(112, 'Naolinco'),
	(113, 'Naranjal'),
	(114, 'Nautla'),
	(115, ' Nogales'),
	(116, 'Oluta'),
	(117, 'Omealca'),
	(118, 'Orizaba'),
	(119, 'Otatitlán'),
	(120, 'Oteapan'),
	(121, 'Ozuluama de Mascare±as'),
	(122, 'Pajapan'),
	(123, 'Pánuco'),
	(124, 'Papantla'),
	(125, 'Paso del Macho'),
	(126, 'Paso de Ovejas'),
	(127, 'La Perla'),
	(128, 'Perote'),
	(129, 'Platón Sánchez'),
	(130, 'Playa Vicente'),
	(131, 'Poza Rica de Hidalgo'),
	(132, 'Las Vigas de Ramírez'),
	(133, 'Pueblo Viejo'),
	(134, 'Puente Nacional'),
	(135, 'Rafael Delgado'),
	(136, 'Rafael Lucio'),
	(137, 'Los Reyes'),
	(138, 'Río Blanco'),
	(139, 'Saltabarranca'),
	(140, ' San Andrés Tenejapan'),
	(141, 'San Andrés Tuxtla'),
	(142, 'San Juan Evangelista'),
	(143, 'Santiago Tuxtla'),
	(144, 'Sayula de Alemán'),
	(145, 'Soconusco'),
	(146, 'Sochiapa'),
	(147, 'Soledad Atzompa'),
	(148, 'Soledad de Doblado'),
	(149, 'Soteapan'),
	(150, 'Tamalín'),
	(151, ' Tamiahua'),
	(152, 'Tampico Alto'),
	(153, ' Tancoco'),
	(154, 'Tantima'),
	(155, 'Tantoyuca'),
	(156, 'Tatatila'),
	(157, 'Castillo de Teayo'),
	(158, 'Tecolutla'),
	(159, 'Tehuipango'),
	(160, 'Temapache'),
	(161, 'Tempoal'),
	(162, 'Tenampa'),
	(163, 'Tenochtitlán'),
	(164, 'Teocelo'),
	(165, 'Tepatlaxco'),
	(166, 'Tepetlán'),
	(167, 'Tepetzintla'),
	(168, 'Tequila'),
	(169, ' José Azueta'),
	(170, ' Texcatepec'),
	(171, 'Texhuacán'),
	(172, ' Texistepec'),
	(173, 'Tezonapa'),
	(174, 'Tierra Blanca'),
	(175, 'Tihuatlán'),
	(176, 'Tlacojalpan'),
	(177, ' Tlacolulan'),
	(178, 'Tlacotalpan'),
	(179, ' Tlacotepec de Mejía'),
	(180, 'Tlachichilco'),
	(181, 'Tlalixcoyan'),
	(182, 'Tlalnelhuayocan'),
	(183, 'Tlapacoyan'),
	(184, ' Tlaquilpa'),
	(185, 'Tlilapan'),
	(186, 'Tomatlán'),
	(187, 'Tonayán'),
	(188, 'Totutla'),
	(189, 'Túxpam'),
	(190, 'Tuxtilla'),
	(191, 'Ursulo Galván'),
	(192, ' Vega de Alatorre'),
	(193, 'Veracruz'),
	(194, 'Villa Aldama'),
	(195, 'Xoxocotla'),
	(196, 'Yanga'),
	(197, ' Yecuatla'),
	(198, 'Zacualpan'),
	(199, 'Zaragoza'),
	(200, 'Zentla'),
	(201, 'Zongolica'),
	(202, 'Zontecomatlán de López y Fuentes'),
	(203, 'Zozocolco de Hidalgo'),
	(204, 'Agua Dulce'),
	(205, 'El Higo'),
	(206, 'Nanchital de Lázaro Cárdenas del Río'),
	(207, 'Tres Valles'),
	(208, 'Carlos A. Carrillo'),
	(209, 'Tatahuicapan de Juárez'),
	(210, 'Uxpanapa'),
	(211, ' San Rafael'),
	(212, 'Santiago Sochiapan');
/*!40000 ALTER TABLE `cat_municipios` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.cat_parentescos
CREATE TABLE IF NOT EXISTS `cat_parentescos` (
  `id_parentesco` int(11) NOT NULL AUTO_INCREMENT,
  `parentesco` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_parentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.cat_parentescos: ~95 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_parentescos` DISABLE KEYS */;
INSERT INTO `cat_parentescos` (`id_parentesco`, `parentesco`) VALUES
	(1, 'esposa'),
	(2, 'esposo'),
	(3, 'hija'),
	(4, 'hijo'),
	(5, 'hija'),
	(6, 'hijo'),
	(7, 'madre'),
	(8, 'padre'),
	(9, 'hermana'),
	(10, 'hermano'),
	(11, 'sobrina'),
	(12, 'sobrino'),
	(13, 'abuela'),
	(14, 'abuelo'),
	(15, 'tía'),
	(16, 'tío'),
	(17, 'prima'),
	(18, 'primo'),
	(19, 'sobrina segunda'),
	(20, 'sobrino segundo'),
	(21, 'bisabuela'),
	(22, 'bisabuelo'),
	(23, 'tía-abuela'),
	(24, 'tío-abuelo'),
	(25, 'tía segunda'),
	(26, 'tío segundo'),
	(27, 'prima segunda'),
	(28, 'primo segundo'),
	(29, 'sobrina tercera'),
	(30, 'sobrino tercero'),
	(31, 'tatarabuela'),
	(32, 'tatarabuelo'),
	(33, 'tía-bisabuela'),
	(34, 'tío-bisabuelo'),
	(35, 'tía-abuela segunda'),
	(36, 'tío-abuelo segundo'),
	(37, 'tía tercera'),
	(38, 'tío tercero'),
	(39, 'prima tercera'),
	(40, 'primo tercero'),
	(41, 'sobrina cuarta'),
	(42, 'sobrino cuarto'),
	(43, 'cuñada'),
	(44, 'cuñado'),
	(45, 'hija'),
	(46, 'hijo'),
	(47, 'hijastra'),
	(48, 'hijastro'),
	(49, 'suegra'),
	(50, 'suegro'),
	(51, 'cuñada'),
	(52, 'cuñado'),
	(53, 'sobrina política'),
	(54, 'sobrino político'),
	(55, 'abuela política (prosuegra)'),
	(56, 'abuelo político (prosuegro)'),
	(57, 'tía política'),
	(58, 'tío político'),
	(59, 'prima política'),
	(60, 'primo político'),
	(61, 'sobrina segunda política'),
	(62, 'sobrino segundo político'),
	(63, 'bisabuela política (absuegra)'),
	(64, 'bisabuelo político (absuegro)'),
	(65, 'tía-abuela política'),
	(66, 'tío-abuelo político'),
	(67, 'tía segunda política'),
	(68, 'tío segundo político'),
	(69, 'prima segunda política'),
	(70, 'primo segundo político'),
	(71, 'sobrina tercera política'),
	(72, 'sobrino tercero político'),
	(73, 'tatarabuela política'),
	(74, 'tatarabuelo político'),
	(75, 'tía-bisabuela política'),
	(76, 'tío-bisabuelo político'),
	(77, 'tía-abuela segunda política'),
	(78, 'tío-abuelo segundo político'),
	(79, 'tía tercera política'),
	(80, 'tío tercero político'),
	(81, 'tía tercera política'),
	(82, 'primo tercero político'),
	(83, 'sobrina cuarta política'),
	(84, 'sobrino cuarto político'),
	(85, 'prima política'),
	(86, 'primo político'),
	(87, 'sobrina'),
	(88, 'sobrino'),
	(89, 'sobrinastra'),
	(90, 'sobrinastro'),
	(91, 'sobrina segunda'),
	(92, 'sobrino segundo'),
	(93, 'sobrinastra segunda'),
	(94, 'sobrinastro segundo'),
	(95, 'se desconoce');
/*!40000 ALTER TABLE `cat_parentescos` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.cat_tipos_delitos
CREATE TABLE IF NOT EXISTS `cat_tipos_delitos` (
  `id_delito` int(11) NOT NULL AUTO_INCREMENT,
  `delito` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_delito`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.cat_tipos_delitos: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `cat_tipos_delitos` DISABLE KEYS */;
INSERT INTO `cat_tipos_delitos` (`id_delito`, `delito`) VALUES
	(2, 'Omisión de Cuidado'),
	(3, 'Abuso sexual contra menores'),
	(4, 'Amenazas'),
	(5, 'Maltrato a persona incapaz'),
	(6, 'Corrupción de menores'),
	(7, 'uuu'),
	(8, 'Narcomenudeo'),
	(9, 'Violación'),
	(11, 'Estupro'),
	(12, 'Pederastia'),
	(13, 'Robo'),
	(14, 'Contra el medio ambiente'),
	(15, 'Violencia Familiar'),
	(16, 'Omision de Cuidado'),
	(17, 'a'),
	(18, 'a');
/*!40000 ALTER TABLE `cat_tipos_delitos` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_c4_expedientes
CREATE TABLE IF NOT EXISTS `tbl_c4_expedientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c4_folio` varchar(50) DEFAULT NULL,
  `c4_no_oficio` varchar(150) DEFAULT NULL,
  `c4_ruta_sol_oficio` varchar(150) DEFAULT NULL,
  `c4_fecha_inicio` date DEFAULT NULL,
  `c4_edo` int(11) NOT NULL,
  `c4_mun` varchar(50) DEFAULT NULL,
  `c4_mun_edo` varchar(50) DEFAULT NULL,
  `c4_dirigido` varchar(2000) DEFAULT NULL,
  `c4_dg` varchar(2000) DEFAULT NULL,
  `c4_folio_expediente` varchar(50) DEFAULT NULL,
  `anio` year(4) DEFAULT NULL,
  `c4_estatus_caso` varchar(50) DEFAULT 'En Proceso',
  `c4_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c4_created_by` date DEFAULT NULL,
  `c4_update_by` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_can_expedientes_cat_estados` (`c4_edo`),
  CONSTRAINT `FK_tbl_can_expedientes_cat_estados` FOREIGN KEY (`c4_edo`) REFERENCES `cat_estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_c4_expedientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_c4_expedientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c4_expedientes` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_c4_probable_responsable
CREATE TABLE IF NOT EXISTS `tbl_c4_probable_responsable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c4_edad_responsable` varchar(50) DEFAULT NULL,
  `c4_nom_responsable` varchar(50) DEFAULT NULL,
  `c4_parentesco` varchar(50) DEFAULT NULL,
  `c4_exp_folio_resp` varchar(50) DEFAULT NULL,
  `c4_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_c4_probable_responsable: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_c4_probable_responsable` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c4_probable_responsable` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_c4_reportantes
CREATE TABLE IF NOT EXISTS `tbl_c4_reportantes` (
  `id_reportante` int(11) NOT NULL AUTO_INCREMENT,
  `c4_inst_reportante` varchar(50) DEFAULT '0',
  `c4_nom_reportante` varchar(50) DEFAULT NULL,
  `c4_exp_folio_rep` varchar(50) DEFAULT NULL,
  `c4_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `c4_user_by` date DEFAULT NULL,
  `c4_update_by` date DEFAULT NULL,
  PRIMARY KEY (`id_reportante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_c4_reportantes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_c4_reportantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c4_reportantes` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_c4_victimas
CREATE TABLE IF NOT EXISTS `tbl_c4_victimas` (
  `id_victima` int(11) NOT NULL AUTO_INCREMENT,
  `c4_delito` int(11) DEFAULT NULL,
  `c4_exp_folio_victima` varchar(50) DEFAULT NULL,
  `c4_nom_victima` varchar(50) DEFAULT NULL,
  `c4_rep_derecho` varchar(50) DEFAULT NULL,
  `c4_edad_victima` int(11) DEFAULT NULL,
  `c4_gen_victima` varchar(50) DEFAULT NULL,
  `c4_per_tercera_edad` int(11) DEFAULT '0',
  `c4_per_discapacidad` int(11) DEFAULT '0',
  `c4_per_violencia` int(11) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_rep_victima` varchar(50) DEFAULT NULL,
  `id_exp_victima` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_victima`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_c4_victimas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_c4_victimas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_c4_victimas` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_can_avances
CREATE TABLE IF NOT EXISTS `tbl_can_avances` (
  `id_can_avance` int(11) NOT NULL AUTO_INCREMENT,
  `can_tipo_avance` varchar(50) DEFAULT NULL,
  `can_fecha_avance` date DEFAULT NULL,
  `can_estatus_avance` varchar(50) DEFAULT NULL,
  `can_desc_avance` varchar(50) DEFAULT NULL,
  `exp_can_avance` varchar(50) DEFAULT NULL,
  `can_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_can_avance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_can_avances: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_can_avances` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_can_avances` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_can_casos_reportados
CREATE TABLE IF NOT EXISTS `tbl_can_casos_reportados` (
  `id_caso_reportado` int(11) NOT NULL AUTO_INCREMENT,
  `can_des_caso` varchar(500) DEFAULT NULL,
  `can_gest_caso` varchar(500) DEFAULT NULL,
  `exp_id_caso_reportado` varchar(50) DEFAULT NULL,
  `can_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `estatus_caso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_caso_reportado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_can_casos_reportados: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_can_casos_reportados` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_can_casos_reportados` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_can_expediente
CREATE TABLE IF NOT EXISTS `tbl_can_expediente` (
  `id_canalizacion` int(11) NOT NULL AUTO_INCREMENT,
  `can_numero` varchar(50) DEFAULT NULL,
  `can_numero_oficio` varchar(50) DEFAULT NULL,
  `can_fecha` date DEFAULT NULL,
  `can_estado` int(11) DEFAULT NULL,
  `can_municipio` varchar(50) DEFAULT NULL,
  `can_mun_edo` varchar(50) DEFAULT NULL,
  `can_via_rec` varchar(50) DEFAULT NULL,
  `can_folio_expediente` varchar(150) DEFAULT NULL,
  `anio` year(4) DEFAULT NULL,
  `can_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_canalizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_can_expediente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_can_expediente` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_can_expediente` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_can_reportante
CREATE TABLE IF NOT EXISTS `tbl_can_reportante` (
  `id_reportante` int(11) NOT NULL AUTO_INCREMENT,
  `can_inst_reportante` varchar(150) DEFAULT NULL,
  `can_nom_reportante` varchar(150) DEFAULT NULL,
  `exp_id_reportante` varchar(150) NOT NULL,
  `can_created_reportante` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reportante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_can_reportante: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_can_reportante` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_can_reportante` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.tbl_desc_casos_c4
CREATE TABLE IF NOT EXISTS `tbl_desc_casos_c4` (
  `id_desc_caso` int(11) NOT NULL AUTO_INCREMENT,
  `c4_lugar_hechos` varchar(200) DEFAULT NULL,
  `c4_des_hechos` varchar(200) DEFAULT NULL,
  `c4_exp_folio_desc_caso` varchar(200) DEFAULT NULL,
  `c4_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_desc_caso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.tbl_desc_casos_c4: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_desc_casos_c4` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_desc_casos_c4` ENABLE KEYS */;

-- Volcando estructura para tabla sipinna.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `departamento` text NOT NULL,
  `usuario` text NOT NULL,
  `contrasena` text NOT NULL,
  `email` text NOT NULL,
  `imagen` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sipinna.usuarios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `departamento`, `usuario`, `contrasena`, `email`, `imagen`) VALUES
	(4, 'Jose ', 'Vargas Lopez', '1', 'COVA9607044U8', 'a', 'a17050004@itsperote.edu.mx', '398411764.png');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
