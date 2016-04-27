-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2016 at 04:58 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyv`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividad_desabolladura`
--

CREATE TABLE IF NOT EXISTS `actividad_desabolladura` (
  `DES_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `DES_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `DES_HORAS` int(11) NOT NULL,
  `DES_PRECIO` int(11) NOT NULL,
  `DES_ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `actividad_pintura`
--

CREATE TABLE IF NOT EXISTS `actividad_pintura` (
  `PIN_ID` int(11) NOT NULL,
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `PIN_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `PIN_HORAS` int(11) NOT NULL,
  `PIN_PRECIO` int(11) NOT NULL,
  `PIN_ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `CLI_ID` int(11) NOT NULL,
  `CLI_NOMBRES` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_PATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_MATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_RUT` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_TELEFONO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_DIRECCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_IND_CONDUCTA` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cobros`
--

CREATE TABLE IF NOT EXISTS `cobros` (
  `CBR_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `CBR_VALOR` int(11) NOT NULL,
  `CBR_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `despacho`
--

CREATE TABLE IF NOT EXISTS `despacho` (
  `OD_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `OD_FECHA` date NOT NULL,
  `OD_OBSERVACINES` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--

CREATE TABLE IF NOT EXISTS `empleado` (
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_NOMBRES` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_PATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_MATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insumo`
--

CREATE TABLE IF NOT EXISTS `insumo` (
  `INS_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `PAG_ID` int(11) DEFAULT NULL,
  `INS_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `INS_CANTIDAD` int(11) NOT NULL,
  `INS_PRECIO_UNITARIO` int(11) NOT NULL,
  `INS_TOTAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `INV_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `INV_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `INV_CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `MAR_ID` int(11) NOT NULL,
  `MAR_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modelo`
--

CREATE TABLE IF NOT EXISTS `modelo` (
  `MOD_ID` int(11) NOT NULL,
  `MAR_ID` int(11) NOT NULL,
  `MOD_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `MOD_VARIANTE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ot`
--

CREATE TABLE IF NOT EXISTS `ot` (
  `OT_ID` int(11) NOT NULL,
  `OD_ID` int(11) DEFAULT NULL,
  `CBR_ID` int(11) DEFAULT NULL,
  `VEH_ID` int(11) NOT NULL,
  `CLI_ID` int(11) NOT NULL,
  `OT_INICIO` date NOT NULL,
  `OT_ENTREGA` date NOT NULL,
  `OT_OBSERVACIONES` text COLLATE utf8_spanish2_ci NOT NULL,
  `OT_SUBTOTAL` int(11) NOT NULL,
  `OT_IVA` int(11) NOT NULL,
  `OT_TOTAL` int(11) NOT NULL,
  `OT_TOTAL_HORAS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otros_servicios`
--

CREATE TABLE IF NOT EXISTS `otros_servicios` (
  `OS_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `PAG_ID` int(11) DEFAULT NULL,
  `OS_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `OS_PRECIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `PAG_ID` int(11) NOT NULL,
  `OS_ID` int(11) DEFAULT NULL,
  `INS_ID` int(11) DEFAULT NULL,
  `PAG_VALOR` int(11) NOT NULL,
  `PAG_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `US_ID` int(11) NOT NULL,
  `US_USERNAME` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `US_RUT` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `US_NOMBRES` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_PATERNO` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_MATERNO` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_EMAIL` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `US_PASSWORD` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `US_AUTHKEY` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `US_CREADO` datetime NOT NULL,
  `US_ACTUALIZADO` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `VEH_ID` int(11) NOT NULL,
  `MAR_ID` int(11) NOT NULL,
  `MOD_ID` int(11) NOT NULL,
  `CLI_ID` int(11) NOT NULL,
  `VEH_ANIO` int(11) NOT NULL,
  `VEH_CHASIS` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `VEH_MOTOR` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `VEH_COLOR` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `VEH_PATENTE` varchar(8) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividad_desabolladura`
--
ALTER TABLE `actividad_desabolladura`
  ADD PRIMARY KEY (`DES_ID`),
  ADD KEY `FK_REALIZA_DESABOLLADURA` (`OT_ID`),
  ADD KEY `FK_RESPONSABLE_DESABOLLADURA` (`EMP_RUT`);

--
-- Indexes for table `actividad_pintura`
--
ALTER TABLE `actividad_pintura`
  ADD PRIMARY KEY (`PIN_ID`),
  ADD KEY `FK_REALIZA_PINTURA` (`OT_ID`),
  ADD KEY `FK_RESPONSABLE_PINTURA` (`EMP_RUT`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CLI_ID`);

--
-- Indexes for table `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`CBR_ID`),
  ADD KEY `FK_PAGO_REPARACION2` (`OT_ID`);

--
-- Indexes for table `despacho`
--
ALTER TABLE `despacho`
  ADD PRIMARY KEY (`OD_ID`),
  ADD KEY `FK_GENERA2` (`OT_ID`);

--
-- Indexes for table `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`EMP_RUT`);

--
-- Indexes for table `insumo`
--
ALTER TABLE `insumo`
  ADD PRIMARY KEY (`INS_ID`),
  ADD KEY `FK_PAGO_INSUMO` (`PAG_ID`),
  ADD KEY `FK_UTILIZA` (`OT_ID`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`INV_ID`),
  ADD KEY `FK_DEJA_EXCEDENTE` (`OT_ID`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`MAR_ID`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`MOD_ID`),
  ADD KEY `FK_PERTENECE` (`MAR_ID`);

--
-- Indexes for table `ot`
--
ALTER TABLE `ot`
  ADD PRIMARY KEY (`OT_ID`),
  ADD KEY `FK_GENERA` (`OD_ID`),
  ADD KEY `FK_PAGO_REPARACION` (`CBR_ID`),
  ADD KEY `FK_SOLICITA` (`CLI_ID`),
  ADD KEY `FK_TIENE_ASIGNADA` (`VEH_ID`);

--
-- Indexes for table `otros_servicios`
--
ALTER TABLE `otros_servicios`
  ADD PRIMARY KEY (`OS_ID`),
  ADD KEY `FK_NECESITA` (`OT_ID`),
  ADD KEY `FK_PAGO_SERVICIO` (`PAG_ID`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`PAG_ID`),
  ADD KEY `FK_PAGO_INSUMO2` (`INS_ID`),
  ADD KEY `FK_PAGO_SERVICIO2` (`OS_ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`US_ID`);

--
-- Indexes for table `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`VEH_ID`),
  ADD KEY `FK_R_MODELO` (`MOD_ID`),
  ADD KEY `FK_TIENE_VEHICULO` (`CLI_ID`),
  ADD KEY `FK_R_MARCA` (`MAR_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividad_desabolladura`
--
ALTER TABLE `actividad_desabolladura`
  MODIFY `DES_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actividad_pintura`
--
ALTER TABLE `actividad_pintura`
  MODIFY `PIN_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CLI_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cobros`
--
ALTER TABLE `cobros`
  MODIFY `CBR_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `despacho`
--
ALTER TABLE `despacho`
  MODIFY `OD_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `insumo`
--
ALTER TABLE `insumo`
  MODIFY `INS_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `INV_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `MAR_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `MOD_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ot`
--
ALTER TABLE `ot`
  MODIFY `OT_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `otros_servicios`
--
ALTER TABLE `otros_servicios`
  MODIFY `OS_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `PAG_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `US_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `VEH_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividad_desabolladura`
--
ALTER TABLE `actividad_desabolladura`
  ADD CONSTRAINT `FK_REALIZA_DESABOLLADURA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`),
  ADD CONSTRAINT `FK_RESPONSABLE_DESABOLLADURA` FOREIGN KEY (`EMP_RUT`) REFERENCES `empleado` (`EMP_RUT`);

--
-- Constraints for table `actividad_pintura`
--
ALTER TABLE `actividad_pintura`
  ADD CONSTRAINT `FK_REALIZA_PINTURA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`),
  ADD CONSTRAINT `FK_RESPONSABLE_PINTURA` FOREIGN KEY (`EMP_RUT`) REFERENCES `empleado` (`EMP_RUT`);

--
-- Constraints for table `cobros`
--
ALTER TABLE `cobros`
  ADD CONSTRAINT `FK_PAGO_REPARACION2` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`);

--
-- Constraints for table `despacho`
--
ALTER TABLE `despacho`
  ADD CONSTRAINT `FK_GENERA2` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`);

--
-- Constraints for table `insumo`
--
ALTER TABLE `insumo`
  ADD CONSTRAINT `FK_PAGO_INSUMO` FOREIGN KEY (`PAG_ID`) REFERENCES `pagos` (`PAG_ID`),
  ADD CONSTRAINT `FK_UTILIZA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`);

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `FK_DEJA_EXCEDENTE` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`);

--
-- Constraints for table `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `FK_PERTENECE` FOREIGN KEY (`MAR_ID`) REFERENCES `marca` (`MAR_ID`);

