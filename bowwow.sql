-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 06:58 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bowwow`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user id: foreign key referring ''user'' table',
  `is_default` tinyint(4) NOT NULL COMMENT '0: no, 1: yes',
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL COMMENT 'address details (house number and street name)',
  `postal_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: activated, 1: forbidden',
  `rank` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL COMMENT 'for category icon'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `rank`, `description`, `image_path`) VALUES
(1, 'Food', 0, 1, 'All kinds of pet food', 'food.svg'),
(2, 'Health', 0, 2, 'Pet health care products', 'health.svg'),
(3, 'Grooming', 0, 3, 'Pet grooming supplies', 'grooming.svg'),
(4, 'Toys', 0, 4, 'Various kinds of pet toys', 'toys.svg'),
(5, 'Carriers', 1, 5, 'Pet carriers for travelling', 'carriers.svg'),
(6, 'Furniture', 0, 6, 'Pet beds, houses and furniture', 'furniture.svg');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` tinyint(4) NOT NULL COMMENT '0: discount coupon, 1: voucher, 2: cash coupon',
  `value` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_detail`
--

CREATE TABLE `coupon_detail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user id: foreign key referring ''user'' table',
  `coupon_id` int(11) NOT NULL COMMENT 'coupon id: foreign key referring ''coupon'' table',
  `coupon_num` int(11) NOT NULL COMMENT 'number of this coupon item'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'total quantity of products in this order',
  `t_amount` decimal(10,2) NOT NULL COMMENT 'total amount; $',
  `freight` decimal(10,2) NOT NULL COMMENT 'freight charge; $',
  `discount` decimal(10,2) NOT NULL COMMENT 'discount amount; $',
  `coupon_id` int(11) DEFAULT NULL COMMENT 'coupon id: foreign key referring ''coupon_detail'' table',
  `r_amount` decimal(10,2) NOT NULL COMMENT 'real amount; $',
  `user_id` int(11) NOT NULL COMMENT 'user id: foreign key referring ''user'' table',
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment` tinyint(4) NOT NULL COMMENT 'payment method; 0: PayPal, 1: Credit card, 2: Alipay',
  `status` tinyint(4) NOT NULL COMMENT '0: unpaid, 1: unshipped, 2: shipped, 3: completed, 4: canceled',
  `create_time` datetime NOT NULL,
  `pay_time` datetime NOT NULL,
  `delivery_time` datetime NOT NULL,
  `shipped_time` datetime NOT NULL,
  `completed_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL COMMENT 'order id: foreign key referring ''order'' table',
  `item_id` int(11) NOT NULL COMMENT 'product id: foreign key referring ''product'' table',
  `item_num` int(11) NOT NULL COMMENT 'number of this product item'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0: male, 1: female, 2: secrecy',
  `breed` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user id: foreign key referring ''user'' table'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cate_id` int(11) NOT NULL COMMENT 'category id: foreign key referring ''category'' table',
  `is_hot` tinyint(4) NOT NULL COMMENT '0: no, 1: yes',
  `price` decimal(10,2) NOT NULL COMMENT '$',
  `stock_qty` int(11) NOT NULL COMMENT 'stock quantity',
  `status` tinyint(4) NOT NULL COMMENT '0: shelved, 1: unshelved',
  `description` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL COMMENT 'for product image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0: male, 1: female, 2: others, 3: secrecy',
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(4) NOT NULL COMMENT '0: no, 1: yes',
  `is_member` tinyint(4) NOT NULL COMMENT '0: no, 1: yes',
  `num_purchase` int(11) NOT NULL COMMENT 'number of purchase/orders',
  `amount` decimal(10,2) NOT NULL COMMENT 'total purchase amount',
  `payment` tinyint(4) NOT NULL COMMENT 'default payment method; 0: PayPal, 1: Credit card, 2: Alipay',
  `address` varchar(255) NOT NULL COMMENT 'default shipping address',
  `last_online` time NOT NULL COMMENT 'last online time',
  `image_path` varchar(255) DEFAULT NULL COMMENT 'for headshots'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `gender`, `phone`, `email`, `is_admin`, `is_member`, `num_purchase`, `amount`, `payment`, `address`, `last_online`, `image_path`) VALUES
(1, 'admin', '1234', 3, 1234567890, 'admin@example.com', 1, 1, 10, '100.50', 0, '123 Main St, Anytown USA', '15:30:00', '/path/to/image.jpg'),
(2, 'John Doe', 'sdf1Hjks%', 0, 328593827, 'johndoe@example.com', 0, 1, 10, '899.99', 1, '123 Main St, Anytown USA', '18:15:00', 'path/to/image1.jpg'),
(3, 'Jane Smith', 'dgh0fT%hG', 1, 827349020, 'janesmith@example.com', 0, 1, 5, '450.00', 0, '456 Oak Ave, Anytown USA', '14:30:00', 'path/to/image2.jpg'),
(4, 'Mark Johnson', 'fdh2Jhs^', 0, 729834567, 'markjohnson@example.com', 0, 1, 7, '631.25', 1, '789 Elm St, Anytown USA', '10:45:00', 'path/to/image3.jpg'),
(5, 'Samantha Lee', 'fKj4dLh%', 1, 423874956, 'samanthalee@example.com', 0, 0, 0, '0.00', 2, '321 Pine St, Anytown USA', '09:00:00', 'path/to/image4.jpg'),
(6, 'William Chen', 'dHk6fJl#', 0, 982735648, 'williamchen@example.com', 0, 0, 0, '0.00', 1, '654 Birch Rd, Anytown USA', '16:20:00', 'path/to/image5.jpg'),
(7, 'Emily Kim', 'dsJ8Hfh^', 1, 657823419, 'emilykim@example.com', 0, 0, 0, '0.00', 0, '987 Maple St, Anytown USA', '11:10:00', 'path/to/image6.jpg'),
(8, 'Hannah Jones', '83uIv29J', 1, 437206554, 'hjones@gmail.com', 0, 1, 8, '1645.32', 0, '123 Main St., Apt. 456, Boston, MA 02118', '23:15:00', NULL),
(9, 'Tom Smith', 'KfY8J7W6', 0, 942772803, 'tsmith@yahoo.com', 0, 0, 0, '0.00', 1, '456 Park Ave., New York, NY 10022', '14:10:00', NULL),
(10, 'Emily Johnson', 'l04pLhj7', 1, 897602841, 'ejohnson@hotmail.com', 0, 1, 3, '788.99', 2, '789 Cedar St., San Francisco, CA 94109', '09:35:00', NULL),
(11, 'Ethan Lee', 'x7J9KtS1', 0, 155986930, 'elee@gmail.com', 0, 1, 12, '2750.21', 1, '456 Park Ave., New York, NY 10022', '17:22:00', NULL),
(12, 'Olivia Davis', 'J8bHcE2r', 1, 176409078, 'odavis@yahoo.com', 0, 0, 0, '0.00', 0, '789 Cedar St., San Francisco, CA 94109', '11:45:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rank` (`rank`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_detail`
--
ALTER TABLE `coupon_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_detail_ibfk_1` (`user_id`),
  ADD KEY `coupon_detail_ibfk_2` (`coupon_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_id` (`coupon_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_detail_ibfk_1` (`order_id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_detail`
--
ALTER TABLE `coupon_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coupon_detail`
--
ALTER TABLE `coupon_detail`
  ADD CONSTRAINT `coupon_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_detail_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_detail` (`coupon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
