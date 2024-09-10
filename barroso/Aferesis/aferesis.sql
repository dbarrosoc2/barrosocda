-- --------------------------------------------------------
-- Host:                         10.35.50.118
-- Versión del servidor:         10.3.13-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para aferesis
CREATE DATABASE IF NOT EXISTS `aferesis` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `aferesis`;

-- Volcando estructura para tabla aferesis.acceso
CREATE TABLE IF NOT EXISTS `acceso` (
  `id_acceso` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` varchar(50) DEFAULT NULL,
  `id_donante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_acceso`),
  KEY `id_donante` (`id_donante`),
  KEY `fk_acceso_usuario` (`id_usuario`),
  CONSTRAINT `acceso_ibfk_2` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`),
  CONSTRAINT `fk_acceso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.acceso: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `acceso` DISABLE KEYS */;
INSERT INTO `acceso` (`id_acceso`, `fecha`, `id_usuario`, `id_donante`) VALUES
	(1, '2024-04-29 12:15:43', '71118916h', NULL),
	(2, '2024-04-29 12:25:08', '71118916h', NULL),
	(3, '2024-04-30 08:24:16', '71118916h', NULL),
	(4, '2024-04-30 08:29:45', '71118916h', NULL),
	(5, '2024-04-30 08:29:51', '71118916h', NULL),
	(6, '2024-04-30 08:29:57', '71118916h', NULL),
	(7, '2024-04-30 09:08:43', '71118916h', NULL),
	(8, '2024-04-30 09:55:12', '71118916h', NULL),
	(9, '2024-04-30 12:41:25', '71118916h', NULL),
	(10, '2024-04-30 13:50:54', '71118916h', NULL),
	(11, '2024-05-06 08:16:23', '71118916h', NULL),
	(12, '2024-05-06 14:28:27', '71118916h', NULL),
	(13, '2024-05-08 09:06:58', '71118916h', NULL),
	(14, '2024-05-08 13:57:13', '71118916h', NULL),
	(15, '2024-05-09 08:09:02', '71118916h', NULL),
	(16, '2024-05-09 10:55:58', '71118916h', NULL),
	(17, '2024-05-09 11:12:22', '71118916h', NULL),
	(18, '2024-05-09 11:59:19', '71118916h', NULL),
	(19, '2024-05-09 12:00:02', '71118916h', NULL),
	(20, '2024-05-09 12:27:15', '71118916h', NULL),
	(21, '2024-05-10 08:18:03', '71118916h', NULL),
	(22, '2024-05-10 11:30:44', '71118916h', NULL),
	(23, '2024-05-10 11:30:49', '71118916h', NULL),
	(24, '2024-05-10 12:07:13', '71118916h', NULL),
	(25, '2024-05-10 12:19:27', '71118916h', NULL);
/*!40000 ALTER TABLE `acceso` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.calendario
CREATE TABLE IF NOT EXISTS `calendario` (
  `id_dia` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_dia` varchar(20) DEFAULT NULL,
  `id_horario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dia`),
  KEY `id_horario` (`id_horario`),
  CONSTRAINT `calendario_ibfk_1` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id_horario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.calendario: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `calendario` DISABLE KEYS */;
INSERT INTO `calendario` (`id_dia`, `descripcion_dia`, `id_horario`) VALUES
	(1, 'Diario', 1),
	(2, 'Sábado', 2),
	(3, 'Domingo', 2),
	(4, 'Festivo', 2),
	(5, 'Otro', 3),
	(6, 'Sin Servicio', 4);
/*!40000 ALTER TABLE `calendario` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.cita
CREATE TABLE IF NOT EXISTS `cita` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT,
  `id_donante` int(11) DEFAULT NULL,
  `id_dia` int(11) DEFAULT NULL,
  `id_maquina` int(11) DEFAULT NULL,
  `apto` varchar(3) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `id_donante` (`id_donante`),
  KEY `id_dia` (`id_dia`),
  KEY `id_maquina` (`id_maquina`),
  CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`),
  CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_dia`) REFERENCES `calendario` (`id_dia`),
  CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_maquina`) REFERENCES `maquina` (`id_maquina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.cita: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.decision
CREATE TABLE IF NOT EXISTS `decision` (
  `id_decision` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(50) DEFAULT NULL,
  `respuesta` varchar(3) DEFAULT NULL,
  `id_cita` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_decision`),
  KEY `fk_decision_usuario` (`id_usuario`),
  CONSTRAINT `fk_decision_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.decision: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `decision` DISABLE KEYS */;
/*!40000 ALTER TABLE `decision` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.diasespeciales
CREATE TABLE IF NOT EXISTS `diasespeciales` (
  `id_especial` int(11) NOT NULL AUTO_INCREMENT,
  `id_dia_calendario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_especial`),
  KEY `id_dia_calendario` (`id_dia_calendario`),
  CONSTRAINT `diasespeciales_ibfk_1` FOREIGN KEY (`id_dia_calendario`) REFERENCES `calendario` (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.diasespeciales: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `diasespeciales` DISABLE KEYS */;
INSERT INTO `diasespeciales` (`id_especial`, `id_dia_calendario`, `fecha`) VALUES
	(1, 4, '2024-01-01'),
	(2, 4, '2024-01-06'),
	(3, 4, '2024-03-08'),
	(4, 4, '2024-03-29'),
	(6, 4, '2024-05-01'),
	(7, 4, '2024-05-02'),
	(8, 4, '2024-07-25'),
	(9, 4, '2024-08-15'),
	(10, 4, '2024-10-12'),
	(11, 4, '2024-12-06'),
	(12, 4, '2024-12-25'),
	(13, 4, '2024-05-15'),
	(14, 4, '2024-11-09'),
	(16, 4, '2024-11-09'),
	(17, 5, '2024-02-05'),
	(18, 4, '2024-10-02');
