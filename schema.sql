--
-- Štruktúra tabuľky pre tabuľku `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `meno` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `user_ID_book` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `Názov` text NOT NULL,
  `Popis` text NOT NULL,
  `Cena` decimal(10,2) DEFAULT NULL,
  `slug` text NOT NULL,
  `Vytvorené` date NOT NULL DEFAULT current_timestamp(),
  `typ` varchar(100) NOT NULL,
  `in_menu` int(10) NOT NULL,
  `menu_order` int(10) NOT NULL,
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `styles`
--

CREATE TABLE `styles` (
  `id` int(11) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `text_color` varchar(100) NOT NULL,
  `link_color` varchar(100) NOT NULL,
  `header_link_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_role` int(100) NOT NULL DEFAULT 3,
  `API` varchar(255) NOT NULL,
  `Časy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexy pre tabuľku `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
