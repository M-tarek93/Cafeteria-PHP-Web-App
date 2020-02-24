-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2020 at 04:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Hot drinks'),
(2, 'Cold drinks'),
(3, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `Notes` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `room` int(11) NOT NULL,
  `ext` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `Notes`, `date`, `room`, `ext`, `total_price`, `status`, `username`) VALUES
(21, '0', '2020-02-21', 210, 3150, 10, 1, 'Declan'),
(22, '0', '2020-02-21', 220, 3120, 35, 2, 'Breanna'),
(24, '123dcfas', '2020-02-23', 3532, 967, 5, 1, 'Jana');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`order_id`, `product_id`) VALUES
(21, 1),
(21, 2),
(22, 6),
(22, 5),
(24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `isAvailable`) VALUES
(1, 'Tea', 5, 'tea.png', 1, 1),
(2, 'Mint', 5, 'mint.png', 1, 1),
(3, 'Pepsi', 10, 'pepsi.png', 2, 1),
(4, 'Coca Cola', 10, 'coca.png', 2, 1),
(5, 'Milk Shake', 20, 'milkshake.png', 2, 1),
(6, 'Cappuccino', 15, 'cappuccino.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Processing'),
(2, 'Out for Delivery'),
(3, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `room` int(11) NOT NULL,
  `ext` int(11) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `room`, `ext`, `profile_pic`, `role`) VALUES
