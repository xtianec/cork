-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2025 a las 14:49:25
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
(15, 5, 1, '2025-06-23 16:13:00', 4, 4.00, '4', NULL, '2025-06-23 09:14:01', '2025-06-28 01:17:56'),
(16, 5, 1, '2025-06-24 19:22:00', 3, 3.00, '', NULL, '2025-06-24 12:23:34', '2025-06-24 12:23:34'),
(17, 5, 2, '2025-06-24 19:27:00', 4, 4.00, 'r4', NULL, '2025-06-24 12:28:05', '2025-06-24 12:28:05'),
(18, 2, 2, '2025-06-24 19:28:00', 3, 4.00, '12', NULL, '2025-06-24 12:28:31', '2025-06-24 12:28:31'),
(20, 2, 2, '2025-06-24 19:31:00', 2, 2.00, '', NULL, '2025-06-24 12:31:55', '2025-06-24 12:31:55'),
(21, 2, 2, '2025-06-24 19:31:00', 2, 2.00, '', NULL, '2025-06-24 12:32:10', '2025-06-24 12:32:10'),
(22, 5, 3, '2025-06-24 19:33:00', 4, 4.00, '', NULL, '2025-06-24 12:33:28', '2025-06-24 12:33:28'),
(23, 5, 3, '2025-06-24 19:41:00', 3, 33.00, '', NULL, '2025-06-24 12:41:30', '2025-06-24 12:41:30'),
(24, 5, 3, '2025-06-24 19:41:00', 3, 33.00, '3', NULL, '2025-06-24 12:41:33', '2025-06-24 12:41:33'),
(25, 5, 1, '2025-06-24 19:41:00', 3, 3.00, '', NULL, '2025-06-24 12:42:01', '2025-06-24 12:42:01'),
(26, 4, 2, '2025-06-24 19:42:00', 3, 33.00, '', NULL, '2025-06-24 12:42:38', '2025-06-24 12:42:38'),
(27, 5, 2, '2025-06-24 19:46:00', 23, 3.00, '22', NULL, '2025-06-24 12:46:52', '2025-06-24 12:46:52'),
(28, 5, 1, '2025-06-24 19:47:00', 33, 3.00, '', NULL, '2025-06-24 12:47:36', '2025-06-24 12:47:36'),
(29, 1, 2, '2025-06-25 05:04:00', 3, 3.00, '', NULL, '2025-06-24 22:06:48', '2025-06-24 22:06:48'),
(30, 5, 2, '2025-06-28 06:33:00', 34, 3.00, '222', NULL, '2025-06-27 23:33:20', '2025-06-27 23:33:20'),
(31, 5, 2, '2025-06-28 06:33:00', 34, 3.00, '222', NULL, '2025-06-27 23:33:22', '2025-06-27 23:33:22'),
(32, 5, 2, '2025-06-28 06:33:00', 34, 3.00, '222', NULL, '2025-06-27 23:33:23', '2025-06-27 23:33:23'),
(33, 5, 2, '2025-06-28 06:33:00', 34, 3.00, '222', NULL, '2025-06-27 23:33:23', '2025-06-27 23:33:23'),
(34, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:24', '2025-06-28 00:03:24'),
(35, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:26', '2025-06-28 00:03:26'),
(36, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:27', '2025-06-28 00:03:27'),
(37, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:27', '2025-06-28 00:03:27'),
(38, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:27', '2025-06-28 00:03:27'),
(39, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:27', '2025-06-28 00:03:27'),
(40, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:28', '2025-06-28 00:03:28'),
(41, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:28', '2025-06-28 00:03:28'),
(42, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:28', '2025-06-28 00:03:28'),
(43, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:28', '2025-06-28 00:03:28'),
(44, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:28', '2025-06-28 00:03:28'),
(45, 4, 1, '2025-06-28 07:03:00', 4, 3.00, '12211', NULL, '2025-06-28 00:03:29', '2025-06-28 00:03:29'),
(46, 5, 1, '2025-06-28 07:05:00', 3, 3.00, '112', NULL, '2025-06-28 00:06:08', '2025-06-28 00:06:08'),
(47, 5, 1, '2025-06-28 07:09:00', 3, 3.00, '3', NULL, '2025-06-28 00:09:22', '2025-06-28 00:09:22'),
(48, 5, 1, '2025-06-28 07:09:00', 5, 5.00, '5', NULL, '2025-06-28 00:09:50', '2025-06-28 00:09:50'),
(49, 5, 1, '2025-06-28 07:11:00', 3, 3.00, '', NULL, '2025-06-28 00:11:54', '2025-06-28 00:11:54'),
(50, 1, 1, '2025-06-28 08:33:00', 1, 1.00, '1', NULL, '2025-06-28 01:33:31', '2025-06-28 01:33:31'),
(51, 4, 1, '2025-06-28 08:33:00', 3, 3.00, '3', NULL, '2025-06-28 01:33:47', '2025-06-28 01:33:47'),
(52, 5, 2, '2025-06-28 09:30:00', 5, 2.00, '22', NULL, '2025-06-28 02:30:57', '2025-06-28 02:30:57'),
(53, 5, 1, '2025-06-28 09:30:00', 4, 2.00, '22', NULL, '2025-06-28 02:31:02', '2025-06-28 02:31:16'),
(54, 5, 1, '2025-06-28 09:31:00', 2, 2.00, '', NULL, '2025-06-28 02:31:08', '2025-06-28 02:31:08'),
(55, 5, 1, '2025-06-28 09:31:00', 2, 2.00, '2', NULL, '2025-06-28 02:31:12', '2025-06-28 02:31:12'),
(56, 4, 1, '2025-06-28 09:31:00', 4, 4.00, '4', NULL, '2025-06-28 02:31:34', '2025-06-28 02:31:34'),
(57, 4, 1, '2025-06-28 09:31:00', 4, 4.00, '4', NULL, '2025-06-28 02:31:39', '2025-06-28 02:31:39'),
(58, 5, 1, '2025-06-28 09:34:00', 5, 4.00, '45', NULL, '2025-06-28 02:35:13', '2025-06-28 02:35:45'),
(59, 5, 1, '2025-06-28 09:35:00', 4, 4.00, '23', NULL, '2025-06-28 02:35:51', '2025-06-28 02:36:30'),
(60, 5, 1, '2025-06-28 09:36:00', 4, 4.00, '4', NULL, '2025-06-28 02:36:36', '2025-06-28 02:36:36'),
(61, 5, 1, '2025-06-28 09:37:00', 3, 3.00, '3', NULL, '2025-06-28 02:37:11', '2025-06-28 02:37:11'),
(62, 5, 1, '2025-06-28 09:37:00', 4, 0.02, '', NULL, '2025-06-28 02:37:54', '2025-06-28 02:37:54'),
(63, 5, 1, '2025-06-28 09:45:00', 4, 4.00, '4', NULL, '2025-06-28 02:46:05', '2025-06-28 02:46:05'),
(64, 5, 1, '2025-06-28 09:45:00', 4, 4.00, '4', NULL, '2025-06-28 02:46:05', '2025-06-28 02:46:05'),
(65, 5, 1, '2025-06-28 09:45:00', 4, 4.00, '4', NULL, '2025-06-28 02:46:06', '2025-06-28 02:46:06'),
(66, 5, 1, '2025-06-28 09:45:00', 4, 4.00, '4', NULL, '2025-06-28 02:46:06', '2025-06-28 02:46:06'),
(67, 5, 1, '2025-06-28 09:46:00', 4, 4.00, '422eew', NULL, '2025-06-28 02:46:47', '2025-06-28 02:48:20'),
(69, 5, 1, '2025-06-28 09:46:00', 2, 2.00, '3', NULL, '2025-06-28 02:48:31', '2025-06-28 02:48:31'),
(70, 5, 1, '2025-06-28 09:46:00', 1, 1.00, '1', NULL, '2025-06-28 02:49:00', '2025-06-28 02:49:00'),
(71, 5, 1, '2025-06-28 09:49:00', 11, 1.00, '11', NULL, '2025-06-28 02:49:30', '2025-06-28 02:49:30'),
(72, 5, 1, '2025-06-28 09:51:00', 3, 3.00, '', NULL, '2025-06-28 02:51:38', '2025-06-28 02:51:38'),
(73, 5, 1, '2025-06-28 09:53:00', 233, 2.44, '3343', NULL, '2025-06-28 02:53:25', '2025-06-28 04:04:03'),
(106, 5, 1, '2025-06-28 11:03:00', 4, 4.00, '4', 1, '2025-06-28 04:04:15', '2025-06-28 04:04:15'),
(107, 4, 1, '2025-06-28 11:08:00', 5, 3.00, '1', 1, '2025-06-28 04:08:55', '2025-06-28 04:08:55'),
(108, 4, 2, '2025-06-28 11:08:00', 4, 4.00, '', 1, '2025-06-28 04:09:09', '2025-06-28 04:09:09'),
(109, 4, 1, '2025-06-28 11:09:00', 1, 1.00, '', 1, '2025-06-28 04:09:43', '2025-06-28 04:09:43'),
(110, 4, 1, '2025-06-28 11:09:00', 2, 2.00, '', 1, '2025-06-28 04:09:53', '2025-06-28 04:09:53'),
(111, 4, 1, '2025-06-28 11:09:00', 50, 5.00, '3', 1, '2025-06-28 04:10:09', '2025-06-28 04:10:09'),
(112, 4, 2, '2025-06-28 11:10:00', 100, 4.00, '', 1, '2025-06-28 04:10:23', '2025-06-28 04:10:23'),
(113, 4, 1, '2025-06-28 11:10:00', 20, 4.00, '22', 1, '2025-06-28 04:10:42', '2025-06-28 04:10:42'),
(114, 2, 1, '2025-06-28 11:10:00', 1, 1.00, '1', 1, '2025-06-28 04:11:28', '2025-06-28 04:11:28'),
(115, 4, 1, '2025-06-28 11:18:00', 49, 4.00, '', 1, '2025-06-28 04:19:06', '2025-06-28 04:19:06'),
(118, 4, 2, '2025-06-28 12:28:00', 22, 2.00, '', 1, '2025-06-28 05:29:33', '2025-06-28 05:29:33'),
(119, 4, 2, '2025-06-30 14:54:00', 12, 2.00, '', 1, '2025-06-30 07:54:35', '2025-06-30 07:54:35'),
(120, 6, 2, '2025-06-30 15:07:00', 5, 5.00, '', 1, '2025-06-30 08:08:00', '2025-06-30 08:08:00'),
(121, 6, 1, '2025-06-30 15:08:00', 12, 12.00, '12', 1, '2025-06-30 08:08:54', '2025-06-30 08:08:54');

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
(1, 'gsdfearsf', 'wwwww', 'efdaeefffffffffffffffffffffffff', 'sdffdghgfgfdsfgds', 1, 2, 1, 1, 1, 500, 4.00, 8.00, -1, 'uploads/art_6853a1f631130.jpg', 1, '2025-06-18 23:23:30', '2025-06-28 01:33:31'),
(2, 'sasdasdf', 'sdfdfsaaaa', 'sfdasdfa', 'asfddfasfadssdfa', 1, 2, 1, 1, 2, 100, 12.70, 25.33, -4, '', 1, '2025-06-18 23:46:02', '2025-06-28 04:11:28'),
(4, 'eferf', '34r34', 'efffsd', 'ffdfsfsddf', 1, 4, 2, 1, 5, 12, 20.00, 500.00, 50, '', 1, '2025-06-19 00:51:22', '2025-06-30 07:54:35'),
(5, '2212344', '243234', '234234342324342', 'sdfdsdsf', 1, 2, 1, 3, 5, 6, 12.00, 15.00, 203, '', 1, '2025-06-19 00:55:18', '2025-06-28 05:30:38'),
(6, 'aaaaaaaaaaaaaaa', 'aaaa', 'aaaaaa', 'aaaaaaaaaaaaaa', 5, 6, 4, 1, 5, 200, 5.00, 12.00, 12, 'uploads/art_68628c044b2b3.png', 1, '2025-06-30 08:07:16', '2025-06-30 08:08:54'),
(7, '11', '22', 'COMPRESOR AIRES', 'SSS', 5, 6, 4, 1, 1, 12, 5.00, 12.00, 1, 'uploads/art_686366f47a392.png', 1, '2025-06-30 23:41:24', '2025-06-30 23:41:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `empleado_id`, `fecha`, `hora_entrada`, `hora_salida`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-07-04', '08:20:00', '17:02:00', 1, '2025-07-04 07:42:54', '2025-07-04 07:42:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_cliente`
--

CREATE TABLE `atencion_cliente` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Abierto',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_log`
--

CREATE TABLE `audit_log` (
  `id` bigint(20) NOT NULL,
  `tabla` varchar(40) NOT NULL,
  `registro_id` int(11) NOT NULL,
  `accion` enum('CREATE','UPDATE','DELETE','RESTORE') NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detalle`)),
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `audit_log`
--

INSERT INTO `audit_log` (`id`, `tabla`, `registro_id`, `accion`, `user_id`, `detalle`, `fecha`) VALUES
(1, 'usuario', 5, 'CREATE', 1, '{\"username\":\"2343245452\"}', '2025-06-30 15:27:47');

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

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Gerente General', 1, '2025-06-30 23:41:54', '2025-06-30 23:41:54'),
(2, 'SubGerente', 1, '2025-06-30 23:42:28', '2025-06-30 23:42:28'),
(3, 'Vendedor', 1, '2025-06-30 23:42:36', '2025-06-30 23:42:36');

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
  `estado` enum('Generado','Enviado','Aceptado','Rechazado','Anulado') DEFAULT 'Generado',
  `archivo_xml` varchar(255) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL,
  `cdr` varchar(255) DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comprobante_electronico`
--

INSERT INTO `comprobante_electronico` (`id`, `tipo_comprobante`, `serie`, `numero`, `fecha_emision`, `cliente_id`, `cliente_ruc`, `moneda`, `subtotal`, `igv`, `total`, `estado`, `archivo_xml`, `archivo_pdf`, `cdr`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 'Factura', 'F001', 1, '2025-06-26 21:37:04', 10, '20601664292', 'PEN', 30.00, 5.40, 35.40, 'Anulado', NULL, NULL, NULL, '', '2025-06-26 21:37:04', '2025-06-26 21:37:56');

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
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto_total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `estado_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Volcado de datos para la tabla `detalle_comprobante`
--

INSERT INTO `detalle_comprobante` (`id`, `comprobante_id`, `articulo_id`, `cantidad`, `precio_unitario`, `subtotal`, `igv`, `total`) VALUES
(1, 1, 1, 5.00, 6.00, 30.00, 5.40, 35.40);

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
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `apellido`, `dni`, `email`, `telefono`, `cargo_id`, `fecha_ingreso`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Cristhian', 'Cuadros', '60470100', 'espino.cristhian@gmail.com', '09999999', 1, '2025-03-02', 1, '2025-06-30 23:43:11', '2025-06-30 23:43:11');

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
-- Estructura de tabla para la tabla `evaluacion_proveedor`
--

CREATE TABLE `evaluacion_proveedor` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `calificacion` int(11) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, 'qw4yur', 1, '2025-06-24 22:22:54', '2025-06-24 22:22:54'),
(6, 'compresores', 1, '2025-06-30 08:05:31', '2025-06-30 08:05:31');

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
(1, 'ddassdagfdasf', 1, '2025-06-18 18:52:38', '2025-06-30 07:54:07'),
(2, 'weqedwe', 1, '2025-06-19 00:33:36', '2025-06-19 00:33:36'),
(3, 'dfdsaasdf', 1, '2025-06-19 00:33:40', '2025-06-19 00:33:40'),
(4, 'TOYOTA', 1, '2025-06-24 22:23:33', '2025-06-24 22:23:33'),
(5, 'AAAAAAAAAAAAA', 1, '2025-06-30 08:06:10', '2025-06-30 08:06:10');

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
(1, 'prueba1', 'prueba12233', 1, '2025-06-24 21:53:21', '2025-06-30 09:46:39'),
(2, 'inventario', '111', 1, '2025-06-30 09:15:09', '2025-06-30 09:40:56'),
(3, 'Inventario', '/inventario', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(4, 'Ventas', '/ventas', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(5, 'Contabilidad', '/conta', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(6, 'Inventario', '/inventario', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(7, 'Ventas', '/ventas', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(8, 'Contabilidad', '/conta', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(9, 'Inventario', '/inventario', 1, '2025-06-30 10:06:25', '2025-06-30 10:06:25'),
(10, 'Ventas', '/ventas', 1, '2025-06-30 10:06:25', '2025-06-30 10:06:25'),
(11, 'Contabilidad', '/conta', 1, '2025-06-30 10:06:25', '2025-06-30 10:06:25');

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
-- Estructura de tabla para la tabla `orden_compra`
--

CREATE TABLE `orden_compra` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `solicitud_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `estado_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo`
--

CREATE TABLE `orden_trabajo` (
  `id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo_tarea`
--

CREATE TABLE `orden_trabajo_tarea` (
  `id` int(11) NOT NULL,
  `orden_trabajo_id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `horas` decimal(8,2) DEFAULT NULL,
  `costo_hora` decimal(14,2) DEFAULT NULL,
  `costo_total` decimal(14,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_venta`
--

CREATE TABLE `pedido_venta` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto_total` decimal(14,2) NOT NULL DEFAULT 0.00,
  `estado_id` int(11) NOT NULL,
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

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `modulo_id`, `accion`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 1, '224', 1, '2025-06-30 09:41:12', '2025-06-30 09:48:07'),
(4, 1, 'crear', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(5, 1, 'editar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(6, 1, 'eliminar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(7, 1, 'ver', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(8, 2, 'crear', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(9, 2, 'editar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(10, 2, 'eliminar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(11, 2, 'ver', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(12, 3, 'crear', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(13, 3, 'editar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(14, 3, 'eliminar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(15, 3, 'ver', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(16, 4, 'crear', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(17, 4, 'editar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(18, 4, 'eliminar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(19, 4, 'ver', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(20, 5, 'crear', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(21, 5, 'editar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(22, 5, 'eliminar', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(23, 5, 'ver', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04'),
(35, 1, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(36, 1, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(37, 1, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(38, 1, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(39, 2, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(40, 2, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(41, 2, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(42, 2, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(43, 3, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(44, 3, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(45, 3, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(46, 3, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(47, 4, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(48, 4, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(49, 4, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(50, 4, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(51, 5, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(52, 5, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(53, 5, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(54, 5, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(55, 6, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(56, 6, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(57, 6, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(58, 6, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(59, 7, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(60, 7, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(61, 7, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(62, 7, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(63, 8, 'crear', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(64, 8, 'editar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(65, 8, 'eliminar', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(66, 8, 'ver', 1, '2025-06-30 10:06:17', '2025-06-30 10:06:17'),
(98, 1, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(99, 1, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(100, 1, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(101, 1, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(102, 2, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(103, 2, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(104, 2, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(105, 2, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(106, 3, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(107, 3, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(108, 3, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(109, 3, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(110, 4, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(111, 4, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(112, 4, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(113, 4, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(114, 5, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(115, 5, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(116, 5, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(117, 5, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(118, 6, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(119, 6, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(120, 6, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(121, 6, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(122, 7, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(123, 7, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(124, 7, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(125, 7, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(126, 8, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(127, 8, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(128, 8, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(129, 8, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(130, 9, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(131, 9, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(132, 9, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(133, 9, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(134, 10, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(135, 10, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(136, 10, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(137, 10, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(138, 11, 'crear', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(139, 11, 'editar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(140, 11, 'eliminar', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40'),
(141, 11, 'ver', 1, '2025-06-30 10:06:40', '2025-06-30 10:06:40');

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
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion_mercancia`
--

CREATE TABLE `recepcion_mercancia` (
  `id` int(11) NOT NULL,
  `orden_compra_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'prueba1', 1, '2025-06-24 21:47:52', '2025-06-30 09:48:02', NULL),
(2, 'prueba 2', 1, '2025-06-24 21:53:04', '2025-06-24 21:53:04', NULL),
(3, 'Administrador', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04', NULL),
(6, 'Adminin', 1, '2025-06-30 10:07:06', '2025-06-30 10:07:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`rol_id`, `permiso_id`) VALUES
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serie_comprobante`
--

CREATE TABLE `serie_comprobante` (
  `id` int(11) NOT NULL,
  `tipo_comprobante` enum('Factura','Boleta') NOT NULL,
  `serie` varchar(4) NOT NULL,
  `ultimo_numero` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `serie_comprobante`
--

INSERT INTO `serie_comprobante` (`id`, `tipo_comprobante`, `serie`, `ultimo_numero`) VALUES
(1, 'Factura', 'F001', 1),
(2, 'Boleta', 'B001', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_compra`
--

CREATE TABLE `solicitud_compra` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado_id` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(3, 5, '32terter', 1, '2025-06-24 22:23:01', '2025-06-24 22:23:01'),
(4, 6, 'compresores con aire', 1, '2025-06-30 08:05:48', '2025-06-30 08:05:48');

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
(1, 'aadsfadsf', 1, '2025-06-18 18:52:32', '2025-06-30 08:06:20'),
(2, 'sdfdfghfds', 1, '2025-06-18 22:29:18', '2025-06-30 08:06:23');

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
  `email` varchar(120) NOT NULL,
  `password` varchar(256) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `email`, `password`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '22222', '1', '$2y$10$jqO29QaH/r4bV8s3GtFz5O9LHDBRLW3V9yK/dDCZbVaObSSHL8dgW', 1, '2025-06-24 21:54:18', '2025-06-30 10:02:57', NULL),
(2, '1234', '2', '$2y$10$wqBxq/WhURCV9KDjMm.TMe4yhGYuYFVuE8C9GwkFEfiKjZWugIdwa', 1, '2025-06-30 09:14:05', '2025-06-30 10:03:00', NULL),
(3, 'admin', 'admin@local', '$2y$10$2K0Y9Kb6PrE8rQWO9gQryO9DcUNRIqf6E/4o1CClUJIijfB20uq4a', 1, '2025-06-30 10:06:04', '2025-06-30 10:06:04', NULL),
(5, '2343245452', 'espino.cristhian@gmail.com', '$2y$10$KpbqLhGMbLxJnZQY2WuB0uug8SmHshMknEKnNiPJ63k65qwT8Oo..', 1, '2025-06-30 10:27:47', '2025-06-30 10:27:47', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_modulo_rol`
--

CREATE TABLE `usuario_modulo_rol` (
  `usuario_id` int(11) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 2),
(2, 1),
(2, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacacion`
--

CREATE TABLE `vacacion` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `dias` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

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
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `atencion_cliente`
--
ALTER TABLE `atencion_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `estado_id` (`estado_id`);

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
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_id` (`cargo_id`);

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
-- Indices de la tabla `evaluacion_proveedor`
--
ALTER TABLE `evaluacion_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

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
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`),
  ADD KEY `solicitud_id` (`solicitud_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `proyecto_id` (`proyecto_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `orden_trabajo_tarea`
--
ALTER TABLE `orden_trabajo_tarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_trabajo_id` (`orden_trabajo_id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `pedido_venta`
--
ALTER TABLE `pedido_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `estado_id` (`estado_id`);

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
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recepcion_mercancia`
--
ALTER TABLE `recepcion_mercancia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_compra_id` (`orden_compra_id`);

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
-- Indices de la tabla `serie_comprobante`
--
ALTER TABLE `serie_comprobante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_tipo_serie` (`tipo_comprobante`,`serie`);

--
-- Indices de la tabla `solicitud_compra`
--
ALTER TABLE `solicitud_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`estado_id`);

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
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `idx_usr_username` (`username`),
  ADD UNIQUE KEY `idx_usr_email` (`email`);

--
-- Indices de la tabla `usuario_modulo_rol`
--
ALTER TABLE `usuario_modulo_rol`
  ADD PRIMARY KEY (`usuario_id`,`modulo_id`),
  ADD KEY `fk_umr_modulo` (`modulo_id`),
  ADD KEY `fk_umr_rol` (`rol_id`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`usuario_id`,`rol_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `vacacion`
--
ALTER TABLE `vacacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen_movimiento`
--
ALTER TABLE `almacen_movimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `atencion_cliente`
--
ALTER TABLE `atencion_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_comprobante`
--
ALTER TABLE `detalle_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_guia`
--
ALTER TABLE `detalle_guia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT de la tabla `evaluacion_proveedor`
--
ALTER TABLE `evaluacion_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo_tarea`
--
ALTER TABLE `orden_trabajo_tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_venta`
--
ALTER TABLE `pedido_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recepcion_mercancia`
--
ALTER TABLE `recepcion_mercancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `serie_comprobante`
--
ALTER TABLE `serie_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicitud_compra`
--
ALTER TABLE `solicitud_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sublinea`
--
ALTER TABLE `sublinea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vacacion`
--
ALTER TABLE `vacacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
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
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `atencion_cliente`
--
ALTER TABLE `atencion_cliente`
  ADD CONSTRAINT `atencion_cliente_fk` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_cliente_fk` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cotizacion_estado_fk` FOREIGN KEY (`estado_id`) REFERENCES `estado_cotizacion` (`id`) ON UPDATE CASCADE;

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
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluacion_proveedor`
--
ALTER TABLE `evaluacion_proveedor`
  ADD CONSTRAINT `evaluacion_proveedor_prov_fk` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `guia_remision_electronica`
--
ALTER TABLE `guia_remision_electronica`
  ADD CONSTRAINT `guia_remision_electronica_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `orden_compra_estado_fk` FOREIGN KEY (`estado_id`) REFERENCES `estado_orden_compra` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_compra_proveedor_fk` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_compra_solicitud_fk` FOREIGN KEY (`solicitud_id`) REFERENCES `solicitud_compra` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD CONSTRAINT `orden_trabajo_estado_fk` FOREIGN KEY (`estado_id`) REFERENCES `estado_orden_trabajo` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_trabajo_proyecto_fk` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_venta`
--
ALTER TABLE `pedido_venta`
  ADD CONSTRAINT `pedido_venta_cliente_fk` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_venta_estado_fk` FOREIGN KEY (`estado_id`) REFERENCES `estado_documento` (`id`) ON UPDATE CASCADE;

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
-- Filtros para la tabla `recepcion_mercancia`
--
ALTER TABLE `recepcion_mercancia`
  ADD CONSTRAINT `recepcion_mercancia_orden_fk` FOREIGN KEY (`orden_compra_id`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_compra`
--
ALTER TABLE `solicitud_compra`
  ADD CONSTRAINT `solicitud_compra_estado_fk` FOREIGN KEY (`estado_id`) REFERENCES `estado_orden_compra` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sublinea`
--
ALTER TABLE `sublinea`
  ADD CONSTRAINT `sublinea_ibfk_1` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_modulo_rol`
--
ALTER TABLE `usuario_modulo_rol`
  ADD CONSTRAINT `fk_umr_modulo` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_umr_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_umr_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vacacion`
--
ALTER TABLE `vacacion`
  ADD CONSTRAINT `vacacion_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
