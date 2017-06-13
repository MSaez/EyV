-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-06-2017 a las 06:41:22
-- Versión del servidor: 5.5.55-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `eyv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_desabolladura`
--

CREATE TABLE IF NOT EXISTS `actividad_desabolladura` (
  `DES_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OT_ID` int(11) DEFAULT NULL,
  `DES_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `DES_HORAS` int(11) NOT NULL,
  `DES_PRECIO` int(11) NOT NULL,
  `DES_ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Sin Asignar',
  PRIMARY KEY (`DES_ID`),
  KEY `FK_REALIZA_DESABOLLADURA` (`OT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_pintura`
--

CREATE TABLE IF NOT EXISTS `actividad_pintura` (
  `PIN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OT_ID` int(11) DEFAULT NULL,
  `PIN_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `PIN_HORAS` int(11) NOT NULL,
  `PIN_PRECIO` int(11) NOT NULL,
  `PIN_ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Sin Asignar',
  PRIMARY KEY (`PIN_ID`),
  KEY `FK_REALIZA_PINTURA` (`OT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `CLI_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLI_NOMBRES` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_PATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_MATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_RUT` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_TELEFONO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_DIRECCION` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`CLI_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE IF NOT EXISTS `cobros` (
  `CBR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OT_ID` int(11) DEFAULT NULL,
  `CBR_VALOR` int(11) NOT NULL,
  `CBR_FECHA` date NOT NULL,
  PRIMARY KEY (`CBR_ID`),
  KEY `FK_PAGO_REPARACION2` (`OT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho`
--

CREATE TABLE IF NOT EXISTS `despacho` (
  `OD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OT_ID` int(11) DEFAULT NULL,
  `OD_FECHA` date NOT NULL,
  `OD_OBSERVACINES` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`OD_ID`),
  KEY `FK_GENERA2` (`OT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_NOMBRES` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_PATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_MATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`EMP_RUT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE IF NOT EXISTS `insumo` (
  `INS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OT_ID` int(11) DEFAULT NULL,
  `PINS_ID` int(11) DEFAULT NULL,
  `INV_ID` int(11) DEFAULT NULL,
  `INS_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `INS_CANTIDAD` int(11) NOT NULL,
  `INS_PRECIO_UNITARIO` int(11) NOT NULL,
  `INS_TOTAL` int(11) NOT NULL,
  `INS_RECIBIDO` tinyint(1) NOT NULL DEFAULT '0',
  `INS_REUTILIZADO` int(11) DEFAULT NULL,
  PRIMARY KEY (`INS_ID`),
  KEY `FK_PAGO_INSUMO` (`PINS_ID`),
  KEY `FK_UTILIZA` (`OT_ID`),
  KEY `FK_ALMACENADO1` (`INV_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `INV_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OT_ID` int(11) DEFAULT NULL,
  `INS_ID` int(11) DEFAULT NULL,
  `INV_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `INV_CANTIDAD` int(11) NOT NULL,
  `INV_PRECIO_UNITARIO` int(11) NOT NULL,
  `INV_TOTAL` int(11) NOT NULL,
  PRIMARY KEY (`INV_ID`),
  KEY `FK_DEJA_EXCEDENTE` (`OT_ID`),
  KEY `FK_ALMACENADO2` (`INS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `MAR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MAR_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`MAR_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE IF NOT EXISTS `modelo` (
  `MOD_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MAR_ID` int(11) NOT NULL,
  `MOD_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `MOD_VARIANTE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`MOD_ID`),
  KEY `FK_PERTENECE` (`MAR_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ot`
--

CREATE TABLE IF NOT EXISTS `ot` (
  `OT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OD_ID` int(11) DEFAULT NULL,
  `CBR_ID` int(11) DEFAULT NULL,
  `VEH_ID` int(11) NOT NULL,
  `CLI_ID` int(11) NOT NULL,
  `OT_INICIO` date NOT NULL,
  `OT_ENTREGA` date NOT NULL,
  `OT_OBSERVACIONES` text COLLATE utf8_spanish2_ci NOT NULL,
  `OT_ESTADO` varchar(12) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Presupuesto',
  `OT_TDESABOLLADURA` int(11) NOT NULL,
  `OT_TPINTURA` int(11) NOT NULL,
  `OT_TINSUMO` int(11) NOT NULL,
  `OT_TEXTERNO` int(11) NOT NULL,
  `OT_TREUTILIZADO` int(11) NOT NULL,
  `OT_SUBTOTAL` int(11) NOT NULL,
  `OT_IVA` int(11) NOT NULL,
  `OT_TOTAL` int(11) NOT NULL,
  `OT_TOTAL_HORAS` int(11) NOT NULL,
  `OT_EDES` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `OT_EPIN` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`OT_ID`),
  KEY `FK_GENERA` (`OD_ID`),
  KEY `FK_PAGO_REPARACION` (`CBR_ID`),
  KEY `FK_SOLICITA` (`CLI_ID`),
  KEY `FK_TIENE_ASIGNADA` (`VEH_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otros_servicios`
--

CREATE TABLE IF NOT EXISTS `otros_servicios` (
  `OS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OT_ID` int(11) DEFAULT NULL,
  `PEXT_ID` int(11) DEFAULT NULL,
  `OS_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `OS_PRECIO` int(11) NOT NULL,
  PRIMARY KEY (`OS_ID`),
  KEY `FK_NECESITA` (`OT_ID`),
  KEY `FK_PAGO_SERVICIO` (`PEXT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_externos`
--

CREATE TABLE IF NOT EXISTS `pago_externos` (
  `PEXT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `OS_ID` int(11) DEFAULT NULL,
  `PEXT_FACTURA` int(11) NOT NULL,
  `PEXT_VALOR` int(11) NOT NULL,
  `PEXT_FECHA` date NOT NULL,
  PRIMARY KEY (`PEXT_ID`),
  KEY `FK_PAGO_SERVICIO` (`OS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_insumos`
--

CREATE TABLE IF NOT EXISTS `pago_insumos` (
  `PINS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `INS_ID` int(11) DEFAULT NULL,
  `PINS_FACTURA` int(11) NOT NULL,
  `PINS_VALOR` int(11) NOT NULL,
  `PINS_FECHA` date NOT NULL,
  PRIMARY KEY (`PINS_ID`),
  KEY `FK_PAGO_INSUMO` (`INS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_desabolladura`
--

CREATE TABLE IF NOT EXISTS `responsable_desabolladura` (
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `DES_ID` int(11) NOT NULL,
  PRIMARY KEY (`EMP_RUT`,`DES_ID`),
  KEY `FK_RESPONSABLE_DESABOLLADURA2` (`DES_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable_pintura`
--

CREATE TABLE IF NOT EXISTS `responsable_pintura` (
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `PIN_ID` int(11) NOT NULL,
  PRIMARY KEY (`EMP_RUT`,`PIN_ID`),
  KEY `FK_RESPONSABLE_PINTURA2` (`PIN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `US_ID` int(11) NOT NULL AUTO_INCREMENT,
  `US_USERNAME` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `US_RUT` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `US_NOMBRES` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_PATERNO` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_MATERNO` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_EMAIL` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_PASSWORD` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `US_AUTHKEY` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `US_ROL` int(11) NOT NULL DEFAULT '1',
  `US_CREADO` datetime NOT NULL,
  `US_ACTUALIZADO` datetime NOT NULL,
  PRIMARY KEY (`US_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `VEH_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MAR_ID` int(11) NOT NULL,
  `MOD_ID` int(11) NOT NULL,
  `CLI_ID` int(11) NOT NULL,
  `VEH_ANIO` int(11) NOT NULL,
  `VEH_CHASIS` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `VEH_MOTOR` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `VEH_COLOR` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `VEH_PATENTE` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`VEH_ID`),
  KEY `FK_R_MODELO` (`MOD_ID`),
  KEY `FK_TIENE_VEHICULO` (`CLI_ID`),
  KEY `FK_R_MARCA` (`MAR_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=16 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad_desabolladura`
--
ALTER TABLE `actividad_desabolladura`
  ADD CONSTRAINT `FK_REALIZA_DESABOLLADURA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actividad_pintura`
--
ALTER TABLE `actividad_pintura`
  ADD CONSTRAINT `FK_REALIZA_PINTURA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD CONSTRAINT `FK_PAGO_REPARACION2` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `despacho`
--
ALTER TABLE `despacho`
  ADD CONSTRAINT `FK_GENERA2` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD CONSTRAINT `FK_ALMACENADO1` FOREIGN KEY (`INV_ID`) REFERENCES `inventario` (`INV_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PAGO_INSUMO2` FOREIGN KEY (`PINS_ID`) REFERENCES `pago_insumos` (`PINS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UTILIZA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `FK_ALMACENADO2` FOREIGN KEY (`INS_ID`) REFERENCES `insumo` (`INS_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DEJA_EXCEDENTE` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `FK_PERTENECE` FOREIGN KEY (`MAR_ID`) REFERENCES `marca` (`MAR_ID`);

--
-- Filtros para la tabla `ot`
--
ALTER TABLE `ot`
  ADD CONSTRAINT `FK_GENERA` FOREIGN KEY (`OD_ID`) REFERENCES `despacho` (`OD_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PAGO_REPARACION` FOREIGN KEY (`CBR_ID`) REFERENCES `cobros` (`CBR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SOLICITA` FOREIGN KEY (`CLI_ID`) REFERENCES `cliente` (`CLI_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TIENE_ASIGNADA` FOREIGN KEY (`VEH_ID`) REFERENCES `vehiculo` (`VEH_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `otros_servicios`
--
ALTER TABLE `otros_servicios`
  ADD CONSTRAINT `FK_NECESITA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PAGO_SERVICIO2` FOREIGN KEY (`PEXT_ID`) REFERENCES `pago_externos` (`PEXT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago_externos`
--
ALTER TABLE `pago_externos`
  ADD CONSTRAINT `FK_PAGO_SERVICIO` FOREIGN KEY (`OS_ID`) REFERENCES `otros_servicios` (`OS_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago_insumos`
--
ALTER TABLE `pago_insumos`
  ADD CONSTRAINT `FK_PAGO_INSUMO` FOREIGN KEY (`INS_ID`) REFERENCES `insumo` (`INS_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `responsable_desabolladura`
--
ALTER TABLE `responsable_desabolladura`
  ADD CONSTRAINT `FK_RESPONSABLE_DESABOLLADURA` FOREIGN KEY (`EMP_RUT`) REFERENCES `empleado` (`EMP_RUT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RESPONSABLE_DESABOLLADURA2` FOREIGN KEY (`DES_ID`) REFERENCES `actividad_desabolladura` (`DES_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `responsable_pintura`
--
ALTER TABLE `responsable_pintura`
  ADD CONSTRAINT `FK_RESPONSABLE_PINTURA` FOREIGN KEY (`EMP_RUT`) REFERENCES `empleado` (`EMP_RUT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RESPONSABLE_PINTURA2` FOREIGN KEY (`PIN_ID`) REFERENCES `actividad_pintura` (`PIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `FK_R_MARCA` FOREIGN KEY (`MAR_ID`) REFERENCES `marca` (`MAR_ID`),
  ADD CONSTRAINT `FK_R_MODELO` FOREIGN KEY (`MOD_ID`) REFERENCES `modelo` (`MOD_ID`),
  ADD CONSTRAINT `FK_TIENE_VEHICULO` FOREIGN KEY (`CLI_ID`) REFERENCES `cliente` (`CLI_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
