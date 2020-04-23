-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 22. 04 2020 kl. 21:25:35
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `programmering`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL,
  `body` longtext NOT NULL,
  `owner` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `boards`
--

INSERT INTO `boards` (`id`, `body`, `owner`) VALUES
(1, '\n            <div id=\"0\">\n                <div class=\"container\" id=\"0\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n                <div class=\"container\" id=\"1\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n                <div class=\"container\" id=\"2\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n            </div>\n            <div id=\"1\">\n                <div class=\"container\" id=\"0\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n                <div class=\"container\" id=\"1\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n                <div class=\"container\" id=\"2\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n            </div>\n            <div id=\"2\">\n                <div class=\"container\" id=\"0\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n                <div class=\"container\" id=\"1\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n                <div class=\"container\" id=\"2\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div>\n            </div>\n        ', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `boards_users`
--

CREATE TABLE `boards_users` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `boards_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `boards_users`
--
ALTER TABLE `boards_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `boards_users`
--
ALTER TABLE `boards_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
