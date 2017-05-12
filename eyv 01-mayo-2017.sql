-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2017 at 06:22 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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

CREATE TABLE `actividad_desabolladura` (
  `DES_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `DES_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `DES_HORAS` int(11) NOT NULL,
  `DES_PRECIO` int(11) NOT NULL,
  `DES_ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Sin Asignar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `actividad_desabolladura`
--

INSERT INTO `actividad_desabolladura` (`DES_ID`, `OT_ID`, `DES_DESCRIPCION`, `DES_HORAS`, `DES_PRECIO`, `DES_ESTADO`) VALUES
(4, 7, '1', 211, 1, 'Ejecutando'),
(5, 8, 'asdf', 10, 10000, 'Ejecutando'),
(7, 10, 'juan andres', 1, 555, 'Ejecutando'),
(9, 11, 'Desabollar Capot', 8, 150000, 'Pendiente'),
(10, 12, 'des', 1, 1000000, 'Pendiente'),
(11, 2, 'Actividad 1', 10, 10000, 'Pendiente'),
(12, 5, 'Actividad 1', 10, 10000, 'Terminado'),
(13, 2, 'Actividad 2', 20, 2000000, 'Ejecutando'),
(14, 14, 'aaa', 1, 100, 'Sin Asignar'),
(15, 9, '1', 1, 1, 'Sin Asignar');

-- --------------------------------------------------------

--
-- Table structure for table `actividad_pintura`
--

CREATE TABLE `actividad_pintura` (
  `PIN_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `PIN_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `PIN_HORAS` int(11) NOT NULL,
  `PIN_PRECIO` int(11) NOT NULL,
  `PIN_ESTADO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Sin Asignar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `actividad_pintura`
--

INSERT INTO `actividad_pintura` (`PIN_ID`, `OT_ID`, `PIN_DESCRIPCION`, `PIN_HORAS`, `PIN_PRECIO`, `PIN_ESTADO`) VALUES
(1, 8, 'Pintura', 23, 200000, 'activo'),
(2, 11, 'Pintar capot', 5, 100000, 'Pendiente'),
(3, 10, 'pintura', 12, 10000, 'Sin Asignar'),
(4, 2, 'Actividad 1', 10, 50000, 'Ejecutando');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `CLI_ID` int(11) NOT NULL,
  `CLI_NOMBRES` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_PATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_MATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_RUT` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_TELEFONO` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CLI_DIRECCION` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`CLI_ID`, `CLI_NOMBRES`, `CLI_PATERNO`, `CLI_MATERNO`, `CLI_RUT`, `CLI_TELEFONO`, `CLI_DIRECCION`) VALUES
(1, 'Juan Antonio', 'Sáez', 'Tapia', '72580125', '+56956568068', 'Pasaje Distrito Esperanza 238 Villa los heroes, Lota'),
(2, 'Nombre Cliente 1', 'Paterno Cliente 1', 'Materno Cliente 1', '168181922', '412877297', 'Pasaje Distrito Esperanza #238, Villa los Heroes, Lota'),
(3, 'Paula Andrea', 'Sáez', 'Tapia', '14616949k', '956568014', 'Pasaje Distrito Esperanza 238 Villa los heroes');

-- --------------------------------------------------------

--
-- Table structure for table `cobros`
--

CREATE TABLE `cobros` (
  `CBR_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `CBR_VALOR` int(11) NOT NULL,
  `CBR_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `despacho`
--

CREATE TABLE `despacho` (
  `OD_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `OD_FECHA` date NOT NULL,
  `OD_OBSERVACINES` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--

CREATE TABLE `empleado` (
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_NOMBRES` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_PATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `EMP_MATERNO` varchar(128) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`EMP_RUT`, `EMP_NOMBRES`, `EMP_PATERNO`, `EMP_MATERNO`) VALUES
('14616949k', 'Paula Andrea', 'Saez', 'Tapia');

-- --------------------------------------------------------

--
-- Table structure for table `insumo`
--

CREATE TABLE `insumo` (
  `INS_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `PAG_ID` int(11) DEFAULT NULL,
  `INS_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `INS_CANTIDAD` int(11) NOT NULL,
  `INS_PRECIO_UNITARIO` int(11) NOT NULL,
  `INS_TOTAL` int(11) NOT NULL,
  `INS_RECIBIDO` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `insumo`
--

INSERT INTO `insumo` (`INS_ID`, `OT_ID`, `PAG_ID`, `INS_NOMBRE`, `INS_CANTIDAD`, `INS_PRECIO_UNITARIO`, `INS_TOTAL`, `INS_RECIBIDO`) VALUES
(1, 8, NULL, 'Pintura Azul', 2, 10000, 20000, 0),
(2, 2, NULL, '121221', 2, 34, 68, 1),
(3, 11, NULL, 'Lija grano 600', 5, 200, 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `INV_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `INV_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `INV_CANTIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `MAR_ID` int(11) NOT NULL,
  `MAR_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`MAR_ID`, `MAR_NOMBRE`) VALUES
(1, 'Alfa Romeo'),
(2, 'Alpine'),
(5, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `modelo`
--

CREATE TABLE `modelo` (
  `MOD_ID` int(11) NOT NULL,
  `MAR_ID` int(11) NOT NULL,
  `MOD_NOMBRE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL,
  `MOD_VARIANTE` varchar(128) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `modelo`
--

INSERT INTO `modelo` (`MOD_ID`, `MAR_ID`, `MOD_NOMBRE`, `MOD_VARIANTE`) VALUES
(1, 1, '147', 'Sedán'),
(2, 2, 'coupé', '(sin variante)'),
(3, 1, '4c', 'no posee');

-- --------------------------------------------------------

--
-- Table structure for table `ot`
--

CREATE TABLE `ot` (
  `OT_ID` int(11) NOT NULL,
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
  `OT_SUBTOTAL` int(11) NOT NULL,
  `OT_IVA` int(11) NOT NULL,
  `OT_TOTAL` int(11) NOT NULL,
  `OT_TOTAL_HORAS` int(11) NOT NULL,
  `OT_EDES` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `OT_EPIN` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `ot`
--

INSERT INTO `ot` (`OT_ID`, `OD_ID`, `CBR_ID`, `VEH_ID`, `CLI_ID`, `OT_INICIO`, `OT_ENTREGA`, `OT_OBSERVACIONES`, `OT_ESTADO`, `OT_TDESABOLLADURA`, `OT_TPINTURA`, `OT_TINSUMO`, `OT_TEXTERNO`, `OT_SUBTOTAL`, `OT_IVA`, `OT_TOTAL`, `OT_TOTAL_HORAS`, `OT_EDES`, `OT_EPIN`) VALUES
(2, NULL, NULL, 1, 1, '2017-04-14', '2017-04-30', 'lalalalaala', 'Pendiente', 2010000, 50000, 68, 0, 2060068, 391413, 2451481, 40, 'Pendiente', 'Pendiente'),
(5, NULL, NULL, 1, 1, '2016-04-07', '2016-04-30', 'asdfg', 'OT', 10000, 0, 0, 20000, 30000, 5700, 35700, 10, 'Terminado', NULL),
(7, NULL, NULL, 1, 1, '2016-04-06', '2016-04-06', 'asd', 'Presupuesto', 0, 0, 0, 0, 1, 1, 1, 1, NULL, NULL),
(8, NULL, NULL, 1, 1, '2016-04-19', '2016-05-11', 'obs.', 'Presupuesto', 0, 0, 0, 0, 220000, 111111, 300000, 20, NULL, NULL),
(9, NULL, NULL, 1, 1, '2016-04-04', '2016-04-13', 'asdfghjk', 'OT', 1, 0, 0, 0, 1, 0, 1, 1, NULL, NULL),
(10, NULL, NULL, 1, 1, '2016-05-04', '2016-05-05', 'asdf', 'Terminado', 555, 10000, 0, 0, 10555, 2005, 12560, 13, NULL, NULL),
(11, NULL, NULL, 3, 2, '2017-03-31', '2017-04-15', 'Observación 1', 'Presupuesto', 0, 0, 0, 0, 501000, 28500, 178500, 13, NULL, NULL),
(12, NULL, NULL, 3, 2, '2017-04-07', '2017-04-08', 'obs', 'Presupuesto', 0, 0, 0, 0, 1000000, 190000, 1190000, 1, NULL, NULL),
(13, NULL, NULL, 1, 1, '2017-04-11', '2017-04-12', 'OBS.', 'Presupuesto', 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(14, NULL, NULL, 1, 1, '2017-05-01', '2017-05-02', 'aaaa', 'Presupuesto', 100, 0, 0, 0, 100, 19, 119, 1, NULL, NULL),
(15, NULL, NULL, 3, 1, '2017-05-01', '2017-05-02', 'aaaa', 'Presupuesto', 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `otros_servicios`
--

CREATE TABLE `otros_servicios` (
  `OS_ID` int(11) NOT NULL,
  `OT_ID` int(11) DEFAULT NULL,
  `PAG_ID` int(11) DEFAULT NULL,
  `OS_DESCRIPCION` text COLLATE utf8_spanish2_ci NOT NULL,
  `OS_PRECIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `otros_servicios`
--

INSERT INTO `otros_servicios` (`OS_ID`, `OT_ID`, `PAG_ID`, `OS_DESCRIPCION`, `OS_PRECIO`) VALUES
(4, 5, NULL, 'a', 20000),
(5, 11, NULL, 'Reparación Chasis', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `PAG_ID` int(11) NOT NULL,
  `OS_ID` int(11) DEFAULT NULL,
  `INS_ID` int(11) DEFAULT NULL,
  `PAG_FACTURA` int(11) NOT NULL,
  `PAG_VALOR` int(11) NOT NULL,
  `PAG_FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsable_desabolladura`
--

CREATE TABLE `responsable_desabolladura` (
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `DES_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `responsable_desabolladura`
--

INSERT INTO `responsable_desabolladura` (`EMP_RUT`, `DES_ID`) VALUES
('14616949k', 5),
('14616949k', 13);

-- --------------------------------------------------------

--
-- Table structure for table `responsable_pintura`
--

CREATE TABLE `responsable_pintura` (
  `EMP_RUT` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `PIN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `US_ID` int(11) NOT NULL,
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
  `US_ACTUALIZADO` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`US_ID`, `US_USERNAME`, `US_RUT`, `US_NOMBRES`, `US_PATERNO`, `US_MATERNO`, `US_EMAIL`, `US_PASSWORD`, `US_AUTHKEY`, `US_ROL`, `US_CREADO`, `US_ACTUALIZADO`) VALUES
(1, 'msaez', '168181922', 'Marcelo Alexis', 'Sáez', 'Tapia', 'marcelo.saez.t@gmail.com', '123123123', 'aaaaa', 2, '2016-04-03 14:10:08', '2017-04-20 15:28:48'),
(2, 'usuario', '72139976', 'Usuario', 'Usuario', 'Usuario', 'usuario@gmail.com', 'usuario', '2jjvpbhlM-ZNuiy6jn3_XhTAHwwRcvPW', 1, '2017-04-23 19:13:47', '2017-04-23 19:13:47'),
(3, 'usuario1', '14616949k', 'Usuario', 'Usuario', 'Usuario', 'usuario1@gmail.com', 'usuario', 'bVPDfQLRC2yXCBMej_FnbN7FbMQpYMs4', 1, '2017-04-23 19:27:10', '2017-04-23 19:27:10');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

CREATE TABLE `vehiculo` (
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
-- Dumping data for table `vehiculo`
--

INSERT INTO `vehiculo` (`VEH_ID`, `MAR_ID`, `MOD_ID`, `CLI_ID`, `VEH_ANIO`, `VEH_CHASIS`, `VEH_MOTOR`, `VEH_COLOR`, `VEH_PATENTE`) VALUES
(1, 1, 1, 1, 2006, '12345', '12345', 'Rojo', 'GG-WP-99'),
(2, 2, 2, 2, 1909, '12345', '12345', 'Rojo', 'GG-WP-88'),
(3, 2, 2, 2, 2015, 'CHASIS1', 'MOTOR1', 'Burdeo', 'UL-1658');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividad_desabolladura`
--
ALTER TABLE `actividad_desabolladura`
  ADD PRIMARY KEY (`DES_ID`),
  ADD KEY `FK_REALIZA_DESABOLLADURA` (`OT_ID`);

--
-- Indexes for table `actividad_pintura`
--
ALTER TABLE `actividad_pintura`
  ADD PRIMARY KEY (`PIN_ID`),
  ADD KEY `FK_REALIZA_PINTURA` (`OT_ID`);

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
-- Indexes for table `responsable_desabolladura`
--
ALTER TABLE `responsable_desabolladura`
  ADD PRIMARY KEY (`EMP_RUT`,`DES_ID`),
  ADD KEY `FK_RESPONSABLE_DESABOLLADURA2` (`DES_ID`);

--
-- Indexes for table `responsable_pintura`
--
ALTER TABLE `responsable_pintura`
  ADD PRIMARY KEY (`EMP_RUT`,`PIN_ID`),
  ADD KEY `FK_RESPONSABLE_PINTURA2` (`PIN_ID`);

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
  MODIFY `DES_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `actividad_pintura`
--
ALTER TABLE `actividad_pintura`
  MODIFY `PIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CLI_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `INS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `INV_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `MAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `MOD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ot`
--
ALTER TABLE `ot`
  MODIFY `OT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `otros_servicios`
--
ALTER TABLE `otros_servicios`
  MODIFY `OS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `PAG_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `US_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `VEH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividad_desabolladura`
--
ALTER TABLE `actividad_desabolladura`
  ADD CONSTRAINT `FK_REALIZA_DESABOLLADURA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`);

--
-- Constraints for table `actividad_pintura`
--
ALTER TABLE `actividad_pintura`
  ADD CONSTRAINT `FK_REALIZA_PINTURA` FOREIGN KEY (`OT_ID`) REFERENCES `ot` (`OT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `responsable_desabolladura`
--
ALTER TABLE `responsable_desabolladura`
  ADD CONSTRAINT `FK_RESPONSABLE_DESABOLLADURA` FOREIGN KEY (`EMP_RUT`) REFERENCES `empleado` (`EMP_RUT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RESPONSABLE_DESABOLLADURA2` FOREIGN KEY (`DES_ID`) REFERENCES `actividad_desabolladura` (`DES_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responsable_pintura`
--
ALTER TABLE `responsable_pintura`
  ADD CONSTRAINT `FK_RESPONSABLE_PINTURA` FOREIGN KEY (`EMP_RUT`) REFERENCES `empleado` (`EMP_RUT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RESPONSABLE_PINTURA2` FOREIGN KEY (`PIN_ID`) REFERENCES `actividad_pintura` (`PIN_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
