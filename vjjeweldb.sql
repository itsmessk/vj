-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 07:13 PM
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
-- Database: `vjjeweldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `award_date` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `title`, `award_date`, `category`, `image`, `created_by`, `created_at`) VALUES
(1, '\"Best Diamond Show Room\" for four years - De Beers', '2023-10-10', 'Group Marketing', '38366b715a53d1336f4799835f2061461735804515.jpg', 1, '2025-01-02 07:55:15'),
(2, '\"No.1 In South India for Purity of 916 Gold \" - BIS Bureau of Indian Standards', '2020-02-11', 'Bureau of Indian Standards', 'f68ae65232ed261581ffc7bbc5a3d3a91735804614.jpg', 1, '2025-01-02 07:56:54'),
(3, '\"No.1 Platinum Retail Outlet in India\" - PGI Platinum Guild International', '2019-02-02', 'PGI Platinum Guild International', 'd0096ec6c83575373e3a21d129ff8fef1735804702.jpg', 1, '2025-01-02 07:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `link`, `image`, `created_by`, `created_at`) VALUES
(1, 'Now up to 70% off*', 'MID YEAR SALE', 'https://www.youtube.com/', 'a09048df6d61b4f2107274fb344b4a401735292899.jpg', 0, '2024-12-27 09:48:19'),
(2, 'Now up to 70% off*', 'MID YEAR SALE', 'https://www.youtube.com/', '88c376edec31c46a9095993c14614eab1735293240.jpg', 0, '2024-12-27 09:54:00'),
(3, 'Now up to 80%', 'MID YEAR SALE', 'https://www.youtube.com/', 'b100e9abb9311e2aa4e333ab151a654b1735293921.jpg', 0, '2024-12-27 10:05:21'),
(8, 'Now up to 80%', 'MID YEAR SALE', 'https://www.youtube.com/', '8527f6c834e8fa029f26b4f9181915d81735294686.jpg', 0, '2024-12-27 10:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `createdBy` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`, `createdBy`, `type_id`) VALUES
(10, 'Earrings', 'Gold Earrings', '2024-12-15 20:25:50', NULL, 1, 1),
(11, 'Necklaces', 'Gold Necklaces', '2024-12-15 20:25:50', NULL, 1, 1),
(12, 'Rings', 'Gold Rings', '2024-12-15 20:25:50', NULL, 1, 1),
(13, 'Gender', 'Gold Jewelry for Gender', '2024-12-15 20:25:50', NULL, 1, 1),
(14, 'Occasion', 'Gold Jewelry for Occasions', '2024-12-15 20:25:50', NULL, 1, 1),
(15, 'Mangalsutra', 'Gold Mangalsutra', '2024-12-15 20:25:50', NULL, 1, 1),
(16, 'Bangles & Bracelets', 'Bangles & Bracelets', '2024-12-15 20:25:50', '2024-12-16 05:51:13', 1, 1),
(18, 'Necklaces', 'Silver Necklaces', '2024-12-15 20:25:50', NULL, 1, 2),
(19, 'Rings', 'Silver Rings', '2024-12-15 20:25:50', NULL, 1, 2),
(20, 'Gender', 'Silver Jewelry for Gender', '2024-12-15 20:25:50', NULL, 1, 2),
(21, 'Occasion', 'Silver Jewelry for Occasions', '2024-12-15 20:25:50', NULL, 1, 2),
(22, 'Mangalsutra', 'Silver Mangalsutra', '2024-12-15 20:25:50', NULL, 1, 2),
(23, 'Bangles & Bracelets', 'Silver Mangalsutra, Bangles & Bracelets', '2024-12-15 20:25:50', '2024-12-16 06:37:39', 1, 2),
(24, 'Earrings', 'Silver Earrings', '2024-12-15 20:25:50', NULL, 1, 2),
(25, 'Necklaces', 'Diamond Necklaces', '2024-12-15 20:25:50', NULL, 1, 3),
(26, 'Rings', 'Diamond Rings', '2024-12-15 20:25:50', NULL, 1, 3),
(27, 'Gender', 'Diamond Jewelry for Gender', '2024-12-15 20:25:50', NULL, 1, 3),
(28, 'Occasion', 'Diamond Jewelry for Occasions', '2024-12-15 20:25:50', NULL, 1, 3),
(29, 'Mangalsutra', 'Diamond Mangalsutra', '2024-12-15 20:25:50', NULL, 1, 3),
(30, 'Bangles & Bracelets', 'Diamond Mangalsutra, Bangles & Bracelets', '2024-12-15 20:25:50', '2024-12-16 06:37:49', 1, 3),
(31, 'Earrings', 'Diamond Earrings', '2024-12-15 20:25:50', NULL, 1, 3),
(32, 'mohsina', 'dvfjchevjhrce', '2024-12-31 20:18:37', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hot_products`
--

CREATE TABLE `hot_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) NOT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `product_status` enum('Hot','New Arrival') NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hot_products`
--

INSERT INTO `hot_products` (`id`, `product_name`, `original_price`, `discounted_price`, `discount_percentage`, `product_status`, `product_image`, `created_date`) VALUES
(3, 'Glorious Pink Stone Gold Earrings', 25000.00, 20999.00, 16, 'New Arrival', 'e7ee863f66d5b727e592f7daa70ef7651735806378.jpg', '2025-01-02 08:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_popup`
--

