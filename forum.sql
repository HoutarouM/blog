-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 10 Kwi 2022, 11:53
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `forum`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `kategoria` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `kategoria`) VALUES
(1, 'kategoria');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `polubienia`
--

CREATE TABLE `polubienia` (
  `id` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_posta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `polubienia`
--

INSERT INTO `polubienia` (`id`, `id_uzytkownika`, `id_posta`) VALUES
(4, 2, 4),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `id` int(11) NOT NULL,
  `id_postu_nadzendnego` int(11) DEFAULT NULL,
  `id_kategorii` int(11) NOT NULL,
  `id_autora` int(11) NOT NULL,
  `tytul` varchar(25) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `text` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`id`, `id_postu_nadzendnego`, `id_kategorii`, `id_autora`, `tytul`, `text`) VALUES
(3, NULL, 1, 2, 'hello forum', 'hello'),
(4, NULL, 1, 2, 'test secon post', 'hello');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` text COLLATE utf8mb4_polish_ci NOT NULL,
  `nick` varchar(15) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nick`) VALUES
(1, 'aaa', 'd6f644b19812e97b5d871658d6d3400ecd4787faeb9b8990c1e7608288664be77257104a58d033bcf1a0e0945ff06468ebe53e2dff36e248424c7273117dac09', 'aaa'),
(2, 'hello@mail.com', 'a4db351d57adf4b71105ef2b13138ea50d539c93a83b471974a7a7c1f8b132cd267e11266529eaaf08f05e516dbebf03133688826cb538eebc626bb06ad1ebd8', 'hello'),
(3, 'hello@mail.com', 'a4db351d57adf4b71105ef2b13138ea50d539c93a83b471974a7a7c1f8b132cd267e11266529eaaf08f05e516dbebf03133688826cb538eebc626bb06ad1ebd8', 'dadasdas'),
(4, 'hello@mail.com', 'a4db351d57adf4b71105ef2b13138ea50d539c93a83b471974a7a7c1f8b132cd267e11266529eaaf08f05e516dbebf03133688826cb538eebc626bb06ad1ebd8', 'test'),
(5, 'admin@mail.com', 'a4db351d57adf4b71105ef2b13138ea50d539c93a83b471974a7a7c1f8b132cd267e11266529eaaf08f05e516dbebf03133688826cb538eebc626bb06ad1ebd8', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `polubienia`
--
ALTER TABLE `polubienia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_posta` (`id_posta`);

--
-- Indeksy dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postu_nadzendnego` (`id_postu_nadzendnego`),
  ADD KEY `id_kategorii` (`id_kategorii`),
  ADD KEY `id_autora` (`id_autora`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `polubienia`
--
ALTER TABLE `polubienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `polubienia`
--
ALTER TABLE `polubienia`
  ADD CONSTRAINT `ko_post` FOREIGN KEY (`id_posta`) REFERENCES `posty` (`id`),
  ADD CONSTRAINT `ko_user` FOREIGN KEY (`id_uzytkownika`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD CONSTRAINT `ko_autor` FOREIGN KEY (`id_autora`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ko_kategorie` FOREIGN KEY (`id_kategorii`) REFERENCES `kategorie` (`id`),
  ADD CONSTRAINT `ko_posty_nadzendne` FOREIGN KEY (`id_postu_nadzendnego`) REFERENCES `posty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
