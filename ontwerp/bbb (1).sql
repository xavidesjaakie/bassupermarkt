-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 mrt 2026 om 18:48
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelen`
--

CREATE TABLE `artikelen` (
  `artikel_id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `voorraad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikelen`
--

INSERT INTO `artikelen` (`artikel_id`, `naam`, `prijs`, `voorraad`) VALUES
(1, 'Laptop', 999.99, 10),
(2, 'Muis', 19.95, 100),
(3, 'Toetsenbord', 49.95, 50),
(4, 'Monitor', 199.95, 25);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klant_id` int(11) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefoon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klant_id`, `voornaam`, `achternaam`, `email`, `telefoon`) VALUES
(1, 'Jan', 'Jansen', 'jan@email.nl', '0612345678'),
(2, 'Piet', 'Pieters', 'piet@email.nl', '0687654321'),
(3, 'Lisa', 'de Vries', 'lisa@email.nl', '0622334455'),
(4, 'Emma', 'Bakker', 'emma@email.nl', '0655443322');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkooporders`
--

CREATE TABLE `verkooporders` (
  `order_id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `orderdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verkooporders`
--

INSERT INTO `verkooporders` (`order_id`, `klant_id`, `artikel_id`, `aantal`, `orderdatum`) VALUES
(1, 1, 1, 1, '2026-03-01'),
(2, 2, 2, 2, '2026-03-02'),
(3, 3, 3, 1, '2026-03-03'),
(4, 1, 2, 3, '2026-03-04'),
(5, 4, 4, 1, '2026-03-04');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klant_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `klant_id` (`klant_id`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD CONSTRAINT `verkooporders_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `klanten` (`klant_id`),
  ADD CONSTRAINT `verkooporders_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `artikelen` (`artikel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