/*!40000 ALTER TABLE `diasespeciales` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.donante
CREATE TABLE IF NOT EXISTS `donante` (
  `id_donante` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido1` varchar(255) DEFAULT NULL,
  `apellido2` varchar(255) DEFAULT NULL,
  `nhc` varchar(20) DEFAULT NULL,
  `telef1` varchar(100) DEFAULT NULL,
  `telef2` varchar(100) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `ultima_donacion` date DEFAULT NULL,
  `recordatorio` varchar(255) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `llamar` varchar(255) NOT NULL DEFAULT 'No',
  `cipa` varchar(255) DEFAULT NULL,
  `acepto_comunicacion` varchar(3) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `citable` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_donante`),
  UNIQUE KEY `uk_dni` (`dni`),
  UNIQUE KEY `uk_nhc` (`nhc`),
  UNIQUE KEY `uk_cipa` (`cipa`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.donante: ~32 rows (aproximadamente)
/*!40000 ALTER TABLE `donante` DISABLE KEYS */;
INSERT INTO `donante` (`id_donante`, `nombre`, `apellido1`, `apellido2`, `nhc`, `telef1`, `telef2`, `dni`, `ultima_donacion`, `recordatorio`, `observaciones`, `llamar`, `cipa`, `acepto_comunicacion`, `fecha_nacimiento`, `citable`) VALUES
	(74, 'David Alejandro', 'Barroso', 'Contreras', '123456', '614191217', NULL, '123456', NULL, NULL, NULL, 'No', '123456', 'Sí', '1991-02-05', NULL),
	(76, 'Jose Luis', 'Arias', 'Cerezo', NULL, '665805543', NULL, '691293', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(77, 'MAGDA AZUCENA', 'ARGUETA', 'ARGUETA', '', '685325642', NULL, '1096747', NULL, NULL, NULL, 'No', '', 'SI', '1900-01-01', NULL),
	(78, 'ÁNGEL', 'DE ANDRÉS', 'GARCÍA', NULL, '646399650', NULL, '925736', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(79, 'ADRIÁN', 'ARRANZ', 'ESCUDERO', NULL, '693693126', NULL, '1097557', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(80, 'MONTSERRAT', 'AMPUERO', 'ANDRADE', NULL, '677893251', NULL, '1625174', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(81, 'LAURA', 'ARMESTO', 'REMIS', NULL, '675626067', NULL, '747925', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(82, 'MARÍA MAR', 'ADRADA', 'RIVERA', NULL, '644371099', NULL, '529204', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(83, 'ANTONIO EPIFANIO', 'ALARCÓN', 'GARCÍA', NULL, '686354518', NULL, '928096', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(84, 'MARÍA CARMEN', 'ARROYO', 'JURADO', NULL, '605133109', NULL, '421208', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(85, 'KARLA', 'ANDIA', 'CRUZ', NULL, '644782590', NULL, '661880', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(86, 'ALBERTO', 'ACEVES', 'MARTÍNEZ', NULL, '659101233', NULL, '282318', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(87, 'ESTIBALIZ', 'AROCENA', 'ALONSO', NULL, '679963203', NULL, '1076975', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(88, 'ELENA', 'ALTAMIRANO', 'SALGADO', NULL, '628071879', NULL, '530369', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(89, 'CLARA', 'ALZOLA', 'MARTÍN', NULL, '687741961', NULL, '603803', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(90, 'Mª ANGELES', 'ALCAIDE', 'RODRIGUEZ', NULL, '696651938', NULL, '643336', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(91, 'MARIO', 'ARRISCADO', 'DÍAZ', NULL, '686491489', NULL, '1305082', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(92, 'JESÚS MARÍA', 'ALONSO', 'GARCÍA', NULL, '625598121', NULL, '846561', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(93, 'JESÚS', 'ALONSO', 'SÁNCHEZ', NULL, '696326963', NULL, '277306', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(94, 'MANUEL', 'ALONSO', 'SANTOS', NULL, '652884820', NULL, '452188', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(95, 'ANA KAREN', 'ARANCIBIA', 'ROCA', NULL, '675220801', NULL, '676616', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(96, 'JOSE LUIS', 'ÁLVAREZ', 'MINGUEZA', NULL, '619358835', NULL, '1028581', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(97, 'ÓSCAR ALBINO', 'BRITEZ', 'ORTEGA', NULL, '612242572', NULL, '821798', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(98, 'SANTA BELÉN', 'ARENAS', 'MOZOS', NULL, '637323345', NULL, '380453', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(99, 'DIEGO', 'ALBA', 'ESPINOSA', NULL, '608019305', NULL, '1639487', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(100, 'FRANCISCO', 'ÁLVARO', 'LÓPEZ', NULL, '671757416', NULL, '348085', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(101, 'MARTA', 'ANDREU', 'REIMÚNDEZ', NULL, '608018985', NULL, '1656696', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(102, 'MANUEL', 'ANGUITA', 'CIUDAD', NULL, '656846766', NULL, '1097683', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(103, 'JORGE', 'ÁLVARO', 'GONZALEZ', NULL, '605896470', NULL, '945311', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(104, 'MIGUEL ÁNGEL', 'ALCONCHEL', 'GONZALEZ', NULL, '638858023', NULL, '609597', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(105, 'ALBERTO', 'ANTONIONI', '', NULL, '692518128', NULL, '1590097', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL),
	(106, 'VERONICA ANDREA', 'ANGUISACA', 'ADRIANO', NULL, '626314526', NULL, '1496817', NULL, NULL, NULL, 'No', NULL, 'Sí', '1900-01-01', NULL);
/*!40000 ALTER TABLE `donante` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `tiempo_cita` time DEFAULT NULL,
  PRIMARY KEY (`id_horario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.horarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` (`id_horario`, `hora_inicio`, `hora_fin`, `tiempo_cita`) VALUES
	(1, '08:30:00', '18:00:00', '02:00:00'),
	(2, '08:30:00', '13:00:00', '02:00:00'),
	(3, '13:00:00', '18:00:00', '02:00:00'),
	(4, NULL, NULL, NULL);
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.log
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` varchar(50) DEFAULT NULL,
  `operacion` varchar(255) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla aferesis.log: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.maquina
CREATE TABLE IF NOT EXISTS `maquina` (
  `id_maquina` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_maquina` varchar(50) DEFAULT NULL,
  `activa` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id_maquina`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.maquina: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `maquina` DISABLE KEYS */;
INSERT INTO `maquina` (`id_maquina`, `descripcion_maquina`, `activa`) VALUES
	(1, 'Maquina1', 'SI'),
	(2, 'Maquina2', 'SI'),
	(3, 'Maquina 3', 'NO');
/*!40000 ALTER TABLE `maquina` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.observaciones
CREATE TABLE IF NOT EXISTS `observaciones` (
  `id_observacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_donante` int(11) DEFAULT NULL,
  `id_usuario` varchar(50) DEFAULT NULL,
  `observacion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_observacion`),
  KEY `id_donante` (`id_donante`),
  KEY `fk_observaciones_usuario` (`id_usuario`),
  CONSTRAINT `fk_observaciones_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `observaciones_ibfk_1` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.observaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `observaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `observaciones` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.pregunta
CREATE TABLE IF NOT EXISTS `pregunta` (
  `id_pregunta` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.pregunta: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` (`id_pregunta`, `pregunta`) VALUES
	(1, '¿Has tenido gripe, fiebre o diarrea en los últimos 15 días o has estado enfermo en los últimos 15 días?'),
	(2, '¿Has tomado antiinflamatorios en los últimos 5 días?'),
	(4, '¿Te has realizado algún tratamiento invasivo (tatuaje, piercing, endoscopia) en los últimos 4 meses?'),
	(5, '¿Has viajado fuera de Europa en los últimos 6 meses?');
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.respuesta
CREATE TABLE IF NOT EXISTS `respuesta` (
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `id_pregunta` int(11) DEFAULT NULL,
  `id_donante` int(11) DEFAULT NULL,
  `fecha_respuesta` timestamp NOT NULL DEFAULT current_timestamp(),
  `observacion` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id_respuesta`),
  KEY `id_pregunta` (`id_pregunta`),
  KEY `id_donante` (`id_donante`),
  CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`),
  CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`id_donante`) REFERENCES `donante` (`id_donante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.respuesta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuesta` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.rol: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id_rol`, `descripcion_rol`) VALUES
	(0, 'Denegar'),
	(1, 'Administrador'),
	(2, 'Super'),
	(3, 'Usuario');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido1` varchar(50) DEFAULT NULL,
  `apellido2` varchar(50) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `ultima_conexion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla aferesis.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido1`, `apellido2`, `id_rol`, `ultima_conexion`) VALUES
	('55026262g', 'David Alejandro', 'Barroso', 'Contreras', 3, NULL),
	('71118916h ', 'Alvar Javier', 'Blanco', 'Martinez', 3, NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_appointments
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('approved','pending','canceled','rejected','no-show') DEFAULT NULL,
  `bookingStart` datetime NOT NULL,
  `bookingEnd` datetime NOT NULL,
  `notifyParticipants` tinyint(1) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `packageId` int(11) DEFAULT NULL,
  `providerId` int(11) NOT NULL,
  `locationId` int(11) DEFAULT NULL,
  `internalNotes` text DEFAULT NULL,
  `googleCalendarEventId` varchar(255) DEFAULT NULL,
  `googleMeetUrl` varchar(255) DEFAULT NULL,
  `outlookCalendarEventId` varchar(255) DEFAULT NULL,
  `zoomMeeting` text DEFAULT NULL,
  `lessonSpace` text DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_appointments: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_appointments` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_cache
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `paymentId` int(11) DEFAULT NULL,
  `data` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_cache: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_cache` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_categories
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
  `name` varchar(255) NOT NULL DEFAULT '',
  `position` int(11) NOT NULL,
  `translations` text DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#1788FB',
  `pictureFullPath` varchar(767) DEFAULT NULL,
  `pictureThumbPath` varchar(767) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_categories: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_categories` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_coupons
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `discount` double NOT NULL,
  `deduction` double NOT NULL,
  `limit` double NOT NULL,
  `customerLimit` double NOT NULL DEFAULT 0,
  `status` enum('hidden','visible') NOT NULL,
  `notificationInterval` int(11) NOT NULL DEFAULT 0,
  `notificationRecurring` tinyint(1) NOT NULL DEFAULT 0,
  `expirationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_coupons: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_coupons_to_events
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_coupons_to_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_coupons_to_events: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons_to_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons_to_events` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_coupons_to_packages
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_coupons_to_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponId` int(11) NOT NULL,
  `packageId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_coupons_to_packages: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons_to_packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons_to_packages` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_coupons_to_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_coupons_to_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_coupons_to_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons_to_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_coupons_to_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_customer_bookings
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_customer_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointmentId` int(11) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `status` enum('approved','pending','canceled','rejected','no-show') DEFAULT NULL,
  `price` double NOT NULL,
  `persons` int(11) NOT NULL,
  `couponId` int(11) DEFAULT NULL,
  `token` varchar(10) DEFAULT NULL,
  `customFields` text DEFAULT NULL,
  `info` text DEFAULT NULL,
  `utcOffset` int(3) DEFAULT NULL,
  `aggregatedPrice` tinyint(1) DEFAULT 1,
  `packageCustomerServiceId` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `actionsCompleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_customer_bookings: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_customer_bookings_to_events_periods
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_customer_bookings_to_events_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerBookingId` bigint(20) NOT NULL,
  `eventPeriodId` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookingEventPeriod` (`customerBookingId`,`eventPeriodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_customer_bookings_to_events_periods: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings_to_events_periods` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings_to_events_periods` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_customer_bookings_to_events_tickets
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_customer_bookings_to_events_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerBookingId` bigint(20) NOT NULL,
  `eventTicketId` bigint(20) NOT NULL,
  `price` double DEFAULT 0,
  `persons` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_customer_bookings_to_events_tickets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings_to_events_tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings_to_events_tickets` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_customer_bookings_to_extras
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_customer_bookings_to_extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerBookingId` int(11) NOT NULL,
  `extraId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `aggregatedPrice` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookingExtra` (`customerBookingId`,`extraId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_customer_bookings_to_extras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings_to_extras` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_customer_bookings_to_extras` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_custom_fields
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` text NOT NULL DEFAULT '',
  `type` enum('text','text-area','select','checkbox','radio','content','file','datepicker','address') NOT NULL DEFAULT 'text',
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL,
  `translations` text DEFAULT NULL,
  `allServices` tinyint(1) DEFAULT NULL,
  `allEvents` tinyint(1) DEFAULT NULL,
  `useAsLocation` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_custom_fields: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_custom_fields_events
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_custom_fields_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customFieldId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_custom_fields_events: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields_events` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_custom_fields_options
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_custom_fields_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customFieldId` int(11) NOT NULL,
  `label` text NOT NULL DEFAULT '',
  `position` int(11) NOT NULL,
  `translations` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_custom_fields_options: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields_options` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_custom_fields_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_custom_fields_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customFieldId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_custom_fields_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_custom_fields_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_events
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` enum('approved','pending','canceled','rejected') NOT NULL,
  `bookingOpens` datetime DEFAULT NULL,
  `bookingCloses` datetime DEFAULT NULL,
  `bookingOpensRec` enum('same','calculate') DEFAULT 'same',
  `bookingClosesRec` enum('same','calculate') DEFAULT 'same',
  `ticketRangeRec` enum('same','calculate') DEFAULT 'calculate',
  `recurringCycle` enum('daily','weekly','monthly','yearly') DEFAULT NULL,
  `recurringOrder` int(11) DEFAULT NULL,
  `recurringInterval` int(11) DEFAULT 1,
  `recurringMonthly` enum('each','on') DEFAULT 'each',
  `monthlyDate` datetime DEFAULT NULL,
  `monthlyOnRepeat` enum('first','second','third','fourth','last') DEFAULT NULL,
  `monthlyOnDay` enum('monday','tuesday','wednesday','thursday','friday','saturday','sunday') DEFAULT NULL,
  `recurringUntil` datetime DEFAULT NULL,
  `maxCapacity` int(11) NOT NULL,
  `maxCustomCapacity` int(11) DEFAULT NULL,
  `maxExtraPeople` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `locationId` bigint(20) DEFAULT NULL,
  `customLocation` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `show` tinyint(1) NOT NULL DEFAULT 1,
  `notifyParticipants` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `settings` text DEFAULT NULL,
  `zoomUserId` varchar(255) DEFAULT NULL,
  `bringingAnyone` tinyint(1) DEFAULT 1,
  `bookMultipleTimes` tinyint(1) DEFAULT 1,
  `translations` text DEFAULT NULL,
  `depositPayment` enum('disabled','fixed','percentage') DEFAULT 'disabled',
  `depositPerPerson` tinyint(1) DEFAULT 1,
  `fullPayment` tinyint(1) DEFAULT 0,
  `deposit` double DEFAULT 0,
  `customPricing` tinyint(1) DEFAULT 0,
  `organizerId` bigint(20) DEFAULT NULL,
  `closeAfterMin` int(11) DEFAULT NULL,
  `closeAfterMinBookings` tinyint(1) DEFAULT 0,
  `aggregatedPrice` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_events: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_events` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_events_periods
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_events_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `periodStart` datetime NOT NULL,
  `periodEnd` datetime NOT NULL,
  `zoomMeeting` text DEFAULT NULL,
  `lessonSpace` text DEFAULT NULL,
  `googleCalendarEventId` varchar(255) DEFAULT NULL,
  `googleMeetUrl` varchar(255) DEFAULT NULL,
  `outlookCalendarEventId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_events_periods: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_events_periods` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_events_periods` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_events_tags
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_events_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_events_tags: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_events_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_events_tags` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_events_to_providers
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_events_to_providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_events_to_providers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_events_to_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_events_to_providers` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_events_to_tickets
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_events_to_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `enabled` tinyint(1) DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `price` double DEFAULT 0,
  `dateRanges` text DEFAULT NULL,
  `spots` int(11) NOT NULL,
  `translations` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_events_to_tickets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_events_to_tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_events_to_tickets` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_extras
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_extras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `price` double NOT NULL,
  `maxQuantity` int(11) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `serviceId` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `aggregatedPrice` tinyint(1) DEFAULT NULL,
  `translations` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_extras: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_extras` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_extras` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_galleries
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entityId` int(11) NOT NULL,
  `entityType` enum('service','event','package') NOT NULL,
  `pictureFullPath` varchar(767) DEFAULT NULL,
  `pictureThumbPath` varchar(767) DEFAULT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_galleries: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_galleries` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_locations
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(63) NOT NULL,
  `latitude` decimal(8,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `pictureFullPath` varchar(767) DEFAULT NULL,
  `pictureThumbPath` varchar(767) DEFAULT NULL,
  `pin` mediumtext DEFAULT NULL,
  `translations` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_locations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_locations` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_locations_views
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_locations_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locationId` int(11) NOT NULL,
  `date` date NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_locations_views: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_locations_views` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_locations_views` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_notifications
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `customName` varchar(255) DEFAULT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `type` enum('email','sms','whatsapp') NOT NULL,
  `entity` enum('appointment','event') NOT NULL DEFAULT 'appointment',
  `time` time DEFAULT NULL,
  `timeBefore` int(11) DEFAULT NULL,
  `timeAfter` int(11) DEFAULT NULL,
  `sendTo` enum('customer','provider') NOT NULL,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `content` text DEFAULT NULL,
  `translations` text DEFAULT NULL,
  `sendOnlyMe` tinyint(1) DEFAULT 0,
  `whatsAppTemplate` varchar(255) DEFAULT NULL,
  `minimumTimeBeforeBooking` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_notifications: ~111 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications` DISABLE KEYS */;
INSERT INTO `wp_aferesisamelia_notifications` (`id`, `name`, `customName`, `status`, `type`, `entity`, `time`, `timeBefore`, `timeAfter`, `sendTo`, `subject`, `content`, `translations`, `sendOnlyMe`, `whatsAppTemplate`, `minimumTimeBeforeBooking`) VALUES
	(1, 'customer_appointment_approved', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', '%service_name% Appointment Approved', 'Dear <strong>%customer_full_name%</strong>,<br><br>You have successfully scheduled\n                     <strong>%service_name%</strong> appointment with <strong>%employee_full_name%</strong>. We are \n                     waiting you at <strong>%location_address% </strong>on <strong>%appointment_date_time%</strong>.\n                     <br><br>Thank you for choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(2, 'customer_appointment_pending', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', '%service_name% Appointment Pending', 'Dear <strong>%customer_full_name%</strong>,<br><br>The <strong>%service_name%</strong> appointment \n                     with <strong>%employee_full_name%</strong> at <strong>%location_address%</strong>, scheduled for\n                     <strong>%appointment_date_time%</strong> is waiting for a confirmation.<br><br>Thank you for \n                     choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(3, 'customer_appointment_rejected', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', '%service_name% Appointment Rejected', 'Dear <strong>%customer_full_name%</strong>,<br><br>Your <strong>%service_name%</strong> \n                     appointment, scheduled on <strong>%appointment_date_time%</strong> at <strong>%location_address%\n                     </strong>has been rejected.<br><br>Thank you for choosing our company,\n                     <br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(4, 'customer_appointment_canceled', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', '%service_name% Appointment Canceled', 'Dear <strong>%customer_full_name%</strong>,<br><br>Your <strong>%service_name%</strong> \n                     appointment, scheduled on <strong>%appointment_date_time%</strong> at <strong>%location_address%\n                     </strong>has been canceled.<br><br>Thank you for choosing our company,\n                     <br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(5, 'customer_appointment_rescheduled', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', '%service_name% Appointment Rescheduled', 'Dear <strong>%customer_full_name%</strong>,<br><br>The details for your \n                     <strong>%service_name%</strong> appointment with <strong>%employee_full_name%</strong> at \n                     <strong>%location_name%</strong> has been changed. The appointment is now set for \n                     <strong>%appointment_date%</strong> at <strong>%appointment_start_time%</strong>.<br><br>\n                     Thank you for choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(6, 'customer_appointment_next_day_reminder', NULL, 'enabled', 'email', 'appointment', '17:00:00', NULL, NULL, 'customer', '%service_name% Appointment Reminder', 'Dear <strong>%customer_full_name%</strong>,<br><br>We would like to remind you that you have \n                     <strong>%service_name%</strong> appointment tomorrow at <strong>%appointment_start_time%</strong>.\n                     We are waiting for you at <strong>%location_name%</strong>.<br><br>Thank you for \n                     choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(7, 'customer_appointment_follow_up', NULL, 'enabled', 'email', 'appointment', NULL, NULL, 1800, 'customer', '%service_name% Appointment Follow Up', 'Dear <strong>%customer_full_name%</strong>,<br><br>Thank you once again for choosing our company. \n                     We hope you were satisfied with your <strong>%service_name%</strong>.<br><br>We look forward to \n                     seeing you again soon,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(8, 'customer_birthday_greeting', NULL, 'enabled', 'email', 'appointment', '17:00:00', NULL, NULL, 'customer', 'Happy Birthday', 'Dear <strong>%customer_full_name%</strong>,<br><br>Happy birthday!<br>We wish you all the best.\n                    <br><br>Thank you for choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(9, 'provider_appointment_approved', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', '%service_name% Appointment Approved', 'Hi <strong>%employee_full_name%</strong>,<br><br>You have one confirmed \n                     <strong>%service_name%</strong> appointment at <strong>%location_name%</strong> on \n                     <strong>%appointment_date%</strong> at <strong>%appointment_start_time%</strong>. The appointment \n                     is added to your schedule.<br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(10, 'provider_appointment_pending', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', '%service_name% Appointment Pending', 'Hi <strong>%employee_full_name%</strong>,<br><br>You have new appointment \n                     in <strong>%service_name%</strong>. The appointment is waiting for a confirmation.<br><br>Thank \n                     you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(11, 'provider_appointment_rejected', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', '%service_name% Appointment Rejected', 'Hi <strong>%employee_full_name%</strong>,<br><br>Your <strong>%service_name%</strong> appointment \n                     at <strong>%location_name%</strong>, scheduled for <strong>%appointment_date%</strong> at  \n                     <strong>%appointment_start_time%</strong> has been rejected.\n                     <br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(12, 'provider_appointment_canceled', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', '%service_name% Appointment Canceled', 'Hi <strong>%employee_full_name%</strong>,<br><br>Your <strong>%service_name%</strong> appointment,\n                     scheduled on <strong>%appointment_date%</strong>, at <strong>%location_name%</strong> has been \n                     canceled.<br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(13, 'provider_appointment_rescheduled', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', '%service_name% Appointment Rescheduled', 'Hi <strong>%employee_full_name%</strong>,<br><br>The details for your \n                     <strong>%service_name%</strong> appointment at <strong>%location_name%</strong> has been changed. \n                     The appointment is now set for <strong>%appointment_date%</strong> at \n                     <strong>%appointment_start_time%</strong>.<br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(14, 'provider_appointment_next_day_reminder', NULL, 'enabled', 'email', 'appointment', '17:00:00', NULL, NULL, 'provider', '%service_name% Appointment Reminder', 'Dear <strong>%employee_full_name%</strong>,<br><br>We would like to remind you that you have \n                     <strong>%service_name%</strong> appointment tomorrow at <strong>%appointment_start_time%</strong>\n                     at <strong>%location_name%</strong>.<br><br>Thank you, \n                     <br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(15, 'customer_appointment_approved', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n\nYou have successfully scheduled %service_name% appointment with %employee_full_name%. We are waiting for you at %location_address% on %appointment_date_time%.\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(16, 'customer_appointment_pending', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%, \n                    \nThe %service_name% appointment with %employee_full_name% at %location_address%, scheduled for %appointment_date_time% is waiting for a confirmation.\n                    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(17, 'customer_appointment_rejected', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nYour %service_name% appointment, scheduled on %appointment_date_time% at %location_address% has been rejected.\n                    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(18, 'customer_appointment_canceled', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nYour %service_name% appointment, scheduled on %appointment_date_time% at %location_address% has been canceled. \n                    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(19, 'customer_appointment_rescheduled', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nThe details for your %service_name% appointment with %employee_full_name% at %location_name% has been changed. The appointment is now set for %appointment_date% at %appointment_start_time%.\n                    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(20, 'customer_appointment_next_day_reminder', NULL, 'enabled', 'sms', 'appointment', '17:00:00', NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nWe would like to remind you that you have %service_name% appointment tomorrow at %appointment_start_time%. We are waiting for you at %location_name%.\n                    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(21, 'customer_appointment_follow_up', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, 1800, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nThank you once again for choosing our company. We hope you were satisfied with your %service_name%.\n                     \nWe look forward to seeing you again soon,\n%company_name%', NULL, 0, NULL, NULL),
	(22, 'customer_birthday_greeting', NULL, 'enabled', 'sms', 'appointment', '17:00:00', NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nHappy birthday! We wish you all the best. \n                    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(23, 'provider_appointment_approved', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n                    \nYou have one confirmed %service_name% appointment at %location_name% on %appointment_date% at %appointment_start_time%. The appointment is added to your schedule.\n                    \nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(24, 'provider_appointment_pending', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n                    \nYou have new appointment in %service_name%. The appointment is waiting for a confirmation.\n                    \nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(25, 'provider_appointment_rejected', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n                    \nYour %service_name% appointment at %location_name%, scheduled for %appointment_date% at %appointment_start_time% has been rejected. \n                    \nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(26, 'provider_appointment_canceled', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n                    \nYour %service_name% appointment, scheduled on %appointment_date%, at %location_name% has been canceled.\n                    \nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(27, 'provider_appointment_rescheduled', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n                    \nThe details for your %service_name% appointment at %location_name% has been changed. The appointment is now set for %appointment_date% at %appointment_start_time%.\n                    \nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(28, 'provider_appointment_next_day_reminder', NULL, 'enabled', 'sms', 'appointment', '17:00:00', NULL, NULL, 'provider', 'NULL', 'Dear %employee_full_name%, \n                    \nWe would like to remind you that you have %service_name% appointment tomorrow at %appointment_start_time% at %location_name%.\n                    \nThank you, \n%company_name%', NULL, 0, NULL, NULL),
	(29, 'customer_event_approved', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'customer', '%event_name% Event Booked', 'Dear <strong>%customer_full_name%</strong>,<br><br>You have successfully scheduled\n                     <strong>%event_name%</strong> event. We are\n                     waiting you at <strong>%event_location% </strong>on <strong>%event_start_date_time%</strong>.\n                     <br><br>Thank you for choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(30, 'customer_event_rejected', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'customer', '%event_name% Event Canceled By Admin', 'Dear <strong>%customer_full_name%</strong>,<br><br>Your <strong>%event_name%</strong>\n                     event, scheduled on <strong>%event_start_date_time%</strong> at <strong>%event_location%\n                     </strong>has been canceled.<br><br>Thank you for choosing our company,\n                     <br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(31, 'customer_event_canceled', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'customer', '%event_name% Event Canceled By Attendee', 'Dear <strong>%customer_full_name%</strong>,<br><br>Your <strong>%event_name%</strong>\n                     event, scheduled on <strong>%event_start_date_time%</strong> at <strong>%event_location%\n                     </strong>has been canceled.<br><br>Thank you for choosing our company,\n                     <br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(32, 'customer_event_rescheduled', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'customer', '%event_name% Event Rescheduled', 'Dear <strong>%customer_full_name%</strong>,<br><br>The details for your\n                     <strong>%event_name%</strong> event at\n                     <strong>%event_location%</strong> has been changed. The event is now set for\n                     <strong>%event_start_date_time%</strong>.<br><br>\n                     Thank you for choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(33, 'customer_event_next_day_reminder', NULL, 'enabled', 'email', 'event', '17:00:00', NULL, NULL, 'customer', '%event_name% Event Reminder', 'Dear <strong>%customer_full_name%</strong>,<br><br>We would like to remind you that you have\n                     <strong>%event_name%</strong> event tomorrow at <strong>%event_start_date_time%</strong>.\n                     We are waiting for you at <strong>%event_location%</strong>.<br><br>Thank you for\n                     choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(34, 'customer_event_follow_up', NULL, 'enabled', 'email', 'event', NULL, NULL, 1800, 'customer', '%event_name% Event Follow Up', 'Dear <strong>%customer_full_name%</strong>,<br><br>Thank you once again for choosing our company.\n                     We hope you were satisfied with your <strong>%event_name%</strong>.<br><br>We look forward to\n                     seeing you again soon,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(35, 'provider_event_approved', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'provider', '%event_name% Event Booked', 'Hi <strong>%employee_full_name%</strong>,<br><br>You have one confirmed\n                     <strong>%event_name%</strong> Event at <strong>%event_location%</strong> on\n                     <strong>%event_start_date_time%</strong>. The event\n                     is added to your schedule.<br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(36, 'provider_event_rejected', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'provider', '%event_name% Event Canceled By Admin', 'Hi <strong>%employee_full_name%</strong>,<br><br>Your <strong>%event_name%</strong> event\n                     at <strong>%event_location%</strong>, scheduled for <strong>%event_start_date_time%</strong>\n                     has been canceled.<br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(37, 'provider_event_canceled', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'provider', '%event_name% Event Canceled By Customer', 'Hi <strong>%employee_full_name%</strong>,<br><br>Your <strong>%event_name%</strong> event,\n                     scheduled on <strong>%event_start_date_time%</strong>, at <strong>%event_location%</strong> has been\n                     canceled.<br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(38, 'provider_event_rescheduled', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'provider', '%event_name% Event Rescheduled', 'Hi <strong>%employee_full_name%</strong>,<br><br>The details for your\n                     <strong>%event_name%</strong> event at <strong>%event_location%</strong> has been changed.\n                     The event is now set for <strong>%event_start_date_time%</strong>.\n                     <br><br>Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(39, 'provider_event_next_day_reminder', NULL, 'enabled', 'email', 'event', '17:00:00', NULL, NULL, 'provider', '%event_name% Event Reminder', 'Dear <strong>%employee_full_name%</strong>,<br><br>We would like to remind you that you have \n                     <strong>%event_name%</strong> event at <strong>%event_start_date_time%</strong>\n                     at <strong>%event_location%</strong>.<br><br>Thank you, \n                     <br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(40, 'customer_event_approved', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n\nYou have successfully scheduled %event_name% event. We are waiting for you at %event_location% on %event_start_date_time%.\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(41, 'customer_event_rejected', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n\nYour %event_name% event, scheduled on %event_start_date_time% at %event_location% has been cancelled.\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(42, 'customer_event_canceled', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n\nYour %event_name% event, scheduled on %event_start_date_time% at %event_location% has been cancelled.\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(43, 'customer_event_rescheduled', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n\nThe details for your %event_name% event at %event_location% has been changed. The event is now set for %event_start_date_time%.\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(44, 'customer_event_next_day_reminder', NULL, 'enabled', 'sms', 'event', '17:00:00', NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nWe would like to remind you that you have %event_name% event at %event_start_date_time%. We are waiting for you at %event_location%.\n                    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(45, 'customer_event_follow_up', NULL, 'enabled', 'sms', 'event', NULL, NULL, 1800, 'customer', 'NULL', 'Dear %customer_full_name%,\n                    \nThank you once again for choosing our company. We hope you were satisfied with your %event_name%.\n                     \nWe look forward to seeing you again soon,\n%company_name%', NULL, 0, NULL, NULL),
	(46, 'provider_event_approved', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n\nYou have one confirmed %event_name% event at %event_location% on %event_start_date_time%. The event is added to your schedule.\n\nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(47, 'provider_event_rejected', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n\nYour %event_name% event at %event_location%, scheduled for %event_start_date_time% has been canceled by admin.\n\nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(48, 'provider_event_canceled', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n\nYour %event_name% event, scheduled on %event_start_date_time%, at %event_location% has been canceled.\n\nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(49, 'provider_event_rescheduled', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n\nThe details for your %event_name% event at %event_location% has been changed. The event is now set for %event_start_date_time%.\n\nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(50, 'provider_event_next_day_reminder', NULL, 'enabled', 'sms', 'event', '17:00:00', NULL, NULL, 'provider', 'NULL', 'Dear %employee_full_name%, \n                    \nWe would like to remind you that you have %event_name% event at %event_start_date_time% at %event_location%.\n                    \nThank you, \n%company_name%', NULL, 0, NULL, NULL),
	(51, 'customer_account_recovery', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', 'Customer Panel Access', 'Dear <strong>%customer_full_name%</strong>,<br><br>You can access your profile on this <b><a href="%customer_panel_url%">link</a></b>.\n                    <br><br>Thank you for choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(52, 'provider_panel_access', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', 'Employee Panel Access', 'Dear <strong>%employee_full_name%</strong>,<br><br>You can access your profile and track your bookings on this <b><a href="%employee_panel_url%">link</a></b>.<br><br>Your login credentials:<br>Email: <b>%employee_email%</b><br>Password: <b>%employee_password%</b>\n                    <br><br>Best regards,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(53, 'provider_panel_recovery', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', 'Employee Panel Access', 'Dear <strong>%employee_full_name%</strong>,<br><br>You can access your profile and track your bookings on this <b><a href="%employee_panel_url%">link</a></b>.\n                    <br><br>Best regards,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(54, 'customer_package_purchased', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', 'Package %package_name% purchased', 'Dear <strong>%customer_full_name%</strong>,<br><br>You have successfully purchased\n                     <strong>%package_name%</strong>.\n                     <br><br>Thank you for choosing our company,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(55, 'customer_package_purchased', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'Package %package_name% purchased', 'Dear %customer_full_name%,\n\nYou have successfully purchased %package_name%.\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(56, 'provider_package_purchased', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', 'Package %package_name% purchased', 'Hi <strong>%employee_full_name%</strong>,<br><br>\n                     Customer <strong>%customer_full_name%</strong> has purchased <strong>%package_name%</strong> package.<br><br>\n                     Thank you,<br><strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(57, 'provider_package_purchased', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'Package %package_name% purchased', 'Hi %employee_full_name%,\n\nCustomer %customer_full_name% has purchased %package_name% package.\n                     \nThank you, %company_name%', NULL, 0, NULL, NULL),
	(58, 'customer_package_canceled', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', 'Package %package_name% canceled', 'Dear <strong>%customer_full_name%</strong>, \n                    The <strong>%package_name%</strong> that you have purchased has been canceled. \n                    Thank you,\n                    <strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(59, 'customer_package_canceled', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'Package %package_name% canceled', 'Dear %customer_full_name%, \nThe %package_name% that you have purchased has been canceled. \nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(60, 'provider_package_canceled', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', 'Package %package_name% canceled', 'Dear <strong>%employee_full_name%</strong>,\nThe <strong>%package_name%</strong> purchased by <strong>%customer_full_name%</strong> has been canceled.', NULL, 0, NULL, NULL),
	(61, 'provider_package_canceled', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'Package %package_name% canceled', 'Dear %employee_full_name%,\nThe %package_name% purchased by %customer_full_name% has been canceled.', NULL, 0, NULL, NULL),
	(62, 'customer_cart', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', 'Cart Purchase', '<p>Dear <strong>%customer_full_name%</strong>,</p><p><br></p><p>You have successfully purchased several appointments. The details about your bookings are shown below.</p><p><br></p><p>%cart_appointments_details%.</p><p><br></p><p>Thank you for choosing our company,</p><p><strong>%company_name%</strong></p>', NULL, 0, NULL, NULL),
	(63, 'customer_cart', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', 'NULL', 'Dear %customer_full_name%,\n\nYou have successfully scheduled several appointments.\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(64, 'provider_cart', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', 'Cart Purchase', '<p>Hi <strong>%employee_full_name%</strong>,</p><p><br></p><p>Customer <strong>%customer_full_name%</strong> has successfully scheduled several appointments. The details about bookings are shown below.</p><p><br></p><p>%cart_appointments_details%</p><p><br></p><p>Thank you,</p><p><strong>%company_name%</strong></p>', NULL, 0, NULL, NULL),
	(65, 'provider_cart', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', 'NULL', 'Hi %employee_full_name%,\n\nCustomer %customer_full_name% has successfully scheduled several appointments.\n                     \nThank you, %company_name%', NULL, 0, NULL, NULL),
	(66, 'customer_appointment_approved', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(67, 'customer_appointment_pending', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(68, 'customer_appointment_rejected', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(69, 'customer_appointment_canceled', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(70, 'customer_appointment_rescheduled', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(71, 'customer_appointment_next_day_reminder', NULL, 'enabled', 'whatsapp', 'appointment', '17:00:00', NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(72, 'customer_appointment_follow_up', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, 1800, 'customer', '', '', NULL, 0, NULL, NULL),
	(73, 'provider_appointment_approved', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(74, 'provider_appointment_pending', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(75, 'provider_appointment_rejected', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(76, 'provider_appointment_canceled', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(77, 'provider_appointment_rescheduled', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(78, 'provider_appointment_next_day_reminder', NULL, 'enabled', 'whatsapp', 'appointment', '17:00:00', NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(79, 'customer_event_approved', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(80, 'customer_event_rejected', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(81, 'customer_event_canceled', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(82, 'customer_event_rescheduled', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(83, 'customer_event_next_day_reminder', NULL, 'enabled', 'whatsapp', 'event', '17:00:00', NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(84, 'customer_event_follow_up', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, 1800, 'customer', '', '', NULL, 0, NULL, NULL),
	(85, 'provider_event_approved', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(86, 'provider_event_rejected', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(87, 'provider_event_canceled', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(88, 'provider_event_rescheduled', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(89, 'provider_event_next_day_reminder', NULL, 'enabled', 'whatsapp', 'event', '17:00:00', NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(90, 'customer_package_purchased', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(91, 'customer_package_canceled', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(92, 'provider_package_purchased', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(93, 'provider_package_canceled', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(94, 'customer_birthday_greeting', NULL, 'enabled', 'whatsapp', 'appointment', '17:00:00', NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(95, 'customer_account_recovery', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(96, 'provider_panel_access', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(97, 'provider_panel_recovery', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(98, 'customer_cart', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(99, 'provider_cart', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(100, 'customer_appointment_updated', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'customer', '%service_name% Appointment Details Changed', 'Dear <strong>%customer_full_name%</strong>,<br><br>Details of the appointment on <strong>%appointment_date_time%</strong> have changed: <br>\n                        <ul>\n                            <li>Employee: <strong>%employee_full_name%</strong></li>\n                            <li>Location: <strong>%location_name%</strong></li>\n                            <li>Extras: <strong>%service_extras%</strong></li>\n                        </ul><br>Thank you for choosing our company,<br>\n                    <strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(101, 'provider_appointment_updated', NULL, 'enabled', 'email', 'appointment', NULL, NULL, NULL, 'provider', '%service_name% Appointment Details Changed', 'Hi <strong>%employee_full_name%</strong>,<br><br>Details of the appointment on <strong>%appointment_date_time%</strong>  have changed:\n                       <br>\n                        <ul>\n                            <li>Customers: <strong>%customer_full_name%</strong></li>\n                            <li>Location: <strong>%location_name%</strong></li>\n                            <li>Extras: <strong>%service_extras%</strong></li>\n                        </ul><br>Thank you,<br>\n                    <strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(102, 'customer_appointment_updated', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'customer', '%service_name% Appointment Details Changed', 'Dear %customer_full_name%,\n\nDetails of the appointment on %appointment_date_time% have changed:\n    Employee: %employee_full_name%\n    Location: %location_name%\n    Extras: %service_extras%\n    \nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(103, 'provider_appointment_updated', NULL, 'enabled', 'sms', 'appointment', NULL, NULL, NULL, 'provider', '%service_name% Appointment Details Changed', 'Hi %employee_full_name%,\n                \nDetails of the appointment on %appointment_date_time% have changed:\n    Customers: %customer_full_name%,\n    Location: %location_name%,\n    Extras: %service_extras%\n    \nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(104, 'customer_appointment_updated', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(105, 'provider_appointment_updated', NULL, 'enabled', 'whatsapp', 'appointment', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL),
	(106, 'customer_event_updated', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'customer', '%event_name% Event Details Changed', 'Dear <strong>%customer_full_name%</strong>,<br><br>Details of the event on <strong>%event_start_date_time%</strong> have changed:\n                    <ul>\n                        <li>Organizer: <strong>%employee_full_name%</strong></li>\n                        <li>Location: <strong>%location_name%</strong></li>\n                    </ul><br>Thank you for choosing our company, <br>\n                    <strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(107, 'provider_event_updated', NULL, 'enabled', 'email', 'event', NULL, NULL, NULL, 'provider', '%event_name% Event Details Changed', 'Hi <strong>%employee_full_name%</strong>,<br><br>Details of the event on <strong>%event_start_date_time%</strong> have changed:\n                        <ul>\n                            <li>Description: <strong>%event_description%</strong></li>\n                            <li>Location: <strong>%location_name%</strong></li> \n                        </ul><br>Thank you, <br>\n                    <strong>%company_name%</strong>', NULL, 0, NULL, NULL),
	(108, 'customer_event_updated', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'customer', '%event_name% Event Details Changed', 'Dear %customer_full_name%,\n                    \nDetails of the event on %event_start_date_time% have changed:\n    Organizer: %employee_full_name\n    Location: %location_name%\n\nThank you for choosing our company,\n%company_name%', NULL, 0, NULL, NULL),
	(109, 'provider_event_updated', NULL, 'enabled', 'sms', 'event', NULL, NULL, NULL, 'provider', '%event_name% Event Details Changed', 'Hi %employee_full_name%,\n                \nDetails of the event on %event_start_date_time% have changed:\n    Description: %event_description%, \n    Location: %location_name%\n\nThank you,\n%company_name%', NULL, 0, NULL, NULL),
	(110, 'customer_event_updated', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'customer', '', '', NULL, 0, NULL, NULL),
	(111, 'provider_event_updated', NULL, 'enabled', 'whatsapp', 'event', NULL, NULL, NULL, 'provider', '', '', NULL, 0, NULL, NULL);
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_notifications_log
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_notifications_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificationId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `appointmentId` int(11) DEFAULT NULL,
  `eventId` int(11) DEFAULT NULL,
  `packageCustomerId` int(11) DEFAULT NULL,
  `sentDateTime` datetime NOT NULL,
  `sent` tinyint(1) DEFAULT NULL,
  `data` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_notifications_log: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications_log` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_notifications_sms_history
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_notifications_sms_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificationId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `appointmentId` int(11) DEFAULT NULL,
  `eventId` int(11) DEFAULT NULL,
  `packageCustomerId` int(11) DEFAULT NULL,
  `logId` int(11) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `text` varchar(1600) NOT NULL,
  `phone` varchar(63) NOT NULL,
  `alphaSenderId` varchar(11) NOT NULL,
  `status` enum('prepared','accepted','queued','sent','failed','delivered','undelivered') NOT NULL DEFAULT 'prepared',
  `price` double DEFAULT NULL,
  `segments` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_notifications_sms_history: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications_sms_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications_sms_history` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_notifications_to_entities
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_notifications_to_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificationId` int(11) NOT NULL,
  `entityId` int(11) NOT NULL,
  `entity` enum('appointment','event') NOT NULL DEFAULT 'appointment',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_notifications_to_entities: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications_to_entities` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_notifications_to_entities` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_packages
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '',
  `price` double NOT NULL,
  `status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
  `pictureFullPath` varchar(767) DEFAULT NULL,
  `pictureThumbPath` varchar(767) DEFAULT NULL,
  `position` int(11) DEFAULT 0,
  `calculatedPrice` tinyint(1) DEFAULT 1,
  `discount` double NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `durationType` enum('day','week','month') DEFAULT NULL,
  `durationCount` int(4) DEFAULT NULL,
  `settings` text DEFAULT NULL,
  `translations` text DEFAULT NULL,
  `depositPayment` enum('disabled','fixed','percentage') DEFAULT 'disabled',
  `deposit` double DEFAULT 0,
  `fullPayment` tinyint(1) DEFAULT 0,
  `sharedCapacity` tinyint(1) DEFAULT 0,
  `quantity` int(11) DEFAULT 1,
  `limitPerCustomer` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_packages: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_packages` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_packages_customers_to_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_packages_customers_to_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `packageCustomerId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `providerId` int(11) DEFAULT NULL,
  `locationId` int(11) DEFAULT NULL,
  `bookingsCount` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_packages_customers_to_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_customers_to_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_customers_to_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_packages_services_to_locations
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_packages_services_to_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `packageServiceId` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_packages_services_to_locations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_services_to_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_services_to_locations` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_packages_services_to_providers
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_packages_services_to_providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `packageServiceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_packages_services_to_providers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_services_to_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_services_to_providers` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_packages_to_customers
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_packages_to_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `packageId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `price` double NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `purchased` datetime NOT NULL,
  `status` enum('approved','pending','canceled','rejected') DEFAULT NULL,
  `bookingsCount` int(5) DEFAULT NULL,
  `couponId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_packages_to_customers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_to_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_to_customers` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_packages_to_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_packages_to_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serviceId` int(11) NOT NULL,
  `packageId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `minimumScheduled` int(5) DEFAULT 1,
  `maximumScheduled` int(5) DEFAULT 1,
  `allowProviderSelection` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_packages_to_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_to_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_packages_to_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_payments
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerBookingId` int(11) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `dateTime` datetime DEFAULT NULL,
  `status` enum('paid','pending','partiallyPaid','refunded') NOT NULL,
  `gateway` enum('onSite','payPal','stripe','wc','mollie','razorpay') NOT NULL,
  `gatewayTitle` varchar(255) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `packageCustomerId` int(11) DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  `entity` enum('appointment','event','package') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `actionsCompleted` tinyint(1) DEFAULT NULL,
  `triggeredActions` tinyint(1) DEFAULT NULL,
  `wcOrderId` bigint(20) DEFAULT NULL,
  `wcOrderItemId` bigint(20) DEFAULT NULL,
  `transactionId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_payments: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_payments` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_daysoff
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_daysoff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `repeat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_daysoff: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_daysoff` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_daysoff` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_google_calendar
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_google_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `token` text NOT NULL,
  `calendarId` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_google_calendar: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_google_calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_google_calendar` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_locations
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_locations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_locations` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_outlook_calendar
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_outlook_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `token` text NOT NULL,
  `calendarId` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_outlook_calendar: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_outlook_calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_outlook_calendar` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_periods
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weekDayId` int(11) NOT NULL,
  `locationId` int(11) DEFAULT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_periods: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_periods` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_periods` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_periods_location
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_periods_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodId` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_periods_location: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_periods_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_periods_location` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_periods_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_periods_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_periods_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_periods_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_periods_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `price` double NOT NULL,
  `minCapacity` int(11) NOT NULL,
  `maxCapacity` int(11) NOT NULL,
  `customPricing` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_specialdays
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_specialdays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_specialdays: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_specialdays_periods
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_specialdays_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specialDayId` int(11) NOT NULL,
  `locationId` int(11) DEFAULT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_specialdays_periods: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays_periods` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays_periods` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_specialdays_periods_location
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_specialdays_periods_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodId` int(11) NOT NULL,
  `locationId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_specialdays_periods_location: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays_periods_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays_periods_location` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_specialdays_periods_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_specialdays_periods_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `periodId` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_specialdays_periods_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays_periods_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_specialdays_periods_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_timeouts
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_timeouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weekDayId` int(11) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_timeouts: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_timeouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_timeouts` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_to_weekdays
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_to_weekdays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `dayIndex` tinyint(2) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_to_weekdays: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_weekdays` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_to_weekdays` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_providers_views
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_providers_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `date` date NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_providers_views: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_views` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_providers_views` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_resources
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `quantity` int(11) DEFAULT 1,
  `shared` enum('service','location') DEFAULT NULL,
  `status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
  `countAdditionalPeople` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_resources: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_resources` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_resources_to_entities
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_resources_to_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resourceId` int(11) NOT NULL,
  `entityId` int(11) NOT NULL,
  `entityType` enum('service','location','employee') NOT NULL DEFAULT 'service',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_resources_to_entities: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_resources_to_entities` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_resources_to_entities` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_services
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '',
  `price` double NOT NULL,
  `status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
  `categoryId` int(11) NOT NULL,
  `minCapacity` int(11) NOT NULL,
  `maxCapacity` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `timeBefore` int(11) DEFAULT 0,
  `timeAfter` int(11) DEFAULT 0,
  `bringingAnyone` tinyint(1) DEFAULT 1,
  `priority` enum('least_expensive','most_expensive','least_occupied','most_occupied') NOT NULL,
  `pictureFullPath` varchar(767) DEFAULT NULL,
  `pictureThumbPath` varchar(767) DEFAULT NULL,
  `position` int(11) DEFAULT 0,
  `show` tinyint(1) DEFAULT 1,
  `aggregatedPrice` tinyint(1) DEFAULT 1,
  `settings` text DEFAULT NULL,
  `recurringCycle` enum('disabled','all','daily','weekly','monthly') DEFAULT 'disabled',
  `recurringSub` enum('disabled','past','future','both') DEFAULT 'future',
  `recurringPayment` int(3) DEFAULT 0,
  `translations` text DEFAULT NULL,
  `depositPayment` enum('disabled','fixed','percentage') DEFAULT 'disabled',
  `depositPerPerson` tinyint(1) DEFAULT 1,
  `deposit` double DEFAULT 0,
  `fullPayment` tinyint(1) DEFAULT 0,
  `mandatoryExtra` tinyint(1) DEFAULT 0,
  `minSelectedExtras` int(11) DEFAULT 0,
  `customPricing` text DEFAULT NULL,
  `maxExtraPeople` int(11) DEFAULT NULL,
  `limitPerCustomer` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_services: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_services` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_services_views
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_services_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serviceId` int(11) NOT NULL,
  `date` date NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_services_views: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_services_views` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_services_views` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisamelia_users
CREATE TABLE IF NOT EXISTS `wp_aferesisamelia_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('hidden','visible','disabled') NOT NULL DEFAULT 'visible',
  `type` enum('customer','provider','manager','admin') NOT NULL,
  `externalId` bigint(20) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL DEFAULT '',
  `lastName` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(63) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `note` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pictureFullPath` varchar(767) DEFAULT NULL,
  `pictureThumbPath` varchar(767) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `usedTokens` text DEFAULT NULL,
  `zoomUserId` varchar(255) DEFAULT NULL,
  `countryPhoneIso` varchar(2) DEFAULT NULL,
  `translations` text DEFAULT NULL,
  `timeZone` varchar(255) DEFAULT NULL,
  `badgeId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla aferesis.wp_aferesisamelia_users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisamelia_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesisamelia_users` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesiscommentmeta
CREATE TABLE IF NOT EXISTS `wp_aferesiscommentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesiscommentmeta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesiscommentmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesiscommentmeta` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesiscomments
CREATE TABLE IF NOT EXISTS `wp_aferesiscomments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT 0,
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesiscomments: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesiscomments` DISABLE KEYS */;
INSERT INTO `wp_aferesiscomments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
	(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2024-05-06 08:53:51', '2024-05-06 08:53:51', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href="https://en.gravatar.com/">Gravatar</a>.', 0, '1', '', 'comment', 0, 0);
/*!40000 ALTER TABLE `wp_aferesiscomments` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesiscpabc_appointments
CREATE TABLE IF NOT EXISTS `wp_aferesiscpabc_appointments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `calendar` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `booked_time` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `booked_time_unformatted` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `email` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `phone` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `question` mediumtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `quantity` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `buffered_date` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesiscpabc_appointments: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointments` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointments` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesiscpabc_appointments_discount_codes
CREATE TABLE IF NOT EXISTS `wp_aferesiscpabc_appointments_discount_codes` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `cal_id` mediumint(9) NOT NULL DEFAULT 1,
  `code` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `discount` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `expires` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `availability` int(10) unsigned NOT NULL DEFAULT 0,
  `used` int(10) unsigned NOT NULL DEFAULT 0,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesiscpabc_appointments_discount_codes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointments_discount_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointments_discount_codes` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesiscpabc_appointment_calendars
CREATE TABLE IF NOT EXISTS `wp_aferesiscpabc_appointment_calendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `uname` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `passwd` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `lang` varchar(5) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cpages` tinyint(3) unsigned DEFAULT NULL,
  `ctype` tinyint(3) unsigned DEFAULT NULL,
  `msg` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `workingDates` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `restrictedDates` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timeWorkingDates0` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timeWorkingDates1` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timeWorkingDates2` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timeWorkingDates3` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timeWorkingDates4` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timeWorkingDates5` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `timeWorkingDates6` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `caldeleted` tinyint(3) unsigned DEFAULT NULL,
  `conwer` int(11) NOT NULL,
  `form_structure` mediumtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `specialDates` mediumtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `vs_use_validation` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_is_required` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_is_email` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_datemmddyyyy` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_dateddmmyyyy` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_number` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_digits` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_max` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_min` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `vs_text_submitbtn` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `calendar_language` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `calendar_dateformat` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `calendar_pages` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `calendar_militarytime` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `calendar_weekday` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `calendar_mindate` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `calendar_maxdate` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `calendar_startmonth` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `calendar_startyear` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `calendar_theme` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `min_slots` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `max_slots` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `close_fpanel` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `quantity_field` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `paypal_mode` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `enable_paypal` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `paypal_email` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `request_cost` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `request_address` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `paypal_product_name` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `currency` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `url_ok` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `url_cancel` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `paypal_language` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cu_user_email_field` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `notification_from_email` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `notification_destination_email` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `email_subject_confirmation_to_user` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `email_confirmation_to_user` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `email_subject_notification_to_admin` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `email_notification_to_admin` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `enable_reminder` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `reminder_hours` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `reminder_subject` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `reminder_content` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_enable_captcha` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_width` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_height` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_chars` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_min_font_size` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_max_font_size` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_noise` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_noise_length` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_background` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_border` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `dexcv_font` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cv_text_enter_valid_captcha` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `cp_cal_checkboxes` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `nuser_emailformat` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `nadmin_emailformat` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `nremind_emailformat` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesiscpabc_appointment_calendars: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointment_calendars` DISABLE KEYS */;
INSERT INTO `wp_aferesiscpabc_appointment_calendars` (`id`, `title`, `uname`, `passwd`, `lang`, `cpages`, `ctype`, `msg`, `workingDates`, `restrictedDates`, `timeWorkingDates0`, `timeWorkingDates1`, `timeWorkingDates2`, `timeWorkingDates3`, `timeWorkingDates4`, `timeWorkingDates5`, `timeWorkingDates6`, `caldeleted`, `conwer`, `form_structure`, `specialDates`, `vs_use_validation`, `vs_text_is_required`, `vs_text_is_email`, `vs_text_datemmddyyyy`, `vs_text_dateddmmyyyy`, `vs_text_number`, `vs_text_digits`, `vs_text_max`, `vs_text_min`, `vs_text_submitbtn`, `calendar_language`, `calendar_dateformat`, `calendar_pages`, `calendar_militarytime`, `calendar_weekday`, `calendar_mindate`, `calendar_maxdate`, `calendar_startmonth`, `calendar_startyear`, `calendar_theme`, `min_slots`, `max_slots`, `close_fpanel`, `quantity_field`, `paypal_mode`, `enable_paypal`, `paypal_email`, `request_cost`, `request_address`, `paypal_product_name`, `currency`, `url_ok`, `url_cancel`, `paypal_language`, `cu_user_email_field`, `notification_from_email`, `notification_destination_email`, `email_subject_confirmation_to_user`, `email_confirmation_to_user`, `email_subject_notification_to_admin`, `email_notification_to_admin`, `enable_reminder`, `reminder_hours`, `reminder_subject`, `reminder_content`, `dexcv_enable_captcha`, `dexcv_width`, `dexcv_height`, `dexcv_chars`, `dexcv_min_font_size`, `dexcv_max_font_size`, `dexcv_noise`, `dexcv_noise_length`, `dexcv_background`, `dexcv_border`, `dexcv_font`, `cv_text_enter_valid_captcha`, `cp_cal_checkboxes`, `nuser_emailformat`, `nadmin_emailformat`, `nremind_emailformat`) VALUES
	(1, 'cal1', 'Calendar Item 1', '', '-', 1, 3, 'Please, select your appointment.', '1,2,3,4,5', '', '', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0', '', 0, 0, '[[{"name":"email","index":0,"title":"Email","ftype":"femail","userhelp":"","csslayout":"","required":true,"predefined":"","size":"medium"},{"name":"subject","index":1,"title":"Subject","required":true,"ftype":"ftext","userhelp":"","csslayout":"","predefined":"","size":"medium"},{"name":"message","index":2,"size":"large","required":true,"title":"Message","ftype":"ftextarea","userhelp":"","csslayout":"","predefined":""}],[{"title":"","description":"","formlayout":"top_aligned"}]]', NULL, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'modern/', '', '', '', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointment_calendars` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesiscpabc_appointment_calendars_data
CREATE TABLE IF NOT EXISTS `wp_aferesiscpabc_appointment_calendars_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appointment_calendar_id` int(10) unsigned DEFAULT NULL,
  `datatime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(250) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `description_customer` text COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `reminder` varchar(1) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `reference` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `quantity` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesiscpabc_appointment_calendars_data: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointment_calendars_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesiscpabc_appointment_calendars_data` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesislinks
CREATE TABLE IF NOT EXISTS `wp_aferesislinks` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesislinks: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesislinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesislinks` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisoptions
CREATE TABLE IF NOT EXISTS `wp_aferesisoptions` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesisoptions: ~145 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisoptions` DISABLE KEYS */;
INSERT INTO `wp_aferesisoptions` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
	(1, 'siteurl', 'http://10.35.50.118/wordpress', 'yes'),
	(2, 'home', 'http://10.35.50.118/wordpress', 'yes'),
	(3, 'blogname', 'aferesis', 'yes'),
	(4, 'blogdescription', '', 'yes'),
	(5, 'users_can_register', '0', 'yes'),
	(6, 'admin_email', 'dbarrosoc2@gmail.com', 'yes'),
	(7, 'start_of_week', '1', 'yes'),
	(8, 'use_balanceTags', '0', 'yes'),
	(9, 'use_smilies', '1', 'yes'),
	(10, 'require_name_email', '1', 'yes'),
	(11, 'comments_notify', '1', 'yes'),
	(12, 'posts_per_rss', '10', 'yes'),
	(13, 'rss_use_excerpt', '0', 'yes'),
	(14, 'mailserver_url', 'mail.example.com', 'yes'),
	(15, 'mailserver_login', 'login@example.com', 'yes'),
	(16, 'mailserver_pass', 'password', 'yes'),
	(17, 'mailserver_port', '110', 'yes'),
	(18, 'default_category', '1', 'yes'),
	(19, 'default_comment_status', 'open', 'yes'),
	(20, 'default_ping_status', 'open', 'yes'),
	(21, 'default_pingback_flag', '0', 'yes'),
	(22, 'posts_per_page', '10', 'yes'),
	(23, 'date_format', 'F j, Y', 'yes'),
	(24, 'time_format', 'g:i a', 'yes'),
	(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
	(26, 'comment_moderation', '0', 'yes'),
	(27, 'moderation_notify', '1', 'yes'),
	(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
	(29, 'rewrite_rules', 'a:94:{s:11:"^wp-json/?$";s:22:"index.php?rest_route=/";s:14:"^wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:21:"^index.php/wp-json/?$";s:22:"index.php?rest_route=/";s:24:"^index.php/wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:17:"^wp-sitemap\\.xml$";s:23:"index.php?sitemap=index";s:17:"^wp-sitemap\\.xsl$";s:36:"index.php?sitemap-stylesheet=sitemap";s:23:"^wp-sitemap-index\\.xsl$";s:34:"index.php?sitemap-stylesheet=index";s:48:"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$";s:75:"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]";s:34:"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$";s:47:"index.php?sitemap=$matches[1]&paged=$matches[2]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:23:"category/(.+?)/embed/?$";s:46:"index.php?category_name=$matches[1]&embed=true";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:20:"tag/([^/]+)/embed/?$";s:36:"index.php?tag=$matches[1]&embed=true";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:21:"type/([^/]+)/embed/?$";s:44:"index.php?post_format=$matches[1]&embed=true";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:8:"embed/?$";s:21:"index.php?&embed=true";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:17:"comments/embed/?$";s:21:"index.php?&embed=true";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:20:"search/(.+)/embed/?$";s:34:"index.php?s=$matches[1]&embed=true";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:23:"author/([^/]+)/embed/?$";s:44:"index.php?author_name=$matches[1]&embed=true";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:45:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$";s:74:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:32:"([0-9]{4})/([0-9]{1,2})/embed/?$";s:58:"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:19:"([0-9]{4})/embed/?$";s:37:"index.php?year=$matches[1]&embed=true";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:58:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:68:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:88:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:64:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:53:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$";s:91:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$";s:85:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1";s:77:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:65:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]";s:61:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]";s:47:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:57:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:77:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:53:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]";s:51:"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]";s:38:"([0-9]{4})/comment-page-([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&cpage=$matches[2]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";}', 'yes'),
	(30, 'hack_file', '0', 'yes'),
	(31, 'blog_charset', 'UTF-8', 'yes'),
	(32, 'moderation_keys', '', 'no'),
	(33, 'active_plugins', 'a:1:{i:0;s:51:"appointment-booking-calendar/cpabc_appointments.php";}', 'yes'),
	(34, 'category_base', '', 'yes'),
	(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
	(36, 'comment_max_links', '2', 'yes'),
	(37, 'gmt_offset', '0', 'yes'),
	(38, 'default_email_category', '1', 'yes'),
	(39, 'recently_edited', '', 'no'),
	(40, 'template', 'understrap', 'yes'),
	(41, 'stylesheet', 'understrap', 'yes'),
	(42, 'comment_registration', '0', 'yes'),
	(43, 'html_type', 'text/html', 'yes'),
	(44, 'use_trackback', '0', 'yes'),
	(45, 'default_role', 'subscriber', 'yes'),
	(46, 'db_version', '57155', 'yes'),
	(47, 'uploads_use_yearmonth_folders', '1', 'yes'),
	(48, 'upload_path', '', 'yes'),
	(49, 'blog_public', '0', 'yes'),
	(50, 'default_link_category', '2', 'yes'),
	(51, 'show_on_front', 'posts', 'yes'),
	(52, 'tag_base', '', 'yes'),
	(53, 'show_avatars', '1', 'yes'),
	(54, 'avatar_rating', 'G', 'yes'),
	(55, 'upload_url_path', '', 'yes'),
	(56, 'thumbnail_size_w', '150', 'yes'),
	(57, 'thumbnail_size_h', '150', 'yes'),
	(58, 'thumbnail_crop', '1', 'yes'),
	(59, 'medium_size_w', '300', 'yes'),
	(60, 'medium_size_h', '300', 'yes'),
	(61, 'avatar_default', 'mystery', 'yes'),
	(62, 'large_size_w', '1024', 'yes'),
	(63, 'large_size_h', '1024', 'yes'),
	(64, 'image_default_link_type', 'none', 'yes'),
	(65, 'image_default_size', '', 'yes'),
	(66, 'image_default_align', '', 'yes'),
	(67, 'close_comments_for_old_posts', '0', 'yes'),
	(68, 'close_comments_days_old', '14', 'yes'),
	(69, 'thread_comments', '1', 'yes'),
	(70, 'thread_comments_depth', '5', 'yes'),
	(71, 'page_comments', '0', 'yes'),
	(72, 'comments_per_page', '50', 'yes'),
	(73, 'default_comments_page', 'newest', 'yes'),
	(74, 'comment_order', 'asc', 'yes'),
	(75, 'sticky_posts', 'a:0:{}', 'yes'),
	(76, 'widget_categories', 'a:0:{}', 'yes'),
	(77, 'widget_text', 'a:0:{}', 'yes'),
	(78, 'widget_rss', 'a:0:{}', 'yes'),
	(79, 'uninstall_plugins', 'a:1:{s:31:"ameliabooking/ameliabooking.php";a:2:{i:0;s:20:"AmeliaBooking\\Plugin";i:1;s:8:"deletion";}}', 'no'),
	(80, 'timezone_string', '', 'yes'),
	(81, 'page_for_posts', '0', 'yes'),
	(82, 'page_on_front', '0', 'yes'),
	(83, 'default_post_format', '0', 'yes'),
	(84, 'link_manager_enabled', '0', 'yes'),
	(85, 'finished_splitting_shared_terms', '1', 'yes'),
	(86, 'site_icon', '0', 'yes'),
	(87, 'medium_large_size_w', '768', 'yes'),
	(88, 'medium_large_size_h', '0', 'yes'),
	(89, 'wp_page_for_privacy_policy', '3', 'yes'),
	(90, 'show_comments_cookies_opt_in', '1', 'yes'),
	(91, 'admin_email_lifespan', '1730537628', 'yes'),
	(92, 'disallowed_keys', '', 'no'),
	(93, 'comment_previously_approved', '1', 'yes'),
	(94, 'auto_plugin_theme_update_emails', 'a:0:{}', 'no'),
	(95, 'auto_update_core_dev', 'enabled', 'yes'),
	(96, 'auto_update_core_minor', 'enabled', 'yes'),
	(97, 'auto_update_core_major', 'enabled', 'yes'),
	(98, 'wp_force_deactivated_plugins', 'a:0:{}', 'yes'),
	(99, 'wp_attachment_pages_enabled', '0', 'yes'),
	(100, 'initial_db_version', '57155', 'yes'),
	(101, 'wp_Aferesisuser_roles', 'a:8:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:128:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:16:"amelia_read_menu";b:1;s:21:"amelia_read_dashboard";b:1;s:21:"amelia_read_whats_new";b:1;s:27:"amelia_read_lite_vs_premium";b:1;s:20:"amelia_read_calendar";b:1;s:24:"amelia_read_appointments";b:1;s:18:"amelia_read_events";b:1;s:21:"amelia_read_employees";b:1;s:20:"amelia_read_services";b:1;s:20:"amelia_read_packages";b:1;s:21:"amelia_read_locations";b:1;s:19:"amelia_read_coupons";b:1;s:21:"amelia_read_customers";b:1;s:19:"amelia_read_finance";b:1;s:25:"amelia_read_notifications";b:1;s:21:"amelia_read_customize";b:1;s:25:"amelia_read_custom_fields";b:1;s:20:"amelia_read_settings";b:1;s:27:"amelia_read_others_settings";b:1;s:28:"amelia_read_others_dashboard";b:1;s:27:"amelia_read_others_calendar";b:1;s:31:"amelia_read_others_appointments";b:1;s:27:"amelia_read_others_services";b:1;s:28:"amelia_read_others_employees";b:1;s:28:"amelia_read_others_customers";b:1;s:22:"amelia_write_dashboard";b:1;s:21:"amelia_write_calendar";b:1;s:25:"amelia_write_appointments";b:1;s:19:"amelia_write_events";b:1;s:22:"amelia_write_employees";b:1;s:21:"amelia_write_services";b:1;s:21:"amelia_write_packages";b:1;s:22:"amelia_write_locations";b:1;s:20:"amelia_write_coupons";b:1;s:22:"amelia_write_customers";b:1;s:20:"amelia_write_finance";b:1;s:26:"amelia_write_notifications";b:1;s:22:"amelia_write_customize";b:1;s:26:"amelia_write_custom_fields";b:1;s:21:"amelia_write_settings";b:1;s:19:"amelia_write_status";b:1;s:28:"amelia_write_others_settings";b:1;s:28:"amelia_write_others_calendar";b:1;s:32:"amelia_write_others_appointments";b:1;s:28:"amelia_write_others_services";b:1;s:29:"amelia_write_others_employees";b:1;s:26:"amelia_write_others_events";b:1;s:27:"amelia_write_others_finance";b:1;s:29:"amelia_write_others_dashboard";b:1;s:23:"amelia_delete_dashboard";b:1;s:22:"amelia_delete_calendar";b:1;s:26:"amelia_delete_appointments";b:1;s:20:"amelia_delete_events";b:1;s:23:"amelia_delete_employees";b:1;s:22:"amelia_delete_services";b:1;s:22:"amelia_delete_packages";b:1;s:23:"amelia_delete_locations";b:1;s:21:"amelia_delete_coupons";b:1;s:23:"amelia_delete_customers";b:1;s:21:"amelia_delete_finance";b:1;s:27:"amelia_delete_notifications";b:1;s:23:"amelia_delete_customize";b:1;s:27:"amelia_delete_custom_fields";b:1;s:22:"amelia_delete_settings";b:1;s:32:"amelia_write_status_appointments";b:1;s:26:"amelia_write_status_events";b:1;s:30:"amelia_write_time_appointments";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}s:17:"wpamelia-customer";a:2:{s:4:"name";s:15:"Amelia Customer";s:12:"capabilities";a:6:{s:4:"read";b:1;s:16:"amelia_read_menu";b:1;s:20:"amelia_read_calendar";b:1;s:24:"amelia_read_appointments";b:1;s:18:"amelia_read_events";b:1;s:30:"amelia_write_time_appointments";b:1;}}s:17:"wpamelia-provider";a:2:{s:4:"name";s:15:"Amelia Employee";s:12:"capabilities";a:18:{s:4:"read";b:1;s:20:"amelia_delete_events";b:1;s:16:"amelia_read_menu";b:1;s:20:"amelia_read_calendar";b:1;s:24:"amelia_read_appointments";b:1;s:18:"amelia_read_events";b:1;s:21:"amelia_read_employees";b:1;s:28:"amelia_read_others_customers";b:1;s:27:"amelia_read_others_services";b:0;s:22:"amelia_write_employees";b:1;s:32:"amelia_write_status_appointments";b:1;s:26:"amelia_write_status_events";b:1;s:30:"amelia_write_time_appointments";b:1;s:32:"amelia_write_others_appointments";b:0;s:28:"amelia_write_others_services";b:0;s:25:"amelia_write_appointments";b:1;s:19:"amelia_write_events";b:1;s:26:"amelia_write_others_events";b:0;}}s:16:"wpamelia-manager";a:2:{s:4:"name";s:14:"Amelia Manager";s:12:"capabilities";a:48:{s:4:"read";b:1;s:20:"amelia_delete_events";b:1;s:16:"amelia_read_menu";b:1;s:21:"amelia_read_dashboard";b:1;s:21:"amelia_read_whats_new";b:1;s:27:"amelia_read_lite_vs_premium";b:1;s:20:"amelia_read_calendar";b:1;s:24:"amelia_read_appointments";b:1;s:18:"amelia_read_events";b:1;s:21:"amelia_read_employees";b:1;s:20:"amelia_read_services";b:1;s:21:"amelia_read_resources";b:1;s:20:"amelia_read_packages";b:1;s:21:"amelia_read_locations";b:1;s:19:"amelia_read_coupons";b:1;s:21:"amelia_read_customers";b:1;s:19:"amelia_read_finance";b:1;s:25:"amelia_read_notifications";b:1;s:28:"amelia_read_others_dashboard";b:1;s:27:"amelia_read_others_calendar";b:1;s:31:"amelia_read_others_appointments";b:1;s:27:"amelia_read_others_services";b:1;s:28:"amelia_read_others_employees";b:1;s:28:"amelia_read_others_customers";b:1;s:22:"amelia_write_dashboard";b:1;s:21:"amelia_write_calendar";b:1;s:25:"amelia_write_appointments";b:1;s:19:"amelia_write_events";b:1;s:22:"amelia_write_employees";b:1;s:21:"amelia_write_services";b:1;s:22:"amelia_write_resources";b:1;s:21:"amelia_write_packages";b:1;s:22:"amelia_write_locations";b:1;s:20:"amelia_write_coupons";b:1;s:22:"amelia_write_customers";b:1;s:20:"amelia_write_finance";b:1;s:26:"amelia_write_notifications";b:1;s:28:"amelia_write_others_calendar";b:1;s:32:"amelia_write_others_appointments";b:1;s:28:"amelia_write_others_services";b:1;s:29:"amelia_write_others_employees";b:1;s:26:"amelia_write_others_events";b:1;s:27:"amelia_write_others_finance";b:1;s:29:"amelia_write_others_dashboard";b:1;s:32:"amelia_write_status_appointments";b:1;s:26:"amelia_write_status_events";b:1;s:30:"amelia_write_time_appointments";b:1;s:12:"upload_files";b:1;}}}', 'yes'),
	(102, 'fresh_site', '0', 'yes'),
	(103, 'user_count', '1', 'no'),
	(104, 'widget_block', 'a:6:{i:2;a:1:{s:7:"content";s:19:"<!-- wp:search /-->";}i:3;a:1:{s:7:"content";s:154:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Recent Posts</h2><!-- /wp:heading --><!-- wp:latest-posts /--></div><!-- /wp:group -->";}i:4;a:1:{s:7:"content";s:227:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Recent Comments</h2><!-- /wp:heading --><!-- wp:latest-comments {"displayAvatar":false,"displayDate":false,"displayExcerpt":false} /--></div><!-- /wp:group -->";}i:5;a:1:{s:7:"content";s:146:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Archives</h2><!-- /wp:heading --><!-- wp:archives /--></div><!-- /wp:group -->";}i:6;a:1:{s:7:"content";s:150:"<!-- wp:group --><div class="wp-block-group"><!-- wp:heading --><h2>Categories</h2><!-- /wp:heading --><!-- wp:categories /--></div><!-- /wp:group -->";}s:12:"_multiwidget";i:1;}', 'yes'),
	(105, 'sidebars_widgets', 'a:8:{s:19:"wp_inactive_widgets";a:0:{}s:13:"right-sidebar";a:3:{i:0;s:7:"block-2";i:1;s:7:"block-3";i:2;s:7:"block-4";}s:12:"left-sidebar";a:2:{i:0;s:7:"block-5";i:1;s:7:"block-6";}s:4:"hero";a:0:{}s:10:"herocanvas";a:0:{}s:10:"statichero";a:0:{}s:10:"footerfull";a:0:{}s:13:"array_version";i:3;}', 'yes'),
	(106, 'cron', 'a:7:{i:1715237633;a:1:{s:34:"wp_privacy_delete_old_export_files";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"hourly";s:4:"args";a:0:{}s:8:"interval";i:3600;}}}i:1715244833;a:4:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:32:"recovery_mode_clean_expired_keys";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1715244869;a:3:{s:21:"wp_update_user_counts";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}s:25:"delete_expired_transients";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1715244870;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1715591997;a:1:{s:30:"wp_delete_temp_updater_backups";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"weekly";s:4:"args";a:0:{}s:8:"interval";i:604800;}}}i:1715676833;a:1:{s:30:"wp_site_health_scheduled_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:6:"weekly";s:4:"args";a:0:{}s:8:"interval";i:604800;}}}s:7:"version";i:2;}', 'yes'),
	(107, 'widget_pages', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(108, 'widget_calendar', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(109, 'widget_archives', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(110, 'widget_media_audio', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(111, 'widget_media_image', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(112, 'widget_media_gallery', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(113, 'widget_media_video', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(114, 'widget_meta', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(115, 'widget_search', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(116, 'widget_recent-posts', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(117, 'widget_recent-comments', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(118, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(119, 'widget_nav_menu', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(120, 'widget_custom_html', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
	(121, '_transient_wp_core_block_css_files', 'a:2:{s:7:"version";s:5:"6.5.2";s:5:"files";a:500:{i:0;s:23:"archives/editor-rtl.css";i:1;s:27:"archives/editor-rtl.min.css";i:2;s:19:"archives/editor.css";i:3;s:23:"archives/editor.min.css";i:4;s:22:"archives/style-rtl.css";i:5;s:26:"archives/style-rtl.min.css";i:6;s:18:"archives/style.css";i:7;s:22:"archives/style.min.css";i:8;s:20:"audio/editor-rtl.css";i:9;s:24:"audio/editor-rtl.min.css";i:10;s:16:"audio/editor.css";i:11;s:20:"audio/editor.min.css";i:12;s:19:"audio/style-rtl.css";i:13;s:23:"audio/style-rtl.min.css";i:14;s:15:"audio/style.css";i:15;s:19:"audio/style.min.css";i:16;s:19:"audio/theme-rtl.css";i:17;s:23:"audio/theme-rtl.min.css";i:18;s:15:"audio/theme.css";i:19;s:19:"audio/theme.min.css";i:20;s:21:"avatar/editor-rtl.css";i:21;s:25:"avatar/editor-rtl.min.css";i:22;s:17:"avatar/editor.css";i:23;s:21:"avatar/editor.min.css";i:24;s:20:"avatar/style-rtl.css";i:25;s:24:"avatar/style-rtl.min.css";i:26;s:16:"avatar/style.css";i:27;s:20:"avatar/style.min.css";i:28;s:20:"block/editor-rtl.css";i:29;s:24:"block/editor-rtl.min.css";i:30;s:16:"block/editor.css";i:31;s:20:"block/editor.min.css";i:32;s:21:"button/editor-rtl.css";i:33;s:25:"button/editor-rtl.min.css";i:34;s:17:"button/editor.css";i:35;s:21:"button/editor.min.css";i:36;s:20:"button/style-rtl.css";i:37;s:24:"button/style-rtl.min.css";i:38;s:16:"button/style.css";i:39;s:20:"button/style.min.css";i:40;s:22:"buttons/editor-rtl.css";i:41;s:26:"buttons/editor-rtl.min.css";i:42;s:18:"buttons/editor.css";i:43;s:22:"buttons/editor.min.css";i:44;s:21:"buttons/style-rtl.css";i:45;s:25:"buttons/style-rtl.min.css";i:46;s:17:"buttons/style.css";i:47;s:21:"buttons/style.min.css";i:48;s:22:"calendar/style-rtl.css";i:49;s:26:"calendar/style-rtl.min.css";i:50;s:18:"calendar/style.css";i:51;s:22:"calendar/style.min.css";i:52;s:25:"categories/editor-rtl.css";i:53;s:29:"categories/editor-rtl.min.css";i:54;s:21:"categories/editor.css";i:55;s:25:"categories/editor.min.css";i:56;s:24:"categories/style-rtl.css";i:57;s:28:"categories/style-rtl.min.css";i:58;s:20:"categories/style.css";i:59;s:24:"categories/style.min.css";i:60;s:19:"code/editor-rtl.css";i:61;s:23:"code/editor-rtl.min.css";i:62;s:15:"code/editor.css";i:63;s:19:"code/editor.min.css";i:64;s:18:"code/style-rtl.css";i:65;s:22:"code/style-rtl.min.css";i:66;s:14:"code/style.css";i:67;s:18:"code/style.min.css";i:68;s:18:"code/theme-rtl.css";i:69;s:22:"code/theme-rtl.min.css";i:70;s:14:"code/theme.css";i:71;s:18:"code/theme.min.css";i:72;s:22:"columns/editor-rtl.css";i:73;s:26:"columns/editor-rtl.min.css";i:74;s:18:"columns/editor.css";i:75;s:22:"columns/editor.min.css";i:76;s:21:"columns/style-rtl.css";i:77;s:25:"columns/style-rtl.min.css";i:78;s:17:"columns/style.css";i:79;s:21:"columns/style.min.css";i:80;s:29:"comment-content/style-rtl.css";i:81;s:33:"comment-content/style-rtl.min.css";i:82;s:25:"comment-content/style.css";i:83;s:29:"comment-content/style.min.css";i:84;s:30:"comment-template/style-rtl.css";i:85;s:34:"comment-template/style-rtl.min.css";i:86;s:26:"comment-template/style.css";i:87;s:30:"comment-template/style.min.css";i:88;s:42:"comments-pagination-numbers/editor-rtl.css";i:89;s:46:"comments-pagination-numbers/editor-rtl.min.css";i:90;s:38:"comments-pagination-numbers/editor.css";i:91;s:42:"comments-pagination-numbers/editor.min.css";i:92;s:34:"comments-pagination/editor-rtl.css";i:93;s:38:"comments-pagination/editor-rtl.min.css";i:94;s:30:"comments-pagination/editor.css";i:95;s:34:"comments-pagination/editor.min.css";i:96;s:33:"comments-pagination/style-rtl.css";i:97;s:37:"comments-pagination/style-rtl.min.css";i:98;s:29:"comments-pagination/style.css";i:99;s:33:"comments-pagination/style.min.css";i:100;s:29:"comments-title/editor-rtl.css";i:101;s:33:"comments-title/editor-rtl.min.css";i:102;s:25:"comments-title/editor.css";i:103;s:29:"comments-title/editor.min.css";i:104;s:23:"comments/editor-rtl.css";i:105;s:27:"comments/editor-rtl.min.css";i:106;s:19:"comments/editor.css";i:107;s:23:"comments/editor.min.css";i:108;s:22:"comments/style-rtl.css";i:109;s:26:"comments/style-rtl.min.css";i:110;s:18:"comments/style.css";i:111;s:22:"comments/style.min.css";i:112;s:20:"cover/editor-rtl.css";i:113;s:24:"cover/editor-rtl.min.css";i:114;s:16:"cover/editor.css";i:115;s:20:"cover/editor.min.css";i:116;s:19:"cover/style-rtl.css";i:117;s:23:"cover/style-rtl.min.css";i:118;s:15:"cover/style.css";i:119;s:19:"cover/style.min.css";i:120;s:22:"details/editor-rtl.css";i:121;s:26:"details/editor-rtl.min.css";i:122;s:18:"details/editor.css";i:123;s:22:"details/editor.min.css";i:124;s:21:"details/style-rtl.css";i:125;s:25:"details/style-rtl.min.css";i:126;s:17:"details/style.css";i:127;s:21:"details/style.min.css";i:128;s:20:"embed/editor-rtl.css";i:129;s:24:"embed/editor-rtl.min.css";i:130;s:16:"embed/editor.css";i:131;s:20:"embed/editor.min.css";i:132;s:19:"embed/style-rtl.css";i:133;s:23:"embed/style-rtl.min.css";i:134;s:15:"embed/style.css";i:135;s:19:"embed/style.min.css";i:136;s:19:"embed/theme-rtl.css";i:137;s:23:"embed/theme-rtl.min.css";i:138;s:15:"embed/theme.css";i:139;s:19:"embed/theme.min.css";i:140;s:19:"file/editor-rtl.css";i:141;s:23:"file/editor-rtl.min.css";i:142;s:15:"file/editor.css";i:143;s:19:"file/editor.min.css";i:144;s:18:"file/style-rtl.css";i:145;s:22:"file/style-rtl.min.css";i:146;s:14:"file/style.css";i:147;s:18:"file/style.min.css";i:148;s:23:"footnotes/style-rtl.css";i:149;s:27:"footnotes/style-rtl.min.css";i:150;s:19:"footnotes/style.css";i:151;s:23:"footnotes/style.min.css";i:152;s:23:"freeform/editor-rtl.css";i:153;s:27:"freeform/editor-rtl.min.css";i:154;s:19:"freeform/editor.css";i:155;s:23:"freeform/editor.min.css";i:156;s:22:"gallery/editor-rtl.css";i:157;s:26:"gallery/editor-rtl.min.css";i:158;s:18:"gallery/editor.css";i:159;s:22:"gallery/editor.min.css";i:160;s:21:"gallery/style-rtl.css";i:161;s:25:"gallery/style-rtl.min.css";i:162;s:17:"gallery/style.css";i:163;s:21:"gallery/style.min.css";i:164;s:21:"gallery/theme-rtl.css";i:165;s:25:"gallery/theme-rtl.min.css";i:166;s:17:"gallery/theme.css";i:167;s:21:"gallery/theme.min.css";i:168;s:20:"group/editor-rtl.css";i:169;s:24:"group/editor-rtl.min.css";i:170;s:16:"group/editor.css";i:171;s:20:"group/editor.min.css";i:172;s:19:"group/style-rtl.css";i:173;s:23:"group/style-rtl.min.css";i:174;s:15:"group/style.css";i:175;s:19:"group/style.min.css";i:176;s:19:"group/theme-rtl.css";i:177;s:23:"group/theme-rtl.min.css";i:178;s:15:"group/theme.css";i:179;s:19:"group/theme.min.css";i:180;s:21:"heading/style-rtl.css";i:181;s:25:"heading/style-rtl.min.css";i:182;s:17:"heading/style.css";i:183;s:21:"heading/style.min.css";i:184;s:19:"html/editor-rtl.css";i:185;s:23:"html/editor-rtl.min.css";i:186;s:15:"html/editor.css";i:187;s:19:"html/editor.min.css";i:188;s:20:"image/editor-rtl.css";i:189;s:24:"image/editor-rtl.min.css";i:190;s:16:"image/editor.css";i:191;s:20:"image/editor.min.css";i:192;s:19:"image/style-rtl.css";i:193;s:23:"image/style-rtl.min.css";i:194;s:15:"image/style.css";i:195;s:19:"image/style.min.css";i:196;s:19:"image/theme-rtl.css";i:197;s:23:"image/theme-rtl.min.css";i:198;s:15:"image/theme.css";i:199;s:19:"image/theme.min.css";i:200;s:29:"latest-comments/style-rtl.css";i:201;s:33:"latest-comments/style-rtl.min.css";i:202;s:25:"latest-comments/style.css";i:203;s:29:"latest-comments/style.min.css";i:204;s:27:"latest-posts/editor-rtl.css";i:205;s:31:"latest-posts/editor-rtl.min.css";i:206;s:23:"latest-posts/editor.css";i:207;s:27:"latest-posts/editor.min.css";i:208;s:26:"latest-posts/style-rtl.css";i:209;s:30:"latest-posts/style-rtl.min.css";i:210;s:22:"latest-posts/style.css";i:211;s:26:"latest-posts/style.min.css";i:212;s:18:"list/style-rtl.css";i:213;s:22:"list/style-rtl.min.css";i:214;s:14:"list/style.css";i:215;s:18:"list/style.min.css";i:216;s:25:"media-text/editor-rtl.css";i:217;s:29:"media-text/editor-rtl.min.css";i:218;s:21:"media-text/editor.css";i:219;s:25:"media-text/editor.min.css";i:220;s:24:"media-text/style-rtl.css";i:221;s:28:"media-text/style-rtl.min.css";i:222;s:20:"media-text/style.css";i:223;s:24:"media-text/style.min.css";i:224;s:19:"more/editor-rtl.css";i:225;s:23:"more/editor-rtl.min.css";i:226;s:15:"more/editor.css";i:227;s:19:"more/editor.min.css";i:228;s:30:"navigation-link/editor-rtl.css";i:229;s:34:"navigation-link/editor-rtl.min.css";i:230;s:26:"navigation-link/editor.css";i:231;s:30:"navigation-link/editor.min.css";i:232;s:29:"navigation-link/style-rtl.css";i:233;s:33:"navigation-link/style-rtl.min.css";i:234;s:25:"navigation-link/style.css";i:235;s:29:"navigation-link/style.min.css";i:236;s:33:"navigation-submenu/editor-rtl.css";i:237;s:37:"navigation-submenu/editor-rtl.min.css";i:238;s:29:"navigation-submenu/editor.css";i:239;s:33:"navigation-submenu/editor.min.css";i:240;s:25:"navigation/editor-rtl.css";i:241;s:29:"navigation/editor-rtl.min.css";i:242;s:21:"navigation/editor.css";i:243;s:25:"navigation/editor.min.css";i:244;s:24:"navigation/style-rtl.css";i:245;s:28:"navigation/style-rtl.min.css";i:246;s:20:"navigation/style.css";i:247;s:24:"navigation/style.min.css";i:248;s:23:"nextpage/editor-rtl.css";i:249;s:27:"nextpage/editor-rtl.min.css";i:250;s:19:"nextpage/editor.css";i:251;s:23:"nextpage/editor.min.css";i:252;s:24:"page-list/editor-rtl.css";i:253;s:28:"page-list/editor-rtl.min.css";i:254;s:20:"page-list/editor.css";i:255;s:24:"page-list/editor.min.css";i:256;s:23:"page-list/style-rtl.css";i:257;s:27:"page-list/style-rtl.min.css";i:258;s:19:"page-list/style.css";i:259;s:23:"page-list/style.min.css";i:260;s:24:"paragraph/editor-rtl.css";i:261;s:28:"paragraph/editor-rtl.min.css";i:262;s:20:"paragraph/editor.css";i:263;s:24:"paragraph/editor.min.css";i:264;s:23:"paragraph/style-rtl.css";i:265;s:27:"paragraph/style-rtl.min.css";i:266;s:19:"paragraph/style.css";i:267;s:23:"paragraph/style.min.css";i:268;s:25:"post-author/style-rtl.css";i:269;s:29:"post-author/style-rtl.min.css";i:270;s:21:"post-author/style.css";i:271;s:25:"post-author/style.min.css";i:272;s:33:"post-comments-form/editor-rtl.css";i:273;s:37:"post-comments-form/editor-rtl.min.css";i:274;s:29:"post-comments-form/editor.css";i:275;s:33:"post-comments-form/editor.min.css";i:276;s:32:"post-comments-form/style-rtl.css";i:277;s:36:"post-comments-form/style-rtl.min.css";i:278;s:28:"post-comments-form/style.css";i:279;s:32:"post-comments-form/style.min.css";i:280;s:27:"post-content/editor-rtl.css";i:281;s:31:"post-content/editor-rtl.min.css";i:282;s:23:"post-content/editor.css";i:283;s:27:"post-content/editor.min.css";i:284;s:23:"post-date/style-rtl.css";i:285;s:27:"post-date/style-rtl.min.css";i:286;s:19:"post-date/style.css";i:287;s:23:"post-date/style.min.css";i:288;s:27:"post-excerpt/editor-rtl.css";i:289;s:31:"post-excerpt/editor-rtl.min.css";i:290;s:23:"post-excerpt/editor.css";i:291;s:27:"post-excerpt/editor.min.css";i:292;s:26:"post-excerpt/style-rtl.css";i:293;s:30:"post-excerpt/style-rtl.min.css";i:294;s:22:"post-excerpt/style.css";i:295;s:26:"post-excerpt/style.min.css";i:296;s:34:"post-featured-image/editor-rtl.css";i:297;s:38:"post-featured-image/editor-rtl.min.css";i:298;s:30:"post-featured-image/editor.css";i:299;s:34:"post-featured-image/editor.min.css";i:300;s:33:"post-featured-image/style-rtl.css";i:301;s:37:"post-featured-image/style-rtl.min.css";i:302;s:29:"post-featured-image/style.css";i:303;s:33:"post-featured-image/style.min.css";i:304;s:34:"post-navigation-link/style-rtl.css";i:305;s:38:"post-navigation-link/style-rtl.min.css";i:306;s:30:"post-navigation-link/style.css";i:307;s:34:"post-navigation-link/style.min.css";i:308;s:28:"post-template/editor-rtl.css";i:309;s:32:"post-template/editor-rtl.min.css";i:310;s:24:"post-template/editor.css";i:311;s:28:"post-template/editor.min.css";i:312;s:27:"post-template/style-rtl.css";i:313;s:31:"post-template/style-rtl.min.css";i:314;s:23:"post-template/style.css";i:315;s:27:"post-template/style.min.css";i:316;s:24:"post-terms/style-rtl.css";i:317;s:28:"post-terms/style-rtl.min.css";i:318;s:20:"post-terms/style.css";i:319;s:24:"post-terms/style.min.css";i:320;s:24:"post-title/style-rtl.css";i:321;s:28:"post-title/style-rtl.min.css";i:322;s:20:"post-title/style.css";i:323;s:24:"post-title/style.min.css";i:324;s:26:"preformatted/style-rtl.css";i:325;s:30:"preformatted/style-rtl.min.css";i:326;s:22:"preformatted/style.css";i:327;s:26:"preformatted/style.min.css";i:328;s:24:"pullquote/editor-rtl.css";i:329;s:28:"pullquote/editor-rtl.min.css";i:330;s:20:"pullquote/editor.css";i:331;s:24:"pullquote/editor.min.css";i:332;s:23:"pullquote/style-rtl.css";i:333;s:27:"pullquote/style-rtl.min.css";i:334;s:19:"pullquote/style.css";i:335;s:23:"pullquote/style.min.css";i:336;s:23:"pullquote/theme-rtl.css";i:337;s:27:"pullquote/theme-rtl.min.css";i:338;s:19:"pullquote/theme.css";i:339;s:23:"pullquote/theme.min.css";i:340;s:39:"query-pagination-numbers/editor-rtl.css";i:341;s:43:"query-pagination-numbers/editor-rtl.min.css";i:342;s:35:"query-pagination-numbers/editor.css";i:343;s:39:"query-pagination-numbers/editor.min.css";i:344;s:31:"query-pagination/editor-rtl.css";i:345;s:35:"query-pagination/editor-rtl.min.css";i:346;s:27:"query-pagination/editor.css";i:347;s:31:"query-pagination/editor.min.css";i:348;s:30:"query-pagination/style-rtl.css";i:349;s:34:"query-pagination/style-rtl.min.css";i:350;s:26:"query-pagination/style.css";i:351;s:30:"query-pagination/style.min.css";i:352;s:25:"query-title/style-rtl.css";i:353;s:29:"query-title/style-rtl.min.css";i:354;s:21:"query-title/style.css";i:355;s:25:"query-title/style.min.css";i:356;s:20:"query/editor-rtl.css";i:357;s:24:"query/editor-rtl.min.css";i:358;s:16:"query/editor.css";i:359;s:20:"query/editor.min.css";i:360;s:19:"quote/style-rtl.css";i:361;s:23:"quote/style-rtl.min.css";i:362;s:15:"quote/style.css";i:363;s:19:"quote/style.min.css";i:364;s:19:"quote/theme-rtl.css";i:365;s:23:"quote/theme-rtl.min.css";i:366;s:15:"quote/theme.css";i:367;s:19:"quote/theme.min.css";i:368;s:23:"read-more/style-rtl.css";i:369;s:27:"read-more/style-rtl.min.css";i:370;s:19:"read-more/style.css";i:371;s:23:"read-more/style.min.css";i:372;s:18:"rss/editor-rtl.css";i:373;s:22:"rss/editor-rtl.min.css";i:374;s:14:"rss/editor.css";i:375;s:18:"rss/editor.min.css";i:376;s:17:"rss/style-rtl.css";i:377;s:21:"rss/style-rtl.min.css";i:378;s:13:"rss/style.css";i:379;s:17:"rss/style.min.css";i:380;s:21:"search/editor-rtl.css";i:381;s:25:"search/editor-rtl.min.css";i:382;s:17:"search/editor.css";i:383;s:21:"search/editor.min.css";i:384;s:20:"search/style-rtl.css";i:385;s:24:"search/style-rtl.min.css";i:386;s:16:"search/style.css";i:387;s:20:"search/style.min.css";i:388;s:20:"search/theme-rtl.css";i:389;s:24:"search/theme-rtl.min.css";i:390;s:16:"search/theme.css";i:391;s:20:"search/theme.min.css";i:392;s:24:"separator/editor-rtl.css";i:393;s:28:"separator/editor-rtl.min.css";i:394;s:20:"separator/editor.css";i:395;s:24:"separator/editor.min.css";i:396;s:23:"separator/style-rtl.css";i:397;s:27:"separator/style-rtl.min.css";i:398;s:19:"separator/style.css";i:399;s:23:"separator/style.min.css";i:400;s:23:"separator/theme-rtl.css";i:401;s:27:"separator/theme-rtl.min.css";i:402;s:19:"separator/theme.css";i:403;s:23:"separator/theme.min.css";i:404;s:24:"shortcode/editor-rtl.css";i:405;s:28:"shortcode/editor-rtl.min.css";i:406;s:20:"shortcode/editor.css";i:407;s:24:"shortcode/editor.min.css";i:408;s:24:"site-logo/editor-rtl.css";i:409;s:28:"site-logo/editor-rtl.min.css";i:410;s:20:"site-logo/editor.css";i:411;s:24:"site-logo/editor.min.css";i:412;s:23:"site-logo/style-rtl.css";i:413;s:27:"site-logo/style-rtl.min.css";i:414;s:19:"site-logo/style.css";i:415;s:23:"site-logo/style.min.css";i:416;s:27:"site-tagline/editor-rtl.css";i:417;s:31:"site-tagline/editor-rtl.min.css";i:418;s:23:"site-tagline/editor.css";i:419;s:27:"site-tagline/editor.min.css";i:420;s:25:"site-title/editor-rtl.css";i:421;s:29:"site-title/editor-rtl.min.css";i:422;s:21:"site-title/editor.css";i:423;s:25:"site-title/editor.min.css";i:424;s:24:"site-title/style-rtl.css";i:425;s:28:"site-title/style-rtl.min.css";i:426;s:20:"site-title/style.css";i:427;s:24:"site-title/style.min.css";i:428;s:26:"social-link/editor-rtl.css";i:429;s:30:"social-link/editor-rtl.min.css";i:430;s:22:"social-link/editor.css";i:431;s:26:"social-link/editor.min.css";i:432;s:27:"social-links/editor-rtl.css";i:433;s:31:"social-links/editor-rtl.min.css";i:434;s:23:"social-links/editor.css";i:435;s:27:"social-links/editor.min.css";i:436;s:26:"social-links/style-rtl.css";i:437;s:30:"social-links/style-rtl.min.css";i:438;s:22:"social-links/style.css";i:439;s:26:"social-links/style.min.css";i:440;s:21:"spacer/editor-rtl.css";i:441;s:25:"spacer/editor-rtl.min.css";i:442;s:17:"spacer/editor.css";i:443;s:21:"spacer/editor.min.css";i:444;s:20:"spacer/style-rtl.css";i:445;s:24:"spacer/style-rtl.min.css";i:446;s:16:"spacer/style.css";i:447;s:20:"spacer/style.min.css";i:448;s:20:"table/editor-rtl.css";i:449;s:24:"table/editor-rtl.min.css";i:450;s:16:"table/editor.css";i:451;s:20:"table/editor.min.css";i:452;s:19:"table/style-rtl.css";i:453;s:23:"table/style-rtl.min.css";i:454;s:15:"table/style.css";i:455;s:19:"table/style.min.css";i:456;s:19:"table/theme-rtl.css";i:457;s:23:"table/theme-rtl.min.css";i:458;s:15:"table/theme.css";i:459;s:19:"table/theme.min.css";i:460;s:23:"tag-cloud/style-rtl.css";i:461;s:27:"tag-cloud/style-rtl.min.css";i:462;s:19:"tag-cloud/style.css";i:463;s:23:"tag-cloud/style.min.css";i:464;s:28:"template-part/editor-rtl.css";i:465;s:32:"template-part/editor-rtl.min.css";i:466;s:24:"template-part/editor.css";i:467;s:28:"template-part/editor.min.css";i:468;s:27:"template-part/theme-rtl.css";i:469;s:31:"template-part/theme-rtl.min.css";i:470;s:23:"template-part/theme.css";i:471;s:27:"template-part/theme.min.css";i:472;s:30:"term-description/style-rtl.css";i:473;s:34:"term-description/style-rtl.min.css";i:474;s:26:"term-description/style.css";i:475;s:30:"term-description/style.min.css";i:476;s:27:"text-columns/editor-rtl.css";i:477;s:31:"text-columns/editor-rtl.min.css";i:478;s:23:"text-columns/editor.css";i:479;s:27:"text-columns/editor.min.css";i:480;s:26:"text-columns/style-rtl.css";i:481;s:30:"text-columns/style-rtl.min.css";i:482;s:22:"text-columns/style.css";i:483;s:26:"text-columns/style.min.css";i:484;s:19:"verse/style-rtl.css";i:485;s:23:"verse/style-rtl.min.css";i:486;s:15:"verse/style.css";i:487;s:19:"verse/style.min.css";i:488;s:20:"video/editor-rtl.css";i:489;s:24:"video/editor-rtl.min.css";i:490;s:16:"video/editor.css";i:491;s:20:"video/editor.min.css";i:492;s:19:"video/style-rtl.css";i:493;s:23:"video/style-rtl.min.css";i:494;s:15:"video/style.css";i:495;s:19:"video/style.min.css";i:496;s:19:"video/theme-rtl.css";i:497;s:23:"video/theme-rtl.min.css";i:498;s:15:"video/theme.css";i:499;s:19:"video/theme.min.css";}}', 'yes'),
	(123, 'theme_mods_twentytwentyfour', 'a:2:{s:18:"custom_css_post_id";i:-1;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1714994046;s:4:"data";a:3:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:3:{i:0;s:7:"block-2";i:1;s:7:"block-3";i:2;s:7:"block-4";}s:9:"sidebar-2";a:2:{i:0;s:7:"block-5";i:1;s:7:"block-6";}}}}', 'no'),
	(124, 'recovery_keys', 'a:0:{}', 'yes'),
	(125, '_site_transient_update_core', 'O:8:"stdClass":3:{s:7:"updates";a:0:{}s:15:"version_checked";s:5:"6.5.2";s:12:"last_checked";i:1715234858;}', 'no'),
	(133, 'can_compress_scripts', '1', 'yes'),
	(136, 'finished_updating_comment_type', '1', 'yes'),
	(137, '_site_transient_wp_plugin_dependencies_plugin_data', 'a:0:{}', 'no'),
	(138, 'recently_activated', 'a:1:{s:31:"ameliabooking/ameliabooking.php";i:1714987550;}', 'yes'),
	(160, 'amelia_settings', '{"db":{"mysqliEnabled":false,"pdoEmulatePrepares":false,"pdoBigSelect":false,"ssl":{"enable":false,"key":null,"cert":null,"ca":null,"verify_cert":null},"wpTablesPrefix":"","port":3306},"general":{"timeSlotLength":1800,"serviceDurationAsSlot":false,"bufferTimeInSlot":true,"defaultAppointmentStatus":"approved","minimumTimeRequirementPriorToBooking":0,"minimumTimeRequirementPriorToCanceling":0,"minimumTimeRequirementPriorToRescheduling":0,"numberOfDaysAvailableForBooking":365,"backendSlotsDaysInFuture":365,"backendSlotsDaysInPast":365,"phoneDefaultCountryCode":"auto","requiredPhoneNumberField":false,"requiredEmailField":true,"itemsPerPage":12,"itemsPerPageBackEnd":30,"appointmentsPerPage":100,"eventsPerPage":100,"servicesPerPage":100,"customersFilterLimit":100,"calendarEmployeesPreselected":0,"gMapApiKey":"","addToCalendar":true,"defaultPageOnBackend":"Dashboard","showClientTimeZone":false,"redirectUrlAfterAppointment":"","customFieldsUploadsPath":"","runInstantPostBookingActions":false,"sortingPackages":"nameAsc","sortingServices":"nameAsc","calendarLocaleSubstitutes":[],"googleRecaptcha":{"enabled":false,"invisible":true,"siteKey":"","secret":""},"usedLanguages":[],"backLink":{"enabled":true,"label":"Powered by Amelia - Appointment and Events Booking Plugin","url":"https:\\/\\/wpamelia.com\\/demos\\/?utm_source=lite&utm_medium=website&utm_campaign=powerdby#Features-list"}},"company":{"pictureFullPath":"","pictureThumbPath":"","name":"","address":"","phone":"","countryPhoneIso":"","website":"","translations":""},"notifications":{"mailService":"php","smtpHost":"","smtpPort":"","smtpSecure":"ssl","smtpUsername":"","smtpPassword":"","mailgunApiKey":"","mailgunDomain":"","mailgunEndpoint":"","senderName":"","senderEmail":"","notifyCustomers":true,"sendAllCF":true,"smsAlphaSenderId":"Amelia","smsSignedIn":false,"smsApiToken":"","bccEmail":"","bccSms":"","emptyPackageEmployees":"","smsBalanceEmail":{"enabled":false,"minimum":0,"email":""},"cancelSuccessUrl":"","cancelErrorUrl":"","approveSuccessUrl":"","approveErrorUrl":"","rejectSuccessUrl":"","rejectErrorUrl":"","breakReplacement":"<br>","pendingReminder":false,"whatsAppEnabled":false,"whatsAppPhoneID":"","whatsAppAccessToken":"","whatsAppBusinessID":"","whatsAppLanguage":"","whatsAppReplyEnabled":false,"whatsAppReplyMsg":"Dear %customer_full_name%,\\nThis message does not have an option for responding. If you need additional information about your booking, please contact us at %company_phone%","whatsAppReplyToken":"1bfac26df3b8bc7d9ba3"},"daysOff":[],"weekSchedule":[{"day":"Monday","time":["09:00","17:00"],"breaks":[],"periods":[]},{"day":"Tuesday","time":["09:00","17:00"],"breaks":[],"periods":[]},{"day":"Wednesday","time":["09:00","17:00"],"breaks":[],"periods":[]},{"day":"Thursday","time":["09:00","17:00"],"breaks":[],"periods":[]},{"day":"Friday","time":["09:00","17:00"],"breaks":[],"periods":[]},{"day":"Saturday","time":[],"breaks":[],"periods":[]},{"day":"Sunday","time":[],"breaks":[],"periods":[]}],"googleCalendar":{"clientID":"","clientSecret":"","redirectURI":"http:\\/\\/10.35.50.118\\/wordpress\\/wp-admin\\/admin.php?page=wpamelia-employees","showAttendees":false,"insertPendingAppointments":false,"addAttendees":false,"sendEventInvitationEmail":false,"removeGoogleCalendarBusySlots":false,"maximumNumberOfEventsReturned":50,"eventTitle":"%service_name%","eventDescription":"","includeBufferTimeGoogleCalendar":false,"status":"tentative","enableGoogleMeet":false,"title":{"appointment":"%service_name%","event":"%event_name%"},"description":{"appointment":"","event":""}},"outlookCalendar":{"clientID":"","clientSecret":"","redirectURI":"http:\\/\\/10.35.50.118\\/wordpress\\/wp-admin\\/","insertPendingAppointments":false,"addAttendees":false,"sendEventInvitationEmail":false,"removeOutlookCalendarBusySlots":false,"maximumNumberOfEventsReturned":50,"eventTitle":"%service_name%","eventDescription":"","includeBufferTimeOutlookCalendar":false,"title":{"appointment":"%service_name%","event":"%event_name%"},"description":{"appointment":"","event":""}},"payments":{"currency":"USD","symbol":"$","priceSymbolPosition":"before","priceNumberOfDecimals":2,"priceSeparator":1,"hideCurrencySymbolFrontend":false,"defaultPaymentMethod":"onSite","onSite":true,"cart":false,"coupons":false,"couponsCaseInsensitive":false,"paymentLinks":{"enabled":false,"changeBookingStatus":false,"redirectUrl":"http:\\/\\/10.35.50.118\\/wordpress"},"payPal":{"enabled":false,"sandboxMode":false,"liveApiClientId":"","liveApiSecret":"","testApiClientId":"","testApiSecret":"","description":{"enabled":false,"appointment":"","package":"","event":"","cart":""}},"stripe":{"enabled":false,"testMode":false,"livePublishableKey":"","liveSecretKey":"","testPublishableKey":"","testSecretKey":"","description":{"enabled":false,"appointment":"","package":"","event":"","cart":""},"metaData":{"enabled":false,"appointment":null,"package":null,"event":null,"cart":""},"manualCapture":false,"returnUrl":""},"wc":{"enabled":false,"productId":"","onSiteIfFree":false,"page":"cart","dashboard":true,"checkoutData":{"appointment":"","package":"","event":"","cart":"","translations":{"appointment":null,"event":null,"package":null,"cart":""}},"skipCheckoutGetValueProcessing":true,"skipGetItemDataProcessing":true,"redirectPage":1,"bookMultiple":false,"bookUnpaid":false,"rules":{"appointment":[{"order":"on-hold","booking":"default","payment":"paid","update":false},{"order":"processing","booking":"default","payment":"paid","update":false},{"order":"completed","booking":"default","payment":"paid","update":false}],"package":[{"order":"on-hold","booking":"approved","payment":"paid","update":false},{"order":"processing","booking":"approved","payment":"paid","update":false},{"order":"completed","booking":"approved","payment":"paid","update":false}],"event":[{"order":"on-hold","booking":"approved","payment":"paid","update":false},{"order":"processing","booking":"approved","payment":"paid","update":false},{"order":"completed","booking":"approved","payment":"paid","update":false}]}},"mollie":{"enabled":false,"testMode":false,"liveApiKey":"","testApiKey":"","description":{"enabled":false,"appointment":"","package":"","event":"","cart":""},"metaData":{"enabled":false,"appointment":null,"package":null,"event":null,"cart":""},"method":[],"cancelBooking":false},"razorpay":{"enabled":false,"testMode":false,"liveKeyId":"","liveKeySecret":"","testKeyId":"","testKeySecret":"","description":{"enabled":false,"appointment":"","package":"","event":"","cart":""},"name":{"enabled":false,"appointment":"","package":"","event":"","cart":""},"metaData":{"enabled":false,"appointment":null,"package":null,"event":null,"cart":""}}},"activation":{"showActivationSettings":true,"active":false,"purchaseCodeStore":"","envatoTokenEmail":"","version":"1.1.4","deleteTables":false,"showAmeliaPromoCustomizePopup":true,"showAmeliaSurvey":true,"stash":false,"responseErrorAsConflict":true,"enablePolyfill":false,"hideUnavailableFeatures":false,"disableUrlParams":true,"enableThriveItems":false,"customUrl":{"enabled":false,"pluginPath":"\\/wp-content\\/plugins\\/ameliabooking\\/","ajaxPath":"\\/wp-admin\\/admin-ajax.php","uploadsPath":""},"v3RelativePath":false,"v3AsyncLoading":false,"premiumBannerVisibility":true,"isNewInstallation":false},"customization":{"primaryColor":"#1A84EE","primaryGradient1":"#1A84EE","primaryGradient2":"#0454A2","textColor":"#354052","textColorOnBackground":"#FFFFFF","font":"Amelia Roboto","fontUrl":"","customFontFamily":"","customFontSelected":"unselected","useGenerated":false,"useGlobalColors":{"stepByStepForm":false,"catalogForm":false,"eventListForm":false,"eventCalendarForm":false},"globalColors":{"primaryColor":"#1A84EE","formBackgroundColor":"#FFFFFF","formTextColor":"#354052","formInputColor":"#FFFFFF","formInputTextColor":"#354052","formDropdownColor":"#FFFFFF","formDropdownTextColor":"#354052","formGradientColor1":"#1A84EE","formGradientColor2":"#0454A2","formGradientAngle":135,"formImageColor":"#1A84EE","textColorOnBackground":"#FFFFFF"}},"labels":{"enabled":true,"employee":"employee","employees":"employees","service":"service","services":"services"},"roles":{"allowConfigureSchedule":false,"allowConfigureDaysOff":false,"allowConfigureSpecialDays":false,"allowConfigureServices":false,"allowWriteAppointments":false,"automaticallyCreateCustomer":true,"inspectCustomerInfo":false,"allowCustomerReschedule":false,"allowCustomerCancelPackages":false,"allowCustomerDeleteProfile":false,"allowWriteEvents":false,"allowAdminBookAtAnyTime":false,"adminServiceDurationAsSlot":false,"enabledHttpAuthorization":true,"enableNoShowTag":false,"customerCabinet":{"enabled":false,"headerJwtSecret":"5ade76c07a30fe8d3844","urlJwtSecret":"ade2d549c6eb9fc63da3","tokenValidTime":2592000,"pageUrl":"","loginEnabled":true,"filterDate":false,"translations":[]},"providerCabinet":{"enabled":false,"headerJwtSecret":"3988ad59a546a42202af","urlJwtSecret":"b9b8016a16abc0e9e1d4","tokenValidTime":2592000,"pageUrl":"","loginEnabled":true,"filterDate":false},"urlAttachment":{"enabled":true,"headerJwtSecret":"6adb543e1b66d04b5520","urlJwtSecret":"4cfc52c9dca0171d4d47","tokenValidTime":2592000,"pageUrl":"","loginEnabled":true,"filterDate":false},"limitPerCustomerService":{"enabled":false,"numberOfApp":1,"timeFrame":"day","period":1,"from":"bookingDate"},"limitPerCustomerPackage":{"enabled":false,"numberOfApp":1,"timeFrame":"day","period":1},"limitPerCustomerEvent":{"enabled":false,"numberOfApp":1,"timeFrame":"day","period":1,"from":"bookingDate"},"limitPerEmployee":{"enabled":false,"numberOfApp":1,"timeFrame":"day","period":1},"providerBadges":{"counter":3,"badges":[{"id":1,"content":"Most Popular","color":"#1246D6"},{"id":2,"content":"Top Performer","color":"#019719"},{"id":3,"content":"Exclusive","color":"#CCA20C"}]}},"appointments":{"isGloballyBusySlot":false,"bookMultipleTimes":false,"allowBookingIfPending":true,"allowBookingIfNotMin":true,"openedBookingAfterMin":false,"cartPlaceholders":"<!-- Content --><p>DateTime: %appointment_date_time%<\\/p>","cartPlaceholdersSms":"DateTime: %appointment_date_time%","cartPlaceholdersCustomer":"<!-- Content --><p>DateTime: %appointment_date_time%<\\/p>","cartPlaceholdersCustomerSms":"DateTime: %appointment_date_time%","recurringPlaceholders":"DateTime: %appointment_date_time%","recurringPlaceholdersSms":"DateTime: %appointment_date_time%","recurringPlaceholdersCustomer":"DateTime: %appointment_date_time%","recurringPlaceholdersCustomerSms":"DateTime: %appointment_date_time%","packagePlaceholders":"DateTime: %appointment_date_time%","packagePlaceholdersSms":"DateTime: %appointment_date_time%","packagePlaceholdersCustomer":"DateTime: %appointment_date_time%","packagePlaceholdersCustomerSms":"DateTime: %appointment_date_time%","groupAppointmentPlaceholder":"Name: %customer_full_name%","groupEventPlaceholder":"Name: %customer_full_name%","groupAppointmentPlaceholderSms":"Name: %customer_full_name%","groupEventPlaceholderSms":"Name: %customer_full_name%","translations":{"cartPlaceholdersCustomer":null,"cartPlaceholdersCustomerSms":null,"recurringPlaceholdersCustomer":null,"recurringPlaceholdersCustomerSms":null,"packagePlaceholdersCustomer":null,"packagePlaceholdersCustomerSms":null,"groupAppointmentPlaceholder":"Name: %customer_full_name%","groupEventPlaceholder":"Name: %customer_full_name%","groupAppointmentPlaceholderSms":"Name: %customer_full_name%","groupEventPlaceholderSms":"Name: %customer_full_name%"},"employeeSelection":"random"},"webHooks":[],"zoom":{"enabled":true,"apiKey":"","apiSecret":"","meetingTitle":"%reservation_name%","meetingAgenda":"%reservation_description%","pendingAppointmentsMeetings":false,"maxUsersCount":300,"s2sEnabled":true,"accountId":"","clientId":"","clientSecret":"","accessToken":""},"apiKeys":{"apiKeys":[]},"lessonSpace":{"enabled":true,"apiKey":"","spaceNameAppointments":"%reservation_name%","spaceNameEvents":"%reservation_name%","pendingAppointments":false,"companyId":""},"ics":{"sendIcsAttachment":false,"sendIcsAttachmentPending":false,"description":{"appointment":"","event":"","translations":{"appointment":null,"event":null}}},"facebookPixel":{"id":"","tracking":{"appointment":[],"event":[],"package":[]}},"googleAnalytics":{"id":"","tracking":{"appointment":[],"event":[],"package":[]}},"googleTag":{"id":"","tracking":{"appointment":[],"event":[],"package":[]}}}', 'yes'),
	(183, '_site_transient_update_themes', 'O:8:"stdClass":1:{s:12:"last_checked";i:1715234858;}', 'no'),
	(184, 'current_theme', 'Understrap', 'yes'),
	(185, 'theme_mods_understrap', 'a:6:{i:0;b:0;s:28:"understrap_posts_index_style";s:7:"default";s:27:"understrap_sidebar_position";s:5:"right";s:25:"understrap_container_type";s:9:"container";s:18:"nav_menu_locations";a:0:{}s:18:"custom_css_post_id";i:-1;}', 'yes'),
	(186, 'theme_switched', '', 'yes'),
	(190, '_site_transient_update_plugins', 'O:8:"stdClass":1:{s:12:"last_checked";i:1715234858;}', 'no'),
	(191, 'installed_appointment-booking-calendar', '1714994173', 'yes'),
	(192, 'CP_ABC_JS', '', 'yes'),
	(193, 'ABC_RCODE', 'b94bff2a-8eab-4747-b46e-c2bcd6d55392', 'yes'),
	(194, '_transient_codepeople_promote_banner_appointment-booking-calendar', '1714994176', 'yes'),
	(207, 'wp_calendar_block_has_published_posts', '1', 'yes'),
	(221, '_site_transient_timeout_theme_roots', '1715236658', 'no'),
	(222, '_site_transient_theme_roots', 'a:1:{s:10:"understrap";s:7:"/themes";}', 'no'),
	(223, '_transient_is_multi_author', '0', 'yes'),
	(224, '_transient_understrap_categories', '1', 'yes'),
	(225, 'https_detection_errors', 'a:1:{s:23:"ssl_verification_failed";a:1:{i:0;s:24:"SSL verification failed.";}}', 'yes'),
	(226, '_transient_health-check-site-status-result', '{"good":14,"recommended":6,"critical":3}', 'yes');
/*!40000 ALTER TABLE `wp_aferesisoptions` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesispostmeta
CREATE TABLE IF NOT EXISTS `wp_aferesispostmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesispostmeta: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesispostmeta` DISABLE KEYS */;
INSERT INTO `wp_aferesispostmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
	(1, 2, '_wp_page_template', 'default'),
	(2, 3, '_wp_page_template', 'default'),
	(3, 6, '_edit_lock', '1714986372:1'),
	(8, 10, '_edit_lock', '1714987820:1'),
	(13, 13, '_edit_lock', '1714994109:1'),
	(14, 14, '_edit_lock', '1714996943:1'),
	(15, 16, '_edit_lock', '1715000658:1');
/*!40000 ALTER TABLE `wp_aferesispostmeta` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisposts
CREATE TABLE IF NOT EXISTS `wp_aferesisposts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesisposts: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisposts` DISABLE KEYS */;
INSERT INTO `wp_aferesisposts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
	(1, 1, '2024-05-06 08:53:51', '2024-05-06 08:53:51', '<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2024-05-06 08:53:51', '2024-05-06 08:53:51', '', 0, 'http://10.35.50.118/wordpress/?p=1', 0, 'post', '', 1),
	(2, 1, '2024-05-06 08:53:51', '2024-05-06 08:53:51', '<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class="wp-block-quote"><p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class="wp-block-quote"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href="http://10.35.50.118/wordpress/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2024-05-06 08:53:51', '2024-05-06 08:53:51', '', 0, 'http://10.35.50.118/wordpress/?page_id=2', 0, 'page', '', 0),
	(3, 1, '2024-05-06 08:53:51', '2024-05-06 08:53:51', '<!-- wp:heading -->\n<h2 class="wp-block-heading">Who we are</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>Our website address is: http://10.35.50.118/wordpress.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">Comments</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">Media</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">Cookies</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">Embedded content from other websites</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">Who we share your data with</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you request a password reset, your IP address will be included in the reset email.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">How long we retain your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\n<!-- /wp:paragraph -->\n<!-- wp:paragraph -->\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">What rights you have over your data</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\n<!-- /wp:paragraph -->\n<!-- wp:heading -->\n<h2 class="wp-block-heading">Where your data is sent</h2>\n<!-- /wp:heading -->\n<!-- wp:paragraph -->\n<p><strong class="privacy-policy-tutorial">Suggested text: </strong>Visitor comments may be checked through an automated spam detection service.</p>\n<!-- /wp:paragraph -->\n', 'Privacy Policy', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2024-05-06 08:53:51', '2024-05-06 08:53:51', '', 0, 'http://10.35.50.118/wordpress/?page_id=3', 0, 'page', '', 0),
	(4, 0, '2024-05-06 08:53:55', '2024-05-06 08:53:55', '<!-- wp:page-list /-->', 'Navigation', '', 'publish', 'closed', 'closed', '', 'navigation', '', '', '2024-05-06 08:53:55', '2024-05-06 08:53:55', '', 0, 'http://10.35.50.118/wordpress/2024/05/06/navigation/', 0, 'wp_navigation', '', 0),
	(5, 1, '2024-05-06 08:54:29', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2024-05-06 08:54:29', '0000-00-00 00:00:00', '', 0, 'http://10.35.50.118/wordpress/?p=5', 0, 'post', '', 0),
	(6, 1, '2024-05-06 09:08:26', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2024-05-06 09:08:26', '0000-00-00 00:00:00', '', 0, 'http://10.35.50.118/wordpress/?p=6', 0, 'post', '', 0),
	(7, 1, '2024-05-06 09:08:35', '2024-05-06 09:08:35', '{"version": 2, "isGlobalStylesUserThemeJSON": true }', 'Custom Styles', '', 'publish', 'closed', 'closed', '', 'wp-global-styles-twentytwentyfour', '', '', '2024-05-06 09:08:35', '2024-05-06 09:08:35', '', 0, 'http://10.35.50.118/wordpress/2024/05/06/wp-global-styles-twentytwentyfour/', 0, 'wp_global_styles', '', 0),
	(10, 1, '2024-05-06 09:26:13', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2024-05-06 09:26:13', '0000-00-00 00:00:00', '', 0, 'http://10.35.50.118/wordpress/?p=10', 0, 'post', '', 0),
	(13, 1, '2024-05-06 11:17:25', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2024-05-06 11:17:25', '0000-00-00 00:00:00', '', 0, 'http://10.35.50.118/wordpress/?p=13', 0, 'post', '', 0),
	(14, 1, '2024-05-06 12:02:53', '2024-05-06 12:02:53', '<!-- wp:calendar /-->\n\n<!-- wp:group {"layout":{"type":"constrained"}} -->\n<div class="wp-block-group"><!-- wp:cpabc/form-shortcode -->\n[CPABC_APPOINTMENT_CALENDAR]\n<!-- /wp:cpabc/form-shortcode --></div>\n<!-- /wp:group -->', 'Calendario', '', 'publish', 'closed', 'closed', '', 'calendario', '', '', '2024-05-06 12:02:53', '2024-05-06 12:02:53', '', 0, 'http://10.35.50.118/wordpress/?page_id=14', 0, 'page', '', 0),
	(15, 1, '2024-05-06 12:02:53', '2024-05-06 12:02:53', '<!-- wp:calendar /-->\n\n<!-- wp:group {"layout":{"type":"constrained"}} -->\n<div class="wp-block-group"><!-- wp:cpabc/form-shortcode -->\n[CPABC_APPOINTMENT_CALENDAR]\n<!-- /wp:cpabc/form-shortcode --></div>\n<!-- /wp:group -->', 'Calendario', '', 'inherit', 'closed', 'closed', '', '14-revision-v1', '', '', '2024-05-06 12:02:53', '2024-05-06 12:02:53', '', 14, 'http://10.35.50.118/wordpress/?p=15', 0, 'revision', '', 0),
	(16, 1, '2024-05-06 12:41:11', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'closed', 'closed', '', '', '', '', '2024-05-06 12:41:11', '0000-00-00 00:00:00', '', 0, 'http://10.35.50.118/wordpress/?page_id=16', 0, 'page', '', 0);
/*!40000 ALTER TABLE `wp_aferesisposts` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesistermmeta
CREATE TABLE IF NOT EXISTS `wp_aferesistermmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesistermmeta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesistermmeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `wp_aferesistermmeta` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisterms
CREATE TABLE IF NOT EXISTS `wp_aferesisterms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesisterms: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisterms` DISABLE KEYS */;
INSERT INTO `wp_aferesisterms` (`term_id`, `name`, `slug`, `term_group`) VALUES
	(1, 'Uncategorized', 'uncategorized', 0),
	(2, 'twentytwentyfour', 'twentytwentyfour', 0);
/*!40000 ALTER TABLE `wp_aferesisterms` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisterm_relationships
CREATE TABLE IF NOT EXISTS `wp_aferesisterm_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesisterm_relationships: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisterm_relationships` DISABLE KEYS */;
INSERT INTO `wp_aferesisterm_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
	(1, 1, 0),
	(7, 2, 0);
/*!40000 ALTER TABLE `wp_aferesisterm_relationships` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisterm_taxonomy
CREATE TABLE IF NOT EXISTS `wp_aferesisterm_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesisterm_taxonomy: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisterm_taxonomy` DISABLE KEYS */;
INSERT INTO `wp_aferesisterm_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
	(1, 1, 'category', '', 0, 1),
	(2, 2, 'wp_theme', '', 0, 1);
/*!40000 ALTER TABLE `wp_aferesisterm_taxonomy` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisusermeta
CREATE TABLE IF NOT EXISTS `wp_aferesisusermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesisusermeta: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisusermeta` DISABLE KEYS */;
INSERT INTO `wp_aferesisusermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
	(1, 1, 'nickname', 'aferesis'),
	(2, 1, 'first_name', ''),
	(3, 1, 'last_name', ''),
	(4, 1, 'description', ''),
	(5, 1, 'rich_editing', 'true'),
	(6, 1, 'syntax_highlighting', 'true'),
	(7, 1, 'comment_shortcuts', 'false'),
	(8, 1, 'admin_color', 'midnight'),
	(9, 1, 'use_ssl', '0'),
	(10, 1, 'show_admin_bar_front', 'true'),
	(11, 1, 'locale', ''),
	(12, 1, 'wp_Aferesiscapabilities', 'a:1:{s:13:"administrator";b:1;}'),
	(13, 1, 'wp_Aferesisuser_level', '10'),
	(14, 1, 'dismissed_wp_pointers', ''),
	(15, 1, 'show_welcome_panel', '1'),
	(17, 1, 'wp_Aferesisdashboard_quick_press_last_post_id', '5'),
	(18, 1, 'wp_Aferesispersisted_preferences', 'a:2:{s:14:"core/edit-post";a:2:{s:26:"isComplementaryAreaVisible";b:0;s:12:"welcomeGuide";b:0;}s:9:"_modified";s:24:"2024-05-06T11:49:23.203Z";}'),
	(19, 1, 'wp_Aferesisuser-settings', 'mfold=o'),
	(20, 1, 'wp_Aferesisuser-settings-time', '1714992762'),
	(21, 1, 'session_tokens', 'a:1:{s:64:"c66051b7e6db6c35a9a7c723ed73da4bc22983a76a532932d36b555195434cfe";a:4:{s:10:"expiration";i:1715172037;s:2:"ip";s:12:"10.245.91.73";s:2:"ua";s:106:"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36";s:5:"login";i:1714999237;}}');
/*!40000 ALTER TABLE `wp_aferesisusermeta` ENABLE KEYS */;

-- Volcando estructura para tabla aferesis.wp_aferesisusers
CREATE TABLE IF NOT EXISTS `wp_aferesisusers` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT 0,
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Volcando datos para la tabla aferesis.wp_aferesisusers: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `wp_aferesisusers` DISABLE KEYS */;
INSERT INTO `wp_aferesisusers` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
	(1, 'aferesis', '$P$BLvXTYeKcQ.Vrxr78.Z0DqY6SDfEO//', 'aferesis', 'dbarrosoc2@gmail.com', 'http://10.35.50.118/wordpress', '2024-05-06 08:53:51', '', 0, 'aferesis');
/*!40000 ALTER TABLE `wp_aferesisusers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
