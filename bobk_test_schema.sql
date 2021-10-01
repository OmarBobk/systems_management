-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2021 at 08:48 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bobk.test.schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `Carts`
--

CREATE TABLE `Carts` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL COMMENT 'Products in the cart not in the stock',
  `net_price` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Contributions`
--

CREATE TABLE `Contributions` (
  `id` int(11) NOT NULL,
  `ammount` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `deposit_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `profit_percent` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `contributor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Contributors`
--

CREATE TABLE `Contributors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `rule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Debtors`
--

CREATE TABLE `Debtors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Debts`
--

CREATE TABLE `Debts` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `is_paid` int(11) NOT NULL DEFAULT 0,
  `due` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `debtor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Expenses`
--

CREATE TABLE `Expenses` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `cost` int(11) NOT NULL,
  `type` varchar(355) NOT NULL,
  `contribution_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Factories`
--

CREATE TABLE `Factories` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `serial_number` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `factory_id` int(11) NOT NULL,
  `ammount` int(11) NOT NULL DEFAULT 1,
  `description` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `user_id` int(11) NOT NULL,
  `serial_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `factory_id` int(11) NOT NULL,
  `contribution_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL COMMENT 'Products amount in the stock',
  `description` text NOT NULL,
  `code` varchar(255) NOT NULL COMMENT 'Product Code Ex: KH-K17'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Profits`
--

