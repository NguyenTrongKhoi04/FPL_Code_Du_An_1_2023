-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 12, 2023 lúc 04:24 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accompanyingfood`
--

CREATE TABLE `accompanyingfood` (
  `IdAccompanyingFood` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `NameAccompanyingFood` varchar(100) NOT NULL,
  `QuantityAccompanyingFood` int(11) NOT NULL,
  `PriceAccompanyingFood` int(11) NOT NULL,
  `ImageAccompanyingFood` varchar(100) NOT NULL,
  `StatusAccompanyingFood` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `IdAccount` int(11) NOT NULL,
  `NameAccounts` varchar(100) NOT NULL,
  `Gmail` varchar(100) NOT NULL,
  `Gender` int(11) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `ImageAccounts` varchar(100) DEFAULT NULL,
  `StatusAccount` int(11) NOT NULL DEFAULT 0,
  `Type` varchar(10) NOT NULL,
  `DateEditAccount` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `IdBill` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `IdTable` int(11) NOT NULL,
  `IdAccompanyingFood` int(11) NOT NULL,
  `QuantityBill` int(11) NOT NULL,
  `PriceBill` int(11) NOT NULL,
  `StatusBill` int(11) NOT NULL DEFAULT 0,
  `DateEditBill` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `NoteBill` varchar(100) DEFAULT NULL,
  `PaymentsBill` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `card`
--

CREATE TABLE `card` (
  `IdCart` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `IdSize` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `IdCategory` int(11) NOT NULL,
  `NameCategory` varchar(100) NOT NULL,
  `StatusCategory` int(11) NOT NULL DEFAULT 0,
  `DateEditCategory` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`IdCategory`, `NameCategory`, `StatusCategory`, `DateEditCategory`) VALUES
(1, 'category1', 0, '2023-11-10 08:38:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `IdComment` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `Content` int(11) NOT NULL,
  `StatusComment` int(11) DEFAULT NULL,
  `DateEditComment` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `details`
--

CREATE TABLE `details` (
  `IdDetails` int(11) NOT NULL,
  `ProductDetails` varchar(100) NOT NULL,
  `ProductDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `IdOder` int(11) NOT NULL,
  `IdTable` int(11) NOT NULL,
  `IdAccompanyingFood` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `IdAccount` int(11) NOT NULL,
  `PriceOrders` int(11) NOT NULL,
  `StatusOrders` int(11) DEFAULT 0,
  `QuantityOrders` int(11) NOT NULL,
  `NoteOrders` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `IdProduct` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL,
  `IdDetails` int(11) NOT NULL,
  `NameProducts` varchar(100) NOT NULL,
  `QuantityProducts` int(11) NOT NULL,
  `PriceProducts` int(11) NOT NULL,
  `ImageProducts` varchar(100) NOT NULL,
  `StatusProducts` int(11) NOT NULL DEFAULT 0,
  `DateEditProducts` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `IdSize` int(11) NOT NULL,
  `IdSizeDefault` int(11) NOT NULL,
  `IdProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizedefault`
--

CREATE TABLE `sizedefault` (
  `IdSizeDefault` int(11) NOT NULL,
  `SizeDefault` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcategories`
--

CREATE TABLE `subcategories` (
  `IdSubCategories` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL,
  `SubCategories` varchar(100) NOT NULL,
  `StatusSubCategories` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tables`
--

CREATE TABLE `tables` (
  `IdTable` int(11) NOT NULL,
  `NumberTables` varchar(20) NOT NULL,
  `NumberPeopleInTables` int(11) NOT NULL,
  `NumberPeopleDefaultInTables` int(11) NOT NULL,
  `StatusTables` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accompanyingfood`
--
ALTER TABLE `accompanyingfood`
  ADD PRIMARY KEY (`IdAccompanyingFood`),
  ADD KEY `IdProduct` (`IdProduct`);

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`IdAccount`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`IdBill`),
  ADD KEY `IdTable` (`IdTable`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdAccompanyingFood` (`IdAccompanyingFood`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Chỉ mục cho bảng `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`IdCart`),
  ADD KEY `IdSize` (`IdSize`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCategory`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`IdComment`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Chỉ mục cho bảng `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`IdDetails`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`IdOder`),
  ADD KEY `IdTable` (`IdTable`),
  ADD KEY `IdAccompanyingFood` (`IdAccompanyingFood`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdAccount` (`IdAccount`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`IdProduct`),
  ADD KEY `IdCategory` (`IdCategory`),
  ADD KEY `IdDetails` (`IdDetails`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`IdSize`),
  ADD KEY `IdSizeDefault` (`IdSizeDefault`),
  ADD KEY `IdProduct` (`IdProduct`);

--
-- Chỉ mục cho bảng `sizedefault`
--
ALTER TABLE `sizedefault`
  ADD PRIMARY KEY (`IdSizeDefault`);

--
-- Chỉ mục cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`IdSubCategories`),
  ADD KEY `IdCategory` (`IdCategory`);

--
-- Chỉ mục cho bảng `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`IdTable`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accompanyingfood`
--
ALTER TABLE `accompanyingfood`
  MODIFY `IdAccompanyingFood` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `IdAccount` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `IdBill` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `card`
--
ALTER TABLE `card`
  MODIFY `IdCart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `IdCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `IdComment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `details`
--
ALTER TABLE `details`
  MODIFY `IdDetails` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `IdOder` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `IdProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `size`
--
ALTER TABLE `size`
  MODIFY `IdSize` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sizedefault`
--
ALTER TABLE `sizedefault`
  MODIFY `IdSizeDefault` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `IdSubCategories` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tables`
--
ALTER TABLE `tables`
  MODIFY `IdTable` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accompanyingfood`
--
ALTER TABLE `accompanyingfood`
  ADD CONSTRAINT `accompanyingfood_ibfk_1` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`);

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`IdTable`) REFERENCES `tables` (`IdTable`),
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`),
  ADD CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`IdAccompanyingFood`) REFERENCES `accompanyingfood` (`IdAccompanyingFood`),
  ADD CONSTRAINT `bill_ibfk_4` FOREIGN KEY (`IdAccount`) REFERENCES `account` (`IdAccount`);

--
-- Các ràng buộc cho bảng `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`IdSize`) REFERENCES `size` (`IdSize`),
  ADD CONSTRAINT `card_ibfk_2` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`),
  ADD CONSTRAINT `card_ibfk_3` FOREIGN KEY (`IdAccount`) REFERENCES `account` (`IdAccount`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`IdAccount`) REFERENCES `account` (`IdAccount`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`IdTable`) REFERENCES `tables` (`IdTable`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`IdAccompanyingFood`) REFERENCES `accompanyingfood` (`IdAccompanyingFood`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`IdAccount`) REFERENCES `account` (`IdAccount`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`IdDetails`) REFERENCES `details` (`IdDetails`);

--
-- Các ràng buộc cho bảng `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `size_ibfk_1` FOREIGN KEY (`IdSizeDefault`) REFERENCES `sizedefault` (`IdSizeDefault`),
  ADD CONSTRAINT `size_ibfk_2` FOREIGN KEY (`IdProduct`) REFERENCES `product` (`IdProduct`);

--
-- Các ràng buộc cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`IdCategory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
