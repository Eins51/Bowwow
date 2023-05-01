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

 Date: 02/05/2023 04:04:06
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
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES (1, 1, 1, 'United States', 'California', 'Los Angeles', 'Downtown', '123 Spring St', '90012');
INSERT INTO `address` VALUES (2, 2, 1, 'United States', 'New York', 'New York', 'Manhattan', '456 Broadway Ave', '10001');
INSERT INTO `address` VALUES (3, 3, 1, 'United States', 'Texas', 'Houston', 'Midtown', '789 Main St', '77002');
INSERT INTO `address` VALUES (4, 4, 1, 'United States', 'Illinois', 'Chicago', 'Lincoln Park', '147 Oak St', '60614');
INSERT INTO `address` VALUES (5, 5, 1, 'United States', 'Florida', 'Miami', 'Brickell', '258 Ocean Dr', '33129');
INSERT INTO `address` VALUES (6, 6, 1, 'United States', 'Washington', 'Seattle', 'Capitol Hill', '369 Pine St', '98122');
INSERT INTO `address` VALUES (7, 7, 1, 'United States', 'Massachusetts', 'Boston', 'Beacon Hill', '480 Beacon St', '02108');
INSERT INTO `address` VALUES (8, 8, 1, 'United States', 'Colorado', 'Denver', 'Cherry Creek', '591 Elm St', '80209');
INSERT INTO `address` VALUES (9, 9, 1, 'United States', 'Arizona', 'Phoenix', 'Arcadia', '602 Palm St', '85018');
INSERT INTO `address` VALUES (10, 10, 1, 'United States', 'Georgia', 'Atlanta', 'Buckhead', '713 Peachtree St', '30305');
INSERT INTO `address` VALUES (11, 11, 1, 'United States', 'Oregon', 'Portland', 'Pearl District', '824 Pearl St', '97209');
INSERT INTO `address` VALUES (12, 12, 1, 'United States', 'Michigan', 'Detroit', 'Midtown', '935 Woodward Ave', '48201');
INSERT INTO `address` VALUES (13, 13, 1, 'United States', 'Tennessee', 'Nashville', 'Germantown', '146 2nd Ave N', '37201');
INSERT INTO `address` VALUES (14, 14, 1, 'United States', 'California', 'San Francisco', 'Mission District', '267 Valencia St', '94103');
INSERT INTO `address` VALUES (15, 15, 1, 'United States', 'Pennsylvania', 'Philadelphia', 'Rittenhouse', '388 Walnut St', '19106');
INSERT INTO `address` VALUES (16, 16, 1, 'United States', 'Ohio', 'Cleveland', 'Tremont', '409 Literary Rd', '44113');
INSERT INTO `address` VALUES (17, 17, 1, 'United States', 'Nevada', 'Las Vegas', 'Downtown', '520 Fremont St', '89101');
INSERT INTO `address` VALUES (18, 4, 0, 'United States', 'California', 'San Diego', 'Gaslamp Quarter', '631 5th Ave', '92101');
INSERT INTO `address` VALUES (19, 2, 0, 'United States', 'New York', 'Brooklyn', 'Williamsburg', '742 Bedford Ave', '11211');
INSERT INTO `address` VALUES (20, 13, 0, 'United States', 'Texas', 'Dallas', 'Uptown', '853 McKinney Ave', '75201');
INSERT INTO `address` VALUES (21, 14, 0, 'United States', 'Washington', 'Spokane', 'Downtown', '1001 1st Ave', '99201');
INSERT INTO `address` VALUES (22, 4, 0, 'United States', 'North Carolina', 'Charlotte', 'South End', '1102 South Blvd', '28203');
INSERT INTO `address` VALUES (23, 6, 0, 'United States', 'Virginia', 'Richmond', 'The Fan', '1203 W Main St', '23220');
INSERT INTO `address` VALUES (24, 11, 0, 'United States', 'Indiana', 'Indianapolis', 'Fountain Square', '1304 Shelby St', '46203');
INSERT INTO `address` VALUES (25, 9, 0, 'United States', 'Minnesota', 'Minneapolis', 'North Loop', '1405 Washington Ave N', '55401');
INSERT INTO `address` VALUES (26, 10, 0, 'United States', 'Wisconsin', 'Milwaukee', 'Third Ward', '1506 N Water St', '53202');
INSERT INTO `address` VALUES (27, 10, 0, 'United States', 'Missouri', 'Kansas City', 'Crossroads', '1607 Main St', '64108');
INSERT INTO `address` VALUES (28, 1, 0, 'United States', 'Oklahoma', 'Oklahoma City', 'Bricktown', '1708 E Sheridan Ave', '73104');
INSERT INTO `address` VALUES (29, 1, 0, 'United States', 'Iowa', 'Des Moines', 'East Village', '1809 E Grand Ave', '50309');
INSERT INTO `address` VALUES (30, 12, 0, 'United States', 'Kentucky', 'Louisville', 'NuLu', '1900 E Market St', '40202');

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint NULL DEFAULT NULL COMMENT '0: male, 1: female, 2: others, 3: secrecy',
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'for headshots',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 3, '123456789', 'admin@gmail.com', 'admin_avatar.png');

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
  `value` decimal(10, 2) NOT NULL,
  `quantity` int NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupon
