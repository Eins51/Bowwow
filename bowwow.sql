-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 08:52 AM
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

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`id`, `name`, `gender`, `breed`, `size`, `age`, `birthday`, `user_id`) VALUES
(1, 'Buddy', 0, 'Golden Retriever', 'Medium', 4, '2019-02-14', 1),
(2, 'Luna', 1, 'Siamese', 'Small', 3, '2020-04-23', 2),
(3, 'Max', 0, 'Labrador Retriever', 'Large', 5, '2017-06-05', 3),
(4, 'Smokey', 0, 'Russian Blue', 'Medium', 4, '2018-09-08', 4),
(5, 'Daisy', 1, 'Bulldog', 'Medium', 7, '2016-01-22', 5),
(6, 'Cocoa', 0, 'Beagle', 'Small', 2, '2020-11-01', 6),
(7, 'Milo', 0, 'Maine Coon', 'Large', 7, '2015-07-17', 7),
(8, 'Maggie', 1, 'Siberian Husky', 'Large', 5, '2017-08-04', 8),
(9, 'Oliver', 0, 'Poodle', 'Small', 3, '2019-10-21', 9),
(10, 'Chloe', 1, 'Chihuahua', 'Small', 4, '2018-12-03', 10),
(11, 'Rocky', 0, 'German Shepherd', 'Large', 7, '2016-02-11', 11),
(12, 'Bella', 1, 'Persian', 'Small', 3, '2020-03-29', 12),
(13, 'Benji', 0, 'Siberian Husky', 'Medium', 4, '2019-02-01', 7),
(14, 'Luna', 1, 'Persian', 'Small', 4, '2018-05-12', 9),
(15, 'Max', 0, 'Golden Retriever', 'Large', 2, '2020-10-19', 3),
(16, 'Tofu', 0, 'Dwarf Hamster', 'Small', 1, '2021-07-15', 6),
(17, 'Lucy', 1, 'Scottish Fold', 'Medium', 3, '2019-11-20', 1),
(18, 'Buddy', 0, 'Beagle', 'Medium', 3, '2020-04-30', 4),
(19, 'Noodle', 1, 'Sphynx', 'Small', 3, '2020-02-22', 8),
(20, 'Charlie', 0, 'Poodle', 'Medium', 4, '2019-01-01', 2),
(21, 'Mittens', 1, 'Siamese', 'Small', 2, '2020-08-07', 5),
(22, 'Rocky', 0, 'German Shepherd', 'Large', 2, '2021-01-01', 10),
(23, 'Cocoa', 1, 'Tabby', 'Small', 3, '2019-06-13', 11),
(24, 'Cotton', 0, 'Angora Rabbit', 'Medium', 4, '2018-08-08', 1);

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

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `cate_id`, `is_hot`, `price`, `stock_qty`, `status`, `description`, `image_path`) VALUES
(1, 'Royal Canin Adult Dry Dog Food', 1, 1, '39.99', 100, 0, 'This dry dog food is specially formulated for adult dogs to support healthy digestion and strong immune systems. Made with high-quality proteins, vitamins, and minerals, this dog food provides complete and balanced nutrition for your furry friend.', 'royal-canin-dog-food.jpg'),
(2, 'Hill\'s Science Diet Wet Cat Food Variety Pack', 1, 0, '24.99', 50, 0, 'This variety pack of wet cat food includes four different flavors to keep your cat interested and satisfied. Made with natural ingredients and no artificial preservatives, this cat food provides complete and balanced nutrition for adult cats.', 'hills-science-diet-cat-food.jpg'),
(3, 'PetSafe Drinkwell 360 Pet Fountain', 2, 1, '49.95', 25, 0, 'This pet fountain provides fresh, filtered water for your furry friend to encourage hydration and improve their overall health. With multiple spout rings, this fountain is perfect for households with multiple pets.', 'drinwell-pet-fountain.jpg'),
(4, 'Vet\'s Best Allergy Itch Relief Dog Shampoo', 2, 0, '9.99', 75, 0, 'This dog shampoo is formulated with natural ingredients to soothe and relieve itchy, irritated skin. Gentle and safe for frequent use, this shampoo is perfect for dogs with allergies or sensitive skin.', 'vets-best-dog-shampoo.jpg'),
(5, 'FURminator Undercoat Deshedding Tool for Dogs', 3, 1, '29.99', 20, 0, 'This deshedding tool is designed to reduce shedding by up to 90% by removing loose fur from your dog\'s undercoat without damaging their topcoat. Suitable for all coat types, this tool helps keep your home free of pet hair.', 'furminator-dog-brush.jpg'),
(6, 'Andis ProClip AGC2 UltraEdge Clipper', 3, 0, '199.99', 5, 0, 'This professional-grade clipper is perfect for grooming your dog at home. With a powerful motor and detachable blade, this clipper is versatile and easy to use for all coat types.', 'andis-dog-clipper.jpg'),
(7, 'KONG Classic Dog Toy', 4, 1, '9.99', 100, 0, 'This classic dog toy is made with durable rubber to withstand even the toughest chewers. Perfect for stuffing with treats or peanut butter, this toy will keep your dog entertained for hours.', 'kong-dog-toy.jpg'),
(8, 'Outward Hound Nina Ottosson Dog Tornado Puzzle Toy', 4, 0, '24.99', 30, 0, 'This interactive puzzle toy is perfect for keeping your dog entertained and mentally stimulated. With multiple layers and hidden compartments, this toy requires your dog to use their problem-solving skills to find the treats.', 'nina-ottosson-dog-toy.jpg'),
(9, 'Organic Chicken & Brown Rice Recipe Dog Food', 1, 1, '49.99', 50, 0, 'This premium dog food is made with high-quality organic chicken and brown rice, providing a balanced and nutritious meal for your furry friend.', 'organic-chicken-brown-rice-dog-food.jpg'),
(10, 'Teeth Cleaning Dog Treats', 2, 0, '14.99', 100, 0, 'These dental chews help clean your dog\'s teeth and freshen their breath, while also providing a tasty treat they\'ll love.', 'teeth-cleaning-dog-treats.jpg'),
(11, 'Cat Grooming Brush', 3, 0, '9.99', 20, 0, 'This brush is designed to help remove loose fur and prevent hairballs in cats, while also providing a relaxing massage for your feline friend.', 'cat-grooming-brush.jpg'),
(12, 'Interactive Cat Toy', 4, 1, '19.99', 30, 0, 'This interactive toy features a variety of fun activities to keep your cat entertained and engaged, including a ball track, scratching pad, and hanging toys.', 'interactive-cat-toy.jpg'),
(13, 'Pet Carrier Backpack', 5, 0, '39.99', 10, 0, 'This backpack-style pet carrier is perfect for small dogs and cats, with adjustable straps and breathable mesh panels for comfort on the go.', 'pet-carrier-backpack.jpg'),
(14, 'Scratching Post with Perch', 6, 1, '59.99', 5, 0, 'This multi-level scratching post features a cozy perch for your cat to relax on, as well as a variety of scratching surfaces to help keep their claws healthy and sharp.', 'scratching-post-with-perch.jpg'),
(15, 'Large Dog Bed', 1, 0, '79.99', 15, 0, 'This comfortable dog bed is perfect for larger breeds, with a soft and supportive mattress and a durable, washable cover.', 'large-dog-bed.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