CREATE TABLE `Profits` (
  `id` int(11) NOT NULL,
  `profit` int(11) NOT NULL COMMENT 'TL or $',
  `type` varchar(355) NOT NULL COMMENT 'TL or $',
  `sale_id` int(11) NOT NULL,
  `contribution_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Rules`
--

CREATE TABLE `Rules` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sales`
--

CREATE TABLE `Sales` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `net_price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `contribution_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `profit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_counter`
--

CREATE TABLE `sales_counter` (
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sellers`
--

CREATE TABLE `Sellers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Taggables`
--

CREATE TABLE `Taggables` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `taggable_id` int(11) NOT NULL,
  `taggable_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE `Tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Carts`
--
ALTER TABLE `Carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_product_cart_id` (`cart_id`),
  ADD KEY `cart_product_product_id` (`product_id`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Contributions`
--
ALTER TABLE `Contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contribut` (`contributor_id`);

--
-- Indexes for table `Contributors`
--
ALTER TABLE `Contributors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asf` (`rule_id`);

--
-- Indexes for table `Debtors`
--
ALTER TABLE `Debtors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Debts`
--
ALTER TABLE `Debts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Debts_fk0` (`product_id`),
  ADD KEY `Debts_fk1` (`user_id`),
  ADD KEY `Debts_fk2` (`debtor_id`);

--
-- Indexes for table `Expenses`
--
ALTER TABLE `Expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asdf` (`contribution_id`);

--
-- Indexes for table `Factories`
--
ALTER TABLE `Factories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Orders_fk0` (`seller_id`),
  ADD KEY `Orders_fk1` (`factory_id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Products_fk0` (`user_id`),
  ADD KEY `Products_fk1` (`category_id`),
  ADD KEY `Products_fk2` (`tag_id`),
  ADD KEY `Products_fk3` (`seller_id`),
  ADD KEY `Products_fk4` (`factory_id`),
  ADD KEY `product_belong_to_contribution` (`contribution_id`);

--
-- Indexes for table `Profits`
--
ALTER TABLE `Profits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profits_fk1` (`sale_id`),
  ADD KEY `profits_contribution` (`contribution_id`);

--
-- Indexes for table `Rules`
--
ALTER TABLE `Rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Sales`
--
ALTER TABLE `Sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Sales_fk0` (`user_id`),
  ADD KEY `Sales_fk1` (`product_id`),
  ADD KEY `Sales_fk2` (`contribution_id`);

--
-- Indexes for table `sales_counter`
--
ALTER TABLE `sales_counter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_counter_product` (`product_id`),
  ADD KEY `sale_counter_sale` (`sale_id`);

--
-- Indexes for table `Sellers`
--
ALTER TABLE `Sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Taggables`
--
ALTER TABLE `Taggables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Taggables_fk0` (`tag_id`);

--
-- Indexes for table `Tags`
--
ALTER TABLE `Tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Carts`
--
ALTER TABLE `Carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Contributions`
--
ALTER TABLE `Contributions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Contributors`
--
ALTER TABLE `Contributors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Debtors`
--
ALTER TABLE `Debtors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Debts`
--
ALTER TABLE `Debts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Expenses`
--
ALTER TABLE `Expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Factories`
--
ALTER TABLE `Factories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Profits`
--
ALTER TABLE `Profits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Rules`
--
ALTER TABLE `Rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Sales`
--
ALTER TABLE `Sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_counter`
--
ALTER TABLE `sales_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Sellers`
--
ALTER TABLE `Sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Taggables`
--
ALTER TABLE `Taggables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_cart_id` FOREIGN KEY (`cart_id`) REFERENCES `Carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_product_product_id` FOREIGN KEY (`product_id`) REFERENCES `Products` (`id`);

--
-- Constraints for table `Contributions`
--
ALTER TABLE `Contributions`
  ADD CONSTRAINT `contribut` FOREIGN KEY (`contributor_id`) REFERENCES `Contributors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Contributors`
--
ALTER TABLE `Contributors`
  ADD CONSTRAINT `asf` FOREIGN KEY (`rule_id`) REFERENCES `Rules` (`id`);

--
-- Constraints for table `Debts`
--
ALTER TABLE `Debts`
  ADD CONSTRAINT `Debts_fk0` FOREIGN KEY (`product_id`) REFERENCES `Products` (`id`),
  ADD CONSTRAINT `Debts_fk1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Debts_fk2` FOREIGN KEY (`debtor_id`) REFERENCES `Debtors` (`id`);

--
-- Constraints for table `Expenses`
--
ALTER TABLE `Expenses`
  ADD CONSTRAINT `asdf` FOREIGN KEY (`contribution_id`) REFERENCES `Contributions` (`id`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_fk0` FOREIGN KEY (`seller_id`) REFERENCES `Sellers` (`id`),
  ADD CONSTRAINT `Orders_fk1` FOREIGN KEY (`factory_id`) REFERENCES `Factories` (`id`);

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `Products_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Products_fk1` FOREIGN KEY (`category_id`) REFERENCES `Categories` (`id`),
  ADD CONSTRAINT `Products_fk2` FOREIGN KEY (`tag_id`) REFERENCES `Tags` (`id`),
  ADD CONSTRAINT `Products_fk3` FOREIGN KEY (`seller_id`) REFERENCES `Sellers` (`id`),
  ADD CONSTRAINT `Products_fk4` FOREIGN KEY (`factory_id`) REFERENCES `Factories` (`id`),
  ADD CONSTRAINT `pro_to_con` FOREIGN KEY (`contribution_id`) REFERENCES `Contributions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Profits`
--
ALTER TABLE `Profits`
  ADD CONSTRAINT `profits_contribution` FOREIGN KEY (`contribution_id`) REFERENCES `Contributions` (`id`),
  ADD CONSTRAINT `profits_fk1` FOREIGN KEY (`sale_id`) REFERENCES `Sales` (`id`);

--
-- Constraints for table `Sales`
--
ALTER TABLE `Sales`
  ADD CONSTRAINT `Sales_fk0` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Sales_fk1` FOREIGN KEY (`product_id`) REFERENCES `Products` (`id`),
  ADD CONSTRAINT `Sales_fk2` FOREIGN KEY (`contribution_id`) REFERENCES `Contributions` (`id`);

--
-- Constraints for table `sales_counter`
--
ALTER TABLE `sales_counter`
  ADD CONSTRAINT `sale_counter_product` FOREIGN KEY (`product_id`) REFERENCES `Products` (`id`),
  ADD CONSTRAINT `sale_counter_sale` FOREIGN KEY (`sale_id`) REFERENCES `Sales` (`id`);

--
-- Constraints for table `Taggables`
--
ALTER TABLE `Taggables`
  ADD CONSTRAINT `Taggables_fk0` FOREIGN KEY (`tag_id`) REFERENCES `Tags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
