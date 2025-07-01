-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2025 a las 04:20:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pacific_compressor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_movimiento`
--

CREATE TABLE `almacen_movimiento` (
  `id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `tipo_movimiento_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(14,2) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `almacen_movimiento`
--

INSERT INTO `almacen_movimiento` (`id`, `articulo_id`, `tipo_movimiento_id`, `fecha`, `cantidad`, `precio_unitario`, `referencia`, `usuario_id`, `created_at`, `updated_at`) VALUES
(10, 5, 3, '2025-06-23 15:33:00', 3, 4.00, 'gfhj', NULL, '2025-06-23 08:33:55', '2025-06-23 08:33:55'),
(12, 4, 1, '2025-06-23 15:45:00', 5, 4.00, '222222222222', NULL, '2025-06-23 08:46:15', '2025-06-23 08:46:15'),
(14, 1, 3, '2025-06-23 16:02:00', 2, 5.00, '', NULL, '2025-06-23 09:02:56', '2025-06-24 12:23:46'),
(15, 5, 1, '2025-06-23 16:13:00', 4, 4.00, '4', NULL, '2025-06-23 09:14:01', '2025-06-23 09:14:01'),
(16, 5, 1, '2025-06-24 19:22:00', 3, 3.00, '', NULL, '2025-06-24 12:23:34', '2025-06-24 12:23:34'),
(17, 5, 2, '2025-06-24 19:27:00', 4, 4.00, 'r4', NULL, '2025-06-24 12:28:05', '2025-06-24 12:28:05'),
(18, 2, 2, '2025-06-24 19:28:00', 3, 4.00, '12', NULL, '2025-06-24 12:28:31', '2025-06-24 12:28:31'),
(19, 5, 1, '2025-06-24 19:30:00', 3, 3.00, '', NULL, '2025-06-24 12:31:04', '2025-06-24 12:31:04'),
(20, 2, 2, '2025-06-24 19:31:00', 2, 2.00, '', NULL, '2025-06-24 12:31:55', '2025-06-24 12:31:55'),
(21, 2, 2, '2025-06-24 19:31:00', 2, 2.00, '', NULL, '2025-06-24 12:32:10', '2025-06-24 12:32:10'),
(22, 5, 3, '2025-06-24 19:33:00', 4, 4.00, '', NULL, '2025-06-24 12:33:28', '2025-06-24 12:33:28'),
(23, 5, 3, '2025-06-24 19:41:00', 3, 33.00, '', NULL, '2025-06-24 12:41:30', '2025-06-24 12:41:30'),
(24, 5, 3, '2025-06-24 19:41:00', 3, 33.00, '3', NULL, '2025-06-24 12:41:33', '2025-06-24 12:41:33'),
(25, 5, 1, '2025-06-24 19:41:00', 3, 3.00, '', NULL, '2025-06-24 12:42:01', '2025-06-24 12:42:01'),
(26, 4, 2, '2025-06-24 19:42:00', 3, 33.00, '', NULL, '2025-06-24 12:42:38', '2025-06-24 12:42:38'),
(27, 5, 2, '2025-06-24 19:46:00', 23, 3.00, '22', NULL, '2025-06-24 12:46:52', '2025-06-24 12:46:52'),
(28, 5, 1, '2025-06-24 19:47:00', 33, 3.00, '', NULL, '2025-06-24 12:47:36', '2025-06-24 12:47:36'),
(29, 1, 2, '2025-06-25 05:04:00', 3, 3.00, '', NULL, '2025-06-24 22:06:48', '2025-06-24 22:06:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `numero_parte` varchar(50) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `linea_id` int(11) DEFAULT NULL,
  `sublinea_id` int(11) DEFAULT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL DEFAULT 0,
  `stock_maximo` int(11) DEFAULT NULL,
  `precio_costo` decimal(14,2) NOT NULL DEFAULT 0.00,
  `precio_venta` decimal(14,2) NOT NULL DEFAULT 0.00,
  `stock_actual` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id`, `codigo`, `numero_parte`, `nombre`, `descripcion`, `marca_id`, `linea_id`, `sublinea_id`, `unidad_medida_id`, `stock_minimo`, `stock_maximo`, `precio_costo`, `precio_venta`, `stock_actual`, `imagen`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'gsdfearsf', 'wwwww', 'efdaeefffffffffffffffffffffffff', 'sdffdghgfgfdsfgds', 1, 2, 1, 1, 1, 500, 4.00, 8.00, 0, 'uploads/art_6853a1f631130.jpg', 1, '2025-06-18 23:23:30', '2025-06-24 22:22:38'),
