/*
 Navicat Premium Data Transfer

 Source Server         : xampp_mysql
 Source Server Type    : MySQL
 Source Server Version : 100422 (10.4.22-MariaDB)
 Source Host           : 127.0.0.1:3306
 Source Schema         : bowwow

 Target Server Type    : MySQL
 Target Server Version : 100422 (10.4.22-MariaDB)
 File Encoding         : 65001

 Date: 01/05/2023 16:27:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL COMMENT 'user id: foreign key referring \'user\' table',
  `is_default` tinyint NOT NULL COMMENT '0: no, 1: yes',
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'address details (house number and street name)',
  `postal_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of address
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint NOT NULL COMMENT '0: activated, 1: forbidden',
  `rank` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'for category icon',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `rank`(`rank` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Food', 0, 1, 'All kinds of pet food', 'food.svg');
INSERT INTO `category` VALUES (2, 'Health', 0, 2, 'Pet health care products', 'health.svg');
INSERT INTO `category` VALUES (3, 'Grooming', 0, 3, 'Pet grooming supplies', 'grooming.svg');
INSERT INTO `category` VALUES (4, 'Toys', 0, 4, 'Various kinds of pet toys', 'toys.svg');
INSERT INTO `category` VALUES (5, 'Carriers', 1, 5, 'Pet carriers for travelling', 'carriers.svg');
INSERT INTO `category` VALUES (6, 'Furniture', 0, 6, 'Pet beds, houses and furniture', 'furniture.svg');

-- ----------------------------
-- Table structure for coupon
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category` tinyint NOT NULL COMMENT '0: discount coupon, 1: voucher, 2: cash coupon',
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupon
-- ----------------------------
INSERT INTO `coupon` VALUES (1, 'Summer Sale Discount Coupon', 0, '0.2', 100, '2023-06-01 00:00:00', '2023-06-30 23:59:59', 'Get 20% off on all summer pet items');
INSERT INTO `coupon` VALUES (2, 'New User Welcome Voucher', 1, '100', 500, '2023-05-01 00:00:00', '2023-12-31 23:59:59', 'Sign up and get a voucher worth $100 for your first purchase!');
INSERT INTO `coupon` VALUES (3, 'Halloween Cash Coupon', 2, '50', 50, '2023-10-15 00:00:00', '2023-11-01 23:59:59', 'Get $50 off on any purchase of $300 or more during Halloween season');
INSERT INTO `coupon` VALUES (4, 'Dog Food Discount Coupon', 0, '0.1', 200, '2023-05-15 00:00:00', '2023-06-30 23:59:59', 'Get 10% off on all dog food items');
INSERT INTO `coupon` VALUES (5, 'Summer Pet Grooming Voucher', 1, '200', 100, '2023-06-01 00:00:00', '2023-07-31 23:59:59', 'Get $200 worth of pet grooming services for free with any purchase of $500 or more on summer pet items');
INSERT INTO `coupon` VALUES (6, 'Cat Toy Cash Coupon', 2, '30', 100, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get $30 off on any purchase of cat toys');
INSERT INTO `coupon` VALUES (7, 'Summer Sale Voucher', 1, '150', 200, '2023-06-01 00:00:00', '2023-06-30 23:59:59', 'Get a voucher worth $150 for any purchase of $300 or more on summer pet items');
INSERT INTO `coupon` VALUES (8, '50% off on pet food', 0, '50', 100, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get 50% off on all pet food items');
INSERT INTO `coupon` VALUES (9, '10% off on pet toys', 0, '10', 200, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get 10% off on all pet toys');
INSERT INTO `coupon` VALUES (10, '$5 voucher for pet grooming', 1, '5', 500, '2023-05-01 00:00:00', '2023-08-31 23:59:59', 'Get $5 voucher on pet grooming services');
INSERT INTO `coupon` VALUES (11, '$10 cash coupon', 2, '10', 1000, '2023-05-01 00:00:00', '2023-05-31 23:59:59', 'Get $10 off on any purchase');
INSERT INTO `coupon` VALUES (12, '20% off on pet beds', 0, '20', 300, '2023-05-01 00:00:00', '2023-06-15 23:59:59', 'Get 20% off on all pet beds');
INSERT INTO `coupon` VALUES (13, 'Free shipping on orders over $50', 0, '0', 500, '2023-05-01 00:00:00', '2023-07-31 23:59:59', 'Get free shipping on all orders over $50');
INSERT INTO `coupon` VALUES (14, '15% off on pet carriers', 0, '15', 200, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get 15% off on all pet carriers');
INSERT INTO `coupon` VALUES (15, '$20 voucher for pet boarding', 1, '20', 100, '2023-05-01 00:00:00', '2023-09-30 23:59:59', 'Get $20 voucher on pet boarding services');

-- ----------------------------
-- Table structure for coupon_detail
-- ----------------------------
DROP TABLE IF EXISTS `coupon_detail`;
CREATE TABLE `coupon_detail`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL COMMENT 'user id: foreign key referring \'user\' table',
  `coupon_id` int NOT NULL COMMENT 'coupon id: foreign key referring \'coupon\' table',
  `coupon_num` int NOT NULL COMMENT 'number of this coupon item',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `coupon_detail_ibfk_1`(`user_id` ASC) USING BTREE,
  INDEX `coupon_detail_ibfk_2`(`coupon_id` ASC) USING BTREE,
  CONSTRAINT `coupon_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `coupon_detail_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupon_detail
-- ----------------------------

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantity` int NOT NULL COMMENT 'total quantity of products in this order',
  `t_amount` decimal(10, 2) NOT NULL COMMENT 'total amount; $',
  `freight` decimal(10, 2) NOT NULL COMMENT 'freight charge; $',
  `discount` decimal(10, 2) NOT NULL COMMENT 'discount amount; $',
  `coupon_id` int NULL DEFAULT NULL COMMENT 'coupon id: foreign key referring \'coupon_detail\' table',
  `r_amount` decimal(10, 2) NOT NULL COMMENT 'real amount; $',
  `user_id` int NOT NULL COMMENT 'user id: foreign key referring \'user\' table',
  `phone` int NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment` tinyint NOT NULL COMMENT 'payment method; 0: PayPal, 1: Credit card, 2: Alipay',
  `status` tinyint NOT NULL COMMENT '0: unpaid, 1: unshipped, 2: shipped, 3: completed, 4: canceled',
  `create_time` datetime NOT NULL,
  `pay_time` datetime NOT NULL,
  `delivery_time` datetime NOT NULL,
  `shipped_time` datetime NOT NULL,
  `completed_time` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `coupon_id`(`coupon_id` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_detail` (`coupon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL COMMENT 'order id: foreign key referring \'order\' table',
  `item_id` int NOT NULL COMMENT 'product id: foreign key referring \'product\' table',
  `item_num` int NOT NULL COMMENT 'number of this product item',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `item_id`(`item_id` ASC) USING BTREE,
  INDEX `order_detail_ibfk_1`(`order_id` ASC) USING BTREE,
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for pet
-- ----------------------------
DROP TABLE IF EXISTS `pet`;
CREATE TABLE `pet`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint NULL DEFAULT NULL COMMENT '0: male, 1: female, 2: secrecy',
  `breed` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `age` int NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `user_id` int NOT NULL COMMENT 'user id: foreign key referring \'user\' table',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pet
-- ----------------------------
INSERT INTO `pet` VALUES (1, 'Buddy', 0, 'Golden Retriever', 'Medium', 4, '2019-02-14', 1);
INSERT INTO `pet` VALUES (2, 'Luna', 1, 'Siamese', 'Small', 3, '2020-04-23', 2);
INSERT INTO `pet` VALUES (3, 'Max', 0, 'Labrador Retriever', 'Large', 5, '2017-06-05', 3);
INSERT INTO `pet` VALUES (4, 'Smokey', 0, 'Russian Blue', 'Medium', 4, '2018-09-08', 4);
INSERT INTO `pet` VALUES (5, 'Daisy', 1, 'Bulldog', 'Medium', 7, '2016-01-22', 5);
INSERT INTO `pet` VALUES (6, 'Cocoa', 0, 'Beagle', 'Small', 2, '2020-11-01', 6);
INSERT INTO `pet` VALUES (7, 'Milo', 0, 'Maine Coon', 'Large', 7, '2015-07-17', 7);
INSERT INTO `pet` VALUES (8, 'Maggie', 1, 'Siberian Husky', 'Large', 5, '2017-08-04', 8);
INSERT INTO `pet` VALUES (9, 'Oliver', 0, 'Poodle', 'Small', 3, '2019-10-21', 9);
INSERT INTO `pet` VALUES (10, 'Chloe', 1, 'Chihuahua', 'Small', 4, '2018-12-03', 10);
INSERT INTO `pet` VALUES (11, 'Rocky', 0, 'German Shepherd', 'Large', 7, '2016-02-11', 11);
INSERT INTO `pet` VALUES (12, 'Bella', 1, 'Persian', 'Small', 3, '2020-03-29', 12);
INSERT INTO `pet` VALUES (13, 'Benji', 0, 'Siberian Husky', 'Medium', 4, '2019-02-01', 7);
INSERT INTO `pet` VALUES (14, 'Luna', 1, 'Persian', 'Small', 4, '2018-05-12', 9);
INSERT INTO `pet` VALUES (15, 'Max', 0, 'Golden Retriever', 'Large', 2, '2020-10-19', 3);
INSERT INTO `pet` VALUES (16, 'Tofu', 0, 'Dwarf Hamster', 'Small', 1, '2021-07-15', 6);
INSERT INTO `pet` VALUES (17, 'Lucy', 1, 'Scottish Fold', 'Medium', 3, '2019-11-20', 1);
INSERT INTO `pet` VALUES (18, 'Buddy', 0, 'Beagle', 'Medium', 3, '2020-04-30', 4);
INSERT INTO `pet` VALUES (19, 'Noodle', 1, 'Sphynx', 'Small', 3, '2020-02-22', 8);
INSERT INTO `pet` VALUES (20, 'Charlie', 0, 'Poodle', 'Medium', 4, '2019-01-01', 2);
INSERT INTO `pet` VALUES (21, 'Mittens', 1, 'Siamese', 'Small', 2, '2020-08-07', 5);
INSERT INTO `pet` VALUES (22, 'Rocky', 0, 'German Shepherd', 'Large', 2, '2021-01-01', 10);
INSERT INTO `pet` VALUES (23, 'Cocoa', 1, 'Tabby', 'Small', 3, '2019-06-13', 11);
INSERT INTO `pet` VALUES (24, 'Cotton', 0, 'Angora Rabbit', 'Medium', 4, '2018-08-08', 1);

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cate_id` int NOT NULL COMMENT 'category id: foreign key referring \'category\' table',
  `is_hot` tinyint NOT NULL COMMENT '0: no, 1: yes',
  `price` decimal(10, 2) NOT NULL COMMENT '$',
  `stock_qty` int NOT NULL COMMENT 'stock quantity',
  `status` tinyint NOT NULL COMMENT '0: shelved, 1: unshelved',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'for product image',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cate_id`(`cate_id` ASC) USING BTREE,
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 'Royal Canin Adult Dry Dog Food', 1, 1, 39.99, 100, 0, 'This dry dog food is specially formulated for adult dogs to support healthy digestion and strong immune systems. Made with high-quality proteins, vitamins, and minerals, this dog food provides complete and balanced nutrition for your furry friend.', 'royal-canin-dog-food.jpg');
INSERT INTO `product` VALUES (2, 'Hill\'s Science Diet Wet Cat Food Variety Pack', 1, 0, 24.99, 50, 0, 'This variety pack of wet cat food includes four different flavors to keep your cat interested and satisfied. Made with natural ingredients and no artificial preservatives, this cat food provides complete and balanced nutrition for adult cats.', 'hills-science-diet-cat-food.jpg');
INSERT INTO `product` VALUES (3, 'PetSafe Drinkwell 360 Pet Fountain', 2, 1, 49.95, 25, 0, 'This pet fountain provides fresh, filtered water for your furry friend to encourage hydration and improve their overall health. With multiple spout rings, this fountain is perfect for households with multiple pets.', 'drinwell-pet-fountain.jpg');
INSERT INTO `product` VALUES (4, 'Vet\'s Best Allergy Itch Relief Dog Shampoo', 2, 0, 9.99, 75, 0, 'This dog shampoo is formulated with natural ingredients to soothe and relieve itchy, irritated skin. Gentle and safe for frequent use, this shampoo is perfect for dogs with allergies or sensitive skin.', 'vets-best-dog-shampoo.jpg');
INSERT INTO `product` VALUES (5, 'FURminator Undercoat Deshedding Tool for Dogs', 3, 1, 29.99, 20, 0, 'This deshedding tool is designed to reduce shedding by up to 90% by removing loose fur from your dog\'s undercoat without damaging their topcoat. Suitable for all coat types, this tool helps keep your home free of pet hair.', 'furminator-dog-brush.jpg');
INSERT INTO `product` VALUES (6, 'Andis ProClip AGC2 UltraEdge Clipper', 3, 0, 199.99, 5, 0, 'This professional-grade clipper is perfect for grooming your dog at home. With a powerful motor and detachable blade, this clipper is versatile and easy to use for all coat types.', 'andis-dog-clipper.jpg');
INSERT INTO `product` VALUES (7, 'KONG Classic Dog Toy', 4, 1, 9.99, 100, 0, 'This classic dog toy is made with durable rubber to withstand even the toughest chewers. Perfect for stuffing with treats or peanut butter, this toy will keep your dog entertained for hours.', 'kong-dog-toy.jpg');
INSERT INTO `product` VALUES (8, 'Outward Hound Nina Ottosson Dog Tornado Puzzle Toy', 4, 0, 24.99, 30, 0, 'This interactive puzzle toy is perfect for keeping your dog entertained and mentally stimulated. With multiple layers and hidden compartments, this toy requires your dog to use their problem-solving skills to find the treats.', 'nina-ottosson-dog-toy.jpg');
INSERT INTO `product` VALUES (9, 'Organic Chicken & Brown Rice Recipe Dog Food', 1, 1, 49.99, 50, 0, 'This premium dog food is made with high-quality organic chicken and brown rice, providing a balanced and nutritious meal for your furry friend.', 'organic-chicken-brown-rice-dog-food.jpg');
INSERT INTO `product` VALUES (10, 'Teeth Cleaning Dog Treats', 2, 0, 14.99, 100, 0, 'These dental chews help clean your dog\'s teeth and freshen their breath, while also providing a tasty treat they\'ll love.', 'teeth-cleaning-dog-treats.jpg');
INSERT INTO `product` VALUES (11, 'Cat Grooming Brush', 3, 0, 9.99, 20, 0, 'This brush is designed to help remove loose fur and prevent hairballs in cats, while also providing a relaxing massage for your feline friend.', 'cat-grooming-brush.jpg');
INSERT INTO `product` VALUES (12, 'Interactive Cat Toy', 4, 1, 19.99, 30, 0, 'This interactive toy features a variety of fun activities to keep your cat entertained and engaged, including a ball track, scratching pad, and hanging toys.', 'interactive-cat-toy.jpg');
INSERT INTO `product` VALUES (13, 'Pet Carrier Backpack', 5, 0, 39.99, 10, 0, 'This backpack-style pet carrier is perfect for small dogs and cats, with adjustable straps and breathable mesh panels for comfort on the go.', 'pet-carrier-backpack.jpg');
INSERT INTO `product` VALUES (14, 'Scratching Post with Perch', 6, 1, 59.99, 5, 0, 'This multi-level scratching post features a cozy perch for your cat to relax on, as well as a variety of scratching surfaces to help keep their claws healthy and sharp.', 'scratching-post-with-perch.jpg');
INSERT INTO `product` VALUES (15, 'Large Dog Bed', 1, 0, 79.99, 15, 0, 'This comfortable dog bed is perfect for larger breeds, with a soft and supportive mattress and a durable, washable cover.', 'large-dog-bed.jpg');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint NULL DEFAULT NULL COMMENT '0: male, 1: female, 2: others, 3: secrecy',
  `phone` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_admin` tinyint NOT NULL COMMENT '0: no, 1: yes',
  `is_member` tinyint NOT NULL COMMENT '0: no, 1: yes',
  `num_purchase` int NOT NULL COMMENT 'number of purchase/orders',
  `amount` decimal(10, 2) NOT NULL COMMENT 'total purchase amount',
  `payment` tinyint NOT NULL COMMENT 'default payment method; 0: PayPal, 1: Credit card, 2: Alipay',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'default shipping address',
  `last_online` time NOT NULL COMMENT 'last online time',
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'for headshots',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '1234', 3, 1234567890, 'admin@example.com', 1, 1, 10, 100.50, 0, '123 Main St, Anytown USA', '15:30:00', '/path/to/image.jpg');
INSERT INTO `user` VALUES (2, 'John Doe', 'sdf1Hjks%', 0, 328593827, 'johndoe@example.com', 0, 1, 10, 899.99, 1, '123 Main St, Anytown USA', '18:15:00', 'path/to/image1.jpg');
INSERT INTO `user` VALUES (3, 'Jane Smith', 'dgh0fT%hG', 1, 827349020, 'janesmith@example.com', 0, 1, 5, 450.00, 0, '456 Oak Ave, Anytown USA', '14:30:00', 'path/to/image2.jpg');
INSERT INTO `user` VALUES (4, 'Mark Johnson', 'fdh2Jhs^', 0, 729834567, 'markjohnson@example.com', 0, 1, 7, 631.25, 1, '789 Elm St, Anytown USA', '10:45:00', 'path/to/image3.jpg');
INSERT INTO `user` VALUES (5, 'Samantha Lee', 'fKj4dLh%', 1, 423874956, 'samanthalee@example.com', 0, 0, 0, 0.00, 2, '321 Pine St, Anytown USA', '09:00:00', 'path/to/image4.jpg');
INSERT INTO `user` VALUES (6, 'William Chen', 'dHk6fJl#', 0, 982735648, 'williamchen@example.com', 0, 0, 0, 0.00, 1, '654 Birch Rd, Anytown USA', '16:20:00', 'path/to/image5.jpg');
INSERT INTO `user` VALUES (7, 'Emily Kim', 'dsJ8Hfh^', 1, 657823419, 'emilykim@example.com', 0, 0, 0, 0.00, 0, '987 Maple St, Anytown USA', '11:10:00', 'path/to/image6.jpg');
INSERT INTO `user` VALUES (8, 'Hannah Jones', '83uIv29J', 1, 437206554, 'hjones@gmail.com', 0, 1, 8, 1645.32, 0, '123 Main St., Apt. 456, Boston, MA 02118', '23:15:00', NULL);
INSERT INTO `user` VALUES (9, 'Tom Smith', 'KfY8J7W6', 0, 942772803, 'tsmith@yahoo.com', 0, 0, 0, 0.00, 1, '456 Park Ave., New York, NY 10022', '14:10:00', NULL);
INSERT INTO `user` VALUES (10, 'Emily Johnson', 'l04pLhj7', 1, 897602841, 'ejohnson@hotmail.com', 0, 1, 3, 788.99, 2, '789 Cedar St., San Francisco, CA 94109', '09:35:00', NULL);
INSERT INTO `user` VALUES (11, 'Ethan Lee', 'x7J9KtS1', 0, 155986930, 'elee@gmail.com', 0, 1, 12, 2750.21, 1, '456 Park Ave., New York, NY 10022', '17:22:00', NULL);
INSERT INTO `user` VALUES (12, 'Olivia Davis', 'J8bHcE2r', 1, 176409078, 'odavis@yahoo.com', 0, 0, 0, 0.00, 0, '789 Cedar St., San Francisco, CA 94109', '11:45:00', NULL);

SET FOREIGN_KEY_CHECKS = 1;
