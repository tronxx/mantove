-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2020 a las 03:03:51
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mantove`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `idAlmacen` int(11) NOT NULL,
  `clave` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  `idEstado` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`idAlmacen`, `clave`, `nombre`, `direccion`, `idCiudad`, `idEstado`) VALUES
(2, 'AL', 'ALMACEN GENERAL', 0, 0, 1),
(5, 'SE', 'SERVICIO', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `car_usuarios`
--

CREATE TABLE `car_usuarios` (
  `IDUSUARIO` int(11) NOT NULL,
  `LOGIN` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `CLAVE` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `NOMBRE` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MAESTRO` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `NUMPOL` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `INICIALES` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `STATUS` varchar(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FECBAJ` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `car_usuarios`
--

INSERT INTO `car_usuarios` (`IDUSUARIO`, `LOGIN`, `CLAVE`, `NOMBRE`, `MAESTRO`, `NUMPOL`, `INICIALES`, `STATUS`, `FECBAJ`) VALUES
(1, 'TRON', 'MASTER', 'Daniel Ricardo Basto Rivero', 'S', NULL, 'DRBR', 'A', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes`
--

CREATE TABLE `choferes` (
  `idChofer` int(11) NOT NULL,
  `codigo` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idCiudad` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idEstatus` int(11) NOT NULL,
  `telefono` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecbaj` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `choferes`
--

INSERT INTO `choferes` (`idChofer`, `codigo`, `nombres`, `apellidos`, `direccion`, `idCiudad`, `idEstado`, `idEstatus`, `telefono`, `fecbaj`) VALUES
(1, 'CEJ', 'JOSE', 'CAN EK', '15 n. 351 x 60 y 62 centro', 6, 0, 1, '9999851597', NULL),
(2, 'CGW', 'WILBERTH', 'CERVERA GARCIA', '15 x 24 y 26', 6, 0, 1, '9999458788', NULL),
(5, 'BPO', 'OLEGARIO', 'BOLIVAR PINO', '10 x 101 y 15 N.831 CENTRO', 11, 0, 1, '9984745858', NULL),
(6, 'PCK', 'KELLY RUSSEL', 'PECH CHI', '11 x 32 y 34 N.434 SN AROLDO', 6, 0, 1, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cias`
--

CREATE TABLE `cias` (
  `CIA` int(11) NOT NULL,
  `RAZON` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DIR` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DIR2` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `NOMFIS` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TEL` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `FAX` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `RFC` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cias`
--

INSERT INTO `cias` (`CIA`, `RAZON`, `DIR`, `DIR2`, `NOMFIS`, `TEL`, `FAX`, `RFC`) VALUES
(1, 'MUEBLERIA DIAZ Y SOLIS SA DE CV', 'Calle 54 N.521-E x 65 y 67 Centro', NULL, 'Calle 54 N.521-E x 65 y 67 Centro', '999-924-45-57', NULL, 'MDS870209190');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idCiudad` int(11) NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudad`, `ciudad`) VALUES
(7, 'ACANCEH'),
(8, 'IZAMAL'),
(6, 'MERIDA'),
(9, 'MOTUL'),
(11, 'OXKUTZCAB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combustibles`
--

CREATE TABLE `combustibles` (
  `idCombustible` int(11) NOT NULL,
  `descripcion` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `iva` double DEFAULT NULL,
  `idEstatus` int(11) DEFAULT NULL,
  `precioxlit` double DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `combustibles`
--

INSERT INTO `combustibles` (`idCombustible`, `descripcion`, `iva`, `idEstatus`, `precioxlit`, `fecha`) VALUES
(3, 'MAGNA', 16, 1, 18, '2020-11-05'),
(4, 'PREMIUM', 16, 1, 19, '2020-11-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `idEstatus` int(11) NOT NULL,
  `estatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `idMarca` int(11) NOT NULL,
  `marca` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`idMarca`, `marca`) VALUES
(6, 'CHEVROLET'),
(4, 'DODGE'),
(2, 'FORD'),
(3, 'NISSAN'),
(11, 'PEUGEOT'),
(9, 'TOYOTA'),
(7, 'VOLKSWAGEN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poligas`
--

CREATE TABLE `poligas` (
  `IDPOLIGAS` int(11) NOT NULL,
  `IDALMACEN` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `STATUS` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `IMPORTE` double DEFAULT NULL,
  `IVA` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `PROMKML` double DEFAULT NULL,
  `LITROS` double DEFAULT NULL,
  `KMTS` int(11) DEFAULT NULL,
  `CIA` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `poligas`
--

INSERT INTO `poligas` (`IDPOLIGAS`, `IDALMACEN`, `FECHA`, `STATUS`, `IDUSUARIO`, `IMPORTE`, `IVA`, `TOTAL`, `PROMKML`, `LITROS`, `KMTS`, `CIA`) VALUES
(8, 2, '2018-07-03', 'A', 0, 474.38999999999993, 806005.61, 806480, 15.16, 47162.59, 714925, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polser`
--

CREATE TABLE `polser` (
  `IDPOLSER` int(11) NOT NULL,
  `IDALMACEN` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `STATUS` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `IMPORTE` double DEFAULT NULL,
  `IVA` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `CIA` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `polser`
--

INSERT INTO `polser` (`IDPOLSER`, `IDALMACEN`, `FECHA`, `STATUS`, `IDUSUARIO`, `IMPORTE`, `IVA`, `TOTAL`, `CIA`) VALUES
(1, 2, '2018-07-07', 'A', 0, 0, 0, 0, 1),
(2, 2, '2018-08-20', 'A', 0, 0, 0, 108, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precioscombustible`
--

CREATE TABLE `precioscombustible` (
  `idPrecioCombustible` int(11) NOT NULL,
  `idCombustible` int(11) NOT NULL,
  `precio` double DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `precioscombustible`
--

INSERT INTO `precioscombustible` (`idPrecioCombustible`, `idCombustible`, `precio`, `fecha`) VALUES
(1, 3, 18, '2020-11-05 06:00:00'),
(2, 4, 19, '2020-11-05 06:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renpogas`
--

CREATE TABLE `renpogas` (
  `IDRENPOGAS` int(11) NOT NULL,
  `IDPOLIGAS` int(11) NOT NULL,
  `IDVEHICULO` int(11) NOT NULL,
  `KMTANT` int(11) DEFAULT NULL,
  `KMTACT` int(11) DEFAULT NULL,
  `RECORR` int(11) DEFAULT NULL,
  `LITROS` double DEFAULT NULL,
  `PRECIOU` double DEFAULT NULL,
  `IDCOMBUST` int(11) NOT NULL,
  `IDCHOFER` int(11) NOT NULL,
  `ZONA` int(11) NOT NULL,
  `IMPORTE` double DEFAULT NULL,
  `IVA` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `PIVA` double DEFAULT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `FECNOT` date DEFAULT NULL,
  `CONSE` smallint(6) DEFAULT NULL,
  `KMTACU` int(11) DEFAULT NULL,
  `CIA` smallint(6) DEFAULT NULL,
  `IDTIPAGO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `renpogas`
--

INSERT INTO `renpogas` (`IDRENPOGAS`, `IDPOLIGAS`, `IDVEHICULO`, `KMTANT`, `KMTACT`, `RECORR`, `LITROS`, `PRECIOU`, `IDCOMBUST`, `IDCHOFER`, `ZONA`, `IMPORTE`, `IVA`, `TOTAL`, `PIVA`, `IDUSUARIO`, `FECNOT`, `CONSE`, `KMTACU`, `CIA`, `IDTIPAGO`) VALUES
(7, 8, 2, 0, 259985, 259985, 10526.32, 17.1, 1, 1, 1, 105.88, 179894.12, 180000, 16, 0, '2018-07-03', 0, 259985, 1, 2),
(8, 8, 2, 259985, 260210, 225, 26.32, 17.1, 1, 2, 2, 0.26, 449.74, 450, 16, 0, '2018-07-03', 0, 260210, 1, 2),
(9, 8, 3, 0, 189000, 189000, 21052.63, 17.1, 1, 2, 2, 211.76, 359788.24, 360000, 16, 0, '2018-07-03', 0, 189000, 1, 2),
(10, 8, 4, 0, 265000, 265000, 15497.08, 17.1, 1, 2, 2, 155.88, 264844.12, 265000, 16, 0, '2018-07-03', 0, 265000, 1, 2),
(11, 8, 4, 265000, 265300, 300, 26.32, 17.1, 1, 2, 2, 0.26, 449.74, 450, 16, 0, '2018-07-03', 0, 265300, 1, 2),
(12, 8, 4, 265300, 265400, 100, 10.53, 17.1, 1, 1, 1, 0.11, 179.89, 180, 16, 0, '2018-07-03', 0, 265400, 1, 2),
(13, 8, 2, 260210, 260290, 80, 2.92, 17.1, 1, 1, 1, 0.03, 49.97, 50, 16, 0, '2018-07-03', 0, 260290, 1, 2),
(14, 8, 3, 189000, 189235, 235, 20.47, 17.1, 1, 2, 2, 0.21, 349.79, 350, 16, 0, '2018-07-03', 0, 189235, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renposer`
--

CREATE TABLE `renposer` (
  `IDRENPOSER` int(11) NOT NULL,
  `IDPOLSER` int(11) NOT NULL,
  `IDVEHICULO` int(11) NOT NULL,
  `FECHA` date DEFAULT NULL,
  `CONSE` smallint(6) DEFAULT NULL,
  `IDSERVMANTO` int(11) NOT NULL,
  `KILOM` int(11) NOT NULL,
  `EDOTOGGLE` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IDTALLERAUT` int(11) NOT NULL,
  `IDOBSERV` int(11) NOT NULL,
  `COSTO` double DEFAULT NULL,
  `IDCHOFER` int(11) NOT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `CIA` smallint(6) NOT NULL,
  `observs` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `renposer`
--

INSERT INTO `renposer` (`IDRENPOSER`, `IDPOLSER`, `IDVEHICULO`, `FECHA`, `CONSE`, `IDSERVMANTO`, `KILOM`, `EDOTOGGLE`, `IDTALLERAUT`, `IDOBSERV`, `COSTO`, `IDCHOFER`, `IDUSUARIO`, `CIA`, `observs`) VALUES
(2, 2, 2, '2018-08-20', 0, 1, 260290, 'S', 1, 1, 18, 1, 0, 1, 0x20456e20476f6f676c6520706f6472c3a17320656e636f6e7472617220756e61206772616e2063616e7469646164206465206c6962726572c3ad617320717565207265616c697a616e20636f6e76657273696f6e65732061205044463b2073696e20656d626172676f206573746120657320756e61206465206c6173206c6962726572c3ad617320717565206dc3a173206d65206861206775737461646f2064656269646f20612073752073656e63696c6c657a20616c206d6f6d656e746f20646520637265617220756e205044462e),
(3, 2, 3, '2018-08-20', 0, 4, 189235, 'S', 1, 1, 18, 1, 0, 1, 0x45737461626c6563657220656c206d6f646f206465206572726f722070617261206c616e7a617220657863657063696f6e65732e204573746f206576697461207175652074656e676120717565206573746172206f6273657276616e646f206c6f7320726573756c7461646f732064652050444f53746174656d656e743a3a65786563757465282920792068616365207175652073752063c3b36469676f20736561206d656e6f7320726564756e64616e74652e);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servmanto`
--

CREATE TABLE `servmanto` (
  `IDSERVMANTO` int(11) NOT NULL,
  `CLAVE` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `DESCRI` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idtipovehiculo` int(11) DEFAULT NULL,
  `PERIO` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `KMOFE` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `XCADA` int(11) DEFAULT NULL,
  `XCADANVO` int(11) DEFAULT NULL,
  `TOLER` int(11) DEFAULT NULL,
  `TOGGLE` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `SERVOP` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `PARAM` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IDVEHICULO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servmanto`
--

INSERT INTO `servmanto` (`IDSERVMANTO`, `CLAVE`, `DESCRI`, `idtipovehiculo`, `PERIO`, `KMOFE`, `XCADA`, `XCADANVO`, `TOLER`, `TOGGLE`, `SERVOP`, `PARAM`, `IDVEHICULO`) VALUES
(1, 'AFI', 'AFINACION', 1, 'N', '', 0, 0, 0, 'N', 'N', NULL, NULL),
(2, 'AFM', 'AFINACION MOTO', 2, 'S', 'K', 5000, 5000, 200, 'N', '', NULL, NULL),
(3, 'ALB', 'ALINEACION Y BALANCEO', 1, 'S', 'K', 180, 180, 30, 'S', '', NULL, NULL),
(4, 'CAM', 'CAMBIO DE ACEITE', 1, 'S', 'K', 2750, 2750, 200, 'S', 'FILTRO DE ACEITE', NULL, NULL),
(5, 'CAT', 'CAMBIO DE ACEITE MOTOR', 2, 'S', 'K', 2500, 2500, 100, 'N', '', NULL, NULL),
(6, 'DIV', 'REPARACIONES DIVERSAS (MOTO)', 2, 'N', '', 0, 0, 0, 'N', '', NULL, NULL),
(7, 'LAE', 'LAVADO Y ENGRASADO', 1, 'S', 'K', 15000, 15000, 200, 'N', '', NULL, NULL),
(8, 'LAM', 'LAVADO DE MOTOR Y RADIADOR', 1, 'S', 'D', 90, 0, 0, 'N', '', NULL, NULL),
(9, 'LFR', 'LIMPIEZA DE FRENOS', 2, 'S', 'K', 5000, 5000, 200, 'N', '', NULL, NULL),
(10, 'REP', 'REPARACIONES DIVERSAS', 1, 'N', '', 0, 0, 0, 'N', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleres`
--

CREATE TABLE `talleres` (
  `idtaller` int(11) NOT NULL,
  `clave` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `representante` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `telefonos` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `giro` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idEstatus` int(11) DEFAULT NULL,
  `fecbaj` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `talleres`
--

INSERT INTO `talleres` (`idtaller`, `clave`, `nombre`, `representante`, `direccion`, `telefonos`, `giro`, `idEstatus`, `fecbaj`) VALUES
(1, 'ALEX', 'TALLER MECANICO AUTOMOTRIZ ALE', 'ALEJANDRO TEC TUN', '15 n. 351 x 60 y 62 centro', '9999458788', 'TODOS', 1, NULL),
(2, 'NOS', 'NOSOTROS MISMOS', '', 'MDS', '', 'MDS', 1, NULL),
(3, 'EPA', 'TALLER ALFREDO ECHEVERRIA', 'ALFREDO ECHEVERRIA', '46 x 71 y 73 centro', '99874598', 'Mecanica en General', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `idtelefono` int(11) NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopagos`
--

CREATE TABLE `tipopagos` (
  `idTipoPago` int(11) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `valor` double NOT NULL,
  `idEstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipopagos`
--

INSERT INTO `tipopagos` (`idTipoPago`, `descripcion`, `valor`, `idEstatus`) VALUES
(2, 'EFECTIVO', 1, 1),
(3, 'VALES', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipovehiculos`
--

CREATE TABLE `tipovehiculos` (
  `idTipoVehiculo` int(11) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `idEstatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `tipovehiculos`
--

INSERT INTO `tipovehiculos` (`idTipoVehiculo`, `descripcion`, `idEstatus`) VALUES
(1, 'CAMIONETA', 1),
(2, 'MOTO', 1),
(6, 'TRICICLO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `IDVEHICULO` int(11) NOT NULL,
  `CODIGO` int(11) NOT NULL,
  `DESCRI` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IDMARCAVEH` int(11) NOT NULL,
  `MODELO` int(11) DEFAULT NULL,
  `FECING` date DEFAULT NULL,
  `FECBAJ` date DEFAULT NULL,
  `STATUS` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `PLACAS` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CHASIS` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `SERMOT` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `MAXTAC` int(11) DEFAULT NULL,
  `KILOM` int(11) DEFAULT NULL,
  `TACACU` int(11) DEFAULT NULL,
  `NVOHASTA` int(11) DEFAULT NULL,
  `NVOUSA` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TIPOGAS` int(11) NOT NULL,
  `CARACTM` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `TIPLLANTA` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `BATERIA` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `POLSEG` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `VENPOL` date DEFAULT NULL,
  `IDCHOFER` int(11) NOT NULL,
  `CAMTAC` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `KMTCAMTAC` int(11) DEFAULT NULL,
  `ZONA` int(11) DEFAULT NULL,
  `FECAMTAC` date DEFAULT NULL,
  `CIA` int(11) DEFAULT NULL,
  `idtipovehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`IDVEHICULO`, `CODIGO`, `DESCRI`, `IDMARCAVEH`, `MODELO`, `FECING`, `FECBAJ`, `STATUS`, `PLACAS`, `CHASIS`, `SERMOT`, `MAXTAC`, `KILOM`, `TACACU`, `NVOHASTA`, `NVOUSA`, `TIPOGAS`, `CARACTM`, `TIPLLANTA`, `BATERIA`, `POLSEG`, `VENPOL`, `IDCHOFER`, `CAMTAC`, `KMTCAMTAC`, `ZONA`, `FECAMTAC`, `CIA`, `idtipovehiculo`) VALUES
(2, 7, 'ESTACAS NISSAN ROJA 2010 S/K020278', 3, 2010, '2010-05-19', '2018-05-23', 'A', 'YT-1309-A', '3N6DD25T6AK020278', 'KA24467713A', 999999, 1044412, 1044412, 100000, 'U', 1, '4 CIL. 1600 CC', '195R15', '', 'SEGUROS BX', '2018-06-19', 1, '', 0, 1, '2018-05-23', 1, 1),
(3, 8, 'ESTACAS NISSAN ROJA 2010 S/K022748 CA/CH', 3, 2010, '2010-07-01', '2018-06-06', 'A', 'YP-1027-A', 'AK022748', 'KA24470751A', 999999, 570870, 570870, 100000, 'U', 1, '4 CIL', '195R14', 'MULTIVA', '71925-01', '2018-07-09', 2, '', 0, 2, '2018-06-06', 1, 1),
(4, 21, 'ESTACAS NISSAN ROJA 2012 S/CK013732', 3, 2012, '2012-01-18', '2018-06-06', 'A', 'YU-6837-A', 'CABINA', 'KA24542834', 999999, 532435, 532435, 100000, 'U', 1, '4 CIL. 1600 CC', '195R15', 'SEGUROS MULTIVA', '75153-01', '2018-01-18', 2, '', 0, 1, '2018-06-06', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `idzona` int(11) NOT NULL,
  `zona` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idzona`, `zona`) VALUES
(1, 'ZONA MERIDA'),
(2, 'ZONA SUR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`idAlmacen`) USING BTREE,
  ADD UNIQUE KEY `CLAVE` (`clave`) USING BTREE;

--
-- Indices de la tabla `car_usuarios`
--
ALTER TABLE `car_usuarios`
  ADD PRIMARY KEY (`IDUSUARIO`),
  ADD UNIQUE KEY `LOGIN` (`LOGIN`),
  ADD UNIQUE KEY `INICIALES` (`INICIALES`);

--
-- Indices de la tabla `choferes`
--
ALTER TABLE `choferes`
  ADD PRIMARY KEY (`idChofer`) USING BTREE,
  ADD UNIQUE KEY `CODIGO` (`codigo`,`idEstatus`) USING BTREE;

--
-- Indices de la tabla `cias`
--
ALTER TABLE `cias`
  ADD PRIMARY KEY (`CIA`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCiudad`) USING BTREE,
  ADD UNIQUE KEY `CIUDAD` (`ciudad`) USING BTREE;

--
-- Indices de la tabla `combustibles`
--
ALTER TABLE `combustibles`
  ADD PRIMARY KEY (`idCombustible`) USING BTREE;

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`) USING BTREE,
  ADD UNIQUE KEY `ESTADO` (`estado`) USING BTREE;

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`idEstatus`) USING BTREE;

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`idMarca`) USING BTREE,
  ADD UNIQUE KEY `MARCA` (`marca`) USING BTREE;

--
-- Indices de la tabla `poligas`
--
ALTER TABLE `poligas`
  ADD PRIMARY KEY (`IDPOLIGAS`);

--
-- Indices de la tabla `polser`
--
ALTER TABLE `polser`
  ADD PRIMARY KEY (`IDPOLSER`),
  ADD UNIQUE KEY `IDALMACEN` (`IDALMACEN`,`FECHA`,`CIA`);

--
-- Indices de la tabla `precioscombustible`
--
ALTER TABLE `precioscombustible`
  ADD PRIMARY KEY (`idPrecioCombustible`) USING BTREE;

--
-- Indices de la tabla `renpogas`
--
ALTER TABLE `renpogas`
  ADD PRIMARY KEY (`IDRENPOGAS`);

--
-- Indices de la tabla `renposer`
--
ALTER TABLE `renposer`
  ADD PRIMARY KEY (`IDRENPOSER`);

--
-- Indices de la tabla `servmanto`
--
ALTER TABLE `servmanto`
  ADD PRIMARY KEY (`IDSERVMANTO`);

--
-- Indices de la tabla `talleres`
--
ALTER TABLE `talleres`
  ADD PRIMARY KEY (`idtaller`) USING BTREE,
  ADD UNIQUE KEY `CLAVE` (`clave`) USING BTREE;

--
-- Indices de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD PRIMARY KEY (`idtelefono`);

--
-- Indices de la tabla `tipopagos`
--
ALTER TABLE `tipopagos`
  ADD PRIMARY KEY (`idTipoPago`) USING BTREE;

--
-- Indices de la tabla `tipovehiculos`
--
ALTER TABLE `tipovehiculos`
  ADD PRIMARY KEY (`idTipoVehiculo`) USING BTREE;

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`IDVEHICULO`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`,`CIA`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`idzona`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `idAlmacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `choferes`
--
ALTER TABLE `choferes`
  MODIFY `idChofer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `combustibles`
--
ALTER TABLE `combustibles`
  MODIFY `idCombustible` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `poligas`
--
ALTER TABLE `poligas`
  MODIFY `IDPOLIGAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `polser`
--
ALTER TABLE `polser`
  MODIFY `IDPOLSER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `precioscombustible`
--
ALTER TABLE `precioscombustible`
  MODIFY `idPrecioCombustible` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `renpogas`
--
ALTER TABLE `renpogas`
  MODIFY `IDRENPOGAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `renposer`
--
ALTER TABLE `renposer`
  MODIFY `IDRENPOSER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servmanto`
--
ALTER TABLE `servmanto`
  MODIFY `IDSERVMANTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `talleres`
--
ALTER TABLE `talleres`
  MODIFY `idtaller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `telefonos`
--
ALTER TABLE `telefonos`
  MODIFY `idtelefono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipopagos`
--
ALTER TABLE `tipopagos`
  MODIFY `idTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipovehiculos`
--
ALTER TABLE `tipovehiculos`
  MODIFY `idTipoVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `IDVEHICULO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `idzona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
