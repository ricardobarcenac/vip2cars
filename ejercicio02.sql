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


-- Volcando estructura de base de datos para vip2cars
CREATE DATABASE IF NOT EXISTS `vip2cars` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `vip2cars`;

-- Volcando estructura para tabla vip2cars.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_documento_id` int(10) NOT NULL,
  `numero_documento` char(15) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `telefono` char(20) NOT NULL,
  `correo_electronico` char(150) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `FK_cliente_tipo_documento` (`tipo_documento_id`),
  CONSTRAINT `FK_cliente_tipo_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla vip2cars.cliente: ~0 rows (aproximadamente)
DELETE FROM `cliente`;
INSERT INTO `cliente` (`id_cliente`, `tipo_documento_id`, `numero_documento`, `nombres`, `apellidos`, `telefono`, `correo_electronico`, `fecha_registro`, `eliminacion_logica`) VALUES
	(1, 1, '70677839', 'Ricardo', 'Barcena', '940434470', 'ricardobarcena.c@gmail.com', '2025-09-12 23:57:19', 1);

-- Volcando estructura para tabla vip2cars.marca
CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int(10) NOT NULL AUTO_INCREMENT,
  `marca` varchar(250) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla vip2cars.marca: ~5 rows (aproximadamente)
DELETE FROM `marca`;
INSERT INTO `marca` (`id_marca`, `marca`, `fecha_registro`, `eliminacion_logica`) VALUES
	(1, 'Toyota', '2025-09-12 23:05:52', 1),
	(2, 'Ford', '2025-09-12 23:05:52', 1),
	(3, 'Honda', '2025-09-12 23:05:53', 1),
	(4, 'Chevrolet', '2025-09-12 23:05:53', 1),
	(5, 'Nissan', '2025-09-12 23:05:54', 1);