('Breanna', '123', 'non@molestie.com', 5822, 967, '1228031.jpg', 0),
('Brock', '123', 'magna@Donecluctusaliquet.edu', 3532, 129, '4.jpg', 0),
('Cedric', '123456', 'tortor.Nunc.commodo@vitae.ca', 3317, 897, '4.jpg', 0),
('Cyrus', '123456', 'Nulla.tempor.augue@liberoMorbi.co.uk', 3556, 377, '5.jpg', 0),
('Danielle', '123456', 'Sed.neque@acmattissemper.net', 5916, 751, '3.jpg', 0),
('Dawn', '123', 'auctor.odio@magnased.co.uk', 5730, 377, '5.jpg', 0),
('Declan', '123456', 'Ut@tinciduntvehicula.co.uk', 4495, 708, '1.jpg', 0),
('Denise', '123', 'Nullam.scelerisque.neque@Morbiaccumsan.org', 4392, 133, '6.jpg', 0),
('Dexter', '123', 'faucibus.orci@Phasellus.co.uk', 5472, 502, '4.jpg', 0),
('Driscoll', '123', 'lorem.ac@sit.com', 2307, 578, '8.jpg', 0),
('Erica', '123', 'Sed@sociisnatoquepenatibus.org', 2756, 390, '2.jpg', 0),
('Fritz', '123', 'convallis.erat.eget@Vestibulum.ca', 2943, 183, '4.jpg', 0),
('Gannon', '123', 'facilisis.lorem.tristique@Donec.org', 4538, 746, '9.jpg', 0),
('Garrison', '123', 'nec.malesuada.ut@Proinegetodio.edu', 4056, 874, '5.jpg', 0),
('Gemma', '123', 'ante@Etiamimperdiet.edu', 4741, 18, '4.jpg', 0),
('Heather', '123', 'nec.tempus.mauris@risusNulla.co.uk', 5429, 877, '8.jpg', 0),
('Hilary', '123456', 'ornare.elit@dignissimpharetraNam.ca', 3933, 205, '9.jpg', 0),
('Holmes', '123456', 'eu.sem@nibh.com', 5083, 862, '7.jpg', 0),
('Isabella', '123', 'metus.In@Aliquamnisl.ca', 5855, 4, '7.jpg', 0),
('Jana', '123456', 'tellus.faucibus@non.com', 5607, 25, '10.jpg', 0),
('Jesse', '123', 'In.lorem@eulacus.edu', 4508, 71, '10.jpg', 0),
('Joshua', '123456', 'cursus@orci.ca', 2250, 901, '1.jpg', 0),
('Kennan', '123456', 'a@eu.ca', 3557, 114, '4.jpg', 0),
('Kim', '123456', 'Etiam.laoreet@Mauriseu.com', 5477, 358, '3.jpg', 0),
('Kitra', '123', 'vitae@sagittis.ca', 3476, 919, '7.jpg', 0),
('Kristen', '123456', 'bibendum@luctuset.net', 4670, 777, '8.jpg', 0),
('Kylan', '123', 'semper.auctor@sitamet.edu', 4501, 717, '8.jpg', 0),
('MacKenzie', '123', 'orci.in@musAeneaneget.edu', 3743, 63, '2.jpg', 0),
('Mari', '123', 'suscipit.est@Aliquamgravidamauris.co.uk', 2513, 467, '2.jpg', 0),
('Maxine', '123456', 'convallis.in.cursus@nasceturridiculus.net', 5657, 252, '9.jpg', 0),
('Melyssa', '123456', 'a.nunc.In@laoreet.org', 5428, 622, '3.jpg', 0),
('Merrill', '123456', 'eget.tincidunt@dolorDonecfringilla.net', 4795, 9, '4.jpg', 0),
('Nasim', '123', 'lacus.varius.et@lacusEtiambibendum.net', 5074, 844, '8.jpg', 0),
('Noelle', '123456', 'Vivamus@sit.co.uk', 4728, 507, '1.jpg', 0),
('Octavius', '123', 'Sed.eu.nibh@enimcommodo.org', 4170, 209, '3.jpg', 0),
('Oprah', '123456', 'interdum.Nunc.sollicitudin@ligulaconsectetuer.com', 2748, 628, '8.jpg', 0),
('Orlando', '123', 'odio@egestas.org', 2336, 467, '9.jpg', 0),
('Plato', '123456', 'Nunc@metusfacilisis.org', 4112, 309, '5.jpg', 0),
('Rachel', '123456', 'a.ultricies.adipiscing@bibendumsedest.ca', 2787, 590, '10.jpg', 0),
('Rana', '123', 'Curae@magnaDuis.ca', 3952, 208, '3.jpg', 0),
('Rebecca', '123456', 'adipiscing@penatibuset.com', 4987, 430, '7.jpg', 0),
('Robert', '123456', 'dolor.Fusce.feugiat@lobortisquam.ca', 5780, 353, '4.jpg', 0),
('Robin', '123456', 'lorem.ipsum.sodales@montesnascetur.ca', 3081, 152, '8.jpg', 0),
('Rooney', '123', 'Etiam.vestibulum@id.edu', 4693, 860, '5.jpg', 0),
('Rudyard', '123', 'magna.a.neque@acsem.net', 4124, 400, '5.jpg', 0),
('Serena', '123456', 'tincidunt.aliquam.arcu@ad.net', 4923, 693, '9.jpg', 0),
('Tanisha', '123', 'ac.libero.nec@Integersem.edu', 2718, 664, '10.jpg', 0),
('Tucker', '123456', 'egestas.blandit@Crasdictum.edu', 3298, 82, '8.jpg', 0),
('Vivian', '123456', 'mollis@sedleo.org', 5997, 286, '3.jpg', 0),
('Wade', '123456', 'dui@nulla.com', 2651, 912, '9.jpg', 0),
('Wesley', '123456', 'Nunc.ullamcorper@ultricesDuis.net', 4618, 669, '8.jpg', 0),
('Xena', '123', 'tincidunt.Donec.vitae@nonegestasa.org', 4929, 132, '8.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderForiegnKey` (`username`),
  ADD KEY `statusCodes` (`status`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD KEY `orderItemsForiegnKeyOrders` (`order_id`),
  ADD KEY `orderItemsForiegnKeyProducts` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories` (`category`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `statusCodes` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `orderItemsForiegnKeyOrders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderItemsForiegnKeyProducts` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categories` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
