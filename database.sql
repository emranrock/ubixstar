-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2023 at 07:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ubixstar`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `full_name`, `email`, `contact_number`, `password`, `status`) VALUES
(1, 'Abdul Rahman', 'imran', '09828127878', '$2y$10$bu/O2YpetHZITBDG4c6KQeo6m6oOG28NCZbeEcFx2ymYfVIonCR.G', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES
(8, 'payment_methods', '[\"Cashfree Payments\"]'),
(9, 'home_page', '{\"home_page\":{\"hero\":\"active\",\"aboutus\":\"active\",\"services\":\"active\",\"plans\":\"active\",\"banner\":\"in-active\",\"teams\":\"in-active\",\"testimonials\":\"active\",\"blogs\":\"in-active\"}}'),
(16, 'about_page', '{\"about_page\":{\"banner\":\"active\",\"aboutus\":\"active\"}}'),
(17, 'services_page', '{\"services_page\":{\"banner\":\"active\",\"services\":\"active\",\"testimonials\":\"in-active\"}}'),
(18, 'contact_page', '{\"contact_page\":{\"banner\":\"active\",\"contactus\":\"active\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tag` text NOT NULL,
  `instructions` text NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `description`, `ingredients`, `category_id`, `tag`, `instructions`, `created_at`) VALUES
(1, 'test recipe', 'testy description', '4', 6, 'nice,testy,curry', 'some instructions i don\'t know that is it', NULL),
(2, 'Quick salt cod', 'Although Portugal doesn’t have a coastline in the Med, they’re included, and this take on fish and chips, inspired by bacalhau à Brás, is my stripped-back version of their much-loved comfort food dish', '5', 4, 'CRISPY POTATOES, SILKY EGGS, PARSLEY & OLIVE TAPENADE', '2 x 150 g cod fillets , skin on, scaled, pin-boned, from sustainable sources\r\n500 g Maris Piper potatoes\r\n2 large free-range eggs\r\n½ a bunch of flat-leaf parsley , (15g)\r\n2 teaspoons black olive tapenade', NULL),
(3, 'Special scrambled eggs', 'Whisk and season the eggs. Halve the buns. Peel and coarsely grate the onion, then put 1 tablespoon into a bowl with a pinch of sea salt and a splash of red wine vinegar, and leave to quickly pickle. Scatter the rest into a large non-stick frying pan on a', '5', 3, 'Eggs,Bread,Tomato,Sandwiches & wraps', '4 large free-range eggs\r\n2 soft buns\r\n1 red onion\r\nred wine vinegar\r\nolive oil\r\n1 teaspoon garam masala\r\n200 g ripe tomatoes\r\n½ a bunch of coriander , (15g)', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_category`
--

CREATE TABLE `recipe_category` (
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_category`
--

INSERT INTO `recipe_category` (`cat_id`, `title`) VALUES
(1, 'Baked & steamed desserts'),
(2, 'Beverages/drinks'),
(3, 'Bread & buns, sweet'),
(4, 'Bread & rolls, savory'),
(6, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `name`) VALUES
(1, 'Vegetables'),
(2, 'Spices and Herbs'),
(3, 'Cereals and Pulses'),
(4, 'Meat'),
(5, 'Dairy Products'),
(6, 'Fruits'),
(7, 'Seafood'),
(8, 'Sugar and Sugar Products');

-- --------------------------------------------------------

--
-- Table structure for table `site_setting`
--

CREATE TABLE `site_setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(250) NOT NULL,
  `social_links` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_setting`
--

INSERT INTO `site_setting` (`id`, `name`, `number`, `email`, `address`, `social_links`) VALUES
(1, 'Recipe Hub', '8003051520', 'imra8233@gmail.com', 'test address of bikaner rajshthans', '{\"facebook\":\"#\",\"twitter\":\"#\",\"instagram\":\"#\",\"google\":\"#\"}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL COMMENT 'full name of user',
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `phone_number` varchar(20) DEFAULT NULL,
  `roleId` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `full_name`, `email`, `password`, `phone_number`, `roleId`, `isDeleted`) VALUES
(1, 'System Administrator', 'imra8233@gmail.com', '$2y$10$nXDHcvyfvaEr01nQauDSaOj6r5zhI2mdCkwhNemmJolK2.Ewn0qO.', '8003051520', 1, 0),
(23, 'test user', 'testUser@gmail.com', '$2y$10$8qWp5RotUuevS0YQ5qTTUuqeIinkjJnybm5ULhD9LQLDK8j/6E9ES', '1234567890', 2, 0),
(22, 'test demo', 'testdemo@gmail.com', '$2y$10$/5h0nifNWeHxEZifrCD/JebQSGXFq11XXMJV3xTI2aPZxrbFnQ7De', '1234567890', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(15) NOT NULL,
  `message` varchar(150) NOT NULL,
  `image` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `type`, `message`, `image`, `status`) VALUES
(1, 'Client Name 1', 'Profession', 'Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam', 'testimonial-1.jpg', 'active'),
(2, 'Client Name', 'Profession', 'Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam', 'testimonial-2.jpg', 'active'),
(3, 'Client Name', 'Profession', 'Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam', 'testimonial-3.jpg', 'active'),
(4, 'Client Name', 'Profession', 'Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam', 'testimonial-4.jpg', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe_category`
--
ALTER TABLE `recipe_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_setting`
--
ALTER TABLE `site_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recipe_category`
--
ALTER TABLE `recipe_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `site_setting`
--
ALTER TABLE `site_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
