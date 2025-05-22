-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Loomise aeg: Mai 22, 2025 kell 04:12 PL
-- Serveri versioon: 10.4.32-MariaDB
-- PHP versioon: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `pizzeria_db`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `kasutajad`
--

CREATE TABLE `kasutajad` (
  `id` int(11) NOT NULL,
  `kasutajanimi` varchar(50) NOT NULL,
  `parool_hash` varchar(255) NOT NULL,
  `roll` enum('admin','kasutaja') NOT NULL DEFAULT 'kasutaja',
  `registreerimise_kp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Andmete tõmmistamine tabelile `kasutajad`
--

INSERT INTO `kasutajad` (`id`, `kasutajanimi`, `parool_hash`, `roll`, `registreerimise_kp`) VALUES
(1, 'burmir05', '$2y$10$UcMOeUex6oTqsWkMPCI.EeBsjWFFITwJd1W4PEki/P57Em2j8d0Ly', 'admin', '2025-05-22 12:45:19'),
(2, 'Bananchkik', '$2y$10$mMJ1beSKZB9wm9Fo6nTLruQWnl4p6byNdSaK8Mip4vVD5yvRMtXeW', 'kasutaja', '2025-05-22 13:36:06');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `pitsad`
--

CREATE TABLE `pitsad` (
  `PitsaID` int(11) NOT NULL,
  `Nimetus` varchar(100) NOT NULL,
  `Kirjeldus` text DEFAULT NULL,
  `Hind` decimal(10,2) NOT NULL,
  `RestoranID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Andmete tõmmistamine tabelile `pitsad`
--

INSERT INTO `pitsad` (`PitsaID`, `Nimetus`, `Kirjeldus`, `Hind`, `RestoranID`) VALUES
(1, 'Margarita', 'Klassikaline tomat, mozzarella, basiilik', 8.50, 1),
(2, 'Pepperoni', 'Pepperoni vorst, mozzarella, tomatikaste', 9.90, 1),
(3, 'Hawaii', 'Sink, ananass, mozzarella, tomatikaste', 9.50, 2),
(4, 'Mereanni', 'Krevetid, rannakarbid, kalmaar, mozzarella, tomatikaste', 12.50, 2),
(5, 'Vegetariana', 'Erinevad köögiviljad, mozzarella, tomatikaste', 9.00, 3),
(9, 'Mokarella', 'Tralalelo Tralali', 5.99, 3),
(10, 'Juustupizza', 'Rikkalikult juustu - mozzarella, cheddar ja parmesani segu krõbedal põhjal.', 7.90, 1),
(11, 'Kodune Hakklihapizza', 'Mahlane hakkliha, sibul, paprika ja marineeritud kurk tomatikastme ja juustuga.', 9.20, 1),
(12, 'Singi-seenepizza', 'Klassikaline kombinatsioon: sink, värsked šampinjonid, tomatikaste ja mozzarella.', 8.80, 1),
(13, 'Quattro Formaggi', 'Un classico italiano! Mozzarella, gorgonzola, parmigiano e provolone su una base croccante.', 11.50, 2),
(14, 'Diavola', 'Per gli amanti del piccante: salame piccante, mozzarella, olive nere e un tocco di peperoncino.', 10.80, 2),
(15, 'Capricciosa', 'Un trionfo di sapori: prosciutto cotto, funghi freschi, carciofini, olive e mozzarella.', 12.00, 2),
(16, 'Margherita Extra', 'La regina delle pizze con pomodoro San Marzano, mozzarella di bufala Campana DOP e basilico fresco.', 10.50, 2),
(17, 'BBQ Chicken Feast', 'Tender grilled chicken strips, smoky BBQ sauce, red onions, and a generous layer of mozzarella cheese.', 11.20, 3),
(18, 'Supreme Veggie', 'A garden delight! Bell peppers, onions, mushrooms, black olives, and sweetcorn on a tomato base with mozzarella.', 9.90, 3),
(19, 'Meat Lovers Deluxe', 'For the ultimate carnivore: pepperoni, ham, spicy beef, sausage, and extra mozzarella.', 13.50, 3);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `pitsarestoranid`
--

CREATE TABLE `pitsarestoranid` (
  `RestoranID` int(11) NOT NULL,
  `Nimi` varchar(255) NOT NULL,
  `Aadress` text DEFAULT NULL,
  `Telefon` varchar(50) DEFAULT NULL,
  `AvatudAlates` time DEFAULT NULL,
  `AvatudKuni` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Andmete tõmmistamine tabelile `pitsarestoranid`
--

INSERT INTO `pitsarestoranid` (`RestoranID`, `Nimi`, `Aadress`, `Telefon`, `AvatudAlates`, `AvatudKuni`) VALUES
(1, 'Peetri Pizza Kesklinn', 'Tartu mnt 1, Tallinn', '555-1234', '10:00:00', '22:00:00'),
(2, 'Opera Pizza', 'Viru tn 10, Tallinn', '555-5678', '11:00:00', '23:00:00'),
(3, 'Pizza Americana', 'Mustamäe tee 50, Tallinn', '555-9012', '09:00:00', '21:00:00');

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `kasutajad`
--
ALTER TABLE `kasutajad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kasutajanimi` (`kasutajanimi`);

--
-- Indeksid tabelile `pitsad`
--
ALTER TABLE `pitsad`
  ADD PRIMARY KEY (`PitsaID`),
  ADD KEY `RestoranID` (`RestoranID`);

--
-- Indeksid tabelile `pitsarestoranid`
--
ALTER TABLE `pitsarestoranid`
  ADD PRIMARY KEY (`RestoranID`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `kasutajad`
--
ALTER TABLE `kasutajad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabelile `pitsad`
--
ALTER TABLE `pitsad`
  MODIFY `PitsaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT tabelile `pitsarestoranid`
--
ALTER TABLE `pitsarestoranid`
  MODIFY `RestoranID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tõmmistatud tabelite piirangud
--

--
-- Piirangud tabelile `pitsad`
--
ALTER TABLE `pitsad`
  ADD CONSTRAINT `pitsad_ibfk_1` FOREIGN KEY (`RestoranID`) REFERENCES `pitsarestoranid` (`RestoranID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
