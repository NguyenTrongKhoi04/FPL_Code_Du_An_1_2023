-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 08:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `IdAccount` int(11) NOT NULL,
  `NameAccount` varchar(100) NOT NULL,
  `Gmail` varchar(100) NOT NULL,
  `Gender` int(11) DEFAULT 0,
  `Password` varchar(100) NOT NULL,
  `ImageAccounts` varchar(100) DEFAULT NULL,
  `StatusAccount` int(11) DEFAULT 0,
  `Role` int(11) DEFAULT 0,
  `DateEditAccount` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `IdBill` int(11) NOT NULL,
  `IdOrder` int(11) NOT NULL,
  `BillDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PriceBill` int(11) NOT NULL,
  `PaymentMethodBill` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `IdCart` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `Size` varchar(100) NOT NULL,
  `PriceCard` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DateCart` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `IdCategory` int(11) NOT NULL,
  `NameCategory` varchar(100) NOT NULL,
  `StatusCategory` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `IdComment` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `Content` varchar(100) NOT NULL,
  `StatusComment` int(11) DEFAULT 0,
  `DateEditComment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `IdDetails` int(11) NOT NULL,
  `ProductDetails` varchar(100) NOT NULL,
  `ProductDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `IdOrder` int(11) NOT NULL,
  `IdTable` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `PriceOrders` int(11) NOT NULL,
  `StatusOrders` int(11) DEFAULT 0,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_pro`
--

CREATE TABLE `order_pro` (
  `IdOrder_Pro` int(11) NOT NULL,
  `IdOrder` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `StatusOrders` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `IdProduct` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL,
  `IdDetails` int(11) NOT NULL,
  `NameProduct` varchar(100) NOT NULL,
  `QuantityProduct` int(11) NOT NULL,
  `PriceProduct` int(11) NOT NULL,
  `ImageProduct` varchar(100) NOT NULL,
  `StatusProduct` int(11) DEFAULT 0,
  `DateEditProduct` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `IdSize` int(11) NOT NULL,
  `NameSize` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size_pro`
--

CREATE TABLE `size_pro` (
  `IdSizePro` int(11) NOT NULL,
  `IdProduct` int(11) DEFAULT NULL,
  `IdSize` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `IdSubCategories` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL,
  `NameSubCategories` varchar(100) NOT NULL,
  `StatusSubCategories` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `IdTables` int(11) NOT NULL,
  `NumberTable` int(11) DEFAULT NULL,
  `StatusTable` int(11) DEFAULT 0,
  `NumberPeople` int(11) DEFAULT NULL CHECK (`NumberPeople` <= 10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`IdAccount`),
  ADD UNIQUE KEY `Gmail` (`Gmail`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`IdBill`),
  ADD KEY `fk_IdOder` (`IdOrder`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`IdCart`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`IdComment`),
  ADD KEY `IdAccount` (`IdAccount`),
  ADD KEY `IdProduct` (`IdProduct`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`IdDetails`),
  ADD UNIQUE KEY `ProductDescription` (`ProductDescription`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`IdOrder`),
  ADD KEY `IdAccount` (`IdAccount`),
  ADD KEY `fk_IdTabse` (`IdTable`);

--
-- Indexes for table `order_pro`
--
ALTER TABLE `order_pro`
  ADD PRIMARY KEY (`IdOrder_Pro`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdOrder` (`IdOrder`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`IdProduct`),
  ADD UNIQUE KEY `NameProduct` (`NameProduct`),
  ADD KEY `IdCategory` (`IdCategory`),
  ADD KEY `IdDetails` (`IdDetails`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`IdSize`);

--
-- Indexes for table `size_pro`
--
ALTER TABLE `size_pro`
  ADD PRIMARY KEY (`IdSizePro`),
  ADD UNIQUE KEY `IdProduct` (`IdProduct`),
  ADD UNIQUE KEY `IdSize` (`IdSize`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`IdSubCategories`),
  ADD KEY `IdCategory` (`IdCategory`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`IdTables`),
  ADD UNIQUE KEY `NumberTable` (`NumberTable`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `IdBill` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `IdCart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `IdComment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `IdDetails` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `IdOrder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_pro`
--
ALTER TABLE `order_pro`
  MODIFY `IdOrder_Pro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `IdProduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `IdSize` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size_pro`
--
ALTER TABLE `size_pro`
  MODIFY `IdSizePro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `IdSubCategories` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `IdTables` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_IdOder` FOREIGN KEY (`IdOrder`) REFERENCES `orders` (`IdOrder`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`IdAccount`) REFERENCES `account` (`IdAccount`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`IdAccount`) REFERENCES `account` (`IdAccount`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_IdTabse` FOREIGN KEY (`IdTable`) REFERENCES `tables` (`IdTables`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`IdAccount`) REFERENCES `account` (`IdAccount`);

--
-- Constraints for table `order_pro`
--
ALTER TABLE `order_pro`
  ADD CONSTRAINT `order_pro_ibfk_1` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`),
  ADD CONSTRAINT `order_pro_ibfk_2` FOREIGN KEY (`IdOrder`) REFERENCES `orders` (`IdOrder`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`IdDetails`) REFERENCES `details` (`IdDetails`);

--
-- Constraints for table `size_pro`
--
ALTER TABLE `size_pro`
  ADD CONSTRAINT `size_pro_ibfk_1` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`),
  ADD CONSTRAINT `size_pro_ibfk_2` FOREIGN KEY (`IdSize`) REFERENCES `size` (`IdSize`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
