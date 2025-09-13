-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para encuestas_anonimas
CREATE DATABASE IF NOT EXISTS `encuestas_anonimas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `encuestas_anonimas`;

-- Volcando estructura para tabla encuestas_anonimas.encuesta
CREATE TABLE IF NOT EXISTS `encuesta` (
  `id_encuesta` int(10) NOT NULL AUTO_INCREMENT,
  `titulo_encuesta` varchar(250) DEFAULT NULL,
  `descripcion_encuesta` varchar(500) DEFAULT NULL,
  `link` char(50) NOT NULL DEFAULT '0',
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_encuesta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla encuestas_anonimas.encuesta: ~0 rows (aproximadamente)
DELETE FROM `encuesta`;
INSERT INTO `encuesta` (`id_encuesta`, `titulo_encuesta`, `descripcion_encuesta`, `link`, `fecha_registro`, `eliminacion_logica`) VALUES
	(1, 'Demo Encuesta Anónima', 'Esta es una encuesta de demo para una prueba en VIP2CARS', '0', '2025-09-12 21:19:58', 1);

-- Volcando estructura para tabla encuestas_anonimas.encuesta_pregunta
CREATE TABLE IF NOT EXISTS `encuesta_pregunta` (
  `id_encuesta_pregunta` int(10) NOT NULL AUTO_INCREMENT,
  `encuesta_id` int(10) NOT NULL,
  `tipo_pregunta_id` int(10) NOT NULL,
  `pregunta` varchar(500) DEFAULT NULL,
  `alternativas` tinytext DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_encuesta_pregunta`),
  KEY `FK_encuesta_pregunta_encuesta` (`encuesta_id`),
  KEY `FK_encuesta_pregunta_pregunta_tipo` (`tipo_pregunta_id`),
  CONSTRAINT `FK_encuesta_pregunta_encuesta` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id_encuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_encuesta_pregunta_pregunta_tipo` FOREIGN KEY (`tipo_pregunta_id`) REFERENCES `pregunta_tipo` (`id_tipo_pregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla encuestas_anonimas.encuesta_pregunta: ~3 rows (aproximadamente)
DELETE FROM `encuesta_pregunta`;
INSERT INTO `encuesta_pregunta` (`id_encuesta_pregunta`, `encuesta_id`, `tipo_pregunta_id`, `pregunta`, `alternativas`, `fecha_registro`, `fecha_actualizacion`, `eliminacion_logica`) VALUES
	(1, 1, 4, '¿Es una demo?', 'Sí|No', '2025-09-12 21:20:13', NULL, 1),
	(2, 1, 1, 'Cuéntanos acerca de ti', NULL, '2025-09-12 21:27:33', NULL, 1),
	(3, 1, 4, '¿Cuánto es 1x8?', '56|25|69|25|N.A.', '2025-09-12 21:36:17', NULL, 1);

-- Volcando estructura para tabla encuestas_anonimas.encuesta_pregunta_respuesta
CREATE TABLE IF NOT EXISTS `encuesta_pregunta_respuesta` (
  `id_encuesta_pregunta_respuesta` int(10) NOT NULL AUTO_INCREMENT,
  `encuesta_respuesta_id` int(10) DEFAULT NULL,
  `encuesta_pregunta_id` int(10) DEFAULT NULL,
  `respuesta` tinytext DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_encuesta_pregunta_respuesta`),
  KEY `FK_encuesta_pregunta_respuesta_encuesta_respuesta` (`encuesta_respuesta_id`),
  KEY `FK_encuesta_pregunta_respuesta_encuesta_pregunta` (`encuesta_pregunta_id`),
  CONSTRAINT `FK_encuesta_pregunta_respuesta_encuesta_pregunta` FOREIGN KEY (`encuesta_pregunta_id`) REFERENCES `encuesta_pregunta` (`id_encuesta_pregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_encuesta_pregunta_respuesta_encuesta_respuesta` FOREIGN KEY (`encuesta_respuesta_id`) REFERENCES `encuesta_respuesta` (`id_encuesta_respuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla encuestas_anonimas.encuesta_pregunta_respuesta: ~0 rows (aproximadamente)
DELETE FROM `encuesta_pregunta_respuesta`;

-- Volcando estructura para tabla encuestas_anonimas.encuesta_respuesta
CREATE TABLE IF NOT EXISTS `encuesta_respuesta` (
  `id_encuesta_respuesta` int(10) NOT NULL AUTO_INCREMENT,
  `encuesta_id` int(10) NOT NULL,
  `ip` char(100) NOT NULL,
  `agente` varchar(250) NOT NULL,
  `trama_geolocalizacion` tinytext NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_encuesta_respuesta`),
  KEY `FK_encuesta_respuesta_encuesta` (`encuesta_id`),
  CONSTRAINT `FK_encuesta_respuesta_encuesta` FOREIGN KEY (`encuesta_id`) REFERENCES `encuesta` (`id_encuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla encuestas_anonimas.encuesta_respuesta: ~0 rows (aproximadamente)
DELETE FROM `encuesta_respuesta`;

-- Volcando estructura para tabla encuestas_anonimas.pregunta_tipo
CREATE TABLE IF NOT EXISTS `pregunta_tipo` (
  `id_tipo_pregunta` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_pregunta` char(50) NOT NULL DEFAULT '',
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_pregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla encuestas_anonimas.pregunta_tipo: ~3 rows (aproximadamente)
DELETE FROM `pregunta_tipo`;
INSERT INTO `pregunta_tipo` (`id_tipo_pregunta`, `tipo_pregunta`, `fecha_registro`, `fecha_actualizacion`, `eliminacion_logica`) VALUES
	(1, 'Respuesta corta', '2025-09-12 21:16:20', NULL, 1),
	(2, 'Respuesta larga', '2025-09-12 21:16:27', NULL, 1),
	(3, 'Opción múltiple', '2025-09-12 21:16:50', NULL, 1),
	(4, 'Opción única', '2025-09-12 21:17:05', NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