CREATE TABLE `newsletter_popup` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `offer_details` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter_popup`
--

INSERT INTO `newsletter_popup` (`id`, `title`, `subtitle`, `offer_details`, `image`, `created_by`, `creation_date`) VALUES
(1, 'Offers', 'Newyear offer 10%', '10% offer on diamond jewelss', 'uploads/5f3ef2b21d1c06eb14f945c4cfa9e774.jpg', 1, '2024-12-26 17:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `PId` varchar(255) DEFAULT NULL,
  `IsOrderPlaced` int(5) DEFAULT NULL,
  `OrderNumber` int(5) DEFAULT NULL,
  `PaymentMethod` varchar(200) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `OrderDateTime` datetime DEFAULT NULL,
  `RazorpayOrderId` varchar(255) DEFAULT NULL,
  `RazorpayPaymentId` varchar(255) DEFAULT NULL,
  `PaymentStatus` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `UserId`, `PId`, `IsOrderPlaced`, `OrderNumber`, `PaymentMethod`, `orderDate`, `OrderDateTime`, `RazorpayOrderId`, `RazorpayPaymentId`, `PaymentStatus`) VALUES
(100, 13, '84', 1, 184367012, 'razorpay', '2025-01-04 23:50:41', NULL, 'order_PfYTPhhr8iur9x', 'pay_PfYVXVdQzDkRMp', 'Completed'),
(102, 13, '52', NULL, NULL, NULL, '2025-01-05 09:42:16', NULL, NULL, NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productweight` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `addedBy` int(11) DEFAULT NULL,
  `lastUpdatedBy` int(2) DEFAULT NULL,
  `caller_review` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `type`, `productName`, `productweight`, `productPrice`, `gender`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`, `addedBy`, `lastUpdatedBy`, `caller_review`) VALUES
(26, 1, 1, 'Gold', 'Glinting Butterfly Diamond Stud Earrings(14 Carate)', '', 8607, 'gender', 'Product Information\r\nWidth - 7.5 mm\r\nHeight - 5.9 mm\r\nPurity - 14 Kt\r\nApprox.Weight - 0.97 g', 'd917f129d6e4b0895d864682a3909c5b.jpg', '610510f601f662581c6fbb577c8b30f5.jpg', 'a6146e9bb59550da409063667a94b450.jpg', 120, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:16', 1, NULL, 0),
(27, 1, 2, 'Gold', 'Drop Earing 22 Carate', '15G', 24000, 'gender', 'Drop Earing 22 Carate\r\nuiyuiyui\r\njoiuoi\r\nkoujoi', 'c3c08f9c03c66d753798274b4245d158.jpg', 'c3c08f9c03c66d753798274b4245d158.jpg', 'c3c08f9c03c66d753798274b4245d158.jpg', 120, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, 1, 0),
(28, 2, 10, 'Diamond', 'Crystal Diamond Pendant', '', 15346, 'gender', 'Width - 7.2 mm\r\nHeight - 28.9 mm\r\nPurity - 18 Kt\r\nApprox.Weight - 1.62 g', '42e3a6ca313022c6d3f34a1676bd434f.jpg', 'e431ea294034a9afbc885e35e4ad0558.jpg', '42e3a6ca313022c6d3f34a1676bd434f.jpg', 80, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(29, 2, 12, 'Gold', 'Teardrop Pendant in gold', '', 27000, 'gender', 'Teardrop Pendant in gold\r\nProduct Information\r\nWeight: 2 gm\r\nCarate: 22K', '19e2705e043c3807b4a19fd336977ec8.jpg', '3fcb00947475cd8a85638374f20198b2.jpg', '19e2705e043c3807b4a19fd336977ec8.jpg', 85, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(30, 1, 1, 'Gold', 'gjhghjgj', '7gm', 545544, 'gender', 'hjkhkjhkjhkhkhklvcgf\r\ngtuyiuhkjk', '205a8fd06cdb1ab80d3b1436c004be9b.jpg', 'ca1df5cc5f239e4475e32d2c451b9caa.jpg', '205a8fd06cdb1ab80d3b1436c004be9b.jpg', 89, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(31, 2, 11, 'Diamond', 'bjgjlhhui', '12 gm', 11579888, 'Female', 'jhghjghhkkjl\r\nkjhiuyiu\r\nkjyiuyioulhyiuytiu\r\njiouiy', 'b0962738125cc719cb04e494ef6675f8.jpg', '94896cbf76d9133c94b737da69d79832.jpg', '0f60661062bc215e2f63d28554dc6832.jpg', 90, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(32, 2, 12, 'Gold', 'Teardrop Pendant in gold', '', 27000, 'gender', 'Teardrop Pendant in gold\r\nProduct Information\r\nWeight: 2 gm\r\nCarate: 22K', '19e2705e043c3807b4a19fd336977ec8.jpg', '3fcb00947475cd8a85638374f20198b2.jpg', '19e2705e043c3807b4a19fd336977ec8.jpg', 85, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(33, 1, 1, 'Gold', 'gjhghjgj', '7gm', 545544, 'gender', 'hjkhkjhkjhkhkhklvcgf\r\ngtuyiuhkjk', '205a8fd06cdb1ab80d3b1436c004be9b.jpg', 'ca1df5cc5f239e4475e32d2c451b9caa.jpg', '205a8fd06cdb1ab80d3b1436c004be9b.jpg', 89, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(34, 2, 12, 'Gold', 'Teardrop Pendant in gold', '', 27000, 'gender', 'Teardrop Pendant in gold\r\nProduct Information\r\nWeight: 2 gm\r\nCarate: 22K', '19e2705e043c3807b4a19fd336977ec8.jpg', '3fcb00947475cd8a85638374f20198b2.jpg', '19e2705e043c3807b4a19fd336977ec8.jpg', 85, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(35, 2, 10, 'Diamond', 'Crystal Diamond Pendant', '', 15346, 'gender', 'Width - 7.2 mm\r\nHeight - 28.9 mm\r\nPurity - 18 Kt\r\nApprox.Weight - 1.62 g', '42e3a6ca313022c6d3f34a1676bd434f.jpg', 'e431ea294034a9afbc885e35e4ad0558.jpg', '42e3a6ca313022c6d3f34a1676bd434f.jpg', 80, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(36, 1, 2, 'Gold', 'Drop Earing 22 Carate', '', 24000, 'gender', 'Drop Earing 22 Carate\r\nuiyuiyui\r\njoiuoi\r\nkoujoi', 'c3c08f9c03c66d753798274b4245d158.jpg', 'c3c08f9c03c66d753798274b4245d158.jpg', 'c3c08f9c03c66d753798274b4245d158.jpg', 120, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(37, 1, 2, 'Gold', 'fsdfsd', '234csdf', 234234, 'Female', 'dsfsdf', '402fdfb700f491da48cf8536e0593cf0.jpg', '402fdfb700f491da48cf8536e0593cf0.jpg', '402fdfb700f491da48cf8536e0593cf0.jpg', 34, 'In Stock', '2024-01-20 05:26:23', '2024-03-09 18:14:27', 1, NULL, 0),
(41, 10, 25, '1', 'Lustrous Pretty Floral Gold Earrings', '2.732	', 24, '', 'bvuwhbrhwbrhvuwhbvuywybrvhwbufygygewgefoqybbvwhbjbdhcbhgvdiywwrbpwuirgvusyodbsjkhbvurvguovwybywbuorbvwhufbvuhfbdvbfuhv', 'b0d2cba6c2d32c98157572a3d2969ff9.jpg', 'b0d2cba6c2d32c98157572a3d2969ff9.jpg', 'b0d2cba6c2d32c98157572a3d2969ff9.jpg', 1500, 'In Stock', '2024-12-15 21:29:01', NULL, 1, NULL, 0),
(42, 10, 26, '1', 'Glorious Pink Stone Gold Earrings', '5.235 grams', 44, '', 'uuwiribwyrgvwihsnvjsdbjsbxhbaycwqygoevwhorrvpwpvjwdcjbanxbnavevcouqyypvoqepgwcvbwhdvywgdudvgwbnjwbvu wvhwuc w vwuvhqyub  qcuqhc wwueuhffqwuhv qwuhvvw c', 'cccc6119c850c0d39aa220041a905d25.jpg', 'cccc6119c850c0d39aa220041a905d25.jpg', 'cccc6119c850c0d39aa220041a905d25.jpg', 2400, 'In Stock', '2024-12-15 21:31:16', NULL, 1, NULL, 0),
(43, 10, 27, '1', 'Enchanting Floral Gold Earrings', '2.5', 250666, '', 'jbebviqijnevwbosudvipudviwidbvw wvbwbivbwivrbiw qwriruvubwiurrbvs wvbiwbviwijv', '234647318356142a36e67aff63462bf3.jpg', '234647318356142a36e67aff63462bf3.jpg', '234647318356142a36e67aff63462bf3.jpg', 1500, 'In Stock', '2024-12-15 21:34:28', NULL, 1, NULL, 0),
(44, 10, 28, '1', 'Ravishing Beaded Charms Gold Earrings', '3.6', 25, '', 'aiueviqbiq hevbquiowuybrvq qwvebqwihbc wwuvbwhbdcjhbdcuoyw jncinckjwq jnveiuqwevuu', '876ef127771d8877e4fcc5f8bd744206.jpg', '876ef127771d8877e4fcc5f8bd744206.jpg', '876ef127771d8877e4fcc5f8bd744206.jpg', 3500, 'In Stock', '2024-12-15 21:36:28', '2024-12-15 21:37:10', 1, 1, 0),
(45, 10, 29, '1', 'Divine Lakshmi With Peacock Gold Earrings', '5.6', 58, '', 'akjdhvwrbouvsbyrwh wulhrhvbwhbd wvubewh buwbvhjwbduw uwbidduvbwdv', 'de787fe1261ca69bca1dd37ba4c47267.jpg', 'de787fe1261ca69bca1dd37ba4c47267.jpg', 'de787fe1261ca69bca1dd37ba4c47267.jpg', 6522, 'In Stock', '2024-12-15 21:38:29', NULL, 1, NULL, 0),
(46, 11, 31, '1', 'Captivating Dual Stone Gold Necklace', '7.8', 65, '', ' seuhviwveygwhbvwub wurvbyw wvubrvwbvhbdjw wegrvuywgdvuygsufv sbvjsvcutsferw wyrgcvwuygvrwyvew hfbvhufbusv whdbwhvbw vwvbrwhv wuyvbsn cvwjhdvb wdvwy', '4ed7a3f8353ef254f05b14a1ca167341.jpg', '4ed7a3f8353ef254f05b14a1ca167341.jpg', '4ed7a3f8353ef254f05b14a1ca167341.jpg', 5, 'In Stock', '2024-12-16 05:53:21', NULL, 1, NULL, 0),
(47, 11, 30, '1', 'Exquisite Floral Peacock Gold Necklace', '48.574', 427, '', 'Adorn yourself with this gorgeous gold necklace featuring a striking pendant design. The pendant showcases a beautiful combination of synthetic red and green stones in a floral and peacock motif.', '92acfeb7d798a14b5d1d5759eddab3be.jpg', '92acfeb7d798a14b5d1d5759eddab3be.jpg', '92acfeb7d798a14b5d1d5759eddab3be.jpg', 6522, 'In Stock', '2024-12-16 05:55:05', NULL, 1, NULL, 0),
(48, 12, 32, '1', 'Celebrations Wedding Rings | Gents | J005A', '4.379', 36, '', 'This scintillating 22KT gold wedding band from GRT Jewelers Celebrations Collection features a trendy Celtic knot design, meticulously crafted from gleaming 22KT gold. The intricate knot adds a touch of history and symbolism to the band, while the textured finish adds depth and dimension. ', '5a79febc9e1062586c49350f9a36eb02.jpg', '5a79febc9e1062586c49350f9a36eb02.jpg', '5a79febc9e1062586c49350f9a36eb02.jpg', 5, 'In Stock', '2024-12-16 05:58:10', NULL, 1, NULL, 0),
(49, 12, 34, '1', 'Splendid Floral with Leaf Gold Rings', '7.6', 26, '', 'This exquisite 22KT gold ring from GRT Jewellers features a blooming floral design that is both elegant and eye-catching. The ring is crafted from high-quality gold and is sure to last for years to come. The intricate flower design is reminiscent of spring, with delicate petals and leaves that seem to come alive on the finger. This ring is perfect for everyday wear or special occasions. Enjoy the peace of mind of free insured shipping when you buy online.', 'd86208c6eea11d8bc2d8a8b24afda0fa.jpg', 'd86208c6eea11d8bc2d8a8b24afda0fa.jpg', 'd86208c6eea11d8bc2d8a8b24afda0fa.jpg', 2400, 'In Stock', '2024-12-16 06:00:01', NULL, 1, NULL, 0),
(50, 13, 40, '1', 'Classic Intricate Triangular Gold Kada', '33.729', 287, '', 'veevuh vcwubevwybve wbuw wbevuywrgw wvuwy8 eycwyecb wvceyuvbw  wygevhwb wvyrbw vybvrhuwbe vurybwubvwev wvbrwhvr', 'bcfb16cd7bdeeab739c02a1dcff453ef.jpg', 'bcfb16cd7bdeeab739c02a1dcff453ef.jpg', 'bcfb16cd7bdeeab739c02a1dcff453ef.jpg', 3500, 'In Stock', '2024-12-16 06:01:59', NULL, 1, NULL, 0),
(51, 13, 41, '1', 'Exotic Abstract Stone Studded Gold Bracelets', '11.003', 96, '', 'Free Insured Shipping.', '8265e8f75ca9bcdf7948cbc9a8bf9d74.jpg', '8265e8f75ca9bcdf7948cbc9a8bf9d74.jpg', '8265e8f75ca9bcdf7948cbc9a8bf9d74.jpg', 3500, 'In Stock', '2024-12-16 06:03:24', NULL, 1, NULL, 0),
(52, 13, 42, '1', 'Majestic Lion Head Gold Pendant', '0.925', 8, '', 'Attractive lion pendant from GRT Jewellers is a delightful accessory designed to capture your little one’s playful spirit. The adorable lion charm, crafted in high-quality gold, is sure to bring joy and excitement to their day. Its charming design adds a touch of fun and personality, making it a perfect piece for young ones. Whether for a special occasion or everyday wear, this pendant is sure to become a treasured keepsake.Order online today and enjoy free insured shipping with your GRT Jewellers purchase.', '1d8e3763d13c3e9d05b2a60acfe3ba16.jpg', '1d8e3763d13c3e9d05b2a60acfe3ba16.jpg', '1d8e3763d13c3e9d05b2a60acfe3ba16.jpg', 6522, 'In Stock', '2024-12-16 06:04:45', NULL, 1, NULL, 0),
(53, 13, 43, '1', 'Pleasant Lord Bal Ganesha Gold Pendant', '4.548', 38, '', 'Free Insured Shipping.', '58d2ddad0f3d011d9a6775dea7b68e15.jpg', '58d2ddad0f3d011d9a6775dea7b68e15.jpg', '58d2ddad0f3d011d9a6775dea7b68e15.jpg', 5, 'In Stock', '2024-12-16 06:06:06', NULL, 1, NULL, 0),
(54, 14, 44, '1', 'Adoring Butterfly Gold Ring', '4.933', 42, '', 'Unfurl your wings and embrace vibrant charm with this captivating butterfly ring from GRT Jewellers. Crafted in luminous 22KT gold, the design features a mesmerizing butterfly motif, its delicate wings adorned with sparkling cubic zirconia stones. Playful enamel coating brings the butterfly to life in vivid hues, adding a touch of whimsical magic to your finger. Enjoy free insured shipping when you buy online from GRT Jewellers and discover the magic of their craftsmanship.', '4e830e09c6e57f5bc7e73e4315501832.jpg', '4e830e09c6e57f5bc7e73e4315501832.jpg', '4e830e09c6e57f5bc7e73e4315501832.jpg', 2400, 'In Stock', '2024-12-16 06:08:14', NULL, 1, NULL, 0),
(55, 14, 45, '1', 'Golden Embrace Floral Fantasy Gold Necklace', '17.352', 147, '', 'Unveiling a captivating blend of delicate design and modern elegance, this necklace from GRT Jewellers features a sparkling pink gemstone nestled within a mesmerizing mini floral mesh pattern, all crafted in lustrous 22KT Gold. The unique and airy design adds a touch of trendy flair, making this necklace a true statement piece. Embrace the blush of pink and the shimmering gold - order yours online today and enjoy free insured shipping', '3ff664ebad5b401f7ef8bf5851a5d83d.png', '3ff664ebad5b401f7ef8bf5851a5d83d.png', '3ff664ebad5b401f7ef8bf5851a5d83d.png', 5, 'In Stock', '2024-12-16 06:09:29', NULL, 1, NULL, 0),
(56, 14, 46, '1', 'Verdant Floral Enchantment Beaded Pearls Gold Necklace-Kaanchi Collection', '49.405', 425, '', 'cvwivubw wvurvbnwiurv wvubrwibvwv wvw wrbvwurbv wbvurybv wvbw wyrbvwh wrygvwrv wvbryuvwybrv wvyrbvuwybrvwbrv vbwvwef7werf wcuwiecbcwe cwbwbec wyevwuw veuwbvh.', '3c63e6adda8d89515433f189c6b558c2.jpg', '3c63e6adda8d89515433f189c6b558c2.jpg', '3c63e6adda8d89515433f189c6b558c2.jpg', 1500, 'In Stock', '2024-12-16 06:11:05', NULL, 1, NULL, 0),
(57, 15, 91, '1', 'Appealing Tiny Beaded Gold Mangalsutra', '6.053', 52, '', 'Free Insured Shipping', 'ec0de69a3a41b4cb5b1280891d7f9128.jpg', 'ec0de69a3a41b4cb5b1280891d7f9128.jpg', 'ec0de69a3a41b4cb5b1280891d7f9128.jpg', 6522, 'In Stock', '2024-12-16 06:14:00', NULL, 1, NULL, 0),
(58, 15, 35, '1', 'Mesmerizing Peacock Gold Nosepin', '0.693', 7, '', 'Free Insured Shipping', 'f81198eae2ba221aeb312fff1c0cb793.jpg', 'f81198eae2ba221aeb312fff1c0cb793.jpg', 'f81198eae2ba221aeb312fff1c0cb793.jpg', 3500, 'In Stock', '2024-12-16 06:15:25', NULL, 1, NULL, 0),
(59, 16, 36, '1', 'Lambent Wavy Gold Bangles', '32.49', 279, '', 'Free Insured Shipping', '5bd59034e8cb82a9a6952f0e47756ec1.jpg', '5bd59034e8cb82a9a6952f0e47756ec1.jpg', '5bd59034e8cb82a9a6952f0e47756ec1.jpg', 2400, 'In Stock', '2024-12-16 06:20:39', NULL, 1, NULL, 0),
(60, 16, 37, '1', 'Divine Open Type Twin Leaf Gold Bracelet', '8.678', 73, '', 'Free Insured Shipping', '2813810b173bfa0f972e53fdcaa65a3a.jpg', '2813810b173bfa0f972e53fdcaa65a3a.jpg', '2813810b173bfa0f972e53fdcaa65a3a.jpg', 5, 'In Stock', '2024-12-16 06:21:50', NULL, 1, NULL, 0),
(61, 16, 38, '1', 'Glossy Stylus Gold Bracelet', '5.6', 70, '', 'Free Insured Shipping', 'd13e30d036834b4bf961ad17f97d4dcd.jpg', 'd13e30d036834b4bf961ad17f97d4dcd.jpg', 'd13e30d036834b4bf961ad17f97d4dcd.jpg', 6522, 'In Stock', '2024-12-16 06:23:09', NULL, 1, NULL, 0),
(62, 16, 39, '1', 'Lambent Petite Floral Gold Bracelet', '12.372', 108, '', 'Free Insured Shipping', '77a6285e4814997175070969bd4c6a09.jpg', '77a6285e4814997175070969bd4c6a09.jpg', '77a6285e4814997175070969bd4c6a09.jpg', 3500, 'In Stock', '2024-12-16 06:24:38', NULL, 1, NULL, 0),
(63, 18, 48, '2', 'Simple Inter Linked Silver Chain', '92.5', 10, '', 'Free Insured Shipping', 'bdce2462ae2948ea6b9e9cba69b512eb.jpg', 'bdce2462ae2948ea6b9e9cba69b512eb.jpg', 'bdce2462ae2948ea6b9e9cba69b512eb.jpg', 1500, 'In Stock', '2024-12-16 06:26:50', NULL, 1, NULL, 0),
(64, 19, 51, '2', 'Elegant Wavy Adjustable Silver Couple Ring', '5.6', 2, '', 'Free Insured Shipping', '03df14f213cda234f68933e55e3ff17e.jpg', '03df14f213cda234f68933e55e3ff17e.jpg', '03df14f213cda234f68933e55e3ff17e.jpg', 1500, 'In Stock', '2024-12-16 06:29:32', NULL, 1, NULL, 0),
(65, 20, 52, '2', 'Trendy Carved Silver Bracelet', '92.5', 5, '', 'ciygw vwjbevw cwecbwuc wyvbuwyv cbyeygqwc wycwqcw cqwyecgqyvecq cgyec cyegcyuwec cwyvevcw cq7ewyew vwriwhbecbw.', 'fad3ea0aeac6ae11a8600dded4b4f7a3.jpg', 'fad3ea0aeac6ae11a8600dded4b4f7a3.jpg', 'fad3ea0aeac6ae11a8600dded4b4f7a3.jpg', 5, 'In Stock', '2024-12-16 06:30:49', NULL, 1, NULL, 0),
(66, 20, 53, '2', 'Fluttery Fun Delicate Butterfly Charms Silver Bracelet', '92.5', 2, '', 'cwevyuw rviwruwygruvy vbc wwechbwec cuwyvw ywgevuywev wvbwyuebcbqw cqyeqc cbqbecqc cbec hciqejcw ciwuecwec wecbwuv wvwyevw ewiheiwvw vwjnvwvw.', 'b72583e7ee349ca7ba584e96b7958e6a.jpg', 'b72583e7ee349ca7ba584e96b7958e6a.jpg', 'b72583e7ee349ca7ba584e96b7958e6a.jpg', 2400, 'In Stock', '2024-12-16 06:32:20', NULL, 1, NULL, 0),
(67, 20, 54, '2', 'Forever My Love Engraved Silver Necklace', '5.6', 24, '', 'cebvwr  wrbbwrnte etnetmymum wrbwtne etbwbtwrb', 'eb29b690ef1d0f710064ee3d5bce17a6.jpg', 'eb29b690ef1d0f710064ee3d5bce17a6.jpg', 'eb29b690ef1d0f710064ee3d5bce17a6.jpg', 6522, 'In Stock', '2024-12-16 06:33:26', NULL, 1, NULL, 0),
(68, 21, 56, '2', 'Classic with a Twist Figaro Link Sterling Silver Chain', '2.5', 24, '', 'ceqjhevq evbqiev ciuebciw cwcuebwiec wcbwiuc ewcjwbew', '89e00e87c9c65bff93c5661f24fa9bec.jpg', '89e00e87c9c65bff93c5661f24fa9bec.jpg', '89e00e87c9c65bff93c5661f24fa9bec.jpg', 2400, 'In Stock', '2024-12-16 06:35:23', NULL, 1, NULL, 0),
(69, 21, 58, '2', 'Appealing Floral Silver Earrings', '5.6', 44, '', 'scluvbe viuebvbq evquebvuqevc nevnqievac', '24a2a3d1a30244977db9a10679f31c20.jpg', '24a2a3d1a30244977db9a10679f31c20.jpg', '24a2a3d1a30244977db9a10679f31c20.jpg', 1500, 'In Stock', '2024-12-16 06:36:55', NULL, 1, NULL, 0),
(70, 23, 60, '2', 'Petite Statement Starter Silver Bangles', '92.5', 24, '', 'qaeivybqwiev wqpiehvbwe vuwebciqbec cwebc chwbecw ecwe cuweycw ecbwqecqe', '5f3ef2b21d1c06eb14f945c4cfa9e774.jpg', '5f3ef2b21d1c06eb14f945c4cfa9e774.jpg', '5f3ef2b21d1c06eb14f945c4cfa9e774.jpg', 3500, 'In Stock', '2024-12-16 06:38:53', NULL, 1, NULL, 0),
(71, 23, 62, '2', 'Charismatic Contrast Sterling Silver Bracelet', '2.5', 24, '', 'caebw rvrbwqbrw wrbwbr wevqevqev eqvcqev', '826d9355afa87bf4f75790de6374409f.jpg', '826d9355afa87bf4f75790de6374409f.jpg', '826d9355afa87bf4f75790de6374409f.jpg', 2400, 'In Stock', '2024-12-16 06:40:42', NULL, 1, NULL, 0),
(72, 23, 93, '2', 'Appealing Triple Floret Adjustable Silver Bracelet', '5.6', 44, '', 'caevwrbw wrbwrbwb wrvwrvwv wvr wrvwrvw bwrbvwrivw rbiwnr vworubw rjvw ubvw rvuwyrv wurvyw rvw.', '7c478d741d750f8e024c707dfa55d784.jpg', '7c478d741d750f8e024c707dfa55d784.jpg', '7c478d741d750f8e024c707dfa55d784.jpg', 2400, 'In Stock', '2024-12-16 06:43:03', NULL, 1, NULL, 0),
(73, 24, 64, '2', 'Splendid Circle Pattern Silver Earrings', '92.5', 44, '', 'arbwr  tbwb betnmeymr ehwtbwbw rwbwrwer', 'a8c1b576e66b80586569556e210b03b2.jpg', 'a8c1b576e66b80586569556e210b03b2.jpg', 'a8c1b576e66b80586569556e210b03b2.jpg', 3500, 'In Stock', '2024-12-16 06:44:33', NULL, 1, NULL, 0),
(74, 24, 65, '2', 'Modish Enamel Floret Silver Earrings', '92.5', 4, '', 'fsbs  ber eberw erbetn ', 'cabfa36d1ba6762004bb64d8d8629f0e.jpg', 'cabfa36d1ba6762004bb64d8d8629f0e.jpg', 'cabfa36d1ba6762004bb64d8d8629f0e.jpg', 5, 'In Stock', '2024-12-16 06:45:27', NULL, 1, NULL, 0),
(75, 24, 66, '2', 'Attractive Drops Silver Earrings', '5.6', 1, '', 'vwqevwce vwrvwbre vwrv vrwvwb wbrwbwb bvwrewbr vwwvwrfv.', '42c3b509f98f835ba04e61c756543d2d.jpg', '42c3b509f98f835ba04e61c756543d2d.jpg', '42c3b509f98f835ba04e61c756543d2d.jpg', 6522, 'In Stock', '2024-12-16 06:46:21', NULL, 1, NULL, 0),
(76, 24, 65, '2', 'Modern Stone Drop Silver Earrings', '92.5', 5, '', 'evvwr wefwf wf wfw wef 2f2 f fwefw f', 'c7904f7551eee335c02f28bf73c4ec14.jpg', 'c7904f7551eee335c02f28bf73c4ec14.jpg', 'c7904f7551eee335c02f28bf73c4ec14.jpg', 1500, 'In Stock', '2024-12-16 06:47:07', NULL, 1, NULL, 0),
(77, 24, 68, '2', 'Amiable White Stone Hoop Silver Earrings', '3.6', 5, '', 'cevw wvw wrvwvwev vwwevwvw', '938d77a3b2cbf839f2b357e442e0c057.jpg', '938d77a3b2cbf839f2b357e442e0c057.jpg', '938d77a3b2cbf839f2b357e442e0c057.jpg', 6522, 'In Stock', '2024-12-16 06:48:10', NULL, 1, NULL, 0),
(78, 25, 70, '3', 'Fashionable Sleek Diamond Necklace', '92.5', 24, '', 'aevkqkhkkbcqw becuqqbec cwbecw ecwebcuwu cwuecbwh ecwec wec.', 'df00403cdc97f1263a1a071db6e70e59.jpg', 'df00403cdc97f1263a1a071db6e70e59.jpg', 'df00403cdc97f1263a1a071db6e70e59.jpg', 5, 'In Stock', '2024-12-16 06:49:25', NULL, 1, NULL, 0),
(79, 26, 71, '3', 'Incredible Nine Stone Studded Diamond Rings', '5.6', 44, '', 'scade  vevqe efqwevq', 'f49dad233999690185dd821bce2859f3.jpg', '7cb62826a05a7286514741f7daf337f9.jpg', 'f49dad233999690185dd821bce2859f3.jpg', 3500, 'In Stock', '2024-12-16 06:50:30', NULL, 1, NULL, 0),
(80, 26, 73, '3', 'Sparkling Concentric Diamond Ring', '5.6', 24, '', 'cavqed qveqeqe eqcvqeqcqe', 'd7e104391ea13579121c99cc2d6b3eda.jpg', 'd7e104391ea13579121c99cc2d6b3eda.jpg', 'd7e104391ea13579121c99cc2d6b3eda.jpg', 1500, 'In Stock', '2024-12-16 06:52:06', NULL, 1, NULL, 0),
(81, 27, 74, '3', 'Stunning Cubic Diamond Ring', '92.5', 24, '', 'vee eqweve ewvevwe', '6fb1451d4a7abb835bfc73167a6363b3.jpg', '6fb1451d4a7abb835bfc73167a6363b3.jpg', '6fb1451d4a7abb835bfc73167a6363b3.jpg', 6522, 'In Stock', '2024-12-16 06:53:25', NULL, 1, NULL, 0),
(82, 25, 69, '3', 'Modern Stone Drop Silver Earrings', '92.5', 44, '', 'f f et wrbwbet etnete', '50d2535f089423720d61d4ff9816c8ba.jpg', '50d2535f089423720d61d4ff9816c8ba.jpg', '50d2535f089423720d61d4ff9816c8ba.jpg', 86, 'In Stock', '2024-12-16 07:00:19', NULL, 1, NULL, 0),
(83, 27, 75, '3', 'Ravishing Beaded Charms Gold Earrings', '92.5', 24, '', 'my4ynr', '53b11b6c96e8f1aa863435fab05bf589.jpg', '53b11b6c96e8f1aa863435fab05bf589.jpg', '53b11b6c96e8f1aa863435fab05bf589.jpg', 0, 'In Stock', '2024-12-16 07:01:52', NULL, 1, NULL, 0),
(84, 27, 77, '3', 'Skip to the beginning of the images gallery Divine Trishul Pattern Diamond Pendant Customization', '92.5', 24, '', 'vsr wr wrvbwrwv wvwrbw', 'ddbba5efa515ee8eee1a87d92ce524ca.jpg', 'ddbba5efa515ee8eee1a87d92ce524ca.jpg', 'ddbba5efa515ee8eee1a87d92ce524ca.jpg', 3500, 'In Stock', '2024-12-16 07:03:06', NULL, 1, NULL, 0),
(85, 28, 78, '3', 'Charming Leaf Pattern Diamond Ring - Tubella Collectio', '5.6', 24, '', 'rwrbwb ebetbetb ertbetbe', 'e88a449dc1bfdb0a7f9b23a23baedf28.jpg', 'e88a449dc1bfdb0a7f9b23a23baedf28.jpg', 'e88a449dc1bfdb0a7f9b23a23baedf28.jpg', 5, 'In Stock', '2024-12-16 07:04:05', NULL, 1, NULL, 0),
(86, 28, 79, '3', 'Enriching Floral Diamond Necklace', '3.6', 44, '', 'dcvaevwee wrvwrwv wrvwrvw wrvwrv wrvwrvwsv', 'c3e73e37c9a0480c1942d416dc98c3a8.jpg', 'c3e73e37c9a0480c1942d416dc98c3a8.jpg', 'c3e73e37c9a0480c1942d416dc98c3a8.jpg', 5, 'In Stock', '2024-12-16 07:05:18', NULL, 1, NULL, 0),
(87, 28, 80, '3', 'Divine Ganesha Diamond Pendants', '92.5', 44, '', 'orubuecw cwebwce wueucybwuecw cuwuybcuwc wuyvbwuv wwevwr.', '32c3d7057025533440c061feae5f38d1.jpg', '32c3d7057025533440c061feae5f38d1.jpg', '32c3d7057025533440c061feae5f38d1.jpg', 2400, 'In Stock', '2024-12-16 07:06:43', NULL, 1, NULL, 0),
(88, 30, 83, '3', 'Skip to the beginning of the images gallery Charming Infinite Diamond Cuff Bracelet - Tubella Collection', '35.6', 250, '', 'devqevkjkwberv weivbwebcw echwec whecw cwebcwe cwyecw ywecw wcewcwe.', 'c07998f76051bc2f10d1d6853a217952.jpg', 'c07998f76051bc2f10d1d6853a217952.jpg', 'c07998f76051bc2f10d1d6853a217952.jpg', 6522, 'In Stock', '2024-12-16 07:08:13', NULL, 1, NULL, 0),
(89, 30, 84, '3', 'Impressive Concentric Circle Diamond Bracelet', '5.235 ', 24, '', 'cqevevqe vqievbqybevq jqhe hcbcuyqecuy qyecq ecqueycqe cyqecq ecyqec qhecq ecuyqec qecq ecq ecquce.', 'ba5b717407e10ab3e6eb9218d82aafab.jpg', 'ba5b717407e10ab3e6eb9218d82aafab.jpg', 'ba5b717407e10ab3e6eb9218d82aafab.jpg', 3500, 'In Stock', '2024-12-16 07:09:18', NULL, 1, NULL, 0),
(90, 30, 85, '3', 'Divine Ganesha Diamond Bracelets', '2.5', 44, '', 'cwevwqiyev wevcwuec qwyecwccjw ecqwec qyec quhec qcw wq cwec.', '032311677b3f0672c9eaaf3d82397ee0.jpg', '032311677b3f0672c9eaaf3d82397ee0.jpg', '881b01e44c25fc6299f7512d5c609507.jpg', 1500, 'In Stock', '2024-12-16 07:11:14', NULL, 1, NULL, 0),
(91, 31, 86, '3', 'Trendy Dancing Stone Diamond Earrings - Theiaa Collection', '92.5', 25, '', 'wrvwrhvbwuicr wcebwiec wiebcwuye wyubfwf wyfewef uwyefuwf wuybewyef wuyefw fwyefwef', '6fa2a8136facc9fe52c031b4325827ec.jpg', '6fa2a8136facc9fe52c031b4325827ec.jpg', '6fa2a8136facc9fe52c031b4325827ec.jpg', 5, 'In Stock', '2024-12-16 07:12:38', NULL, 1, NULL, 0),
(92, 31, 87, '3', 'Pretty Rose Floral Diamond Earrings', '5.6', 24, '', 'ceqwvwe wrvwr wrfwr wrwfwfwr', '50894079e66a9ac4bcbb1103412d64f9.jpg', '50894079e66a9ac4bcbb1103412d64f9.jpg', '50894079e66a9ac4bcbb1103412d64f9.jpg', 2400, 'In Stock', '2024-12-16 07:15:16', NULL, 1, NULL, 0),
(93, 31, 88, '3', 'Attractive Floral Diamond Earrings - Theiaa Collection', '5.6', 44, '', 'vcwevwe w rwrvwrwrv wrrwvwr wrwfwrfw', '220b8469391a9e360dca7db33d404aa1.jpg', '24ea5e8908287a7b06739e1b5d9f8ae1.jpg', 'd1f3d5f645131dcc904e75ff95c80ab2.jpg', 6522, 'In Stock', '2024-12-16 07:17:27', NULL, 1, NULL, 0),
(94, 31, 89, '3', 'Ravishing Beaded Charms Diamond Earrings', '5.6', 44, '', 'cwevwer wrfwrwr wrfwrvwr  wefwefwe', '39d565325a216f8346486193a62c0304.jpg', '39d565325a216f8346486193a62c0304.jpg', '39d565325a216f8346486193a62c0304.jpg', 5, 'In Stock', '2024-12-16 07:19:18', NULL, 1, NULL, 0),
(95, 29, 81, '3', 'Splendid Pear Drop Diamond Nosepin', '92.5', 44, '', 'caevwqevrw wrwrbw wrgwr', 'd01836971510f25facc760c0a1a6c1b4.jpg', 'd01836971510f25facc760c0a1a6c1b4.jpg', 'd01836971510f25facc760c0a1a6c1b4.jpg', 3500, 'In Stock', '2024-12-16 07:20:23', NULL, 1, NULL, 0),
(96, 10, 25, '1', 'Ravishing Beaded Charms Gold Earrings', '3.6', 24, '', 'Very beautiful', '6da5cccbb88f488ee2d52be5ef5cb4f9.jpg', '3a7d3b39359f8e61b9700331b942a113.jpg', '6da5cccbb88f488ee2d52be5ef5cb4f9.jpg', 2400, 'In Stock', '2024-12-26 16:47:04', NULL, 1, NULL, 0),
(97, 10, 25, '1', 'Modern Stone', '92.5', 25, '', 'dugvi2brvuwbrivywvuchwe b wefvjcvwuiyvbwuiyrviuvr vuyrvbwurvb vrwuyrbwyrvbwhbvwj vwwygwhrvbuwr v vywbvwbvubeybvrybvrurebtnryn', 'c731a8e6b7b84d650ce480bf5a8c5bbf.png', '55b9fc947fd02e50d4f2ff5630202be7jpeg', 'c1ac4a261e77a0e99af18f7a3a257a16.png', 3500, 'In Stock', '2024-12-31 01:26:58', '2024-12-31 01:53:22', 1, 1, 0),
(98, 12, 34, '1', 'gewdxn vre hfvmhtehmgct', '92.5', 250666, '', ' erbdxmrjgfk thlgk htlkghxjthk,cjtgjxhtgc', 'f058e5330d3f84d0142de3677f46789d.JPG', 'f77b2a71843a26ae7e5e4999b1cf3bfb.JPG', 'f761cf346a98c1321e9f6f089be992cc.JPG', 5400, 'In Stock', '2024-12-31 20:16:32', NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_hotlist`
--

