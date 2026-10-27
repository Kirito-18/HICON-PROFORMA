-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2026 a las 22:42:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hicon_proformas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_01_000001_create_proformas_table', 1),
(2, '2024_01_01_000002_create_proforma_items_table', 1),
(3, '0001_01_01_000000_create_users_table', 2),
(4, '0001_01_01_000001_create_cache_table', 2),
(5, '0001_01_01_000002_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proformas`
--

CREATE TABLE `proformas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `cliente_nombre` varchar(255) DEFAULT NULL,
  `cliente_ruc` varchar(255) DEFAULT NULL,
  `cliente_direccion` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `moneda` varchar(10) NOT NULL DEFAULT 'PEN',
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `igv` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notas` text DEFAULT NULL,
  `estado` enum('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proformas`
--

INSERT INTO `proformas` (`id`, `numero`, `cliente_nombre`, `cliente_ruc`, `cliente_direccion`, `fecha`, `fecha_vencimiento`, `moneda`, `subtotal`, `igv`, `total`, `notas`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'PROF-000001', 'Cliente Ejemplo S.A.C.', '20123456789', 'Av. Floral 123, Juliaca', '2026-02-24', '2026-03-24', 'PEN', 3407.63, 613.37, 4021.00, 'Precios incluyen IGV. Garantía de 12 meses en equipos. Entrega en 3 días hábiles.', 'pendiente', '2026-03-18 03:53:16', '2026-03-27 10:29:03'),
(2, 'PROF-000002', 'Municipalidad de Juliaca', '20601234567', 'Plaza de Armas s/n, Juliaca', '2026-03-01', '2026-03-31', 'PEN', 6600.00, 1188.00, 7788.00, 'Cotización para área de sistemas. Sujeto a disponibilidad de stock.', 'aprobado', '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(5, 'PROF-000003', NULL, NULL, NULL, '2026-04-09', NULL, 'PEN', 296.61, 53.39, 350.00, NULL, 'pendiente', '2026-04-09 08:05:29', '2026-04-09 08:23:54'),
(6, 'PROF-000006', NULL, NULL, NULL, '2026-04-09', NULL, 'PEN', 3470.34, 624.66, 4095.00, NULL, 'rechazado', '2026-04-09 19:49:14', '2026-04-09 20:00:56'),
(7, 'PROF-000007', NULL, NULL, NULL, '2026-04-15', NULL, 'PEN', 537.29, 96.71, 634.00, NULL, 'pendiente', '2026-04-15 19:40:51', '2026-04-15 19:50:07'),
(8, 'PROF-000008', 'Erick', '69656545', 'Juliaca', '2026-05-02', NULL, 'PEN', 216.10, 38.90, 255.00, NULL, 'pendiente', '2026-05-02 19:28:05', '2026-05-02 19:28:06'),
(9, 'PROF-000009', 'Erick', '69656545', 'Juliaca', '2026-05-02', NULL, 'PEN', 323.73, 58.27, 382.00, NULL, 'pendiente', '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(10, 'PROF-000010', NULL, NULL, 'Juliaca', '2026-05-07', NULL, 'PEN', 33.90, 6.10, 40.00, NULL, 'pendiente', '2026-05-07 20:56:14', '2026-05-07 20:57:51'),
(11, 'PROF-000011', 'Institución Educativa Javier Heraut', NULL, NULL, '2026-05-25', NULL, 'PEN', 582.20, 104.80, 687.00, NULL, 'pendiente', '2026-05-25 23:34:35', '2026-05-26 00:13:10'),
(12, 'PROF-000012', NULL, NULL, NULL, '2026-05-25', NULL, 'PEN', 22.03, 3.97, 26.00, NULL, 'pendiente', '2026-05-26 00:00:46', '2026-05-26 00:01:06'),
(13, 'PROF-000013', NULL, NULL, NULL, '2026-06-25', NULL, 'PEN', 0.00, 0.00, 0.00, NULL, 'pendiente', '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(14, 'PROF-000014', NULL, NULL, NULL, '2026-08-28', NULL, 'PEN', 8.47, 1.53, 10.00, NULL, 'pendiente', '2026-07-31 04:50:33', '2026-08-29 05:20:52'),
(15, 'PROF-000015', 'EFRAIN CALJARO ACERO', NULL, NULL, '2026-10-24', NULL, 'PEN', 2990.68, 538.32, 3529.00, NULL, 'pendiente', '2026-10-24 21:55:15', '2026-10-24 21:57:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proforma_items`
--

CREATE TABLE `proforma_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proforma_id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `detalle` text DEFAULT NULL,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 1.00,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proforma_items`
--

INSERT INTO `proforma_items` (`id`, `proforma_id`, `descripcion`, `detalle`, `cantidad`, `precio_unitario`, `subtotal`, `orden`, `created_at`, `updated_at`) VALUES
(1, 1, 'PROCESADOR', 'Intel Core i5-12400F, 2.50/4.40GHz, 18MB Caché L3, LGA1700, 117W, Intel 7 (10nm)', 1.00, 589.00, 589.00, 0, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(2, 1, 'PLACA MADRE', 'Gigabyte B760M GAMING PLUS WIFI DDR4, Chipset Intel B760, LGA1700, mATX', 1.00, 399.00, 399.00, 1, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(3, 1, 'RAM', 'HIKSEMI ARMOR 16GB DDR4-3200MHz PC4-25600, CL18, 1.35V, UDIMM', 1.00, 469.00, 469.00, 2, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(4, 1, 'ALMACENAMIENTO', 'Kingston 1000GB NV3 PCIe 4.0 NVMe M.2 SSD', 1.00, 589.00, 589.00, 3, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(5, 1, 'MONITOR', 'Monitor Plano Lenovo L27-4C, 27\" (1920 x 1080) FHD IPS, 1444 Hz, HDMI, VGA', 1.00, 559.00, 559.00, 4, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(6, 1, 'CASE', 'Gamer TEROS TE-1322G, Mid Tower, USB 3.0 / USB 2.0, audio, ventilador', 1.00, 129.00, 129.00, 5, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(7, 1, 'PERIFÉRICOS', 'Teclado Logitech + Mouse MK120 USB SP Black', 1.00, 39.00, 39.00, 6, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(8, 1, 'TARJETA DE VIDEO', 'ASUS Dual GeForce RTX 3050 OC Edition 6GB GDDR6, PCI-E', 1.00, 1069.00, 1069.00, 7, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(9, 1, 'FUENTE DE PODER', 'MSI MAG A650BN, 650W, 80 PLUS Bronze Certified, Formato ATX', 1.00, 179.00, 179.00, 8, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(10, 2, 'LAPTOP', 'HP 15-fd0xxx, Intel Core i5-1235U, 8GB RAM, 512GB SSD, 15.6\" FHD', 2.00, 2800.00, 5600.00, 0, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(11, 2, 'IMPRESORA', 'Epson EcoTank L3250, Multifuncional, WiFi, USB, Sistema de tinta continua', 1.00, 800.00, 800.00, 1, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(12, 2, 'ROUTER WIFI', 'TP-Link Archer AX23, AX1800, Dual Band, 4 antenas', 1.00, 200.00, 200.00, 2, '2026-03-18 03:53:16', '2026-03-18 03:53:16'),
(24, 5, 'PLACA MADRE', 'BMN', 1.00, 150.00, 150.00, 0, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(25, 5, 'PROCESADOR', 'Epson L3250 multifuncional', 1.00, 200.00, 200.00, 1, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(26, 5, 'MEMORIA RAM', NULL, 1.00, 0.00, 0.00, 2, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(27, 5, 'DISCO SSD', NULL, 1.00, 0.00, 0.00, 3, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(28, 5, 'TARJETA DE VIDEO', NULL, 1.00, 0.00, 0.00, 4, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(29, 5, 'CASE', NULL, 1.00, 0.00, 0.00, 5, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(30, 5, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(31, 5, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(32, 5, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(33, 5, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-04-09 08:05:29', '2026-04-09 08:05:29'),
(34, 6, 'PLACA MADRE', 'MSI PRO B760M-A WIFI', 1.00, 600.00, 600.00, 0, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(35, 6, 'PROCESADOR', 'Intel Core i5-12400', 1.00, 300.00, 300.00, 1, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(36, 6, 'MEMORIA RAM', 'Memoria ram corsair 16gb ddr4 3200mhz', 1.00, 500.00, 500.00, 2, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(37, 6, 'DISCO SSD', 'SSD 1TB KINGSTON NV3 NVMe M.2 2280 Pcie 4.0', 1.00, 600.00, 600.00, 3, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(38, 6, 'TARJETA DE VIDEO', 'NVIDIA GeForce RTX 4060 8GB', 1.00, 1380.00, 1380.00, 4, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(39, 6, 'CASE', 'Corsair 4000D Airflow', 1.00, 245.00, 245.00, 5, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(40, 6, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(41, 6, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(42, 6, 'MOUSE', 'Corsair Katar Pro XT', 1.00, 120.00, 120.00, 8, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(43, 6, 'OTROS', 'Fuente de poder 700w 80 plus gold', 1.00, 350.00, 350.00, 9, '2026-04-09 19:49:14', '2026-04-09 19:49:14'),
(66, 7, 'SERVICIO', 'Servicio de Mantenimiento', 1.00, 50.00, 50.00, 0, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(67, 7, 'FORMATEOS', 'Formateo e Instalacion de programas basicos', 1.00, 25.00, 25.00, 1, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(68, 7, 'COOLER', 'COOLER 8*8CM NEGRO KNT-1145 GENERAL GENERAL 001351', 1.00, 10.00, 10.00, 2, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(69, 7, 'VENTILADOR', 'VENTILADOR C/LUZ 120*120MM 12VDC P/FUENTE', 1.00, 24.00, 24.00, 3, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(70, 7, 'FUENTE', 'FUENTE CBERTEL 2000', 1.00, 75.00, 75.00, 4, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(71, 7, 'TARJETA DE VIDEO', 'INVIDIA GT 1030 (Precio aproximado)', 1.00, 450.00, 450.00, 5, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(72, 7, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(73, 7, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(74, 7, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(75, 7, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(76, 7, 'OTROS', NULL, 1.00, 0.00, 0.00, 10, '2026-04-15 19:50:53', '2026-04-15 19:50:53'),
(77, 8, 'PLACA MADRE', 'BATERIA', 1.00, 120.00, 120.00, 0, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(78, 8, 'PROCESADOR', 'PANTALLA', 1.00, 135.00, 135.00, 1, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(79, 8, 'MEMORIA RAM', NULL, 1.00, 0.00, 0.00, 2, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(80, 8, 'DISCO SSD', NULL, 1.00, 0.00, 0.00, 3, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(81, 8, 'TARJETA DE VIDEO', NULL, 1.00, 0.00, 0.00, 4, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(82, 8, 'CASE', NULL, 1.00, 0.00, 0.00, 5, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(83, 8, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(84, 8, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(85, 8, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(86, 8, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-05-02 19:28:05', '2026-05-02 19:28:05'),
(87, 9, 'PLACA MADRE', 'BATERIA', 1.00, 150.00, 150.00, 0, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(88, 9, 'PROCESADOR', 'PANTALLA', 1.00, 232.00, 232.00, 1, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(89, 9, 'MEMORIA RAM', NULL, 1.00, 0.00, 0.00, 2, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(90, 9, 'DISCO SSD', NULL, 1.00, 0.00, 0.00, 3, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(91, 9, 'TARJETA DE VIDEO', NULL, 1.00, 0.00, 0.00, 4, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(92, 9, 'CASE', NULL, 1.00, 0.00, 0.00, 5, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(93, 9, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(94, 9, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(95, 9, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(96, 9, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-05-02 19:56:36', '2026-05-02 19:56:36'),
(107, 10, 'FORMATEO Y CARGADOR', 'FORMATEO LAPTOP ADVANCE', 1.00, 0.00, 0.00, 0, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(108, 10, 'CARGADOR', 'CODIGO 1010801', 1.00, 0.00, 0.00, 1, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(109, 10, 'ADELANTO', NULL, 1.00, 40.00, 40.00, 2, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(110, 10, 'DISCO SSD', NULL, 1.00, 0.00, 0.00, 3, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(111, 10, 'TARJETA DE VIDEO', NULL, 1.00, 0.00, 0.00, 4, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(112, 10, 'CASE', NULL, 1.00, 0.00, 0.00, 5, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(113, 10, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(114, 10, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(115, 10, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(116, 10, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-05-07 20:57:51', '2026-05-07 20:57:51'),
(147, 12, 'USB', 'USB 16 GB', 1.00, 26.00, 26.00, 0, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(148, 12, 'PROCESADOR', NULL, 1.00, 0.00, 0.00, 1, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(149, 12, 'MEMORIA RAM', NULL, 1.00, 0.00, 0.00, 2, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(150, 12, 'DISCO SSD', NULL, 1.00, 0.00, 0.00, 3, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(151, 12, 'TARJETA DE VIDEO', NULL, 1.00, 0.00, 0.00, 4, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(152, 12, 'CASE', NULL, 1.00, 0.00, 0.00, 5, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(153, 12, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(154, 12, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(155, 12, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(156, 12, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-05-26 00:01:06', '2026-05-26 00:01:06'),
(187, 11, 'ADAPTADOR WI FI', 'TP-LINK ADAPTADOR NANO USB INALAMBRICO N DE 150Mbps (C/U)', 18.00, 27.00, 486.00, 0, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(188, 11, 'PASTA TERMINCA', 'REFRIGERANTE PASTA TÉRMICA DE 30G GRIS', 2.00, 7.00, 14.00, 1, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(189, 11, 'PILA PARA PC', 'PILA LITHIUM CR-2032 DE 3.0V GENERAL GENERAL CR-2032', 18.00, 2.00, 36.00, 2, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(190, 11, 'MEMORIA MICRO SD', 'MEMORIA MICRO SD DE 64 GB KINGSTON', 2.00, 40.00, 80.00, 3, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(191, 11, 'USB CON BOOT DE WINDOWS', '16 GB', 1.00, 31.00, 31.00, 4, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(192, 11, 'USB CON OFFICE', '16 GB', 1.00, 40.00, 40.00, 5, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(193, 11, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(194, 11, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(195, 11, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(196, 11, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-05-26 00:14:05', '2026-05-26 00:14:05'),
(197, 13, 'PLACA MADRE', NULL, 1.00, 0.00, 0.00, 0, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(198, 13, 'PROCESADOR', NULL, 1.00, 0.00, 0.00, 1, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(199, 13, 'MEMORIA RAM', NULL, 1.00, 0.00, 0.00, 2, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(200, 13, 'DISCO SSD', NULL, 1.00, 0.00, 0.00, 3, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(201, 13, 'TARJETA DE VIDEO', NULL, 1.00, 0.00, 0.00, 4, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(202, 13, 'CASE', NULL, 1.00, 0.00, 0.00, 5, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(203, 13, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(204, 13, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(205, 13, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(206, 13, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-06-26 03:41:12', '2026-06-26 03:41:12'),
(257, 14, '1. PANTALLA DE LENOVO THINKPAD L 14', 'ADELANTO DE 10 SOLES', 1.00, 10.00, 10.00, 0, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(258, 14, '2.', NULL, 1.00, 0.00, 0.00, 1, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(259, 14, '3.', NULL, 1.00, 0.00, 0.00, 2, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(260, 14, '4.', NULL, 1.00, 0.00, 0.00, 3, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(261, 14, '5.', NULL, 1.00, 0.00, 0.00, 4, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(262, 14, '6.', NULL, 1.00, 0.00, 0.00, 5, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(263, 14, '7.', NULL, 1.00, 0.00, 0.00, 6, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(264, 14, '8.', NULL, 1.00, 0.00, 0.00, 7, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(265, 14, '9.', NULL, 1.00, 0.00, 0.00, 8, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(266, 14, '10.', NULL, 1.00, 0.00, 0.00, 9, '2026-08-29 05:20:52', '2026-08-29 05:20:52'),
(287, 15, 'TARJETA DE VIDEO SALDO RESTANTE', 'TARJETA DE VIDEO, ASUS, RTX5070 T1 GAMING VGA 12GB AS', 1.00, 3429.00, 3429.00, 0, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(288, 15, 'ADELANTO DE TARJETA DE VIDEO', NULL, 1.00, 100.00, 100.00, 1, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(289, 15, 'MEMORIA RAM', NULL, 1.00, 0.00, 0.00, 2, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(290, 15, 'DISCO SSD', NULL, 1.00, 0.00, 0.00, 3, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(291, 15, 'PLACA MADRE', NULL, 1.00, 0.00, 0.00, 4, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(292, 15, 'CASE', NULL, 1.00, 0.00, 0.00, 5, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(293, 15, 'MONITOR', NULL, 1.00, 0.00, 0.00, 6, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(294, 15, 'TECLADO', NULL, 1.00, 0.00, 0.00, 7, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(295, 15, 'MOUSE', NULL, 1.00, 0.00, 0.00, 8, '2026-10-24 21:57:52', '2026-10-24 21:57:52'),
(296, 15, 'OTROS', NULL, 1.00, 0.00, 0.00, 9, '2026-10-24 21:57:52', '2026-10-24 21:57:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uDDFhzJe34vnVnFR8T6i5GI0p1RagVUHj5HmmwOB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDlDS2xjVlVJRFBoOGRhQXdUM1R2em03S0tyVXdPY3hWdXpya1pwMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9mb3JtYXMvMy9wZGYiO3M6NToicm91dGUiO3M6MTM6InByb2Zvcm1hcy5wZGYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773808644),
('VGtczMTLcSQMZY8beh5nD7pg9Z4IbrxgCkVZxKa1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1FENEtBdlFBakRxbmg4dVFvZGJ3Wjl3UjRqenQ0V3RGYzJZeWJwaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9mb3JtYXMiO3M6NToicm91dGUiO3M6MTU6InByb2Zvcm1hcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774582095);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `proformas`
--
ALTER TABLE `proformas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proformas_numero_unique` (`numero`);

--
-- Indices de la tabla `proforma_items`
--
ALTER TABLE `proforma_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proforma_items_proforma_id_foreign` (`proforma_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proformas`
--
ALTER TABLE `proformas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `proforma_items`
--
ALTER TABLE `proforma_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proforma_items`
--
ALTER TABLE `proforma_items`
  ADD CONSTRAINT `proforma_items_proforma_id_foreign` FOREIGN KEY (`proforma_id`) REFERENCES `proformas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
