-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2019 at 08:37 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brandId` int(10) NOT NULL,
  `brandName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `isDeleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brandId`, `brandName`, `isDeleted`) VALUES
(1, 'Apple', 0),
(2, 'Huawei', 0),
(3, 'Nokia', 0),
(4, 'Sony', 0),
(5, 'LG', 0),
(6, 'Xiaomi', 0),
(7, 'Samsung', 0),
(8, 'HTC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageId` int(10) NOT NULL,
  `source` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `imageType` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `productId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageId`, `source`, `imageType`, `productId`) VALUES
(1, '1.jpg', 'Profile', 1),
(2, '2.jpg', 'Profile', 2),
(3, '3.jpg', 'Profile', 3),
(4, '4.jpg', 'Profile', 4),
(5, '5.jpg', 'Profile', 5),
(6, '6.jpg', 'Profile', 6),
(7, '7.jpg', 'Profile', 7),
(8, '8.jpg', 'Profile', 8),
(9, '9.jpg', 'Profile', 9),
(10, '10.jpg', 'Profile', 10),
(11, '11.jpg', 'Profile', 11),
(12, '12.jpg', 'Profile', 12),
(13, '13.jpg', 'Profile', 13),
(14, '14.jpg', 'Profile', 14),
(15, '15.jpg', 'Profile', 15),
(16, '16.jpg', 'Profile', 16),
(17, '17.jpg', 'Profile', 17),
(18, '18.jpg', 'Profile', 18),
(19, '19.jpg', 'Profile', 19),
(20, '20.jpg', 'Profile', 20),
(21, '21.jpg', 'Profile', 21),
(22, '22.jpg', 'Profile', 22),
(23, '23.jpg', 'Profile', 23),
(24, 'default.jpg', 'Profile', 24),
(25, '25.jpg', 'Profile', 25),
(26, '26.jpg', 'Profile', 26);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageId` int(10) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `username`, `email`, `subject`) VALUES
(1, 'Igor', 'isolesa@outlook.com', 'Hello, world!');

-- --------------------------------------------------------

--
-- Table structure for table `navigationitems`
--

CREATE TABLE `navigationitems` (
  `navItemId` int(10) NOT NULL,
  `itemName` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `itemPosition` int(5) NOT NULL,
  `isDeleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigationitems`
--

INSERT INTO `navigationitems` (`navItemId`, `itemName`, `itemPosition`, `isDeleted`) VALUES
(1, 'Home', 1, 0),
(2, 'Store', 2, 0),
(3, 'Contact', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(10) NOT NULL,
  `productName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(10) NOT NULL,
  `sale` int(10) NOT NULL DEFAULT '0',
  `published` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `averageRating` float DEFAULT NULL,
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `brandId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `description`, `price`, `sale`, `published`, `averageRating`, `isDeleted`, `brandId`) VALUES
(1, 'iPhone 6', 'The iPhone 6 and iPhone 6 Plus both feature built-in NFC functionality that will work seamlessly with Apple\'s new payment system, Apple Pay. ... The rear facing iSight camera in the iPhone 6 has an all new sensor that should handle everyday photography better than ever.', 250, 0, '2019-07-26 04:05:13', NULL, 0, 1),
(2, 'iPhone 7', 'At A Glance. The iPhone 7 and 7 Plus are Apple\'s lower-cost iPhones, with camera improvements, a glossy black color, faster processors, and improved water resistance implemented through a click-less haptic home button and no headphone jack', 598, 10, '2019-07-26 06:27:45', NULL, 0, 1),
(3, 'Honor 10 (128GB)', 'The chipset that is used for Honor 10 Lite is Huawei Hisilicon Kirin 659 and the operating system will be Android 8.1 Oreo. Huawei Honor 10 Lite will be powering up the battery of 3400 mAh.', 463, 0, '2019-07-26 06:27:45', NULL, 0, 2),
(4, 'Honor 10 Lite (3GB, 32GB)', 'The chipset that is used for Honor 10 Lite is Huawei Hisilicon Kirin 659 and the operating system will be Android 8.1 Oreo. Huawei Honor 10 Lite will be powering up the battery of 3400 mAh.', 236, 0, '2019-07-26 06:39:32', NULL, 0, 2),
(5, 'Mate 10 (Dual SIM)', 'The Huawei Mate 10 is a dual SIM (GSM and GSM) . Connectivity options include Wi-Fi, GPS, Bluetooth, NFC, Infrared, USB OTG, 3G and 4G.', 505, 0, '2019-07-26 06:39:32', NULL, 0, 2),
(6, 'G8 GX8 16GB', 'The Huawei G8 (G7 Plus in some markets[1][2]) is an upper-mid Android smartphone, which designed and produced by Huawei. It was released on 2 September 2015.', 165, 0, '2019-07-26 06:47:39', NULL, 0, 2),
(7, 'Honor 5X', 'The Huawei Honor 5X (Chinese: 荣耀畅玩5X) is a mid-range Android smartphone manufactured by Huawei as part of the Huawei Honor X series. It uses the Qualcomm Snapdragon 616 processor and an aluminum body design. It was first released in China in October 2015, and was released in the United States and India in January 2016.', 150, 5, '2019-07-26 06:47:39', NULL, 0, 2),
(8, 'Honor 6x 32GB', 'The Honor 6X is another excellent reasonably-priced smartphone from Huawei and is yet again a lot of smartphone for the money. It has a great camera, good build, dual-Sim and microSD card support, a snappy processor, a decent screen and good battery life.', 175, 15, '2019-07-26 07:02:34', NULL, 0, 2),
(9, 'Honor 8 Pro 64GB', 'Honor, a sub-brand under the Huawei Group, was conceived in late 2011 and established in 2013. Since its inception, the Honor line of smartphones has helped Huawei compete in budget online brands in China. The company began its international expansion in 2014.', 345, 0, '2019-07-26 07:02:34', NULL, 0, 2),
(10, 'Honor 8X Max 64GB', 'The Honor 8 is a smartphone made by Huawei under their Honor sub-brand. It is a successor of the Huawei Honor 7 within the Huawei Honor series.', 303, 0, '2019-07-26 07:12:36', NULL, 0, 2),
(11, 'Honor 9 128GB', 'The Honor 9 is a smartphone made by Huawei under their Honor sub-brand. It is a successor of the Huawei Honor 8 within the Huawei Honor seriesa', 379, 0, '2019-07-26 07:12:36', NULL, 0, 2),
(12, 'Mate 20 Lite', 'Huawei Mate 20 is a line of Android phablets produced by Huawei, which collectively succeed the Mate 10 as part of the Huawei Mate series. The flagship models, the Mate 20 and Mate 20 Pro, were unveiled on 16 October 2018 at a press conference in London.', 295, 0, '2019-07-26 07:18:13', NULL, 0, 2),
(13, 'Mate 20 Pro 128GB', 'So, you\'ve resisted the temptations of big-name 2018 smartphones such as Samsung\'s Galaxy Note 9 and Apple\'s iPhone Xs, and have instead purchased Huawei\'s Mate 20 Pro - the connoisseur\'s choice. ... Just to be clear, the Mate 20 Pro comes with a transparent case included in the price.', 926, 10, '2019-07-26 07:18:13', 5, 0, 2),
(14, 'Mate 9 Dual', 'The Mate 9 also features 4K video, and a front-facing 8MP camera. The Mate 9 comes in Space Gray, Moonlight Silver, Champagne Gold, Mocha Brown, Ceramic White and black (only available in China). It\'s equipped with 4 GB RAM, 64 GB ROM, and microSD support up to 256GB.', 349, 0, '2019-07-26 07:26:10', NULL, 0, 2),
(15, 'Honor 8X 128GB', 'The Honor 8X is a good example of this. Honor is Huawei\'s five-year-old sub-brand for \'digital natives\', which means it largely sells online. ... The Honor 8X is a 6.5-inch handset with a 1,080-by-2,340 resolution, 19.5:9 aspect-ratio display.', 362, 0, '2019-07-26 07:26:10', NULL, 0, 2),
(16, 'Mate 10 Pro 128GB', 'The Huawei Mate 10 is a big phone with an excellent camera, striking design and plenty of power under the hood. Given its size, it won\'t be for everyone, but with very few shortcomings it\'s a definite contender for best value for money big phone of 2017.', 556, 0, '2019-07-26 07:33:20', NULL, 0, 2),
(17, 'Mate 8 32GB', 'The Huawei Mate 8 is a high-end Android smartphone developed and produced by Huawei as part of the Huawei Mate series. It was released on 26 November 2015 in China and globally Q1 2016.', 122, 0, '2019-07-26 07:33:20', 2, 0, 2),
(18, '6.1 (4GB, 64GB)', 'The Nokia 6.1 Plus does not feature OIS, however, the smartphone does bring electronic image stabilization (EIS) to help you get a steady shot.', 261, 25, '2019-07-26 07:43:46', NULL, 0, 3),
(19, '7 plus', 'Nokia 7 Plus price in India starts from Rs. 23,699. The lowest price of Nokia 7 Plus is Rs. 23,699 at shop.gadgetsnow.com. This is 4 GB RAM / 64 GB internal storage variant of Nokia which is available in Black, White colour. 10% off with Axis Bank Buzz Credit Card.', 337, 0, '2019-07-26 07:43:46', NULL, 0, 3),
(20, '8.1', 'Instead the Nokia 8.1 features a 6.18-inch display with a Full HD+ resolution. That\'s 2280 x 1080, with a pixel density of 408ppi. We found the display is good enough for the size of the phone. ... That said, for the price of this phone you\'re unlikely to be disappointed with how the Nokia 8.1 looks.', 421, 0, '2019-07-26 07:50:04', 3, 0, 3),
(21, 'Xperia XA1', 'The Sony Xperia XA1 mobile features a 5.0\" (12.7 cm) display with a screen resolution of HD (720 x 1280 pixels) and runs on Android v7.0 (Nougat) operating system.', 210, 0, '2019-07-26 07:50:04', NULL, 0, 4),
(22, 'Xperia 10 Plus (Dual SIM)', 'The Xperia 1 has a 6.5-inch 21:9 OLED display with a 4K resolution and HDR. It offers a premium, waterproof glass body, a triple 12-megapixel lens camera system on the rear co-developed with Sony Alpha. ... The Xperia 10 and Xperia 10 Plus both feature metal unibody designs, though neither are waterproof.', 429, 0, '2019-07-26 08:02:49', 4, 0, 4),
(23, 'G6', 'The Good The beautifully design LG G6 is water resistant with a tall, expansive display and an extra wide-angle camera. The Bad The phone is LG\'s first flagship in years without a removable battery. It has last year\'s Snapdragon 821 chipset. The Bottom Line The LG G6 is still a decent phone if you can find it cheap.', 250, 20, '2019-07-26 08:02:49', NULL, 0, 5),
(24, 'G4', 'Design. This is where the LG G4 shines. Boasting the best specs and some of the finest photos we\'ve seen from any of the world\'s top smartphones, the G4\'s camera is arguably the best in the business. The sensor itself is 16 megapixels, on par with one of LG\'s closest imaging competitors, the Samsung Galaxy Note 5.', 221, 0, '2019-07-26 08:05:27', NULL, 0, 5),
(25, 'Black Shark (8GB, 128GB)', 'Xiaomi launches the perfect gaming smartphone Black Shark — the Snapdragon 845 processor, 6/8 GB of RAM, 64/128 GB of memory, a screen with a refresh rate of 60 Hz, stereo speakers like in Mi MIX 2S, and a liquid cooling system! ... Play any games at maximum settings.', 422, 0, '2019-07-26 08:05:27', NULL, 0, 6),
(26, 'Mi 8 (256GB)', 'Xiaomi Mi 8 – No Headphone Jack, No in-Display Fingerprint Reader but Dual-Speaker System, Dual Cameras and a Notch That Hides an Advanced 3D Face Unlock Feature. ... If you simply need to attach audio peripherals, you can do that with the Type-C USB to 3.5mm headphone jack adapter.', 385, 0, '2019-07-26 08:07:32', 1, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(5) NOT NULL,
  `roleName` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`) VALUES