-- ----------------------------
INSERT INTO `coupon` VALUES (1, 'Summer Sale Discount Coupon', 0, 0.20, 100, '2023-06-01 00:00:00', '2023-06-30 23:59:59', 'Get 20% off on all summer pet items');
INSERT INTO `coupon` VALUES (2, 'New User Welcome Voucher', 1, 100.00, 500, '2023-05-01 00:00:00', '2023-12-31 23:59:59', 'Sign up and get a voucher worth $100 for your first purchase!');
INSERT INTO `coupon` VALUES (3, 'Halloween Cash Coupon', 2, 50.00, 50, '2023-10-15 00:00:00', '2023-11-01 23:59:59', 'Get $50 off on any purchase of $300 or more during Halloween season');
INSERT INTO `coupon` VALUES (4, 'Dog Food Discount Coupon', 0, 0.10, 200, '2023-05-15 00:00:00', '2023-06-30 23:59:59', 'Get 10% off on all dog food items');
INSERT INTO `coupon` VALUES (5, 'Summer Pet Grooming Voucher', 1, 200.00, 100, '2023-06-01 00:00:00', '2023-07-31 23:59:59', 'Get $200 worth of pet grooming services for free with any purchase of $500 or more on summer pet items');
INSERT INTO `coupon` VALUES (6, 'Cat Toy Cash Coupon', 2, 30.00, 100, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get $30 off on any purchase of cat toys');
INSERT INTO `coupon` VALUES (7, 'Summer Sale Voucher', 1, 150.00, 200, '2023-06-01 00:00:00', '2023-06-30 23:59:59', 'Get a voucher worth $150 for any purchase of $300 or more on summer pet items');
INSERT INTO `coupon` VALUES (8, '50% off on pet food', 0, 0.50, 100, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get 50% off on all pet food items');
INSERT INTO `coupon` VALUES (9, '10% off on pet toys', 0, 0.10, 200, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get 10% off on all pet toys');
INSERT INTO `coupon` VALUES (10, '$5 voucher for pet grooming', 1, 5.00, 500, '2023-05-01 00:00:00', '2023-08-31 23:59:59', 'Get $5 voucher on pet grooming services');
INSERT INTO `coupon` VALUES (11, '$10 cash coupon', 2, 10.00, 1000, '2023-05-01 00:00:00', '2023-05-31 23:59:59', 'Get $10 off on any purchase');
INSERT INTO `coupon` VALUES (12, '20% off on pet beds', 0, 0.20, 300, '2023-05-01 00:00:00', '2023-06-15 23:59:59', 'Get 20% off on all pet beds');
INSERT INTO `coupon` VALUES (14, '15% off on pet carriers', 0, 0.15, 200, '2023-05-01 00:00:00', '2023-06-30 23:59:59', 'Get 15% off on all pet carriers');
INSERT INTO `coupon` VALUES (15, '$20 voucher for pet boarding', 1, 20.00, 100, '2023-05-01 00:00:00', '2023-09-30 23:59:59', 'Get $20 voucher on pet boarding services');

-- ----------------------------
-- Table structure for coupon_detail
-- ----------------------------
DROP TABLE IF EXISTS `coupon_detail`;
CREATE TABLE `coupon_detail`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL COMMENT 'user id: foreign key referring \'user\' table',
  `coupon_id` int NOT NULL COMMENT 'coupon id: foreign key referring \'coupon\' table',
  `coupon_num` int NOT NULL COMMENT 'number of this coupon item that user owns',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `coupon_detail_ibfk_1`(`user_id` ASC) USING BTREE,
  INDEX `coupon_detail_ibfk_2`(`coupon_id` ASC) USING BTREE,
  CONSTRAINT `coupon_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `coupon_detail_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupon_detail
-- ----------------------------
INSERT INTO `coupon_detail` VALUES (1, 5, 3, 2);
INSERT INTO `coupon_detail` VALUES (2, 11, 10, 3);
INSERT INTO `coupon_detail` VALUES (3, 1, 2, 1);
INSERT INTO `coupon_detail` VALUES (4, 13, 9, 4);
INSERT INTO `coupon_detail` VALUES (5, 9, 6, 1);
INSERT INTO `coupon_detail` VALUES (6, 16, 5, 2);
INSERT INTO `coupon_detail` VALUES (7, 2, 1, 1);
INSERT INTO `coupon_detail` VALUES (8, 8, 14, 3);
INSERT INTO `coupon_detail` VALUES (9, 15, 7, 1);
INSERT INTO `coupon_detail` VALUES (10, 7, 12, 1);
INSERT INTO `coupon_detail` VALUES (11, 10, 8, 3);
INSERT INTO `coupon_detail` VALUES (12, 4, 11, 4);
INSERT INTO `coupon_detail` VALUES (13, 6, 3, 2);
INSERT INTO `coupon_detail` VALUES (14, 1, 15, 1);
INSERT INTO `coupon_detail` VALUES (15, 17, 5, 4);
INSERT INTO `coupon_detail` VALUES (16, 14, 2, 1);
INSERT INTO `coupon_detail` VALUES (17, 6, 9, 2);
INSERT INTO `coupon_detail` VALUES (18, 2, 6, 3);
INSERT INTO `coupon_detail` VALUES (19, 3, 7, 2);
INSERT INTO `coupon_detail` VALUES (20, 5, 1, 4);
INSERT INTO `coupon_detail` VALUES (21, 10, 15, 1);
INSERT INTO `coupon_detail` VALUES (22, 12, 4, 3);
INSERT INTO `coupon_detail` VALUES (23, 7, 8, 2);
INSERT INTO `coupon_detail` VALUES (24, 14, 5, 4);
INSERT INTO `coupon_detail` VALUES (25, 4, 12, 1);
INSERT INTO `coupon_detail` VALUES (26, 1, 11, 3);
INSERT INTO `coupon_detail` VALUES (27, 9, 10, 2);
INSERT INTO `coupon_detail` VALUES (28, 15, 14, 4);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` decimal(10, 2) NOT NULL COMMENT 'total amount; $',
  `coupon_id` int NULL DEFAULT NULL COMMENT 'coupon id: foreign key referring \'coupon_detail\' table',
  `user_id` int NOT NULL COMMENT 'user id: foreign key referring \'user\' table',
  `address_id` int NOT NULL COMMENT 'address id: foreign key referring \'address\' table',
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
  INDEX `address_id`(`address_id` ASC) USING BTREE,
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_detail` (`coupon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (1, 100.00, 1, 1, 1, 0, 1, '2023-04-29 15:30:00', '2023-04-29 15:35:00', '2023-04-30 08:00:00', '2023-04-30 18:00:00', '2023-05-02 09:00:00');
INSERT INTO `order` VALUES (2, 150.00, NULL, 2, 2, 1, 2, '2023-04-29 16:00:00', '2023-04-29 16:05:00', '2023-04-30 09:00:00', '2023-04-30 19:00:00', '2023-05-02 10:00:00');
INSERT INTO `order` VALUES (3, 200.00, 2, 3, 3, 2, 3, '2023-04-29 16:30:00', '2023-04-29 16:35:00', '2023-04-30 10:00:00', '2023-04-30 20:00:00', '2023-05-02 11:00:00');
INSERT INTO `order` VALUES (4, 50.00, NULL, 4, 4, 0, 4, '2023-04-29 17:00:00', '2023-04-29 17:05:00', '2023-04-30 11:00:00', '2023-04-30 21:00:00', '2023-05-02 12:00:00');
INSERT INTO `order` VALUES (5, 75.00, NULL, 5, 5, 1, 1, '2023-04-29 17:30:00', '2023-04-29 17:35:00', '2023-04-30 12:00:00', '2023-04-30 22:00:00', '2023-05-02 13:00:00');

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES (1, 1, 1, 2);
INSERT INTO `order_detail` VALUES (2, 1, 2, 1);
INSERT INTO `order_detail` VALUES (3, 2, 3, 3);
INSERT INTO `order_detail` VALUES (4, 2, 4, 2);
INSERT INTO `order_detail` VALUES (5, 3, 1, 4);
INSERT INTO `order_detail` VALUES (6, 3, 5, 1);
INSERT INTO `order_detail` VALUES (7, 4, 2, 5);
INSERT INTO `order_detail` VALUES (8, 4, 3, 1);
INSERT INTO `order_detail` VALUES (9, 5, 4, 1);
INSERT INTO `order_detail` VALUES (10, 5, 5, 3);

-- ----------------------------
-- Table structure for pet
-- ----------------------------
DROP TABLE IF EXISTS `pet`;
CREATE TABLE `pet`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint NULL DEFAULT NULL COMMENT '0: male, 1: female, 2: others, 3: secrecy',
  `breed` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `age` int NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `user_id` int NOT NULL COMMENT 'user id: foreign key referring \'user\' table',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pet
-- ----------------------------
INSERT INTO `pet` VALUES (1, 'Buddy', 0, 'Golden Retriever', 'Large', 3, '2020-04-15', 1);
INSERT INTO `pet` VALUES (2, 'Luna', 1, 'Bengal Cat', 'Medium', 2, '2021-02-28', 1);
INSERT INTO `pet` VALUES (3, 'Max', 0, 'German Shepherd', 'Large', 4, '2019-07-01', 2);
INSERT INTO `pet` VALUES (4, 'Bella', 1, 'Persian Cat', 'Medium', 5, '2018-09-10', 2);
INSERT INTO `pet` VALUES (5, 'Charlie', 0, 'Poodle', 'Small', 1, '2022-05-20', 2);
INSERT INTO `pet` VALUES (6, 'Daisy', 1, 'Siamese Cat', 'Medium', 3, '2020-01-05', 3);
INSERT INTO `pet` VALUES (7, 'Cooper', 0, 'Labrador Retriever', 'Large', 6, '2017-03-30', 4);
INSERT INTO `pet` VALUES (8, 'Lily', 1, 'Sphynx Cat', 'Medium', 4, '2019-10-25', 4);
INSERT INTO `pet` VALUES (9, 'Rocky', 0, 'Bulldog', 'Medium', 2, '2021-06-11', 5);
INSERT INTO `pet` VALUES (10, 'Rosie', 1, 'Maine Coon Cat', 'Large', 1, '2022-03-08', 5);
INSERT INTO `pet` VALUES (11, 'Zeus', 0, 'Boxer', 'Large', 7, '2016-08-02', 6);
INSERT INTO `pet` VALUES (12, 'Molly', 1, 'Ragdoll Cat', 'Medium', 3, '2020-04-29', 7);
INSERT INTO `pet` VALUES (13, 'Tucker', 0, 'Rottweiler', 'Large', 5, '2018-12-14', 7);
INSERT INTO `pet` VALUES (14, 'Sophie', 1, 'Russian Blue Cat', 'Medium', 4, '2019-05-03', 8);
INSERT INTO `pet` VALUES (15, 'Teddy', 0, 'Shih Tzu', 'Small', 1, '2022-08-22', 8);
INSERT INTO `pet` VALUES (16, 'Ziggy', 1, 'Scottish Fold Cat', 'Medium', 2, '2021-11-17', 9);
INSERT INTO `pet` VALUES (17, 'Rex', 0, 'Great Dane', 'Large', 3, '2020-09-04', 9);
INSERT INTO `pet` VALUES (18, 'Oscar', 0, 'Netherland Dwarf Rabbit', 'Small', 2, '2021-07-23', 10);
INSERT INTO `pet` VALUES (19, 'Coco', 1, 'Holland Lop Rabbit', 'Small', 1, '2022-01-12', 11);
INSERT INTO `pet` VALUES (20, 'Milo', 0, 'Syrian Hamster', 'Small', 1, '2022-06-10', 12);
INSERT INTO `pet` VALUES (21, 'Loki', 0, 'Dwarf Hamster', 'Small', 1, '2022-08-01', 13);
INSERT INTO `pet` VALUES (22, 'Finn', 0, 'Yorkshire Terrier', 'Small', 2, '2021-08-20', 2);
INSERT INTO `pet` VALUES (23, 'Lulu', 1, 'Siberian Cat', 'Medium', 3, '2020-12-15', 3);
INSERT INTO `pet` VALUES (24, 'Leo', 0, 'French Bulldog', 'Medium', 4, '2019-05-28', 5);
INSERT INTO `pet` VALUES (25, 'Ruby', 1, 'Devon Rex Cat', 'Medium', 5, '2018-06-10', 7);
INSERT INTO `pet` VALUES (26, 'Sammy', 0, 'American Fuzzy Lop Rabbit', 'Small', 1, '2022-04-05', 9);
INSERT INTO `pet` VALUES (27, 'Maddie', 1, 'Mini Rex Rabbit', 'Small', 2, '2021-05-01', 11);
INSERT INTO `pet` VALUES (28, 'Henry', 0, 'Roborovski Hamster', 'Small', 1, '2022-07-18', 13);
INSERT INTO `pet` VALUES (29, 'Lola', 1, 'Campbell\'s Dwarf Hamster', 'Small', 1, '2022-09-12', 15);
INSERT INTO `pet` VALUES (30, 'Jasper', 0, 'Cavalier King Charles Spaniel', 'Small', 3, '2020-10-25', 1);
INSERT INTO `pet` VALUES (31, 'Penny', 1, 'Exotic Shorthair Cat', 'Medium', 4, '2019-11-08', 3);

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
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 'Purina ONE Natural Dry Dog Food', 1, 1, 21.49, 100, 1, 'Purina ONE Natural dry dog food with real chicken and rice for adult dogs.', 'product1.jpg');
INSERT INTO `product` VALUES (2, 'Hill\'s Science Diet Dry Dog Food', 1, 1, 32.99, 150, 1, 'Hill\'s Science Diet Adult Sensitive Stomach & Skin Chicken Recipe Dry Dog Food.', 'product2.jpg');
INSERT INTO `product` VALUES (3, 'Fancy Feast Gravy Lovers Wet Cat Food', 1, 0, 16.79, 200, 1, 'Fancy Feast Gravy Lovers Wet Cat Food Variety Pack, 3 oz. cans, 24 count.', 'product3.jpg');
INSERT INTO `product` VALUES (4, 'Blue Buffalo Life Protection Formula Dry Dog Food', 1, 1, 54.98, 180, 1, 'Blue Buffalo Life Protection Formula Adult Chicken & Brown Rice Recipe Dry Dog Food.', 'product4.jpg');
INSERT INTO `product` VALUES (5, 'Wellness CORE Grain-Free Dry Cat Food', 1, 0, 40.89, 120, 1, 'Wellness CORE Grain-Free Original Turkey & Chicken Recipe Dry Cat Food.', 'product5.jpg');
INSERT INTO `product` VALUES (6, 'Frontline Plus Flea & Tick Treatment for Dogs', 2, 1, 45.99, 250, 1, 'Frontline Plus Flea and Tick Treatment for dogs (45-88 lbs) - 3 Doses.', 'product6.jpg');
INSERT INTO `product` VALUES (7, 'Nutramax Cosequin Joint Health Supplement', 2, 1, 34.95, 100, 1, 'Nutramax Cosequin Maximum Strength Joint Health Supplement for Dogs, 250 Count.', 'product7.jpg');
INSERT INTO `product` VALUES (8, 'Zesty Paws Allergy Immune Supplement for Dogs', 2, 0, 25.96, 300, 1, 'Zesty Paws Allergy Immune Supplement for Dogs - with Omega 3 Wild Alaskan Salmon Fish Oil & EpiCor + Digestive Prebiotics & Probiotics.', 'product8.jpg');
INSERT INTO `product` VALUES (9, 'Burt\'s Bees for Dogs Natural Itch Soothing Shampoo', 3, 0, 7.49, 200, 1, 'Burt\'s Bees for Dogs Natural Itch Soothing Shampoo with Honeysuckle.', 'product9.jpg');
INSERT INTO `product` VALUES (10, 'FURminator deShedding Tool for Dogs', 3, 1, 29.95, 100, 1, 'FURminator deShedding Tool for Dogs, Large, Long Hair.', 'product10.jpg');
INSERT INTO `product` VALUES (11, 'KONG Classic Dog Toy', 4, 1, 7.99, 500, 1, 'KONG Classic Dog Toy, Durable Natural Rubber- Fun to Chew, Chase and Fetch.', 'product11.jpg');
INSERT INTO `product` VALUES (12, 'Petstages Tower of Tracks Cat Toy', 4, 1, 24.99, 80, 1, 'Petstages Tower of Tracks Cat Toy - 3 Level of Interactive Play - Circle Track with Moving Balls Satisfies Kitty\'s Hunting, Chasing and Exercising Needs.', 'product12.png');
INSERT INTO `product` VALUES (13, 'Benebone Real Flavor Wishbone Dog Chew Toy', 4, 0, 11.59, 120, 1, 'Benebone Real Flavor Wishbone Dog Chew Toy, Made in USA, Medium, Real Chicken Flavor.', 'product13.png');
INSERT INTO `product` VALUES (14, 'SmartyKat Skitter Critters Cat Toy', 4, 0, 2.99, 400, 1, 'SmartyKat Skitter Critters Cat Toy, Catnip Mice, 3/pkg.', 'product14.png');
INSERT INTO `product` VALUES (15, 'AmazonBasics Two-Door Top-Load Pet Kennel', 5, 1, 29.99, 100, 1, 'AmazonBasics Two-Door Top-Load Hard-Sided Pet Travel Carrier, 23-Inch.', 'product15.png');
INSERT INTO `product` VALUES (16, 'Sherpa Travel Original Deluxe Airline Approved Pet Carrier', 5, 0, 73.16, 50, 1, 'Sherpa Travel Original Deluxe Airline Approved Pet Carrier, Large, Black.', 'product16.png');
INSERT INTO `product` VALUES (17, 'Furhaven Pet Dog Bed', 6, 1, 37.99, 100, 1, 'Furhaven Pet Dog Bed - Orthopedic Ultra Plush Faux Fur Ergonomic Luxe Lounger Cradle Mattress Contour Pet Bed for Dogs and Cats, Gray, Large.', 'product17.png');
INSERT INTO `product` VALUES (18, 'MidWest Homes for Pets Deluxe Super Plush Pet Beds', 6, 0, 14.99, 200, 1, 'MidWest Homes for Pets Deluxe Super Plush Pet Beds, Machine Wash & Dryer Friendly, 1-Year Warranty.', 'product18.png');
INSERT INTO `product` VALUES (19, 'Purina Pro Plan High Protein Dry Dog Food', 1, 1, 38.48, 80, 1, 'Purina Pro Plan High Protein Dry Dog Food, SPORT Performance 30/20 Formula - 37.5 lb. Bag.', 'product19.png');
INSERT INTO `product` VALUES (20, 'Merrick Grain-Free Dry Dog Food', 1, 0, 59.99, 60, 1, 'Merrick Grain-Free Dry Dog Food Real Texas Beef + Sweet Potato Recipe - 25 lb. Bag.', 'product20.png');
INSERT INTO `product` VALUES (21, 'Blue Buffalo Wilderness High Protein Dry Cat Food', 1, 1, 36.98, 140, 1, 'Blue Buffalo Wilderness High Protein, Natural Adult Dry Cat Food, Chicken 12-lb.', 'product21.png');
INSERT INTO `product` VALUES (22, 'Bayer Animal Health Seresto Flea and Tick Collar for Dogs', 2, 1, 57.98, 90, 1, 'Bayer Animal Health Seresto Flea and Tick Collar for Dogs, 8-Month Tick and Flea Control for Dogs.', 'product22.png');
INSERT INTO `product` VALUES (23, 'VetriScience Laboratories GlycoFlex Joint Support for Dogs', 2, 0, 39.00, 100, 1, 'VetriScience Laboratories GlycoFlex 3, Hip and Joint Supplement for Dogs, 120 Bite Sized Chews.', 'product23.png');
INSERT INTO `product` VALUES (24, 'PetHonesty 10-for-1 Dog Multivitamin', 2, 1, 25.99, 120, 1, 'PetHonesty 10-for-1 Dog Multivitamin with Glucosamine - Essential Dog Vitamins with Glucosamine Chondroitin, Probiotics and Omega Fish Oil for Dogs Overall Health.', 'product24.png');
INSERT INTO `product` VALUES (25, 'Earthbath All Natural Pet Shampoo', 3, 1, 14.99, 100, 1, 'Earthbath All Natural Pet Shampoo - Oatmeal & Aloe, Fragrance Free, 16 oz.', 'product25.png');
INSERT INTO `product` VALUES (26, 'SmartyKat Skitter Critters Cat Toy', 4, 1, 2.99, 400, 1, 'SmartyKat Skitter Critters Cat Toy, Catnip Mice, 3/pkg.', 'product26.jpg');
INSERT INTO `product` VALUES (27, 'Benebone Real Flavor Wishbone Dog Chew Toy', 4, 0, 11.59, 120, 1, 'Benebone Real Flavor Wishbone Dog Chew Toy, Made in USA, Medium, Real Chicken Flavor.', 'product27.jpg');
INSERT INTO `product` VALUES (28, 'Petstages Tower of Tracks Cat Toy', 4, 0, 24.99, 80, 1, 'Petstages Tower of Tracks Cat Toy - 3 Level of Interactive Play - Circle Track with Moving Balls Satisfies Kitty\'s Hunting, Chasing and Exercising Needs.', 'product28.jpg');
INSERT INTO `product` VALUES (29, 'AmazonBasics Two-Door Top-Load Pet Kennel', 5, 1, 29.99, 100, 1, 'AmazonBasics Two-Door Top-Load Hard-Sided Pet Travel Carrier, 23-Inch.', 'product29.jpg');
INSERT INTO `product` VALUES (30, 'Sherpa Travel Original Deluxe Airline Approved Pet Carrier', 5, 0, 73.16, 50, 1, 'Sherpa Travel Original Deluxe Airline Approved Pet Carrier, Large, Black.', 'product30.jpg');
INSERT INTO `product` VALUES (31, 'Furhaven Pet Dog Bed', 6, 1, 37.99, 100, 1, 'Furhaven Pet Dog Bed - Orthopedic Ultra Plush Faux Fur Ergonomic Luxe Lounger Cradle Mattress Contour Pet Bed for Dogs and Cats, Gray, Large.', 'product31.jpg');
INSERT INTO `product` VALUES (32, 'MidWest Homes for Pets Deluxe Super Plush Pet Beds', 6, 0, 14.99, 200, 1, 'MidWest Homes for Pets Deluxe Super Plush Pet Beds, Machine Wash & Dryer Friendly, 1-Year Warranty.', 'product32.jpg');
INSERT INTO `product` VALUES (33, 'Purina Pro Plan High Protein Dry Dog Food', 1, 1, 38.48, 80, 1, 'Purina Pro Plan High Protein Dry Dog Food, SPORT Performance 30/20 Formula - 37.5 lb. Bag.', 'product33.jpg');
INSERT INTO `product` VALUES (34, 'Merrick Grain-Free Dry Dog Food', 1, 0, 59.99, 60, 1, 'Merrick Grain-Free Dry Dog Food Real Texas Beef + Sweet Potato Recipe - 25 lb. Bag.', 'product34.jpg');
INSERT INTO `product` VALUES (35, 'Blue Buffalo Wilderness High Protein Dry Cat Food', 1, 1, 36.98, 140, 1, 'Blue Buffalo Wilderness High Protein, Natural Adult Dry Cat Food, Chicken 12-lb.', 'product35.jpg');
INSERT INTO `product` VALUES (36, 'Bayer Animal Health Seresto Flea and Tick Collar for Dogs', 2, 1, 57.98, 90, 1, 'Bayer Animal Health Seresto Flea and Tick Collar for Dogs, 8-Month Tick and Flea Control for Dogs.', 'product36.jpg');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` tinyint NULL DEFAULT NULL COMMENT '0: male, 1: female, 2: others, 3: secrecy',
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_member` tinyint NOT NULL COMMENT '0: no, 1: yes',
  `payment` tinyint NOT NULL COMMENT 'default payment method; 0: PayPal, 1: Credit card, 2: Alipay',
  `last_online` datetime NOT NULL COMMENT 'last online time',
  `image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'for avatar',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Alice1984', '3a4b6e1fd87d0e1875c2c95a30cf1e9e', 1, '13912345678', 'alice1984@example.com', 1, 0, '2023-04-30 19:20:21', 'avatar_1.png');
INSERT INTO `user` VALUES (2, 'Bob_Wang', 'b6e92e80f875f1d76d9c8c074bfe5e29', 0, '18523456789', 'bob.wang@example.com', 0, 1, '2023-04-29 22:10:30', 'avatar_2.png');
INSERT INTO `user` VALUES (3, 'CathyLiu', '0d9e9f93ab700f0a56b0be29d0501e8f', 1, '13198765432', 'cathy.liu@example.com', 1, 2, '2023-04-28 18:45:00', 'avatar_3.png');
INSERT INTO `user` VALUES (4, 'Tom123', '4c4e3e1a1b0d8f4c6a4c4d1592d4f21c', 0, '13612938475', 'tom123@example.com', 0, 0, '2023-04-27 20:05:10', 'avatar_4.png');
INSERT INTO `user` VALUES (5, 'Linda_S', '2a2a07ee7dce87d6e1cf70c8149e1d5b', 1, '13987654321', 'linda.s@example.com', 1, 1, '2023-04-26 21:30:15', 'avatar_5.png');
INSERT INTO `user` VALUES (6, 'JackyMao', 'f877054af42f9c9d62e6e8d6e84d11b0', 0, '18765432198', 'jacky.mao@example.com', 1, 2, '2023-04-25 23:00:20', 'avatar_6.png');
INSERT INTO `user` VALUES (7, 'MollyZ', '8e47e995f1c55f6a4e18d4c2a4d4a099', 1, '13345678901', 'molly.z@example.com', 0, 0, '2023-04-24 19:40:35', 'avatar_7.png');
INSERT INTO `user` VALUES (8, 'Peter_Guo', '16f7ee3dbf1d2033cc0639df0a3bb3db', 0, '15912349876', 'peter.guo@example.com', 1, 1, '2023-04-23 22:15:40', 'avatar_8.png');
INSERT INTO `user` VALUES (9, 'Olivia1988', 'ee1f76d0abcb5587f82e8c61a33e9b1d', 1, '14893561234', 'olivia1988@example.com', 1, 0, '2023-04-30 19:20:21', 'avatar_9.png');
INSERT INTO `user` VALUES (10, 'Ethan_M', '2b8c6a42299d9e9f9d02a6b8dfc7bb56', 0, '13726481593', 'ethan.m@example.com', 0, 1, '2023-04-29 22:10:30', 'avatar_10.png');
INSERT INTO `user` VALUES (11, 'SophiaX', '94a6d470107f702cd39df7bea932a0bb', 1, '17981345627', 'sophia.x@example.com', 1, 2, '2023-04-28 18:45:00', 'avatar_11.png');
INSERT INTO `user` VALUES (12, 'Lucas123', '07c7d0a3e3a0eaa6f3c6e1991e2b0b7d', 0, '19612483975', 'lucas123@example.com', 0, 0, '2023-04-27 20:05:10', 'avatar_12.png');
INSERT INTO `user` VALUES (13, 'Emma_S', 'a647e995c0c55f6a4e18d4c2a4d4a1e1', 1, '17598764321', 'emma.s@example.com', 1, 1, '2023-04-26 21:30:15', 'avatar_13.png');
INSERT INTO `user` VALUES (14, 'Aiden_Moore', 'b872054af42f9c9d62e6e8d6e84d11b0', 2, '13826543198', 'aiden.moore@example.com', 1, 2, '2023-04-25 23:00:20', 'avatar_14.png');
INSERT INTO `user` VALUES (15, 'IsabellaZ', 'c247e995f1c55f6a4e18d4c2a4d4a2e2', 3, '14235678901', 'isabella.z@example.com', 0, 0, '2023-04-24 19:40:35', 'avatar_15.png');
INSERT INTO `user` VALUES (16, 'Liam_G', '53f7ee3dbf1d2033cc0639df0a3bb3db', 0, '13492349876', 'liam.g@example.com', 1, 1, '2023-04-23 22:15:40', 'avatar_16.png');
INSERT INTO `user` VALUES (17, 'Ava_Smith', 'a9a9b9a9f0e0b6f5675df5e5c5d5a5b5', 1, '16345871203', 'ava.smith@example.com', 1, 2, '2023-04-22 20:45:25', 'avatar_17.png');

SET FOREIGN_KEY_CHECKS = 1;