-- Volcando estructura para tabla vip2cars.modelo
CREATE TABLE IF NOT EXISTS `modelo` (
  `id_modelo` int(10) NOT NULL AUTO_INCREMENT,
  `marca_id` int(10) NOT NULL,
  `modelo` char(100) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_modelo`),
  KEY `FK_modelo_marca` (`marca_id`),
  CONSTRAINT `FK_modelo_marca` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla vip2cars.modelo: ~9 rows (aproximadamente)
DELETE FROM `modelo`;
INSERT INTO `modelo` (`id_modelo`, `marca_id`, `modelo`, `fecha_registro`, `eliminacion_logica`) VALUES
	(1, 1, 'Corolla', '2025-09-12 23:26:19', 1),
	(2, 1, 'Camry', '2025-09-12 23:26:20', 1),
	(3, 1, 'RAV4', '2025-09-12 23:26:20', 1),
	(4, 2, 'F-150', '2025-09-12 23:26:21', 1),
	(5, 2, 'Mustang', '2025-09-12 23:26:21', 1),
	(6, 3, 'Civic', '2025-09-12 23:26:22', 1),
	(7, 3, 'Accord', '2025-09-12 23:26:22', 1),
	(8, 4, 'Silverado', '2025-09-12 23:26:23', 1),
	(9, 5, 'Sentra', '2025-09-12 23:26:23', 1);

-- Volcando estructura para tabla vip2cars.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `eliminacion_logica` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla vip2cars.perfil: ~3 rows (aproximadamente)
DELETE FROM `perfil`;
INSERT INTO `perfil` (`id_perfil`, `descripcion`, `eliminacion_logica`) VALUES
	(401, 'Cliente', 1),
	(402, 'Usuario', 1),
	(500, 'Administrador', 1);

-- Volcando estructura para tabla vip2cars.tipo_documento
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_documento` char(80) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla vip2cars.tipo_documento: ~3 rows (aproximadamente)
DELETE FROM `tipo_documento`;
INSERT INTO `tipo_documento` (`id_tipo_documento`, `tipo_documento`, `fecha_registro`, `eliminacion_logica`) VALUES
	(1, 'DNI', '2025-09-12 23:54:04', 1),
	(2, 'Carné de Extranjería', '2025-09-12 23:54:12', 1),
	(3, 'Pasaporte', '2025-09-12 23:54:17', 1);

-- Volcando estructura para tabla vip2cars.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombres` char(100) DEFAULT NULL,
  `apellidos` char(100) DEFAULT NULL,
  `telefono` char(20) DEFAULT NULL,
  `correo_electronico` char(150) DEFAULT NULL,
  `usuario` char(150) DEFAULT NULL,
  `contrasena` char(100) DEFAULT NULL,
  `perfil_id` int(10) DEFAULT NULL,
  `token` char(10) DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_solicitud_recuperacion` datetime DEFAULT NULL,
  `fecha_caducidad_token` datetime DEFAULT NULL,
  `fecha_cambio_contrasena` datetime DEFAULT NULL,
  `fecha_ultimo_inicio_sesion` datetime DEFAULT NULL,
  `fecha_eliminacion` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `FK_usuario_perfil` (`perfil_id`),
  CONSTRAINT `FK_usuario_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla vip2cars.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
INSERT INTO `usuario` (`id_usuario`, `nombres`, `apellidos`, `telefono`, `correo_electronico`, `usuario`, `contrasena`, `perfil_id`, `token`, `eliminacion_logica`, `fecha_registro`, `fecha_solicitud_recuperacion`, `fecha_caducidad_token`, `fecha_cambio_contrasena`, `fecha_ultimo_inicio_sesion`, `fecha_eliminacion`, `fecha_actualizacion`) VALUES
	(1, 'Administrador', 'Vip2Cars', '940434470', 'administrador@vip2cars.com', 'administrador', '$2y$10$jiSMUqDQkLp4oNtKSUlQBulICCpAAxqRaBkOx/f9nsj/Cald5dQyq', 500, NULL, 1, '2024-06-17 22:47:19', NULL, NULL, NULL, NULL, NULL, NULL);

-- Volcando estructura para tabla vip2cars.vehiculo
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id_vehiculo` int(10) NOT NULL AUTO_INCREMENT,
  `modelo_id` int(10) NOT NULL,
  `placa` char(10) NOT NULL,
  `ano_fabricacion` year(4) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_vehiculo`),
  KEY `FK_vehiculo_modelo` (`modelo_id`),
  CONSTRAINT `FK_vehiculo_modelo` FOREIGN KEY (`modelo_id`) REFERENCES `modelo` (`id_modelo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla vip2cars.vehiculo: ~0 rows (aproximadamente)
DELETE FROM `vehiculo`;
INSERT INTO `vehiculo` (`id_vehiculo`, `modelo_id`, `placa`, `ano_fabricacion`, `fecha_registro`, `eliminacion_logica`) VALUES
	(1, 1, 'ABC123', '1995', '2025-09-13 00:17:24', 1);

-- Volcando estructura para tabla vip2cars.vehiculo_cliente
CREATE TABLE IF NOT EXISTS `vehiculo_cliente` (
  `id_vehiculo_cliente` int(10) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(10) NOT NULL,
  `cliente_id` int(10) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `eliminacion_logica` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_vehiculo_cliente`),
  KEY `FK_vehiculo_cliente_vehiculo` (`vehiculo_id`),
  KEY `FK_vehiculo_cliente_cliente` (`cliente_id`),
  CONSTRAINT `FK_vehiculo_cliente_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_vehiculo_cliente_vehiculo` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla vip2cars.vehiculo_cliente: ~0 rows (aproximadamente)
DELETE FROM `vehiculo_cliente`;
INSERT INTO `vehiculo_cliente` (`id_vehiculo_cliente`, `vehiculo_id`, `cliente_id`, `fecha_registro`, `eliminacion_logica`) VALUES
	(1, 1, 1, '2025-09-13 00:42:52', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