(1, 'Superuser'),
(2, 'Administrator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(10) NOT NULL,
  `firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `securityToken` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmationToken` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `dateOfRegistration` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imageSmall` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'defaultSmall.jpg',
  `imageBig` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'defaultBig.jpg',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `isOnline` int(1) NOT NULL DEFAULT '0',
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  `roleId` int(5) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `username`, `email`, `password`, `securityToken`, `confirmationToken`, `dateOfBirth`, `dateOfRegistration`, `imageSmall`, `imageBig`, `active`, `isOnline`, `isDeleted`, `roleId`) VALUES
(1, 'Default', 'User', 'default.user', 'default.user@ict.edu.rs', '2c70d446610418b76f5b2ba0b5b6a627d8031578c9accf9b3759c035c2c824fec816096fff59919b4c29c2a45c3a5330eaa295dc38e0933a647409070ba047ff', '6F6cKn21Q2xdngWFJ0ptrlpNZ3cHnuGB', NULL, '1990-05-14', '2019-07-26 03:45:22', 'defaultSmall.jpg', 'defaultBig.jpg', 1, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandId`),
  ADD UNIQUE KEY `brandId` (`brandId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageId`),
  ADD UNIQUE KEY `imageId` (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`),
  ADD UNIQUE KEY `messageId` (`messageId`);

--
-- Indexes for table `navigationitems`
--
ALTER TABLE `navigationitems`
  ADD PRIMARY KEY (`navItemId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `productId` (`productId`),
  ADD KEY `brandId` (`brandId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`),
  ADD UNIQUE KEY `roleId` (`roleId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId` (`userId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleId` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `navigationitems`
--
ALTER TABLE `navigationitems`
  MODIFY `navItemId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `brands` (`brandId`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