(2, 'sasdasdf', 'sdfdfsaaaa', 'sfdasdfa', 'asfddfasfadssdfa', 1, 2, 1, 1, 2, 100, 12.70, 25.33, -5, '', 1, '2025-06-18 23:46:02', '2025-06-24 22:22:34'),
(4, 'eferf', '34r34', 'efffsd', 'ffdfsfsddf', 1, 4, 2, 1, 5, 12, 20.00, 500.00, 7, '', 1, '2025-06-19 00:51:22', '2025-06-24 12:42:38'),
(5, '2212344', '243234', '234234342324342', 'sdfdsdsf', 1, 2, 1, 3, 5, 6, 12.00, 15.00, 37, '', 1, '2025-06-19 00:55:18', '2025-06-24 12:47:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_cliente`
--

CREATE TABLE `categoria_cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_cliente`
--

INSERT INTO `categoria_cliente` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'dd', 0, '2025-06-18 12:26:28', '2025-06-18 17:09:43'),
(2, 'dxdd', 0, '2025-06-18 12:32:50', '2025-06-18 17:09:45'),
(3, 'fddfg', 1, '2025-06-18 12:43:35', '2025-06-18 12:43:35'),
(4, 'f', 1, '2025-06-18 13:21:12', '2025-06-18 13:21:12'),
(5, 'fddefds', 1, '2025-06-18 17:09:39', '2025-06-18 17:09:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_proveedor`
--

CREATE TABLE `categoria_proveedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria_proveedor`
--

INSERT INTO `categoria_proveedor` (`id`, `nombre`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'ff', '2025-06-18 13:41:15', '2025-06-18 13:41:15', 1),
(2, 'asasds', '2025-06-18 17:09:51', '2025-06-18 17:09:54', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `ruc` varchar(11) NOT NULL,
  `razon_social` varchar(200) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `direccion_fiscal` varchar(300) DEFAULT NULL,
  `direccion_planta` varchar(300) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `distrito` varchar(100) DEFAULT NULL,
  `telefono_fijo` varchar(20) DEFAULT NULL,
  `telefono_movil` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `web` varchar(150) DEFAULT NULL,
  `contacto_responsable` varchar(150) DEFAULT NULL,
  `cargo_contacto` varchar(100) DEFAULT NULL,
  `telefono_contacto` varchar(20) DEFAULT NULL,
  `email_contacto` varchar(150) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `ruc`, `razon_social`, `categoria_id`, `estado`, `fecha_registro`, `direccion_fiscal`, `direccion_planta`, `departamento`, `provincia`, `distrito`, `telefono_fijo`, `telefono_movil`, `email`, `web`, `contacto_responsable`, `cargo_contacto`, `telefono_contacto`, `email_contacto`, `created_at`, `updated_at`) VALUES
(1, 'aaaaa', 'dddddd', 3, 1, '2025-06-19 10:57:13', 'Lima Mz K17 Lt2', 'Lima Mz K17 Lt2', 'ddd', 'Gobierno Regional de Lima', 'dd', '323135243524', '234234', 'aa@net', 'https://www.gob.pe/reniec', 'dd', 'dd', 'dd', '354@gmail.com', '2025-06-19 10:57:13', '2025-06-20 02:21:38'),
(4, '32423434', '4234232323', 4, 1, '2025-06-19 11:55:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-19 11:55:26', '2025-06-20 01:19:13'),
(5, '2122222', 'eeee', 5, 1, '2025-06-20 01:19:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-20 01:19:50', '2025-06-20 01:19:50'),
(9, '66666666666', '222', 5, 1, '2025-06-20 02:16:36', 'Lima Mz K17 Lt2', 'Lima Mz K17 Lt2', 'aa', 'Gobierno Regional de Lima', 'aa', 'd43243', '234234', 'espino.cristhian@gmail.com', 'https://www.gob.pe/reniec', 'aa', 'aa', 'aa', '354@gmail.com', '2025-06-20 02:16:36', '2025-06-20 02:16:36'),
(10, '20601664292', 'sdfadsfgdfgs', 4, 1, '2025-06-20 02:21:27', 'Lima Mz K17 Lt2', 'Lima Mz K17 Lt2', 'lima', 'Gobierno Regional de Lima', 'aa', 'd43243', '234234', 'espino.cristhian@gmail.com', 'https://www.gob.pe/reniec', 'aa', 'sss', 'ss', 'ssss@gmail.com', '2025-06-20 02:21:27', '2025-06-20 02:21:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_contacto`
--

CREATE TABLE `cliente_contacto` (
  `cliente_id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_electronico`
--

CREATE TABLE `comprobante_electronico` (
  `id` int(11) NOT NULL,
  `tipo_comprobante` enum('Factura','Boleta') NOT NULL,
  `serie` varchar(10) NOT NULL DEFAULT 'F001',
  `numero` int(11) NOT NULL,
  `fecha_emision` datetime NOT NULL DEFAULT current_timestamp(),
  `cliente_id` int(11) NOT NULL,
  `cliente_ruc` varchar(11) NOT NULL,
  `moneda` char(3) NOT NULL DEFAULT 'PEN',
  `subtotal` decimal(12,2) NOT NULL,
  `igv` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `estado` enum('Generado','Enviado','Aceptado','Rechazado') DEFAULT 'Generado',
  `archivo_xml` varchar(255) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL,
  `cdr` varchar(255) DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `cargo`, `telefono`, `email`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'cristhia', 'aaa', 'aa', '13@gmail.com', 1, '2025-06-18 17:30:15', '2025-06-18 17:30:15'),
(2, 'dasd', 'asddas', 'adasd', 'aa@net', 0, '2025-06-18 17:32:11', '2025-06-18 17:32:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comprobante`
--

CREATE TABLE `detalle_comprobante` (
  `id` int(11) NOT NULL,
  `comprobante_id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `cantidad` decimal(12,2) NOT NULL,
  `precio_unitario` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `igv` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_guia`
--

CREATE TABLE `detalle_guia` (
  `id` int(11) NOT NULL,
  `guia_id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `cantidad` decimal(12,2) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_modelo`
--

CREATE TABLE `equipo_modelo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipo_modelo`
--

INSERT INTO `equipo_modelo` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'afsdfdsadasf', 1, '2025-06-18 17:36:45', '2025-06-18 17:40:28'),
(2, 'asdadfgsasdrf', 1, '2025-06-18 17:36:51', '2025-06-18 17:36:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_tipo`
--

CREATE TABLE `equipo_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipo_tipo`
--

INSERT INTO `equipo_tipo` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'assaasffffffffffffff', 1, '2025-06-18 17:46:15', '2025-06-18 17:47:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cotizacion`
--

CREATE TABLE `estado_cotizacion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_cotizacion`
--

INSERT INTO `estado_cotizacion` (`id`, `descripcion`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'aaftghtryh', 1, '2025-06-18 17:55:50', '2025-06-18 19:13:49'),
(2, 'DFBFDGHJKLNJKL', 1, '2025-06-18 18:23:48', '2025-06-18 19:16:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_documento`
--

CREATE TABLE `estado_documento` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_documento`
--

INSERT INTO `estado_documento` (`id`, `descripcion`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'saasd', 1, '2025-06-18 18:23:25', '2025-06-18 18:23:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_equipos`
--

CREATE TABLE `estado_equipos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_equipos`
--

INSERT INTO `estado_equipos` (`id`, `descripcion`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'asdfs', 1, '2025-06-18 18:23:30', '2025-06-18 18:23:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_orden_compra`
--

CREATE TABLE `estado_orden_compra` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_orden_compra`
--

INSERT INTO `estado_orden_compra` (`id`, `descripcion`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'PendienteS', 1, '2025-06-16 17:27:59', '2025-06-18 18:26:09'),
(2, 'Recepcionada', 1, '2025-06-16 17:27:59', '2025-06-16 17:27:59'),
(3, 'Facturada', 1, '2025-06-16 17:27:59', '2025-06-16 17:27:59'),
(4, 'Cerrada', 1, '2025-06-16 17:27:59', '2025-06-16 17:27:59'),
(5, 'fasdsfdgdfga', 1, '2025-06-18 18:23:34', '2025-06-18 18:23:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_orden_trabajo`
--

CREATE TABLE `estado_orden_trabajo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_orden_trabajo`
--

INSERT INTO `estado_orden_trabajo` (`id`, `descripcion`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'asDASF', 1, '2025-06-18 18:23:40', '2025-06-18 18:23:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE `forma_pago` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_remision_electronica`
--

CREATE TABLE `guia_remision_electronica` (
  `id` int(11) NOT NULL,
  `serie` varchar(10) NOT NULL,
  `numero` int(11) NOT NULL,
  `fecha_emision` datetime DEFAULT current_timestamp(),
  `cliente_id` int(11) NOT NULL,
  `direccion_partida` varchar(250) DEFAULT NULL,
  `direccion_llegada` varchar(250) DEFAULT NULL,
  `motivo_traslado` varchar(100) DEFAULT NULL,
  `modalidad_traslado` varchar(100) DEFAULT NULL,
  `transportista_ruc` varchar(11) DEFAULT NULL,
  `placa_vehiculo` varchar(10) DEFAULT NULL,
  `archivo_xml` varchar(255) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL,
  `cdr` varchar(255) DEFAULT NULL,
  `estado` enum('Generado','Enviado','Aceptado','Rechazado') DEFAULT 'Generado',
  `observaciones` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_rem_modalidad`
--

CREATE TABLE `guia_rem_modalidad` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia_rem_motivo`
--

CREATE TABLE `guia_rem_motivo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'prueba1rrdfsadsfadfsa', 1, '2025-06-18 11:52:05', '2025-06-18 19:09:46'),
(2, 'asas', 1, '2025-06-18 17:22:26', '2025-06-18 23:06:19'),
(3, 'fddfasfasddf', 1, '2025-06-18 18:52:47', '2025-06-18 23:06:13'),
(4, 'eertrte', 1, '2025-06-18 19:12:07', '2025-06-18 23:06:16'),
(5, 'qw4yur', 1, '2025-06-24 22:22:54', '2025-06-24 22:22:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ddassdagfdasf', 0, '2025-06-18 18:52:38', '2025-06-24 22:23:37'),
(2, 'weqedwe', 1, '2025-06-19 00:33:36', '2025-06-19 00:33:36'),
(3, 'dfdsaasdf', 1, '2025-06-19 00:33:40', '2025-06-19 00:33:40'),
(4, 'TOYOTA', 1, '2025-06-24 22:23:33', '2025-06-24 22:23:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruta` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id`, `nombre`, `ruta`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'prueba1', 'prueba1', 1, '2025-06-24 21:53:21', '2025-06-24 21:53:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `id` int(11) NOT NULL,
  `codigo` char(3) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `accion` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `ruc` varchar(11) NOT NULL,
  `razon_social` varchar(200) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `direccion` varchar(300) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `distrito` varchar(100) DEFAULT NULL,
  `telefono_fijo` varchar(20) DEFAULT NULL,
  `telefono_movil` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `web` varchar(150) DEFAULT NULL,
  `contacto_responsable` varchar(150) DEFAULT NULL,
  `cargo_contacto` varchar(100) DEFAULT NULL,
  `telefono_contacto` varchar(20) DEFAULT NULL,
  `email_contacto` varchar(150) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'prueba1', 1, '2025-06-24 21:47:52', '2025-06-24 21:47:52'),
(2, 'prueba 2', 1, '2025-06-24 21:53:04', '2025-06-24 21:53:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sublinea`
--

CREATE TABLE `sublinea` (
  `id` int(11) NOT NULL,
  `linea_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sublinea`
--

INSERT INTO `sublinea` (`id`, `linea_id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'ASDFDAS', 1, '2025-06-18 19:01:47', '2025-06-18 19:01:47'),
(2, 4, 'dsfg', 1, '2025-06-18 19:12:31', '2025-06-18 19:13:12'),
(3, 5, '32terter', 1, '2025-06-24 22:23:01', '2025-06-24 22:23:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_articulo`
--

CREATE TABLE `tipo_articulo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_articulo`
--

INSERT INTO `tipo_articulo` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'aadsfadsf', 0, '2025-06-18 18:52:32', '2025-06-19 00:33:29'),
(2, 'sdfdfghfds', 0, '2025-06-18 22:29:18', '2025-06-19 00:33:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento_almacen`
--

CREATE TABLE `tipo_movimiento_almacen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_movimiento_almacen`
--

INSERT INTO `tipo_movimiento_almacen` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Ingreso', '2025-06-16 17:27:59', '2025-06-16 17:27:59'),
(2, 'Salida', '2025-06-16 17:27:59', '2025-06-16 17:27:59'),
(3, 'Devolucion', '2025-06-16 17:27:59', '2025-06-16 17:27:59'),
(4, 'prueba', '2025-06-20 11:11:41', '2025-06-20 11:11:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_retencion`
--

CREATE TABLE `tipo_retencion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_retencion`
--

INSERT INTO `tipo_retencion` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Anticipo', '2025-06-16 17:27:59', '2025-06-16 17:27:59'),
(2, 'Detraccion', '2025-06-16 17:27:59', '2025-06-16 17:27:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'aaa', 1, '2025-06-18 18:52:27', '2025-06-18 18:52:27'),
(2, 'DASFDFASFADS', 0, '2025-06-18 19:03:52', '2025-06-18 19:07:55'),
(3, 'S', 1, '2025-06-18 19:04:29', '2025-06-18 19:04:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `estado`, `created_at`, `updated_at`) VALUES
(1, '22222', '$2y$10$jqO29QaH/r4bV8s3GtFz5O9LHDBRLW3V9yK/dDCZbVaObSSHL8dgW', 1, '2025-06-24 21:54:18', '2025-06-24 21:54:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`usuario_id`, `rol_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Estructura Stand-in para la vista `vw_inventario_actual`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_inventario_actual` (
`articulo_id` int(11)
,`codigo` varchar(50)
,`nombre` varchar(200)
,`stock_actual` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_kardex`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_kardex` (
`id` int(11)
,`fecha` datetime
,`articulo_id` int(11)
,`articulo_codigo` varchar(50)
,`articulo_nombre` varchar(200)
,`tipo_movimiento` varchar(50)
,`entrada` int(11)
,`salida` int(11)
,`precio_unitario` decimal(14,2)
,`saldo` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_inventario_actual`
--
DROP TABLE IF EXISTS `vw_inventario_actual`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_inventario_actual`  AS SELECT `a`.`id` AS `articulo_id`, `a`.`codigo` AS `codigo`, `a`.`nombre` AS `nombre`, coalesce(sum(case when `tm`.`nombre` in ('Ingreso','Devolucion') then `am`.`cantidad` else -`am`.`cantidad` end),0) AS `stock_actual` FROM ((`articulo` `a` left join `almacen_movimiento` `am` on(`am`.`articulo_id` = `a`.`id`)) left join `tipo_movimiento_almacen` `tm` on(`tm`.`id` = `am`.`tipo_movimiento_id`)) GROUP BY `a`.`id`, `a`.`codigo`, `a`.`nombre` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_kardex`
--
DROP TABLE IF EXISTS `vw_kardex`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_kardex`  AS SELECT `m`.`id` AS `id`, `m`.`fecha` AS `fecha`, `m`.`articulo_id` AS `articulo_id`, `a`.`codigo` AS `articulo_codigo`, `a`.`nombre` AS `articulo_nombre`, `t`.`nombre` AS `tipo_movimiento`, CASE WHEN `t`.`nombre` in ('Ingreso','Devolucion') THEN `m`.`cantidad` ELSE 0 END AS `entrada`, CASE WHEN `t`.`nombre` = 'Salida' THEN `m`.`cantidad` ELSE 0 END AS `salida`, `m`.`precio_unitario` AS `precio_unitario`, sum(case when `t`.`nombre` in ('Ingreso','Devolucion') then `m`.`cantidad` when `t`.`nombre` = 'Salida' then -`m`.`cantidad` else 0 end) over ( partition by `m`.`articulo_id` order by `m`.`fecha`,`m`.`id` rows between  unbounded  preceding and  current row ) AS `saldo` FROM ((`almacen_movimiento` `m` join `articulo` `a` on(`a`.`id` = `m`.`articulo_id`)) join `tipo_movimiento_almacen` `t` on(`t`.`id` = `m`.`tipo_movimiento_id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen_movimiento`
--
ALTER TABLE `almacen_movimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`),
  ADD KEY `tipo_movimiento_id` (`tipo_movimiento_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `marca_id` (`marca_id`),
  ADD KEY `linea_id` (`linea_id`),
  ADD KEY `sublinea_id` (`sublinea_id`),
  ADD KEY `unidad_medida_id` (`unidad_medida_id`);

--
-- Indices de la tabla `categoria_cliente`
--
ALTER TABLE `categoria_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_proveedor`
--
ALTER TABLE `categoria_proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruc` (`ruc`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `cliente_contacto`
--
ALTER TABLE `cliente_contacto`
  ADD PRIMARY KEY (`cliente_id`,`contacto_id`),
  ADD KEY `contacto_id` (`contacto_id`);

--
-- Indices de la tabla `comprobante_electronico`
--
ALTER TABLE `comprobante_electronico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_comprobante`
--
ALTER TABLE `detalle_comprobante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comprobante_id` (`comprobante_id`),
  ADD KEY `articulo_id` (`articulo_id`);

--
-- Indices de la tabla `detalle_guia`
--
ALTER TABLE `detalle_guia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guia_id` (`guia_id`),
  ADD KEY `articulo_id` (`articulo_id`);

--
-- Indices de la tabla `equipo_modelo`
--
ALTER TABLE `equipo_modelo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo_tipo`
--
ALTER TABLE `equipo_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_cotizacion`
--
ALTER TABLE `estado_cotizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_documento`
--
ALTER TABLE `estado_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_equipos`
--
ALTER TABLE `estado_equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_orden_compra`
--
ALTER TABLE `estado_orden_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_orden_trabajo`
--
ALTER TABLE `estado_orden_trabajo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guia_remision_electronica`
--
ALTER TABLE `guia_remision_electronica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `guia_rem_modalidad`
--
ALTER TABLE `guia_rem_modalidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `guia_rem_motivo`
--
ALTER TABLE `guia_rem_motivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulo_id` (`modulo_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruc` (`ruc`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`rol_id`,`permiso_id`),
  ADD KEY `permiso_id` (`permiso_id`);

--
-- Indices de la tabla `sublinea`
--
ALTER TABLE `sublinea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linea_id` (`linea_id`);

--
-- Indices de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_movimiento_almacen`
--
ALTER TABLE `tipo_movimiento_almacen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipo_retencion`
--
ALTER TABLE `tipo_retencion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`usuario_id`,`rol_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_id` (`cargo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen_movimiento`
--
ALTER TABLE `almacen_movimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria_cliente`
--
ALTER TABLE `categoria_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria_proveedor`
--
ALTER TABLE `categoria_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `comprobante_electronico`
--
ALTER TABLE `comprobante_electronico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_comprobante`
--
ALTER TABLE `detalle_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_guia`
--
ALTER TABLE `detalle_guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo_modelo`
--
ALTER TABLE `equipo_modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equipo_tipo`
--
ALTER TABLE `equipo_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_cotizacion`
--
ALTER TABLE `estado_cotizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estado_documento`
--
ALTER TABLE `estado_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_equipos`
--
ALTER TABLE `estado_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estado_orden_compra`
--
ALTER TABLE `estado_orden_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_orden_trabajo`
--
ALTER TABLE `estado_orden_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guia_remision_electronica`
--
ALTER TABLE `guia_remision_electronica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guia_rem_modalidad`
--
ALTER TABLE `guia_rem_modalidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guia_rem_motivo`
--
ALTER TABLE `guia_rem_motivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sublinea`
--
ALTER TABLE `sublinea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_articulo`
--
ALTER TABLE `tipo_articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento_almacen`
--
ALTER TABLE `tipo_movimiento_almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_retencion`
--
ALTER TABLE `tipo_retencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen_movimiento`
--
ALTER TABLE `almacen_movimiento`
  ADD CONSTRAINT `almacen_movimiento_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `almacen_movimiento_ibfk_2` FOREIGN KEY (`tipo_movimiento_id`) REFERENCES `tipo_movimiento_almacen` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `almacen_movimiento_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `articulo_ibfk_3` FOREIGN KEY (`sublinea_id`) REFERENCES `sublinea` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `articulo_ibfk_4` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medida` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_cliente` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente_contacto`
--
ALTER TABLE `cliente_contacto`
  ADD CONSTRAINT `cliente_contacto_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_contacto_ibfk_2` FOREIGN KEY (`contacto_id`) REFERENCES `contacto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comprobante_electronico`
--
ALTER TABLE `comprobante_electronico`
  ADD CONSTRAINT `comprobante_electronico_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `detalle_comprobante`
--
ALTER TABLE `detalle_comprobante`
  ADD CONSTRAINT `detalle_comprobante_ibfk_1` FOREIGN KEY (`comprobante_id`) REFERENCES `comprobante_electronico` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_comprobante_ibfk_2` FOREIGN KEY (`articulo_id`) REFERENCES `articulo` (`id`);

--
-- Filtros para la tabla `detalle_guia`
--
ALTER TABLE `detalle_guia`
  ADD CONSTRAINT `detalle_guia_ibfk_1` FOREIGN KEY (`guia_id`) REFERENCES `guia_remision_electronica` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_guia_ibfk_2` FOREIGN KEY (`articulo_id`) REFERENCES `articulo` (`id`);

--
-- Filtros para la tabla `guia_remision_electronica`
--
ALTER TABLE `guia_remision_electronica`
  ADD CONSTRAINT `guia_remision_electronica_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_proveedor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sublinea`
--
ALTER TABLE `sublinea`
  ADD CONSTRAINT `sublinea_ibfk_1` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
