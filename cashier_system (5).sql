-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 08:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cashier_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckInvalidCategoryIDs` ()   BEGIN
    SELECT p.id AS product_id, p.name AS product_name, p.category_id
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE c.id IS NULL;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(30000, 'Alcoholic Beverages'),
(18000, 'Baby Products'),
(11000, 'Bakery'),
(15000, 'Baking Supplies'),
(16000, 'Beverage Enhancers'),
(24000, 'Beverages'),
(25000, 'Biscuits and Wafers'),
(26000, 'Canned Goods'),
(31000, 'Coffee & Tea'),
(27000, 'Condiments & Sauces'),
(10000, 'Dairy'),
(12000, 'Dairy Alternatives'),
(37000, 'Dairy-Free Products'),
(32000, 'Energy & Sports Drinks'),
(19000, 'Frozen Foods'),
(34000, 'Fruits'),
(38000, 'Gluten-Free Items'),
(14000, 'Grains & Rice'),
(17000, 'Household Essentials'),
(29000, 'Juices'),
(20000, 'Meat'),
(36000, 'Organic Products'),
(21000, 'Personal Care'),
(39000, 'Pet Food'),
(22000, 'Sanitary'),
(35000, 'Seafood'),
(13000, 'Snacks'),
(28000, 'Soft Drinks'),
(33000, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `name`, `price`, `stock`, `category_id`) VALUES
(100001, '100001234567', 'Fresh Milk', 150.00, 40, 10000),
(100002, '100002345678', 'Cheddar Cheese', 200.00, 35, 10000),
(100003, '100003456789', 'Mozzarella Cheese', 220.00, 30, 10000),
(100004, '100004567890', 'Butter', 180.00, 25, 10000),
(100005, '100005678901', 'Greek Yogurt', 250.00, 20, 10000),
(110001, '110001234567', 'Whole Wheat Bread', 80.00, 40, 11000),
(110002, '110002345678', 'Croissant', 60.00, 35, 11000),
(110003, '110003456789', 'Bagels', 70.00, 30, 11000),
(110004, '110004567890', 'Sourdough Bread', 90.00, 28, 11000),
(110005, '110005678901', 'Cinnamon Rolls', 100.00, 25, 11000),
(120001, '120001234567', 'Almond Milk', 180.00, 30, 12000),
(120002, '120002345678', 'Coconut Yogurt', 160.00, 25, 12000),
(120003, '120003456789', 'Soy Milk', 170.00, 28, 12000),
(120004, '120004567890', 'Oat Milk', 190.00, 22, 12000),
(120005, '120005678901', 'Cashew Cream', 210.00, 18, 12000),
(150001, '150001234567', 'All-Purpose Flour', 120.00, 45, 15000),
(150002, '150002345678', 'Baking Powder', 75.00, 50, 15000),
(150003, '150003456789', 'Vanilla Extract', 250.00, 20, 15000),
(150004, '150004567890', 'Cocoa Powder', 180.00, 30, 15000),
(150005, '150005678901', 'Yeast', 50.00, 40, 15000),
(160001, '160001234567', 'Coffee Creamer', 180.00, 30, 16000),
(160002, '160002345678', 'Chocolate Syrup', 150.00, 25, 16000),
(160003, '160003456789', 'Honey', 200.00, 20, 16000),
(160004, '160004567890', 'Milk Powder', 220.00, 18, 16000),
(160005, '160005678901', 'Lemon Flavoring', 90.00, 35, 16000),
(180001, '180001234567', 'Baby Diapers', 250.00, 50, 18000),
(180002, '180002345678', 'Baby Wipes', 90.00, 80, 18000),
(180003, '180003456789', 'Baby Shampoo', 150.00, 40, 18000),
(180004, '180004567890', 'Infant Formula', 500.00, 25, 18000),
(180005, '180005678901', 'Baby Lotion', 180.00, 35, 18000),
(240001, '240001234567', 'Bottled Water', 30.00, 100, 24000),
(240002, '240002345678', 'Iced Tea', 50.00, 80, 24000),
(240003, '240003456789', 'Orange Juice', 80.00, 70, 24000),
(240004, '240004567890', 'Lemonade', 70.00, 65, 24000),
(240005, '240005678901', 'Coconut Water', 90.00, 60, 24000),
(250001, '250001234567', 'Chocolate Wafer', 65.00, 60, 25000),
(250002, '250002345678', 'Cream-Filled Biscuit', 75.00, 55, 25000),
(250003, '250003456789', 'Butter Cookies', 90.00, 50, 25000),
(250004, '250004567890', 'Oatmeal Biscuits', 85.00, 45, 25000),
(250005, '250005678901', 'Shortbread Cookies', 95.00, 40, 25000),
(260001, '260001234567', 'Tuna in Oil', 90.00, 40, 26000),
(260002, '260002345678', 'Corned Beef', 110.00, 35, 26000),
(260003, '260003456789', 'Sardines', 55.00, 50, 26000),
(260004, '260004567890', 'Baked Beans', 100.00, 30, 26000),
(260005, '260005678901', 'Canned Soup', 120.00, 25, 26000),
(270001, '270001234567', 'Soy Sauce', 50.00, 70, 27000),
(270002, '270002345678', 'Ketchup', 60.00, 65, 27000),
(270003, '270003456789', 'Mayonnaise', 85.00, 50, 27000),
(270004, '270004567890', 'Hot Sauce', 70.00, 55, 27000),
(270005, '270005678901', 'Salad Dressing', 95.00, 40, 27000),
(300001, '300001234567', 'Red Wine', 500.00, 20, 30000),
(300002, '300002345678', 'Whiskey', 1200.00, 15, 30000),
(300003, '300003456789', 'Vodka', 950.00, 18, 30000),
(300004, '300004567890', 'Rum', 850.00, 12, 30000),
(300005, '300005678901', 'Beer', 80.00, 50, 30000),
(310001, '310001234567', 'Arabica Coffee', 350.00, 25, 31000),
(310002, '310002345678', 'Green Tea', 250.00, 30, 31000),
(310003, '310003456789', 'Black Coffee', 300.00, 20, 31000),
(310004, '310004567890', 'Earl Grey Tea', 275.00, 22, 31000),
(310005, '310005678901', 'Chamomile Tea', 260.00, 28, 31000),
(330001, '330001234567', 'Carrots', 80.00, 50, 33000),
(330002, '330002345678', 'Broccoli', 120.00, 40, 33000),
(330003, '330003456789', 'Spinach', 60.00, 55, 33000),
(330004, '330004567890', 'Bell Peppers', 150.00, 35, 33000),
(330005, '330005678901', 'Tomatoes', 90.00, 60, 33000),
(330006, '330006789012', 'Cabbage', 70.00, 50, 33000),
(330007, '330007890123', 'Carrots', 85.00, 60, 33000),
(330008, '330008901234', 'Eggplant', 75.00, 40, 33000),
(330009, '330009012345', 'Bell Peppers', 180.00, 30, 33000),
(330010, '330010123456', 'Cucumber', 60.00, 55, 33000),
(330011, '330001000011', 'Zucchini', 95.00, 40, 33000),
(330012, '330001000012', 'Sweet Potato', 85.00, 50, 33000),
(330013, '330001000013', 'Green Beans', 70.00, 60, 33000),
(330014, '330001000014', 'Okra', 55.00, 45, 33000),
(330015, '330001000015', 'Radish', 50.00, 50, 33000),
(330016, '330001000016', 'Bitter Melon', 65.00, 35, 33000),
(330017, '330001000017', 'Beets', 120.00, 30, 33000),
(330018, '330001000018', 'Asparagus', 150.00, 25, 33000),
(330019, '330001000019', 'Kale', 130.00, 40, 33000),
(330020, '330001000020', 'Pumpkin', 90.00, 50, 33000),
(340001, '340001234567', 'Apples', 150.00, 50, 34000),
(340002, '340002345678', 'Bananas', 60.00, 100, 34000),
(340003, '340003456789', 'Oranges', 120.00, 45, 34000),
(340004, '340004567890', 'Mangoes', 200.00, 30, 34000),
(340005, '340005678901', 'Grapes', 180.00, 25, 34000),
(340006, '340006789012', 'Pineapple', 120.00, 40, 34000),
(340007, '340007890123', 'Papaya', 90.00, 35, 34000),
(340008, '340008901234', 'Strawberries', 250.00, 20, 34000),
(340009, '340009012345', 'Blueberries', 300.00, 15, 34000),
(340010, '340010123456', 'Watermelon', 80.00, 50, 34000),
(350001, '350001234567', 'Salmon Fillet', 450.00, 20, 35000),
(350002, '350002345678', 'Shrimps', 400.00, 25, 35000),
(350003, '350003456789', 'Tuna Steak', 500.00, 15, 35000),
(350004, '350004567890', 'Crabs', 550.00, 10, 35000),
(350005, '350005678901', 'Squid', 300.00, 18, 35000),
(350011, '350001000011', 'Haddock', 320.00, 20, 35000),
(350012, '350001000012', 'Tilapia', 270.00, 30, 35000),
(350013, '350001000013', 'Halibut', 550.00, 15, 35000),
(350014, '350001000014', 'Sardines', 160.00, 40, 35000),
(350015, '350001000015', 'Swordfish', 600.00, 10, 35000),
(350016, '350001000016', 'Eel', 500.00, 12, 35000),
(350017, '350001000017', 'Sea Bass', 480.00, 14, 35000),
(350018, '350001000018', 'Octopus', 650.00, 8, 35000),
(350019, '350001000019', 'Scallops', 550.00, 12, 35000),
(350020, '350001000020', 'Sea Urchin', 700.00, 5, 35000),
(370001, '370001000001', 'Almond Milk', 180.00, 40, 37000),
(370002, '370001000002', 'Soy Milk', 160.00, 50, 37000),
(370003, '370001000003', 'Coconut Yogurt', 250.00, 30, 37000),
(370004, '370001000004', 'Cashew Cheese', 300.00, 20, 37000),
(370005, '370001000005', 'Oat Milk', 200.00, 45, 37000),
(370006, '370001000006', 'Rice Milk', 180.00, 40, 37000),
(370007, '370001000007', 'Hazelnut Milk', 220.00, 30, 37000),
(370008, '370001000008', 'Coconut Cheese', 250.00, 20, 37000),
(370009, '370001000009', 'Vegan Butter', 300.00, 15, 37000),
(370010, '370001000010', 'Soy Yogurt', 200.00, 25, 37000),
(380001, '380001000001', 'Gluten-Free Bread', 250.00, 40, 38000),
(380002, '380001000002', 'Gluten-Free Pasta', 300.00, 35, 38000),
(380003, '380001000003', 'Rice Flour', 150.00, 50, 38000),
(380004, '380001000004', 'Corn Tortillas', 120.00, 60, 38000),
(380005, '380001000005', 'Buckwheat Flour', 200.00, 30, 38000),
(380006, '380001000006', 'Gluten-Free Pizza Crust', 280.00, 20, 38000),
(380007, '380001000007', 'Gluten-Free Cookies', 320.00, 25, 38000),
(380008, '380001000008', 'Gluten-Free Crackers', 250.00, 30, 38000),
(380009, '380001000009', 'Gluten-Free Cake Mix', 400.00, 15, 38000),
(380010, '380001000010', 'Gluten-Free Pancake Mix', 350.00, 18, 38000),
(390001, '390001000001', 'Dog Kibble - Beef Flavor', 500.00, 80, 39000),
(390002, '390001000002', 'Cat Wet Food - Tuna', 300.00, 60, 39000),
(390003, '390001000003', 'Bird Seed Mix', 150.00, 100, 39000),
(390004, '390001000004', 'Hamster Pellets', 200.00, 50, 39000),
(390005, '390001000005', 'Fish Flakes', 100.00, 120, 39000),
(390006, '390001000006', 'Dog Treats - Chicken', 200.00, 50, 39000),
(390007, '390001000007', 'Cat Dry Food - Salmon', 350.00, 40, 39000),
(390008, '390001000008', 'Turtle Pellets', 180.00, 60, 39000),
(390009, '390001000009', 'Guinea Pig Food', 220.00, 35, 39000),
(390010, '390001000010', 'Rabbit Hay', 120.00, 70, 39000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `date`, `total`, `user_id`, `name`) VALUES
(1, '2025-02-16 02:29:52', 1050.50, 2, ''),
(2, '2025-02-16 02:29:52', 2000.85, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('cashier','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `role`) VALUES
(1, 'Mark', 'Canete', 'admin', 'admin123', 'admin'),
(2, 'Sherwin', 'Ortega', 'cashier1', 'cashier123', 'cashier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_items_ibfk_1` (`sale_id`),
  ADD KEY `sales_items_ibfk_2` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39001;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390011;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `sales_items_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
