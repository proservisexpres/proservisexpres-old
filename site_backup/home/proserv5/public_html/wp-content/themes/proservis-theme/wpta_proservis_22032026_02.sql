-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Erstellungszeit: 22. Mrz 2026 um 23:54
-- Server-Version: 8.0.30
-- PHP-Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `wpta_proservis`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wpta_postmeta`
--

CREATE TABLE `wpta_postmeta` (
  `meta_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Daten für Tabelle `wpta_postmeta`
--

INSERT INTO `wpta_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(14439, 2181, '_brand_logo', 'lg-logo-logo-logo-pinterest-logos-14.png'),
(14440, 2182, '_brand_logo', 'Miele_Logo_M_Red_sRGB.svg.png'),
(14441, 2183, '_brand_logo', 'Samsung_old_logo_before_year_2015.svg.png'),
(14442, 2184, '_brand_logo', 'argo.jpeg'),
(14443, 2185, '_brand_logo', 'ariston.png'),
(14444, 2186, '_brand_logo', 'New_Beko_logo.svg.png'),
(14445, 2187, '_brand_logo', 'Siemens_AG_logo.svg.png'),
(14446, 2188, '_brand_logo', 'vestel.jpg'),
(14447, 2189, '_brand_logo', 'png-clipart-whirlpool-corporation-home-appliance-washing-machines-brand-maytag-others.png'),
(14448, 2190, '_brand_logo', 'png-clipart-indesit-co-home-appliance-logo-washing-machines-refrigerator-logo-miscellaneous-blue-thumbnail.png'),
(14449, 2191, '_brand_logo', 'png-clipart-electrolux-logo-organization-brand-washing-machines-whirlpool-logo-text-logo-thumbnail.png'),
(14450, 2192, '_brand_logo', 'bauknecht.jpg'),
(14451, 2193, '_brand_logo', 'fagor-logo-png-transparent.png'),
(14465, 2197, '_service_price', '1000'),
(14466, 2198, '_service_price', '2000'),
(14467, 2199, '_service_price', '2000'),
(14468, 2200, '_service_price', '1500'),
(14469, 2201, '_service_price', '2000'),
(14470, 2202, '_service_price', '2000'),
(14471, 2203, '_service_price', '1700'),
(14472, 2204, '_service_price', '2100'),
(14473, 2205, '_service_price', '1500'),
(14474, 2206, '_service_price', '1500'),
(14479, 2197, '_service_unit', 'Kč'),
(14480, 2198, '_service_unit', 'Kč'),
(14481, 2199, '_service_unit', 'Kč'),
(14482, 2200, '_service_unit', 'Kč'),
(14483, 2201, '_service_unit', 'Kč'),
(14484, 2202, '_service_unit', 'Kč'),
(14485, 2203, '_service_unit', 'Kč'),
(14486, 2204, '_service_unit', 'Kč'),
(14487, 2205, '_service_unit', 'Kč'),
(14488, 2206, '_service_unit', 'Kč');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `wpta_postmeta`
--
ALTER TABLE `wpta_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `wpta_postmeta`
--
ALTER TABLE `wpta_postmeta`
  MODIFY `meta_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14492;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