--
-- Constraints for table `ot`
--
ALTER TABLE `ot`
  ADD CONSTRAINT `FK_GENERA` FOREIGN KEY (`OD_ID`) REFERENCES `despacho` (`OD_ID`),
  ADD CONSTRAINT `FK_PAGO_REPARACION` FOREIGN KEY (`CBR_ID`) REFERENCES `cobros` (`CBR_ID`),
  ADD CONSTRAINT `FK_SOLICITA` FOREIGN KEY (`CLI_ID`) REFERENCES `cliente` (`CLI_ID`),
  ADD CONSTRAINT `FK_TIENE_ASIGNADA` FOREIGN KEY (`VEH_ID`) REFERENCES `vehiculo` (`VEH_ID`);

--
-- Constraints for table `otros_servicios`
--
ALTER TABLE `otros_servicios`
  ADD CONSTRAINT `FK_NECESITA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`),
  ADD CONSTRAINT `FK_PAGO_SERVICIO` FOREIGN KEY (`PAG_ID`) REFERENCES `pagos` (`PAG_ID`);

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `FK_PAGO_INSUMO2` FOREIGN KEY (`INS_ID`) REFERENCES `insumo` (`INS_ID`),
  ADD CONSTRAINT `FK_PAGO_SERVICIO2` FOREIGN KEY (`OS_ID`) REFERENCES `otros_servicios` (`OS_ID`);

--
-- Constraints for table `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `FK_R_MARCA` FOREIGN KEY (`MAR_ID`) REFERENCES `marca` (`MAR_ID`),
  ADD CONSTRAINT `FK_R_MODELO` FOREIGN KEY (`MOD_ID`) REFERENCES `modelo` (`MOD_ID`),
  ADD CONSTRAINT `FK_TIENE_VEHICULO` FOREIGN KEY (`CLI_ID`) REFERENCES `cliente` (`CLI_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
