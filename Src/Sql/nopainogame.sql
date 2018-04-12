
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nopainogame`
--

-- --------------------------------------------------------

--
-- Table structure for table `dom_console`
--

CREATE TABLE `dom_console` (
  `cod_console` varchar(4) NOT NULL,
  `desc_console` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dom_ganres`
--

CREATE TABLE `dom_ganres` (
  `cod_genre` varchar(4) NOT NULL,
  `desc_genre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dom_payment`
--

CREATE TABLE `dom_payment` (
  `cod_payment` varchar(4) NOT NULL,
  `desc_payment` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dom_role`
--

CREATE TABLE `dom_role` (
  `cod_role` char(3) NOT NULL,
  `desc_role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fidelity_card`
--

CREATE TABLE `fidelity_card` (
  `id_fidelity_card` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `cod_game` varchar(4) NOT NULL,
  `title` varchar(45) NOT NULL,
  `price` int(11) NOT NULL,
  `cod_console` varchar(4) NOT NULL,
  `price_on_sale` int(11) NOT NULL,
  `flag_sale` char(1) NOT NULL,
  `flag_news` char(1) NOT NULL,
  `insertion_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game_genre`
--

CREATE TABLE `game_genre` (
  `id_game_genre` int(11) NOT NULL,
  `cod_game` varchar(4) NOT NULL,
  `cod_genre` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game_order`
--

CREATE TABLE `game_order` (
  `id_game_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `cod_game` varchar(4) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game_warehouse`
--

CREATE TABLE `game_warehouse` (
  `id_game_warehouse` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cod_warehouse` char(3) NOT NULL,
  `cod_game` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oders`
--

CREATE TABLE `oders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cod_payment` varchar(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `cod_game` varchar(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `username` varchar(11) NOT NULL,
  `passsword` varchar(16) NOT NULL,
  `cod_role` char(3) NOT NULL,
  `password_last_modify` date NOT NULL,
  `id_fidelity_card` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `cod_warehouse` char(3) NOT NULL,
  `address` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dom_console`
--
ALTER TABLE `dom_console`
  ADD PRIMARY KEY (`cod_console`);

--
-- Indexes for table `dom_ganres`
--
ALTER TABLE `dom_ganres`
  ADD PRIMARY KEY (`cod_genre`);

--
-- Indexes for table `dom_payment`
--
ALTER TABLE `dom_payment`
  ADD PRIMARY KEY (`cod_payment`);

--
-- Indexes for table `dom_role`
--
ALTER TABLE `dom_role`
  ADD PRIMARY KEY (`cod_role`);

--
-- Indexes for table `fidelity_card`
--
ALTER TABLE `fidelity_card`
  ADD PRIMARY KEY (`id_fidelity_card`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`cod_game`),
  ADD KEY `cod_console` (`cod_console`);

--
-- Indexes for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD PRIMARY KEY (`id_game_genre`),
  ADD KEY `cod_game` (`cod_game`),
  ADD KEY `cod_genre` (`cod_genre`);

--
-- Indexes for table `game_order`
--
ALTER TABLE `game_order`
  ADD PRIMARY KEY (`id_game_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `cod_game` (`cod_game`),
  ADD KEY `id_order_2` (`id_order`);

--
-- Indexes for table `game_warehouse`
--
ALTER TABLE `game_warehouse`
  ADD PRIMARY KEY (`id_game_warehouse`),
  ADD KEY `cod_warehouse` (`cod_warehouse`),
  ADD KEY `cod_game` (`cod_game`);

--
-- Indexes for table `oders`
--
ALTER TABLE `oders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `cod_payment` (`cod_payment`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `cod_game` (`cod_game`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `cod_role` (`cod_role`),
  ADD KEY `id_fidelity_card` (`id_fidelity_card`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`cod_warehouse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fidelity_card`
--
ALTER TABLE `fidelity_card`
  MODIFY `id_fidelity_card` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `game_genre`
--
ALTER TABLE `game_genre`
  MODIFY `id_game_genre` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `game_order`
--
ALTER TABLE `game_order`
  MODIFY `id_game_order` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `game_warehouse`
--
ALTER TABLE `game_warehouse`
  MODIFY `id_game_warehouse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oders`
--
ALTER TABLE `oders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