CREATE TABLE `product_hotlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `hot_label` varchar(50) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_hotlist`
--

INSERT INTO `product_hotlist` (`id`, `product_id`, `discount_percentage`, `hot_label`, `display_order`, `status`, `created_by`, `created_at`) VALUES
(1, 26, 30, 'New Arrival', 1, 'active', 1, '2025-01-02 08:07:43'),
(2, 28, 20, 'Hot', 2, 'active', 1, '2025-01-02 08:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `gold_rate` decimal(10,2) DEFAULT NULL,
  `silver_rate` decimal(10,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `gold_rate`, `silver_rate`, `created_by`, `created_at`) VALUES
(1, 7920.00, 100.00, NULL, '2025-01-09 16:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategoryName` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `createdBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategoryName`, `creationDate`, `updationDate`, `createdBy`) VALUES
(26, 10, 'Hangings', '2024-12-15 20:25:50', NULL, 1),
(27, 10, 'Drops', '2024-12-15 20:25:50', NULL, 1),
(28, 10, 'Jhumkas', '2024-12-15 20:25:50', NULL, 1),
(29, 10, 'Hoops & Bali', '2024-12-15 20:25:50', NULL, 1),
(30, 11, 'Long Necklaces', '2024-12-15 20:25:50', NULL, 1),
(31, 11, 'Short Necklaces', '2024-12-15 20:25:50', NULL, 1),
(32, 12, 'Band Rings', '2024-12-15 20:25:50', NULL, 1),
(33, 12, 'Engagement Rings', '2024-12-15 20:25:50', NULL, 1),
(34, 12, 'Casual Rings', '2024-12-15 20:25:50', NULL, 1),
(35, 15, 'Nosepins', '2024-12-15 20:25:50', NULL, 1),
(36, 16, 'Bangles', '2024-12-15 20:25:50', NULL, 1),
(37, 16, 'Cuff Bracelets', '2024-12-15 20:25:50', NULL, 1),
(38, 16, 'Chain Bracelets', '2024-12-15 20:25:50', NULL, 1),
(39, 16, 'Bangle Bracelets', '2024-12-15 20:25:50', NULL, 1),
(40, 13, 'Male', '2024-12-15 20:25:50', NULL, 1),
(41, 13, 'Female', '2024-12-15 20:25:50', NULL, 1),
(42, 13, 'Kids & Teens', '2024-12-15 20:25:50', NULL, 1),
(43, 13, 'Unisex', '2024-12-15 20:25:50', NULL, 1),
(44, 14, 'Casual Wear', '2024-12-15 20:25:50', NULL, 1),
(45, 14, 'Party Wear', '2024-12-15 20:25:50', NULL, 1),
(46, 14, 'Traditional Wear', '2024-12-15 20:25:50', NULL, 1),
(47, 18, 'Long Necklaces', '2024-12-15 20:25:50', NULL, 1),
(48, 18, 'Short Necklaces', '2024-12-15 20:25:50', NULL, 1),
(49, 19, 'Band Rings', '2024-12-15 20:25:50', NULL, 1),
(50, 19, 'Engagement Rings', '2024-12-15 20:25:50', NULL, 1),
(51, 19, 'Casual Rings', '2024-12-15 20:25:50', NULL, 1),
(52, 20, 'Male', '2024-12-15 20:25:50', NULL, 1),
(53, 20, 'Female', '2024-12-15 20:25:50', NULL, 1),
(54, 20, 'Kids & Teens', '2024-12-15 20:25:50', NULL, 1),
(55, 20, 'Unisex', '2024-12-15 20:25:50', NULL, 1),
(56, 21, 'Casual Wear', '2024-12-15 20:25:50', NULL, 1),
(57, 21, 'Party Wear', '2024-12-15 20:25:50', NULL, 1),
(58, 21, 'Traditional Wear', '2024-12-15 20:25:50', NULL, 1),
(59, 22, 'Nosepins', '2024-12-15 20:25:50', NULL, 1),
(60, 23, 'Bangles', '2024-12-15 20:25:50', NULL, 1),
(61, 23, 'Cuff Bracelets', '2024-12-15 20:25:50', NULL, 1),
(62, 23, 'Chain Bracelets', '2024-12-15 20:25:50', NULL, 1),
(63, 23, 'Bangle Bracelets', '2024-12-15 20:25:50', NULL, 1),
(64, 24, 'Studs', '2024-12-15 20:25:50', NULL, 1),
(65, 24, 'Hangings', '2024-12-15 20:25:50', NULL, 1),
(66, 24, 'Drops', '2024-12-15 20:25:50', NULL, 1),
(67, 24, 'Jhumkas', '2024-12-15 20:25:50', NULL, 1),
(68, 24, 'Hoops & Bali', '2024-12-15 20:25:50', NULL, 1),
(69, 25, 'Long Necklaces', '2024-12-15 20:25:50', NULL, 1),
(70, 25, 'Short Necklaces', '2024-12-15 20:25:50', NULL, 1),
(71, 26, 'Band Rings', '2024-12-15 20:25:50', NULL, 1),
(72, 26, 'Engagement Rings', '2024-12-15 20:25:50', NULL, 1),
(73, 26, 'Casual Rings', '2024-12-15 20:25:50', NULL, 1),
(74, 27, 'Male', '2024-12-15 20:25:50', NULL, 1),
(75, 27, 'Female', '2024-12-15 20:25:50', NULL, 1),
(76, 27, 'Kids & Teens', '2024-12-15 20:25:50', NULL, 1),
(77, 27, 'Unisex', '2024-12-15 20:25:50', NULL, 1),
(78, 28, 'Casual Wear', '2024-12-15 20:25:50', NULL, 1),
(79, 28, 'Party Wear', '2024-12-15 20:25:50', NULL, 1),
(80, 28, 'Traditional Wear', '2024-12-15 20:25:50', NULL, 1),
(81, 29, 'Nosepins', '2024-12-15 20:25:50', NULL, 1),
(82, 30, 'Bangles', '2024-12-15 20:25:50', NULL, 1),
(83, 30, 'Cuff Bracelets', '2024-12-15 20:25:50', NULL, 1),
(84, 30, 'Chain Bracelets', '2024-12-15 20:25:50', NULL, 1),
(85, 30, 'Bangle Bracelets', '2024-12-15 20:25:50', NULL, 1),
(86, 31, 'Studs', '2024-12-15 20:25:50', NULL, 1),
(87, 31, 'Hangings', '2024-12-15 20:25:50', NULL, 1),
(88, 31, 'Drops', '2024-12-15 20:25:50', NULL, 1),
(89, 31, 'Jhumkas', '2024-12-15 20:25:50', NULL, 1),
(90, 31, 'Hoops & Bali', '2024-12-15 20:25:50', NULL, 1),
(91, 15, 'Chains - Muslim', '2024-12-16 06:12:40', NULL, 1),
(92, 16, 'Adjustable bracelets', '2024-12-16 06:41:20', NULL, 1),
(93, 23, 'Adjustable bracelets', '2024-12-16 06:41:57', NULL, 1),
(94, 22, 'Chains - Muslim', '2024-12-31 01:43:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'VJ Jewel admin', 'sundar', 8979500000, 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2024-01-10 04:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(9, 'sundar', 'sk@gmail.com', 'This is for Testing.', '2024-12-20 11:49:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorderaddresses`
--

CREATE TABLE `tblorderaddresses` (
  `ID` int(10) NOT NULL,
  `UserId` int(5) DEFAULT NULL,
  `Ordernumber` int(10) DEFAULT NULL,
  `Flatnobuldngno` varchar(200) DEFAULT NULL,
  `StreetName` varchar(200) DEFAULT NULL,
  `Area` varchar(200) DEFAULT NULL,
  `Landmark` varchar(200) DEFAULT NULL,
  `City` varchar(200) DEFAULT NULL,
  `Zipcode` int(10) DEFAULT NULL,
  `Phone` bigint(11) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `PaymentMethod` varchar(200) DEFAULT NULL,
  `OrderTime` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(200) DEFAULT NULL,
  `Remark` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblorderaddresses`
--

INSERT INTO `tblorderaddresses` (`ID`, `UserId`, `Ordernumber`, `Flatnobuldngno`, `StreetName`, `Area`, `Landmark`, `City`, `Zipcode`, `Phone`, `Email`, `PaymentMethod`, `OrderTime`, `Status`, `Remark`, `UpdationDate`) VALUES
(8, 7, 528474554, '', '', 'sdff', '', 'sdf', 777444, 7845457845, 'fgdh@hg.fhg', 'E-Wallet', '2024-12-26 10:25:01', NULL, NULL, '2024-12-26 10:25:01'),
(9, 8, 623830828, '21', 'Final test', 'kolathur', '', 'chennai', 600099, 7896541233, 'test@gmail.com', 'E-Wallet', '2024-12-26 10:43:12', 'Delivered', 'Deleivery done ', '2024-12-26 10:43:12'),
(10, 8, 103127394, 'Poonamallee, Chennai', '5/1, Venkadajalapathi Nagar, Keezhperumpakkam, Villupuram.', 'Keelperumbakkam', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'cod', '2025-01-09 17:58:22', 'Delivered', 'Delivered', '2025-01-09 17:58:22'),
(11, 8, 184878695, '', '5/1, Venkadajalapathi Nagar, Keezhperumpakkam, Villupuram.', 'Villupuram', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'cod', '2025-01-09 17:57:31', 'Order Confirmed', 'Order confirmed ', '2025-01-09 17:57:31'),
(12, 10, 609110712, 'Anna Nagar west extension, Chennai', 'Pioneer Colony, Anna Nagar west extension', 'Anna Nagar', '', 'Chennai', 600101, 8015430304, 'mohsinahmedmn004@gmail.com', 'E-Wallet', '2024-12-26 15:02:22', NULL, NULL, '2024-12-26 15:02:22'),
(13, 10, 503483237, '', '5/1, Venkadajalapathi Nagar, Keezhperumpakkam, Villupuram.', 'Villupuram', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'cod', '2024-12-26 16:26:48', NULL, NULL, '2024-12-26 16:26:48'),
(14, 7, 558488226, '', '5/1, Venkadajalapathi Nagar, Keezhperumpakkam, Villupuram.', 'Villupuram', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'bacs', '2024-12-27 13:41:22', NULL, NULL, '2024-12-27 13:41:22'),
(15, 11, 872085022, 'Poonamallee, Chennai', 'Raja Agaraharam Street, MG Nagar', 'Poonamallee, Chennai', '', 'Chennai', 600056, 9952328209, 'mohsinahmedmn004@gmail.com', 'cod', '2024-12-27 13:48:44', NULL, NULL, '2024-12-27 13:48:44'),
(16, 8, 925763672, 'Anna Nagar west extension, Chennai', 'Pioneer Colony, Anna Nagar west extension', 'Anna nagar', '', 'Chennai', 600101, 8015430304, 'mohsinahmedmn004@gmail.com', 'E-Wallet', '2024-12-27 17:07:39', NULL, NULL, '2024-12-27 17:07:39'),
(17, 8, 196458710, 'Poonamallee, Chennai', 'Raja Agaraharam Street, MG Nagar', 'Poonamallee', '', 'Chennai', 600056, 8015430304, 'mohsinahmedmn004@gmail.com', 'cod', '2024-12-27 17:48:18', 'Delivered', 'Order was arrived and delivered', '2024-12-27 17:48:18'),
(18, 8, 800963816, 'Poonamallee, Chennai', '5/1, Venkadajalapathi Nagar, Keezhperumpakkam, Villupuram.', 'Keezhperumbakkam', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'cod', '2024-12-29 06:57:42', NULL, NULL, '2024-12-29 06:57:42'),
(19, 8, 490760909, 'Poonamallee, Chennai', '5/1, Vengadachalapathy Nagar, Keelperumbakkam, Vil', 'Poonamallee', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'cod', '2024-12-29 07:54:22', NULL, NULL, '2024-12-29 07:54:22'),
(20, 8, 269238322, 'Anna Nagar west extension, Chennai', 'Pioneer Colony, Anna Nagar west extension', 'Anna Nagar west extension, Chennai', '', 'Chennai', 600101, 8015430304, 'mohsinahmedmn004@gmail.com', 'bacs', '2024-12-29 07:59:46', NULL, NULL, '2024-12-29 07:59:46'),
(21, 8, 200449277, 'Poonamallee, Chennai', '5/1, Vengadachalapathy Nagar, Keelperumbakkam, Vil', 'Poonamallee, Chennai', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'E-Wallet', '2024-12-29 08:05:47', NULL, NULL, '2024-12-29 08:05:47'),
(22, 8, 716622137, 'Poonamallee, Chennai', '5,Keelperumbakkam, villupuram', 'Villupuram', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'cod', '2024-12-29 08:08:58', NULL, NULL, '2024-12-29 08:08:58'),
(23, 8, 990078500, 'Poonamallee, Chennai', 'Raja Agaraharam Street, MG Nagar', 'Poonamallee, Chennai', '', 'Chennai', 600056, 9952328209, 'mohsinahmedmn004@gmail.com', 'cod', '2024-12-29 08:16:23', NULL, NULL, '2024-12-29 08:16:23'),
(24, 12, 831084577, '', '5/1, Vengadachalapathy Nagar, Keelperumbakkam, Vil', 'Keelperumbakkam', '', 'Villupuram', 605602, 8015430304, 'riomohsin2004@gmail.com', 'cod', '2024-12-29 09:39:15', 'Order Confirmed', 'Your order is confirmed. You will update soon about your order.', '2024-12-29 09:39:15'),
(25, 8, 512646186, '', '5/1, Venkadajalapathi Nagar, Keezhperumpakkam, Villupuram.', 'dsfg ebthyb', '', 'Villupuram', 605602, 8015430304, 'mohsinahmedmn004@gmail.com', 'bacs', '2024-12-31 19:58:48', 'Order Confirmed', 'regt th ryhb j', '2024-12-31 19:58:48'),
(26, 13, 949943527, 'so fake address ', 'This is sample ', 'Perambur', NULL, 'Chennai', 600099, 7878778787, 's@g.v', 'razorpay', '2025-01-04 23:49:24', NULL, NULL, '2025-01-04 23:49:24'),
(27, 13, 339231993, 'so fake address ', 'This is sample ', 'Perambur', NULL, 'Chennai', 600099, 7878778787, 's@g.v', 'razorpay', '2025-01-04 23:49:36', NULL, NULL, '2025-01-04 23:49:36'),
(28, 13, 184367012, 'dfg', '65', 'df', NULL, 'fgb', 545454, 5555555555, 'fhh@gj.fgjh', 'razorpay', '2025-01-05 00:01:30', 'Delivered', 'Deliver to the resident ', '2025-01-05 00:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', '<div><font color=\"#202124\" face=\"arial, sans-serif\"><b>Our mission declares our purpose of existence as a company and our objectives.</b></font></div><div><font color=\"#202124\" face=\"arial, sans-serif\"><b><br></b></font></div><div><font color=\"#202124\" face=\"arial, sans-serif\"><b>To give every customer much more than what he/she asks for in terms of quality, selection, value for money and customer service, by understanding local tastes and preferences and innovating constantly to eventually provide an unmatched experience in jewellery shopping.</b></font></div>', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', '890,Sector 62, Gyan Sarovar, GAIL Noida(Delhi/NCR)', 'info@gmail.com', 7896541239, NULL, '10:30 am to 8:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblreview`
--

CREATE TABLE `tblreview` (
  `ID` int(10) NOT NULL,
  `ProductID` int(10) DEFAULT NULL,
  `ReviewTitle` varchar(200) DEFAULT NULL,
  `Review` mediumtext DEFAULT NULL,
  `UserId` int(5) DEFAULT NULL,
  `DateofReview` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Remark` varchar(200) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblreview`
--

INSERT INTO `tblreview` (`ID`, `ProductID`, `ReviewTitle`, `Review`, `UserId`, `DateofReview`, `Remark`, `Status`, `UpdationDate`) VALUES
(6, 26, 'Nice Product', 'Nice Prodouct', 5, '2024-12-26 10:33:12', 'Review Accept', 'Review Accept', '2022-12-24 10:05:11'),
(10, 26, 'Earring review', 'Very good and beautiful', 12, '2024-12-29 11:22:37', 'Review Accept', 'Review Accept', '2024-12-29 11:21:14'),
(11, 26, 'Earring review', 'Nice quality', 12, '2024-12-29 11:22:47', 'Review Accept', 'Review Accept', '2024-12-29 11:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscriber`
--

CREATE TABLE `tblsubscriber` (
  `ID` int(5) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `DateofSub` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubscriber`
--

INSERT INTO `tblsubscriber` (`ID`, `Email`, `DateofSub`) VALUES
(10, 'jh@gmail.com', '2024-12-21 07:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbltracking`
--

CREATE TABLE `tbltracking` (
  `ID` int(10) NOT NULL,
  `OrderId` char(50) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `StatusDate` timestamp NULL DEFAULT current_timestamp(),
  `OrderCanclledByUser` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltracking`
--

INSERT INTO `tbltracking` (`ID`, `OrderId`, `remark`, `status`, `StatusDate`, `OrderCanclledByUser`) VALUES
(24, '224122905', 'Order Has been Confirmed', 'Order Confirmed', '2024-12-16 18:30:00', NULL),
(25, '819293354', 'Order Has been corfiremed', 'Order Confirmed', '2024-12-22 18:30:00', NULL),
(28, '623830828', 'Order has been approved by admin', 'Order Confirmed', '2024-12-26 10:42:26', NULL),
(29, '623830828', 'Order picked by courier partner', 'Pickup', '2024-12-26 10:42:41', NULL),
(30, '623830828', 'order is on the way tracking id #1213242345', 'On The Way', '2024-12-26 10:43:02', NULL),
(31, '623830828', 'Deleivery done ', 'Delivered', '2024-12-26 10:43:12', NULL),
(32, '196458710', 'Order was confirmed', 'Order Confirmed', '2024-12-27 17:46:45', NULL),
(33, '196458710', 'Order was picked up by your delivery partner', 'Pickup', '2024-12-27 17:47:15', NULL),
(34, '196458710', 'Order was on the way to your home', 'On The Way', '2024-12-27 17:47:44', NULL),
(35, '196458710', 'Order was arrived and delivered', 'Delivered', '2024-12-27 17:48:18', NULL),
(36, '103127394', 'Your order is confirmed', 'Order Confirmed', '2024-12-29 09:18:37', NULL),
(37, '925763672', 'Wrong item selected', 'Order Cancelled', '2024-12-29 09:25:19', 1),
(38, '925763672', 'Not intersres', 'Order Cancelled', '2024-12-29 09:25:53', 1),
(39, '831084577', 'Your order is confirmed. You will update soon about your order.', 'Order Confirmed', '2024-12-29 09:39:15', NULL),
(40, '512646186', 'regt th ryhb j', 'Order Confirmed', '2024-12-31 19:58:48', NULL),
(41, '184367012', 'The order is under packaging ', 'Order Confirmed', '2025-01-04 23:59:13', NULL),
(42, '184367012', 'The order Picked up by the partner ', 'Pickup', '2025-01-05 00:00:30', NULL),
(43, '184367012', 'It is on the way', 'On The Way', '2025-01-05 00:01:02', NULL),
(44, '184367012', 'Deliver to the resident ', 'Delivered', '2025-01-05 00:01:30', NULL),
(45, '184878695', 'Order confirmed ', 'Order Confirmed', '2025-01-09 17:57:31', NULL),
(46, '103127394', 'Order picked up', 'Pickup', '2025-01-09 17:57:45', NULL),
(47, '103127394', 'Order on the way tracking number or contact num: 7878787878', 'On The Way', '2025-01-09 17:58:08', NULL),
(48, '103127394', 'Delivered', 'Delivered', '2025-01-09 17:58:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `typeName` varchar(255) NOT NULL,
  `typeDescription` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `typeName`, `typeDescription`, `creationDate`, `updationDate`, `createdBy`) VALUES
(1, 'Gold', 'Gold Material', '2024-12-15 03:59:15', '2024-12-15 03:59:15', 1),
(2, 'Silver', 'Silver Material', '2024-12-15 03:59:43', '2024-12-15 03:59:43', 1),
(3, 'Diamond', 'Diamond stone', '2024-12-15 04:00:01', '2024-12-15 04:00:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FirstName`, `LastName`, `Email`, `MobileNumber`, `Password`, `regDate`) VALUES
(8, 'Test', 'Account', 'test@gmail.com', 7894563211, '827ccb0eea8a706c4c34a16891f84e7b', '2024-12-26 10:39:50'),
(9, 'Mohsin', 'Ahmed', 'admin@example.com', 8015430304, 'd080a478c55e14e364114881c2ad2bad', '2024-12-26 12:22:03'),
(10, 'Mohsin', 'Ahmed', 'mohsin@email.com', 9952328209, '9c837850199f7692b88b2cd0943efeca', '2024-12-26 15:01:03'),
(11, 'Sundar', 'Karthik', 'admin@ssdc.in', 1234567898, 'a491b20b2ded15f128ad3165e21219c2', '2024-12-27 13:47:11'),
(12, 'Mohsin', 'Ahmed N', 'riomohsin2004@gmail.com', 9789118787, 'a28d931be9ee0020cf9eaa7421310f12', '2024-12-29 09:35:20'),
(13, 'S', 'K', 'sundar@gmail.com', 7878787878, '827ccb0eea8a706c4c34a16891f84e7b', '2025-01-04 23:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `UserId`, `ProductId`, `postingDate`) VALUES
(6, 5, 27, '2024-02-07 09:32:46'),
(18, 7, 29, '2024-12-26 02:13:24'),
(22, 7, 28, '2024-12-27 12:16:03'),
(23, 7, 51, '2024-12-27 13:08:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_type` (`type_id`);

--
-- Indexes for table `hot_products`
--
ALTER TABLE `hot_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_popup`
--
ALTER TABLE `newsletter_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_hotlist`
--
ALTER TABLE `product_hotlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblorderaddresses`
--
ALTER TABLE `tblorderaddresses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblreview`
--
ALTER TABLE `tblreview`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbltracking`
--
ALTER TABLE `tbltracking`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `hot_products`
--
ALTER TABLE `hot_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsletter_popup`
--
ALTER TABLE `newsletter_popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `product_hotlist`
--
ALTER TABLE `product_hotlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblorderaddresses`
--
ALTER TABLE `tblorderaddresses`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblreview`
--
ALTER TABLE `tblreview`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbltracking`
--
ALTER TABLE `tbltracking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_type` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Constraints for table `product_hotlist`
--
ALTER TABLE `product_hotlist`
  ADD CONSTRAINT `fk_product_hotlist` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
