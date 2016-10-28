-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-10-2016 a las 13:32:49
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionproductiva`
--
CREATE DATABASE IF NOT EXISTS `gestionproductiva` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestionproductiva`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Bienes`
--

CREATE TABLE `Bienes` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `TipoMaterial_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cargos`
--

CREATE TABLE `Cargos` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `CargoSuperior` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Cargos`
--

INSERT INTO `Cargos` (`Id`, `Descripcion`, `CargoSuperior`) VALUES
(1, 'Jefe de Ventas', NULL),
(2, 'Ingenierio Agronomo', NULL),
(3, 'Profesor de Programacion', NULL),
(4, 'Otros', NULL),
(5, 'POO', NULL),
(6, 'Limpieza', NULL),
(7, 'Secretaria', NULL),
(8, 'Jefe de Almacen', NULL),
(9, 'Ingeniero Civil', NULL),
(10, 'Tecnico de Maquinaria pesada', NULL),
(11, 'Mantenimiento', NULL),
(13, 'kilo', NULL),
(14, 'Profesor Contratado', NULL),
(15, 'Ingeniero de Software', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ciudades`
--

CREATE TABLE `Ciudades` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Ciudades`
--

INSERT INTO `Ciudades` (`Id`, `Nombre`) VALUES
(1, 'CHACHAPOYAS '),
(2, 'BAGUA'),
(3, 'BONGARA'),
(4, 'CONDORCANQUI'),
(5, 'LUYA'),
(6, 'RODRIGUEZ DE MENDOZA'),
(7, 'UTCUBAMBA'),
(8, 'HUARAZ'),
(9, 'AIJA'),
(10, 'ANTONIO RAYMONDI'),
(11, 'ASUNCION'),
(12, 'BOLOGNESI'),
(13, 'CARHUAZ'),
(14, 'CARLOS FERMIN FITZCARRALD'),
(15, 'CASMA'),
(16, 'CORONGO'),
(17, 'HUARI'),
(18, 'HUARMEY'),
(19, 'HUAYLAS'),
(20, 'MARISCAL LUZURIAGA'),
(21, 'OCROS'),
(22, 'PALLASCA'),
(23, 'POMABAMBA'),
(24, 'RECUAY'),
(25, 'SANTA'),
(26, 'SIHUAS'),
(27, 'YUNGAY'),
(28, 'ABANCAY'),
(29, 'ANDAHUAYLAS'),
(30, 'ANTABAMBA'),
(31, 'AYMARAES'),
(32, 'COTABAMBAS'),
(33, 'CHINCHEROS'),
(34, 'GRAU'),
(35, 'AREQUIPA'),
(36, 'CAMANA'),
(37, 'CARAVELI'),
(38, 'CASTILLA'),
(39, 'CAYLLOMA'),
(40, 'CONDESUYOS'),
(41, 'ISLAY'),
(42, 'LA UNION'),
(43, 'HUAMANGA'),
(44, 'CANGALLO'),
(45, 'HUANCA SANCOS'),
(46, 'HUANTA'),
(47, 'LA MAR'),
(48, 'LUCANAS'),
(49, 'PARINACOCHAS'),
(50, 'PAUCAR DEL SARA SARA'),
(51, 'SUCRE'),
(52, 'VICTOR FAJARDO'),
(53, 'VILCAS HUAMAN'),
(54, 'CAJAMARCA'),
(55, 'CAJABAMBA'),
(56, 'CELENDIN'),
(57, 'CHOTA '),
(58, 'CONTUMAZA'),
(59, 'CUTERVO'),
(60, 'HUALGAYOC'),
(61, 'JAEN'),
(62, 'SAN IGNACIO'),
(63, 'SAN MARCOS'),
(64, 'SAN PABLO'),
(65, 'SANTA CRUZ'),
(66, 'CALLAO'),
(67, 'CUSCO'),
(68, 'ACOMAYO'),
(69, 'ANTA'),
(70, 'CALCA'),
(71, 'CANAS'),
(72, 'CANCHIS'),
(73, 'CHUMBIVILCAS'),
(74, 'ESPINAR'),
(75, 'LA CONVENCION'),
(76, 'PARURO'),
(77, 'PAUCARTAMBO'),
(78, 'QUISPICANCHI'),
(79, 'URUBAMBA'),
(80, 'HUANCAVELICA'),
(81, 'ACOBAMBA'),
(82, 'ANGARAES'),
(83, 'CASTROVIRREYNA'),
(84, 'CHURCAMPA'),
(85, 'HUAYTARA'),
(86, 'TAYACAJA'),
(87, 'HUANUCO'),
(88, 'AMBO'),
(89, 'DOS DE MAYO'),
(90, 'HUACAYBAMBA'),
(91, 'HUAMALIES'),
(92, 'LEONCIO PRADO'),
(93, 'MARA&Ntilde;ON'),
(94, 'PACHITEA'),
(95, 'PUERTO INCA'),
(96, 'LAURICOCHA'),
(97, 'YAROWILCA'),
(98, 'ICA'),
(99, 'CHINCHA'),
(100, 'NAZCA'),
(101, 'PALPA'),
(102, 'PISCO'),
(103, 'HUANCAYO'),
(104, 'CONCEPCION'),
(105, 'CHANCHAMAYO'),
(106, 'JAUJA'),
(107, 'JUNIN'),
(108, 'SATIPO'),
(109, 'TARMA'),
(110, 'YAULI'),
(111, 'CHUPACA'),
(112, 'TRUJILLO'),
(113, 'ASCOPE'),
(114, 'BOLIVAR'),
(115, 'CHEPEN'),
(116, 'JULCAN'),
(117, 'OTUZCO'),
(118, 'PACASMAYO'),
(119, 'PATAZ'),
(120, 'SANCHEZ CARRION'),
(121, 'SANTIAGO DE CHUCO'),
(122, 'GRAN CHIMU'),
(123, 'VIRU'),
(124, 'CHICLAYO'),
(125, 'FERRE&Ntilde;AFE'),
(126, 'LAMBAYEQUE'),
(127, 'LIMA'),
(128, 'BARRANCA'),
(129, 'CAJATAMBO'),
(130, 'CANTA'),
(131, 'CA&Ntilde;ETE'),
(132, 'HUARAL'),
(133, 'HUAROCHIRI'),
(134, 'HUAURA'),
(135, 'OYON'),
(136, 'YAUYOS'),
(137, 'MAYNAS'),
(138, 'ALTO AMAZONAS'),
(139, 'LORETO'),
(140, 'MARISCAL RAMON CASTILLA'),
(141, 'REQUENA'),
(142, 'UCAYALI'),
(143, 'TAMBOPATA'),
(144, 'MANU'),
(145, 'TAHUAMANU'),
(146, 'MARISCAL NIETO'),
(147, 'GENERAL SANCHEZ CERRO'),
(148, 'ILO'),
(149, 'PASCO'),
(150, 'DANIEL ALCIDES CARRION'),
(151, 'OXAPAMPA'),
(152, 'PIURA'),
(153, 'AYABACA'),
(154, 'HUANCABAMBA'),
(155, 'MORROPON'),
(156, 'PAITA'),
(157, 'SULLANA'),
(158, 'TALARA'),
(159, 'SECHURA'),
(160, 'PUNO'),
(161, 'AZANGARO'),
(162, 'CARABAYA'),
(163, 'CHUCUITO'),
(164, 'EL COLLAO'),
(165, 'HUANCANE'),
(166, 'LAMPA'),
(167, 'MELGAR'),
(168, 'MOHO'),
(169, 'SAN ANTONIO DE PUTINA'),
(170, 'SAN ROMAN'),
(171, 'SANDIA'),
(172, 'YUNGUYO'),
(173, 'MOYOBAMBA'),
(174, 'BELLAVISTA'),
(175, 'EL DORADO'),
(176, 'HUALLAGA'),
(177, 'LAMAS'),
(178, 'MARISCAL CACERES'),
(179, 'PICOTA'),
(180, 'RIOJA'),
(181, 'SAN MARTIN'),
(182, 'TOCACHE'),
(183, 'TACNA'),
(184, 'CANDARAVE'),
(185, 'JORGE BASADRE'),
(186, 'TARATA'),
(187, 'TUMBES'),
(188, 'CONTRALMIRANTE VILLAR'),
(189, 'ZARUMILLA'),
(190, 'CORONEL PORTILLO'),
(191, 'ATALAYA'),
(192, 'PADRE ABAD'),
(193, 'PURUS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cronogramas`
--

CREATE TABLE `Cronogramas` (
  `Id` int(11) NOT NULL,
  `Cumplido` tinyint(1) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `Unidad_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetallesOperacion`
--

CREATE TABLE `DetallesOperacion` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Monto` double NOT NULL,
  `Operacion_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DocumentoExistente`
--

CREATE TABLE `DocumentoExistente` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Tipo_Documento_Id` int(11) NOT NULL,
  `Numero` varchar(100) NOT NULL,
  `Fecha_Legalizacion` date NOT NULL,
  `Numero_Folios` varchar(100) NOT NULL,
  `EstadoOperativo` varchar(20) NOT NULL,
  `Observaciones` varchar(200) NOT NULL,
  `Unidad_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Equipos`
--

CREATE TABLE `Equipos` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Modelo` varchar(30) NOT NULL,
  `NumeroSerie` varchar(30) NOT NULL,
  `Fecha_Fabricacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facultad`
--

CREATE TABLE `Facultad` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventarioBienes`
--

CREATE TABLE `InventarioBienes` (
  `Id` int(11) NOT NULL,
  `Cantidad` smallint(6) NOT NULL,
  `Estado` int(11) DEFAULT NULL COMMENT 'B(0) 	R(1) 	M(2)\r\nBueno 	Regular  Malo',
  `Observaciones` varchar(100) NOT NULL,
  `EstadoOperativo` tinyint(4) NOT NULL,
  `Unidad_Id` int(11) NOT NULL,
  `Bien_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventarioEquipos`
--

CREATE TABLE `InventarioEquipos` (
  `Id` int(11) NOT NULL,
  `Unidad_Id` int(11) NOT NULL,
  `Equipo_Id` int(11) NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Condicion` bit(1) DEFAULT NULL COMMENT 'Alquiler o Propio',
  `EstadoOperativo` tinyint(4) NOT NULL,
  `Observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventarioFisico`
--

CREATE TABLE `InventarioFisico` (
  `Id` int(11) NOT NULL,
  `TipoExistencia_Id` int(11) NOT NULL,
  `UnidadMedida_Id` int(11) NOT NULL,
  `Unidad_Id` int(11) NOT NULL,
  `Periodo` varchar(100) NOT NULL,
  `Descripcion_Existencia` varchar(100) NOT NULL,
  `Codigo_Existencia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InventarioFisico_Detalle`
--

CREATE TABLE `InventarioFisico_Detalle` (
  `Id` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Estado` tinyint(4) NOT NULL,
  `Edad` tinyint(4) NOT NULL,
  `Observaciones` varchar(100) NOT NULL,
  `InventarioFisico_Id` int(11) NOT NULL,
  `Material_Insumo_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Material_Insumo`
--

CREATE TABLE `Material_Insumo` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Operaciones`
--

CREATE TABLE `Operaciones` (
  `Id` int(11) NOT NULL,
  `Tipo` tinyint(4) NOT NULL,
  `Monto` double NOT NULL,
  `Unidad_Id` int(11) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personas`
--

CREATE TABLE `Personas` (
  `Dni` varchar(20) NOT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Web` varchar(100) DEFAULT NULL,
  `Nacimiento` date NOT NULL,
  `Genero` tinyint(4) NOT NULL,
  `UltimaConexion` date DEFAULT NULL,
  `Foto` varchar(200) DEFAULT NULL,
  `Informacion` varchar(400) DEFAULT NULL,
  `TipoUsuario` tinyint(4) NOT NULL DEFAULT '0',
  `Fecha_Ingreso` date DEFAULT NULL,
  `Condicion_Laboral` smallint(6) DEFAULT NULL,
  `Especialidad` varchar(100) DEFAULT NULL,
  `Cargo_Id` int(11) DEFAULT NULL,
  `Unidad_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Personas`
--

INSERT INTO `Personas` (`Dni`, `Username`, `Password`, `Nombres`, `Apellidos`, `Direccion`, `Telefono`, `Email`, `Web`, `Nacimiento`, `Genero`, `UltimaConexion`, `Foto`, `Informacion`, `TipoUsuario`, `Fecha_Ingreso`, `Condicion_Laboral`, `Especialidad`, `Cargo_Id`, `Unidad_Id`) VALUES
('1', 'admin', '$2y$10$5Hh9VUKl5hrdRT1/oNwix.XJ8pAzoW8f0HGu3dcnh4FOLt1oDxFfy', 'Administrador', 'General', '', 959003224, '', '', '1995-07-11', 1, NULL, NULL, '', 1, '0000-00-00', 1, '', 15, NULL),
('71498374', 'test', '$2y$10$elzdDHRudsvI/2C2oYsx0e9T59LKE.mYDCeTHc2J/YWMi9ic3/S92', 'test', 'test', '', 0, '', '', '2016-10-19', 1, '2016-10-28', 'imagenes/personas/71498374.jpg', '', 0, '2016-09-30', 1, '', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personas_Roles`
--

CREATE TABLE `Personas_Roles` (
  `Id` int(11) NOT NULL,
  `Dni` varchar(20) NOT NULL,
  `Rol_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personas_Titulos`
--

CREATE TABLE `Personas_Titulos` (
  `Id` int(11) NOT NULL,
  `Dni` varchar(20) NOT NULL,
  `Titulo_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rubros`
--

CREATE TABLE `Rubros` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Rubros`
--

INSERT INTO `Rubros` (`Id`, `Descripcion`) VALUES
(1, 'Agencias de Viajes y Turismo'),
(2, 'Aerolíneas'),
(3, 'Agencias de Publicidad'),
(4, 'Alquiler de vehículos'),
(5, 'Alimentos'),
(6, 'Bancos'),
(7, 'Bebidas'),
(8, 'Balnearios'),
(9, 'Barracas y Aserraderos'),
(10, 'Banquetes y Recepciones'),
(11, 'Construcción, Equipos y Maquinaria de'),
(12, 'Cuero, Curtiembres'),
(13, 'Canchas de Raquet / Wally'),
(14, 'Construcción, Materiales de'),
(15, 'Centro de Convenciones'),
(16, 'Dentistas'),
(17, 'Diarios y Periódicos'),
(18, 'Diseño Gráfico'),
(19, 'Delivery'),
(20, 'Diseño de Interiores'),
(21, 'Eventos'),
(22, 'Educación a Distancia'),
(23, 'Equipo e Instrumental Médico, Hospitalario'),
(24, 'Electricidad, Empresas de'),
(25, 'Educación Superior'),
(26, 'Florerías'),
(27, 'Flotas'),
(28, 'Fondos Financieros Privados'),
(29, 'Funerarias, Empresas de'),
(30, 'Ferreterías'),
(31, 'Gigantografías'),
(32, 'Gimnasios'),
(33, 'Gastronomía'),
(34, 'Guarderías, Kindergartens'),
(35, 'Galerías de Arte'),
(36, 'Hoteles'),
(37, 'Hotels'),
(38, 'Hoteles Resort'),
(39, 'Hamburguesas'),
(40, 'Heladerías'),
(41, 'Imprentas'),
(42, 'Industrias Alimenticias'),
(43, 'Industrias Textiles'),
(44, 'Industrias Químicas'),
(45, 'Importaciones'),
(46, 'Juguetes'),
(47, 'Joyerías'),
(48, 'Jabones'),
(49, 'Jugos de Frutas'),
(50, 'Juegos Inflables'),
(51, 'Kinder'),
(52, 'Karaokes'),
(53, 'Líneas Aéreas'),
(54, 'Laboratorios Farmacéuticos'),
(55, 'Laboratorios de Análisis Clínicos'),
(56, 'Ladrillos, Fábricas de'),
(57, 'Librerías y Papelerías'),
(58, 'Marketing'),
(59, 'Mueblerías'),
(60, 'Mudanzas'),
(61, 'Muebles de Oficina'),
(62, 'Muebles de Cocina'),
(63, 'Notarías'),
(64, 'Nichos'),
(65, 'Noticias, Agencias de'),
(66, 'Nacionalización de Mercadería'),
(67, 'Operadores Turisticos'),
(68, 'Operadores Logísticos'),
(69, 'Opticas'),
(70, 'Organizaciones Internacionales'),
(71, 'Organismos No Gubernamentales'),
(72, 'Pastelerías'),
(73, 'Peluquerías'),
(74, 'Plásticos, Fábricas de'),
(75, 'Panaderías y Pastelerías'),
(76, 'Petroleras: Empresas'),
(77, 'Químicos: Fabricación, Venta, Importación'),
(78, 'Quesos'),
(79, 'Quiroprácticos'),
(80, 'Rent a Car'),
(81, 'Restaurantes'),
(82, 'Restaurantes: Comida Criolla'),
(83, 'Restaurantes: Comida Internacional'),
(84, 'Restaurantes: Comida Rápida'),
(85, 'Serigrafía'),
(86, 'Servicio de Courier'),
(87, 'SPA'),
(88, 'Seguridad Física, Empresas de'),
(89, 'Salones de Fiestas'),
(90, 'Transporte de Carga Internacional'),
(91, 'Transporte Aéreo'),
(92, 'Turismo: Agencias de Viaje'),
(93, 'Transporte de Carga Nacional'),
(94, 'Transporte Terrestre'),
(95, 'Universidades'),
(96, 'Utiles Escolares'),
(97, 'Unidades Educativas'),
(98, 'Vuelos'),
(99, 'Vidrio, Fábricas de'),
(100, 'Veterinarias'),
(101, 'Vinos'),
(102, 'Venta de Autos'),
(103, 'Web y Multimedia'),
(104, 'Wraps'),
(105, 'Yogurt'),
(106, 'Yeso'),
(107, 'Zapatos, Fábricas'),
(108, 'Zonas Francas'),
(109, 'Zapatos, Ventas de'),
(110, 'Zapatos: Maquinarias, Materiales'),
(111, 'Zapaterías'),
(112, 'Comedor'),
(113, 'Nuevo'),
(114, 'Mineria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoExistencia`
--

CREATE TABLE `TipoExistencia` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoMaterial`
--

CREATE TABLE `TipoMaterial` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo_Comprobante_Documento`
--

CREATE TABLE `Tipo_Comprobante_Documento` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Titulos`
--

CREATE TABLE `Titulos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UnidadesProductivas`
--

CREATE TABLE `UnidadesProductivas` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Rubro_Id` int(11) NOT NULL,
  `Web` varchar(100) DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `Telefono_Anexo` int(11) DEFAULT NULL,
  `Fax` varchar(20) DEFAULT NULL,
  `Celular` int(11) DEFAULT NULL,
  `Ubicacion` varchar(100) DEFAULT NULL,
  `Ciudad_Id` int(11) NOT NULL,
  `Organigrama` varchar(200) DEFAULT NULL,
  `Facultad_Id` int(11) DEFAULT NULL,
  `Persona_Dni` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `UnidadesProductivas`
--

INSERT INTO `UnidadesProductivas` (`Id`, `Nombre`, `Rubro_Id`, `Web`, `Telefono`, `Telefono_Anexo`, `Fax`, `Celular`, `Ubicacion`, `Ciudad_Id`, `Organigrama`, `Facultad_Id`, `Persona_Dni`) VALUES
(1, 'CPS', 97, '', 0, 0, '', 0, '', 35, 'imagenes/unidadesproductivas/1.jpg', NULL, '71498374'),
(26, 'LABORATORIO DE ANALISIS FISICO - SERVILAB ', 44, '', 220360, 0, '', 987882315, 'Av. Independencia s/n - Ciudad Universitaria - Laboratorio 108 (1ª piso)', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(27, 'PLANTA DE SEGREGACION DE RIO SECO ', 113, '', 0, 0, '', 988444719, 'Parque Industrial Rio Seco - Cono Norte', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(28, 'PROYECTO DE FUNDICION Y MOLDEO ', 113, 'aicafae@hotmail.com', 225602, 0, '', 0, 'Av. Independencia s/n - Area Ingenierias ', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(29, 'IDUNSA', 113, '', 281710, 0, '', 0, 'Av. Venesuela s/n - Area Ciencias Sociales ', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(30, 'GASTRONOMIA Y ARTE CULINARIO ', 33, '', 0, 0, '', 0, 'Av. Daniel A. Carrion s/n - Apartado 23', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(31, 'UNIDAD DE CAPACITACION DE PRODUCCION Y SERVICIOS ', 25, '', 0, 0, '', 95855656, 'Av. Venezuela 427-A (3ª piso)', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(32, 'INSTITUTO DE LA NASA ', 113, '', 0, 0, '', 0, 'Castilla Postal 2995', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(33, 'INSTITUTO GEOFISICO DE CHARACATO ', 113, '', 0, 0, '', 0, 'Cerro San Francisco s/n Characato', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(34, 'INSTITUTO DE TRANSPORTE Y VIALIDAD', 94, '', 0, 0, '', 0, '', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(35, 'CENTRO ALPAQUERO DE SUMBAY', 113, '', 0, 0, '', 0, 'Centro poblado de Sumbay ', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(36, 'CIEPA MAJES', 113, 'bivehu27@outlook.com', 0, 0, '', 957903974, 'Centro poblado El Pedregal - Majes', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(37, 'CEPRE UNSA', 25, '', 221504, 0, '', 0, 'Calle San Agustin 108 2do Patio', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(38, 'DIRECCION UNIVERSITARIA DE PROCESO DE SELECCION (ADMISION)', 25, '', 287657, 0, '', 0, 'Calle Universidad s/n Cercado', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(39, 'PROYECTO DE SOLDADURA Y CONFORMADO', 113, '', 0, 0, '', 0, 'Av. Independencia s/n', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(40, 'LABORATORIO DE CORROSION DE MATERIALES', 113, '', 0, 0, '', 0, 'Av. Independencia s/n', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(41, 'LABORATORIO DE SERVICIOS INDUSTRIALES', 113, '', 228996, 0, '', 0, 'Av. Independencia s/n Area Ingenierias', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(42, 'INDEHI', 113, '', 0, 0, '', 0, 'Islay - Matarani', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(43, 'LABORATORIO DE MECANICA DE SUELOS PAVIMENTOS', 113, '', 289992, 0, '', 0, 'Calle Paucarpata s/n', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(44, 'LABORATORIO DE CONCRETO Y ENSAYO DE MATERIALES DE CONSTRUCCION', 14, '', 289992, 0, '', 0, 'Av. Independencia s/n - Area Ingenierias', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(45, 'INSTITUTO DE INFORMATICA ', 113, '', 391911, 0, '', 0, 'Av. Independencia s/n - Area Ingenierias', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(46, 'TV UNSA ', 65, 'germantv1@hotmail.com', 229922, 0, '', 0, 'Av. Independencia s/n - Area Ingenierias', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(47, 'CENTRO DE SALUD PEDRO P. DIAZ ', 23, '', 0, 0, '', 0, 'Urb. Pedro P. Diaz - Paucarpata', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(48, 'CENTRO UNIVERSITARIO DE SALUD RIO SECO', 23, '', 443869, 0, '', 0, 'Calle Libertad Mza O lote 25', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(49, 'LIBRERIA UNSA', 57, '', 218781, 0, '', 0, 'Calle San Agustin 108 2ª Patio', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(50, 'MUSEO UNSA ', 35, '', 288881, 0, '', 0, 'Calle Alvarez Thomas Nª 200', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(51, 'CARPINTERIA UNSA', 59, '', 0, 0, '', 0, 'Parque Industrial ', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(52, 'FIBRA DE VIDRIO ', 99, '', 0, 0, '', 959350380, 'Centro Produccion Jacobo Hunter ', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(53, 'HOSPITAL DOCENTE ', 23, '', 0, 0, '', 0, 'Av. Aeropuerto s/n A.H.Andres Belaunde - Cerro Colorado', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(54, 'PANIFICADORA UNSA', 75, '', 241612, 0, '', 0, 'Calle Paucarpata s/n - Ciudad Universitaria ', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(55, 'CENTRO DE MICROSCOPIA ELECTRONICA ', 113, 'violetagarciaromero@yahoo.es', 0, 0, '', 987846105, 'Av. Independencia s/n - Area Ingenierias', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(56, 'CUNA JARDIN UNSA', 34, 'ruthllerena20220@hotmail.com', 201275, 0, '', 978635224, 'Av. Independencia s/n - Estadio Hochi Min', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(57, 'CENTRO DE IDIOMAS ', 113, '', 247524, 0, '', 0, 'Calle San Agustin 105 - Cercado', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(58, 'PROYECTO DE SERVICIOS INDUSTRIALES ', 113, 'sigisalas@hotmail.com', 228986, 0, '', 959242653, 'Av. Independencia s/n - Area Ingenierias', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(59, 'PROMOCION Y COORDINACION CULTURAL ', 113, '', 0, 0, '', 0, 'Calle San Agustin 108 2ª Patio', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(60, 'LABORATORIO DE SUELOS ', 113, '', 0, 0, '', 0, 'Urb. Aurora s/n', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(61, 'LABORATORIO DE ANALISIS CLINICOS', 55, '', 203591, 0, '', 0, 'Av. Alcides Carrion Nº 101 ', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(62, 'CONSULTORIO NUTRICIONAL ', 113, '', 0, 0, '', 0, 'Av. Alcides Carrion Nº 101', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(63, 'INSTITUTO DEL ADOLESCENTE ', 113, '', 219266, 0, '', 0, 'Av. Alcides Carrion Nº 101', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(64, 'LABORATORIO BROMATOLOGICO Y CONTROL DE CALIDAD DE LOS ALIMENTOS ', 113, 'daccsnut@unsa.edu.pe', 417098, 0, '', 0, 'Av. Alcides Carrion Nº 101', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(65, 'AULA MAGNA ', 21, '', 0, 0, '', 968012305, 'Av. Alcides Carrion Nº 101', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(66, 'LABORATORIO DE FISIOLOGIA Y BIOTECNOLOGIA VEGETAL ', 113, 'hlazon@hotmail.com', 0, 0, '', 942723607, 'Av. Alcides Carrion Nº 101', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL),
(67, 'INPEGAS UNSA ', 24, '', 0, 0, '', 0, 'Av. Independencia s/n - Area Ingenierias', 35, 'imagenes/unidadesproductivas/organigrama.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UnidadMedida`
--

CREATE TABLE `UnidadMedida` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Bienes`
--
ALTER TABLE `Bienes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tipomaterial_bienes_fk` (`TipoMaterial_Id`);

--
-- Indices de la tabla `Cargos`
--
ALTER TABLE `Cargos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `cargos_cargos_fk` (`CargoSuperior`);

--
-- Indices de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Cronogramas`
--
ALTER TABLE `Cronogramas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `unidadesproductivas_cronogramas_fk` (`Unidad_Id`);

--
-- Indices de la tabla `DetallesOperacion`
--
ALTER TABLE `DetallesOperacion`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `operaciones_detalles_fk` (`Operacion_Id`);

--
-- Indices de la tabla `DocumentoExistente`
--
ALTER TABLE `DocumentoExistente`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tipo_comprobante_documento_documentoexistente_fk` (`Tipo_Documento_Id`),
  ADD KEY `unidadesproductivas_documentoexistente_fk` (`Unidad_Id`);

--
-- Indices de la tabla `Equipos`
--
ALTER TABLE `Equipos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Facultad`
--
ALTER TABLE `Facultad`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `InventarioBienes`
--
ALTER TABLE `InventarioBienes`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `bienes_inventariobienes_fk` (`Bien_Id`),
  ADD KEY `unidadesproductivas_inventariobienes_fk` (`Unidad_Id`);

--
-- Indices de la tabla `InventarioEquipos`
--
ALTER TABLE `InventarioEquipos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `equipos_inventario_fk` (`Equipo_Id`),
  ADD KEY `unidadesproductivas_inventario_fk` (`Unidad_Id`);

--
-- Indices de la tabla `InventarioFisico`
--
ALTER TABLE `InventarioFisico`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `tipoexistencia_inventariofisico_fk` (`TipoExistencia_Id`),
  ADD KEY `unidadmedida_inventariofisico_fk` (`UnidadMedida_Id`),
  ADD KEY `unidadesproductivas_inventariofisico_fk` (`Unidad_Id`);

--
-- Indices de la tabla `InventarioFisico_Detalle`
--
ALTER TABLE `InventarioFisico_Detalle`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `material_insumo_inventariofisico_detalle_fk` (`Material_Insumo_Id`),
  ADD KEY `inventariofisico_inventariofisico_detalle_fk` (`InventarioFisico_Id`);

--
-- Indices de la tabla `Material_Insumo`
--
ALTER TABLE `Material_Insumo`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Operaciones`
--
ALTER TABLE `Operaciones`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `unidadesproductivas_operaciones_fk` (`Unidad_Id`);

--
-- Indices de la tabla `Personas`
--
ALTER TABLE `Personas`
  ADD PRIMARY KEY (`Dni`),
  ADD KEY `cargos_personas_fk` (`Cargo_Id`),
  ADD KEY `unidadesproductivas_personas_fk` (`Unidad_Id`);

--
-- Indices de la tabla `Personas_Roles`
--
ALTER TABLE `Personas_Roles`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `roles_personas_roles_fk` (`Rol_Id`),
  ADD KEY `personas_personas_roles_fk` (`Dni`);

--
-- Indices de la tabla `Personas_Titulos`
--
ALTER TABLE `Personas_Titulos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `titulos_personas_titulos_fk` (`Titulo_Id`),
  ADD KEY `personas_personas_titulos_fk` (`Dni`);

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Rubros`
--
ALTER TABLE `Rubros`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `TipoExistencia`
--
ALTER TABLE `TipoExistencia`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `TipoMaterial`
--
ALTER TABLE `TipoMaterial`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Tipo_Comprobante_Documento`
--
ALTER TABLE `Tipo_Comprobante_Documento`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `Titulos`
--
ALTER TABLE `Titulos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `UnidadesProductivas`
--
ALTER TABLE `UnidadesProductivas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `facultad_unidadesproductivas_fk` (`Facultad_Id`),
  ADD KEY `ciudades_unidadesproductivas_fk` (`Ciudad_Id`),
  ADD KEY `rubros_unidadesproductivas_fk` (`Rubro_Id`),
  ADD KEY `personas_unidadesproductivas_fk` (`Persona_Dni`);

--
-- Indices de la tabla `UnidadMedida`
--
ALTER TABLE `UnidadMedida`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Bienes`
--
ALTER TABLE `Bienes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Cargos`
--
ALTER TABLE `Cargos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `Ciudades`
--
ALTER TABLE `Ciudades`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT de la tabla `Cronogramas`
--
ALTER TABLE `Cronogramas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `DetallesOperacion`
--
ALTER TABLE `DetallesOperacion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `DocumentoExistente`
--
ALTER TABLE `DocumentoExistente`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Facultad`
--
ALTER TABLE `Facultad`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `InventarioBienes`
--
ALTER TABLE `InventarioBienes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `InventarioFisico`
--
ALTER TABLE `InventarioFisico`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `InventarioFisico_Detalle`
--
ALTER TABLE `InventarioFisico_Detalle`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Operaciones`
--
ALTER TABLE `Operaciones`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Personas_Roles`
--
ALTER TABLE `Personas_Roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Personas_Titulos`
--
ALTER TABLE `Personas_Titulos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Rubros`
--
ALTER TABLE `Rubros`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT de la tabla `Titulos`
--
ALTER TABLE `Titulos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `UnidadesProductivas`
--
ALTER TABLE `UnidadesProductivas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Bienes`
--
ALTER TABLE `Bienes`
  ADD CONSTRAINT `tipomaterial_bienes_fk` FOREIGN KEY (`TipoMaterial_Id`) REFERENCES `TipoMaterial` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Cargos`
--
ALTER TABLE `Cargos`
  ADD CONSTRAINT `cargos_cargos_fk` FOREIGN KEY (`CargoSuperior`) REFERENCES `Cargos` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Cronogramas`
--
ALTER TABLE `Cronogramas`
  ADD CONSTRAINT `unidadesproductivas_cronogramas_fk` FOREIGN KEY (`Unidad_Id`) REFERENCES `UnidadesProductivas` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `DetallesOperacion`
--
ALTER TABLE `DetallesOperacion`
  ADD CONSTRAINT `operaciones_detalles_fk` FOREIGN KEY (`Operacion_Id`) REFERENCES `Operaciones` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `DocumentoExistente`
--
ALTER TABLE `DocumentoExistente`
  ADD CONSTRAINT `tipo_comprobante_documento_documentoexistente_fk` FOREIGN KEY (`Tipo_Documento_Id`) REFERENCES `Tipo_Comprobante_Documento` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidadesproductivas_documentoexistente_fk` FOREIGN KEY (`Unidad_Id`) REFERENCES `UnidadesProductivas` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `InventarioBienes`
--
ALTER TABLE `InventarioBienes`
  ADD CONSTRAINT `bienes_inventariobienes_fk` FOREIGN KEY (`Bien_Id`) REFERENCES `Bienes` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidadesproductivas_inventariobienes_fk` FOREIGN KEY (`Unidad_Id`) REFERENCES `UnidadesProductivas` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `InventarioEquipos`
--
ALTER TABLE `InventarioEquipos`
  ADD CONSTRAINT `equipos_inventario_fk` FOREIGN KEY (`Equipo_Id`) REFERENCES `Equipos` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidadesproductivas_inventario_fk` FOREIGN KEY (`Unidad_Id`) REFERENCES `UnidadesProductivas` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `InventarioFisico`
--
ALTER TABLE `InventarioFisico`
  ADD CONSTRAINT `tipoexistencia_inventariofisico_fk` FOREIGN KEY (`TipoExistencia_Id`) REFERENCES `TipoExistencia` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidadesproductivas_inventariofisico_fk` FOREIGN KEY (`Unidad_Id`) REFERENCES `UnidadesProductivas` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidadmedida_inventariofisico_fk` FOREIGN KEY (`UnidadMedida_Id`) REFERENCES `UnidadMedida` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `InventarioFisico_Detalle`
--
ALTER TABLE `InventarioFisico_Detalle`
  ADD CONSTRAINT `inventariofisico_inventariofisico_detalle_fk` FOREIGN KEY (`InventarioFisico_Id`) REFERENCES `InventarioFisico` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `material_insumo_inventariofisico_detalle_fk` FOREIGN KEY (`Material_Insumo_Id`) REFERENCES `Material_Insumo` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Operaciones`
--
ALTER TABLE `Operaciones`
  ADD CONSTRAINT `unidadesproductivas_operaciones_fk` FOREIGN KEY (`Unidad_Id`) REFERENCES `UnidadesProductivas` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Personas`
--
ALTER TABLE `Personas`
  ADD CONSTRAINT `cargos_personas_fk` FOREIGN KEY (`Cargo_Id`) REFERENCES `Cargos` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `unidadesproductivas_personas_fk` FOREIGN KEY (`Unidad_Id`) REFERENCES `UnidadesProductivas` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Personas_Roles`
--
ALTER TABLE `Personas_Roles`
  ADD CONSTRAINT `personas_personas_roles_fk` FOREIGN KEY (`Dni`) REFERENCES `Personas` (`Dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `roles_personas_roles_fk` FOREIGN KEY (`Rol_Id`) REFERENCES `Roles` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Personas_Titulos`
--
ALTER TABLE `Personas_Titulos`
  ADD CONSTRAINT `personas_personas_titulos_fk` FOREIGN KEY (`Dni`) REFERENCES `Personas` (`Dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `titulos_personas_titulos_fk` FOREIGN KEY (`Titulo_Id`) REFERENCES `Titulos` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `UnidadesProductivas`
--
ALTER TABLE `UnidadesProductivas`
  ADD CONSTRAINT `ciudades_unidadesproductivas_fk` FOREIGN KEY (`Ciudad_Id`) REFERENCES `Ciudades` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `facultad_unidadesproductivas_fk` FOREIGN KEY (`Facultad_Id`) REFERENCES `Facultad` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `personas_unidadesproductivas_fk` FOREIGN KEY (`Persona_Dni`) REFERENCES `Personas` (`Dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rubros_unidadesproductivas_fk` FOREIGN KEY (`Rubro_Id`) REFERENCES `Rubros` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
