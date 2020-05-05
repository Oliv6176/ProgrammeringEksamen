-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 05. 05 2020 kl. 11:11:18
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.1

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
  `name` varchar(100) NOT NULL,
  `body` longtext NOT NULL DEFAULT '<div id="0" class="row">                 <div class="container" id="0" style="z-index: 1;" ondrop="drop(event)" ondragover="allowDrop(event)"></div></div>',
  `owner` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `boards`
--

INSERT INTO `boards` (`id`, `name`, `body`, `owner`) VALUES
(5, 'Test Board 1', '\n            \n            \n            \n            <div id=\"0\" class=\"row\">                 <div class=\"container\" id=\"1588669756143\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669791806\" style=\"background-image: url(&quot;images/14203041965eb12aa2e5e401.55355263.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"0\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669762115\" style=\"background-image: url(&quot;images/13890754965eb12a7fde5f40.73349339.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669758425\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669782677\" style=\"background-image: url(&quot;images/14203041965eb12aa2e5e401.55355263.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669759528\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669771049\" style=\"background-image: url(&quot;images/14203041965eb12aa2e5e401.55355263.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669764471\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div></div>        <div id=\"1588669760855\" class=\"row\">                 <div class=\"container\" id=\"1588669760855\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669790689\" style=\"background-image: url(&quot;images/3960767595eb12a9ac61316.28124233.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669760855\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669789151\" style=\"background-image: url(&quot;images/14203041965eb12aa2e5e401.55355263.png&quot;); background-size: contain; z-index: 2;\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669773633\" style=\"background-image: url(&quot;images/8206619475eb12af47c5dc4.27331247.png&quot;); background-size: contain; z-index: 3;\"></div></div></div><div class=\"container\" id=\"1588669760855\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669781459\" style=\"background-image: url(&quot;images/3960767595eb12a9ac61316.28124233.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669760855\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669769876\" style=\"background-image: url(&quot;images/3960767595eb12a9ac61316.28124233.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669764471\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div></div><div id=\"1588669763010\" class=\"row\">                 <div class=\"container\" id=\"1588669763010\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669794841\" style=\"background-image: url(&quot;images/13890754965eb12a7fde5f40.73349339.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669763010\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669787703\" style=\"background-image: url(&quot;images/3960767595eb12a9ac61316.28124233.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669763010\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"><div class=\"item element\" draggable=\"true\" ondragstart=\"drag(event)\" clone=\"yes\" id=\"1588669784894\" style=\"background-image: url(&quot;images/10184931755eb12a8fa172b2.53764570.png&quot;); background-size: contain; z-index: 2;\"></div></div><div class=\"container\" id=\"1588669763010\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div><div class=\"container\" id=\"1588669764471\" style=\"z-index: 1;\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\"></div></div>                        ', '2');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `boards_users`
--

CREATE TABLE `boards_users` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `boards_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `boards_users`
--

INSERT INTO `boards_users` (`id`, `users_id`, `boards_id`) VALUES
(4, 2, 5);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `img` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `images`
--

INSERT INTO `images` (`id`, `img`, `date`) VALUES
(8, 'images/13890754965eb12a7fde5f40.73349339.png', '2020-05-05 08:57:35'),
(9, 'images/10184931755eb12a8fa172b2.53764570.png', '2020-05-05 08:57:51'),
(10, 'images/3960767595eb12a9ac61316.28124233.png', '2020-05-05 08:58:02'),
(11, 'images/14203041965eb12aa2e5e401.55355263.png', '2020-05-05 08:58:10'),
(12, 'images/8206619475eb12af47c5dc4.27331247.png', '2020-05-05 08:59:32');

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
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `date`) VALUES
(2, '1', '$2y$10$orT0bz0GhFsTbMs2KbF8vuZyoeE8VK8XBnL0KtHpBaGUUYkLWLNjW', '2020-05-05 08:56:58');

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
-- Indeks for tabel `images`
--
ALTER TABLE `images`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tilføj AUTO_INCREMENT i tabel `boards_users`
--
ALTER TABLE `boards_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
