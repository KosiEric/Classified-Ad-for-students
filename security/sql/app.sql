-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 02:38 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `ad_id` varchar(2000) NOT NULL,
  `title` varchar(3000) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `category` varchar(3000) NOT NULL,
  `sub_category` varchar(3000) NOT NULL,
  `product_condition` varchar(3000) NOT NULL,
  `amount` varchar(3000) NOT NULL,
  `negotiable` varchar(3000) NOT NULL,
  `contact_for_price` varchar(200) NOT NULL,
  `photos` varchar(3999) NOT NULL,
  `posted_by` varchar(399) NOT NULL,
  `post_date` varchar(3993) NOT NULL,
  `post_time` varchar(4673) NOT NULL,
  `last_updated` varchar(3939) NOT NULL,
  `views` varchar(400) NOT NULL,
  `closed` varchar(300) NOT NULL,
  `school` varchar(300) NOT NULL DEFAULT 'school',
  `state` varchar(200) NOT NULL DEFAULT 'state'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `ad_id`, `title`, `description`, `category`, `sub_category`, `product_condition`, `amount`, `negotiable`, `contact_for_price`, `photos`, `posted_by`, `post_date`, `post_time`, `last_updated`, `views`, `closed`, `school`, `state`) VALUES
(1, '4ieXrnS', 'Iphone 6 64GB Gold', 'Clean iphone 2gb ram no problem at all', 'phones&tablets', 'Mobile Phones', 'Good', 'N/A', '0', '0', '4ieXrnS-1.jpg,4ieXrnS-2.jpg,4ieXrnS-3.jpg', '01dxe8', '2018-07-18 12:08:46am', '1531872526', '1533568177', '0', '0', 'imsu imo state university, owerri', 'imo'),
(2, 'rW6utcc', 'HP Stream 14 Intel celeron 2016', 'HP Stream 14<br /><br />14.1 inches screen size<br /><br />Intel Celeron<br /><br />Windows 10<br /><br />Webcam<br /><br />Wireless<br /><br />Bluetooth<br /><br />USB port<br /><br />HDMi port<br /><br />128 SSD<br /><br />2gbram<br /><br />DVD player<br /><br />HD Display<br /><br />Good battery<br /><br />Free Charger<br /><br />Installation and Warranty<br /><br />Delivery within Lagos please call me or whatsapp07069723522<br /><br />Address : office is at 1, Adepele street Suite 48 Canaan plaza Computer Village Ikeja.', 'laptops&computers', 'Laptops', 'Good', '80000', '1', '1', 'rW6utcc-1.jpg,rW6utcc-2.jpg,rW6utcc-3.jpg', '01dxe8', '2018-07-18 05:04:29pm', '1531933469', '1533417872', '0', '0', 'imsu imo state university, owerri', 'imo'),
(3, 'oViPJSd', 'Nokia 3 2GB RAM, 16GB Storage', '5.0-inch IPS Display<br />720 x 1280 pixels (294ppi)<br />1.3GHz quad-core Mediatek MTK6737 CPU  with 2GB RAM.<br />Android 7.0 (Nougat)<br />16GB Storage, up to 128GB memory card.<br />8MP Rear Camera and 8MP Front Camera.<br />4G LTE (up to 150 Mbps download)<br />Fingerprint Sensor (Front)<br />2650 mAh Li-ion Battery.', 'phones&tablets', 'Mobile Phones', 'New', '35000', '1', '1', 'oViPJSd-1.jpg,oViPJSd-2.jpg,oViPJSd-3.jpg', '01dxe8', '2018-07-19 12:22:17pm', '1532002937', '1534001989', '0', '0', 'imsu imo state university, owerri', 'imo'),
(4, 'kQ9rQG5', 'Faultless finger print infinix hot 4', 'Very clean, no problem<br />16GB rom<br />2GB Ram<br />Android 6.0<br />', 'phones&tablets', 'Mobile Phones', 'Good', '24000', '1', '1', 'kQ9rQG5-1.jpg,kQ9rQG5-2.jpg,kQ9rQG5-3.jpg', '01dxe8', '2018-07-20 02:35:20am', '1532054120', '1533539453', '1', '0', 'imsu imo state university, owerri', 'imo'),
(5, 'J12r0sb', 'Samsung galaxy s7', 'Very neat and working excellently fine', 'phones&tablets', 'Mobile Phones', 'Good', '75000', '1', '1', 'J12r0sb-1.jpg,J12r0sb-2.jpg,J12r0sb-3.jpg', '01dxe8', '2018-07-25 06:00:04am', '1532498404', '1532498404', '0', '0', 'imsu imo state university, owerri', 'imo'),
(6, 'CG9BpDR', 'Samsung galaxy s7', 'Very neat and working excellently fine', 'phones&tablets', 'Mobile Phones', 'New', '85000', '1', '1', 'CG9BpDR-1.jpg,CG9BpDR-2.jpg,CG9BpDR-3.jpg', '01dxe8', '2018-07-26 09:39:19pm', '1532641159', '1532641159', '1', '0', 'imsu imo state university, owerri', 'imo'),
(7, 'f90Xmsm', 'Samsung galaxy s7', 'Very neat and working excellently fine<br />No problem, neat, new', 'phones&tablets', 'Mobile Phones', 'New', '125000', '1', '1', 'f90Xmsm-1.jpg,f90Xmsm-2.jpg,f90Xmsm-3.jpg', 'uMwIbF', '2018-07-27 04:38:31am', '1532666311', '1534092472', '0', '0', 'futo fed university of technology, owerri', 'imo'),
(9, 'kQ9rQG5', 'Faultless finger print infinix hot 4', 'Very clean, no problem<br />16GB rom<br />2GB Ram<br />Android 6.0<br />', 'phones&tablets', 'Mobile Phones', 'Good', '24000', '1', '1', 'kQ9rQG5-1.jpg', 'UMwIbF', '', '1533490172', '1533539453', '1', '0', 'futo fed university of technology, owerri', 'imo'),
(10, '6obmyGm', 'Iphone 7 for sale', 'Clean, no problem, and very cheap', 'phones&tablets', 'Mobile Phones', 'New', '185000', '1', '1', '6obmyGm-1.jpg,6obmyGm-2.jpg,6obmyGm-3.jpg', '01dxe8', '2018-08-08 11:05:47pm', '1533769547', '1534002246', '0', '0', 'imsu imo state university, owerri', 'imo'),
(11, 'SFXpGvK', 'Infinix Note 4 Pro X571 With X-pen', 'Very neat, in perfect working condition no problem at all', 'phones&tablets', 'Mobile Phones', 'Good', '25000', '1', '1', 'SFXpGvK-1.jpg,SFXpGvK-2.jpg,SFXpGvK-3.jpg', '01dxe8', '2018-08-08 11:13:24pm', '1533770004', '1533770004', '1', '0', 'imsu imo state university, owerri', 'imo'),
(12, 'cMKq0cf', 'UK used HP', 'Very good, no problem at all, it\'s faultless', 'phones&tablets', 'Mobile Phones', 'New', '35000', '1', '1', 'cMKq0cf-1.jpg,cMKq0cf-2.jpg,cMKq0cf-3.jpg', '01dxe8', '2018-08-08 11:18:52pm', '1533770332', '1533770332', '2', '0', 'imsu imo state university, owerri', 'imo'),
(13, 'KZ9_vcg', 'Infinix Hot 5 GOLD 16GB', 'Infinix Infinix Hot 5 (X559C) Dual Sim 16GB ROM/2GB RAM 5.5-Inch HD 8MP+5MP, Fingerprint - Luxurious Gold<br />KEY FEATURES<br />5.5-inch Touch Display, 720 x 1280 pixels (267ppi)<br />1.3GHz quad-core MediaTek MT6580 CPU with 2GB RAM<br />Android 7.0 (Nougat), XOS 2.2<br />16GB Storage with support for memory card up to 32GB<br />8MP Rear Camera and 5MP Front Camera<br />3G and Wi-Fi<br />Fingerprint Sensor (Rear)<br />4000 mAh Battery with Fast Char<br />SPECIFICATIONS<br />SKU<br />IN717EL1534KDNAFAMZ<br />Product Line<br />Tomitimi Network<br />X559c<br />Weight (kg)<br />0.13<br />Colour<br />Gold<br />Main material<br />Plastic cover<br />Display Size (inches)<br />5.5<br />Hard Disk (GB)<br />16<br />Internal Memory(GB)<br />2<br />Megapixels<br />8.0<br />Operating System<br />Android', 'phones&tablets', 'Mobile Phones', 'Good', '30000', '1', '1', 'KZ9_vcg-1.jpg,KZ9_vcg-2.jpg,KZ9_vcg-3.jpg', '01dxe8', '2018-08-12 03:23:27am', '1534044207', '1534044207', '2', '0', 'imsu imo state university, owerri', 'imo'),
(14, 'sMLiwNd', 'Tecno Boom J8 for sale', '<br />Perfectly working,no faults at all,black in colour,contact me', 'phones&tablets', 'Mobile Phones', 'New', '35000', '1', '1', 'sMLiwNd-1.jpg,sMLiwNd-2.jpg,sMLiwNd-3.jpg', '01dxe8', '2018-08-12 03:51:07am', '1534045867', '1534045867', '0', '0', 'imsu imo state university, owerri', 'imo'),
(15, '0INapbD', 'Blackberry Q10 Black 32 Gb', 'Used Blackberry, Neatly used, Uses Whatsapp, Check picture...', 'phones&tablets', 'Accessories', 'Good', '12000', '1', '1', '0INapbD-1.jpg,0INapbD-2.jpg,0INapbD-3.jpg', '01dxe8', '2018-08-12 04:06:34am', '1534046794', '1535355882', '5', '0', 'imsu imo state university, owerri', 'imo'),
(16, '38eWNTK', 'Clean Samsung Galaxy S7 Edge Gold 32 GB', 'Not a single scratch (back & front).<br />Screen protected with liquid nano screen protector.<br />No crack.<br />Unlocked.<br />32GB ROM<br />4GB RAM<br />Dual SIM.<br />Mint condition like new.<br />Accessories:<br />Original Samsung fast adaptive charger<br />Original Samsung ear piece.<br />Screen coated with liquid nano protector.<br />Black pouch if you want.', 'phones&tablets', 'Mobile Phones', 'New', '105000', '1', '1', '38eWNTK-1.jpg,38eWNTK-2.jpg,38eWNTK-3.jpg', '01dxe8', '2018-08-12 04:11:52am', '1534047112', '1534084753', '0', '0', 'imsu imo state university, owerri', 'imo'),
(17, 'keIvPeD', 'Infinix Note 3 Gray 16GB', 'Clean Infinix Note3 With No Faults Just<br />Buy And Enjoy', 'phones&tablets', 'Mobile Phones', 'Good', '35000', '1', '1', 'keIvPeD-1.jpg,keIvPeD-2.jpg,keIvPeD-3.jpg', '01dxe8', '2018-08-12 04:17:22am', '1534047442', '1534082082', '1', '0', 'imsu imo state university, owerri', 'imo'),
(18, 'BXgP6ha', 'Gionee P8w', 'Working perfectly and in good condition... you gonna enjoy buying it<br />I don\'t mind swapping with other phone', 'phones&tablets', 'Mobile Phones', 'Good', '20000', '1', '1', 'BXgP6ha-1.jpg,BXgP6ha-2.jpg,BXgP6ha-3.jpg', '01dxe8', '2018-08-12 04:30:31am', '1534048231', '1534048231', '0', '0', 'imsu imo state university, owerri', 'imo'),
(19, 'WuiUU6X', 'IPhone 6 Plus', 'This an original iPhone 6 Plus by Apple and it is neatly used with no issue to fix', 'phones&tablets', 'Mobile Phones', 'Good', '110000', '1', '1', 'WuiUU6X-1.jpg,WuiUU6X-2.jpg,WuiUU6X-3.jpg', '01dxe8', '2018-08-12 04:42:56am', '1534048976', '1534048976', '0', '0', 'imsu imo state university, owerri', 'imo'),
(20, 'wKMamXM', 'Uk Used Tecno D9 16 GB', 'Neat , No problem at all, not even a crack', 'phones&tablets', 'Mobile Phones', 'Good', '14000', '1', '1', 'wKMamXM-1.jpg,wKMamXM-2.jpg,wKMamXM-3.jpg', 'uMwIbF', '2018-08-13 02:00:41am', '1534125641', '1534125641', '1', '0', 'futo fed university of technology, owerri', 'imo'),
(21, 'R9A_VVo', 'Samsung Galaxy S9 64 GB', 'Is a direct London use in a very good condition, very neat and clean with warranty..', 'phones&tablets', 'Mobile Phones', 'Good', '190000', '1', '1', 'R9A_VVo-1.jpg,R9A_VVo-2.jpg,R9A_VVo-3.jpg', '01dxe8', '2018-08-13 02:06:33am', '1534125993', '1534125993', '3', '0', 'imsu imo state university, owerri', 'imo'),
(22, 'OHgnH7L', 'Google Pixel 2 XL 64 Gb', 'Google pixel 2 xl 64gb new is 300, used is 220. Very Affordable', 'phones&tablets', 'Mobile Phones', 'New', '300000', '1', '1', 'OHgnH7L-1.jpg,OHgnH7L-2.jpg,OHgnH7L-3.jpg', '01dxe8', '2018-08-13 02:11:18am', '1534126278', '1534323330', '3', '0', 'imsu imo state university, owerri', 'imo'),
(23, 'gmepeub', 'Samsung Galaxy S8 Gold 32 GB', 'Samsung Galaxy S8 32gb storage 4gb Ram buy with (warranty) contact for more informations', 'phones&tablets', 'Mobile Phones', 'Good', '155000', '1', '1', 'gmepeub-1.jpg,gmepeub-2.jpg,gmepeub-3.jpg', '01dxe8', '2018-08-13 02:16:11am', '1534126571', '1534126571', '2', '0', 'imsu imo state university, owerri', 'imo'),
(24, 'ocmIuVw', 'IPhone 7plus 32gb With Chip', 'Uk used 32gb iphone7plus all colours with chip in perfect condition', 'phones&tablets', 'Mobile Phones', 'Good', '155000', '1', '1', 'ocmIuVw-1.jpg,ocmIuVw-2.jpg,ocmIuVw-3.jpg', '01dxe8', '2018-08-13 02:23:56am', '1534127036', '1534323109', '2', '0', 'imsu imo state university, owerri', 'imo'),
(25, 'dEC78tZ', 'IPhone 7plus Red 128gb', 'Very very neat and working perfect with long lasting battery', 'phones&tablets', 'Mobile Phones', 'Good', '185000', '1', '1', 'dEC78tZ-1.jpg,dEC78tZ-2.jpg,dEC78tZ-3.jpg', '01dxe8', '2018-08-13 02:28:27am', '1534127307', '1534127307', '0', '0', 'imsu imo state university, owerri', 'imo'),
(26, 'l98Chlg', 'IPhone 6 16GB', 'Clean no problem at all, just enjoy', 'phones&tablets', 'Mobile Phones', 'Good', '70000', '1', '1', 'l98Chlg-1.jpg,l98Chlg-2.jpg,l98Chlg-3.jpg', '01dxe8', '2018-08-13 02:54:38am', '1534128878', '1535375794', '2', '0', 'imsu imo state university, owerri', 'imo'),
(27, 'kjcGN2t', 'Neat HTC Desire 626 White 16 GB', 'HTC desire 626 16GB 2GB Ram 12MP rear camera 5MP front camera in good working condition and neat...', 'phones&tablets', 'Mobile Phones', 'Good', '25000', '1', '1', 'kjcGN2t-1.jpg,kjcGN2t-2.jpg,kjcGN2t-3.jpg', '01dxe8', '2018-08-13 03:01:58am', '1534129318', '1534129318', '4', '0', 'imsu imo state university, owerri', 'imo'),
(28, 'JZUF_rT', 'Samsung Galaxy S9 (Single Sim) Black 64GB', 'Performance and specifications<br />Brand-----------------Samsung<br />Model-----------------Galaxy S9<br />Colour-----------------Black<br />Screen Size------------5.1-6 inches<br />RAM ---------------- -4 GB<br />Storage Capacity ------64 GB<br />Operating System-----Android<br />Condition-------------New<br />', 'phones&tablets', 'Mobile Phones', 'New', '210000', '1', '1', 'JZUF_rT-1.jpg,JZUF_rT-2.jpg,JZUF_rT-3.jpg', '01dxe8', '2018-08-28 02:17:11pm', '1535465831', '1535465831', '2', '0', 'imsu imo state university, owerri', 'imo');

-- --------------------------------------------------------

--
-- Table structure for table `favorite_ads`
--

CREATE TABLE `favorite_ads` (
  `id` int(11) NOT NULL,
  `ad_id` varchar(300) NOT NULL,
  `user_id` varchar(2000) NOT NULL,
  `date_favorited` varchar(399) NOT NULL,
  `time_favorited` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorite_ads`
--

INSERT INTO `favorite_ads` (`id`, `ad_id`, `user_id`, `date_favorited`, `time_favorited`) VALUES
(8, '4ieXrnS', '01dxe8', '2018-08-06 12:34:17pm', '1533551657'),
(11, '0INapbD', '01dxe8', '2018-08-12 06:07:38am', '1534046858'),
(12, 'keIvPeD', '01dxe8', '2018-08-14 01:26:10am', '1534202770'),
(13, 'l98Chlg', '01dxe8', '2018-08-14 01:44:02am', '1534203842'),
(14, 'kQ9rQG5', '01dxe8', '2018-08-14 01:44:29am', '1534203869'),
(15, 'dEC78tZ', '01dxe8', '2018-08-14 01:58:45am', '1534204725'),
(16, 'OHgnH7L', '01dxe8', '2018-08-14 01:59:29am', '1534204769'),
(17, 'kjcGN2t', '01dxe8', '2018-08-14 02:00:01am', '1534204801'),
(18, 'gmepeub', '01dxe8', '2018-08-14 02:11:38am', '1534205498'),
(20, 'R9A_VVo', '01dxe8', '2018-08-14 02:12:05am', '1534205525'),
(21, 'WuiUU6X', '01dxe8', '2018-08-14 02:12:06am', '1534205526'),
(22, 'BXgP6ha', '01dxe8', '2018-08-14 02:12:09am', '1534205529'),
(23, '38eWNTK', '01dxe8', '2018-08-14 02:12:14am', '1534205534'),
(24, 'KZ9_vcg', '01dxe8', '2018-08-14 02:12:17am', '1534205537'),
(25, 'sMLiwNd', '01dxe8', '2018-08-14 02:12:22am', '1534205542'),
(26, 'SFXpGvK', '01dxe8', '2018-08-14 02:12:25am', '1534205545'),
(27, 'cMKq0cf', '01dxe8', '2018-08-14 02:12:26am', '1534205546'),
(28, '6obmyGm', '01dxe8', '2018-08-14 02:12:30am', '1534205550'),
(29, 'oViPJSd', '01dxe8', '2018-08-14 02:12:32am', '1534205552'),
(30, 'rW6utcc', '01dxe8', '2018-08-14 02:12:33am', '1534205553'),
(31, 'wKMamXM', 'uMwIbF', '2018-08-14 01:46:48pm', '1534247208');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `message_id` varchar(1000) NOT NULL,
  `sent_to` varchar(100) NOT NULL,
  `time_sent` varchar(20000) NOT NULL,
  `ad_id` varchar(1000) NOT NULL,
  `message_read` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `subject`, `body`, `message_id`, `sent_to`, `time_sent`, `ad_id`, `message_read`) VALUES
(1, 'Kosi Eric', 'Message subject goes here', 'Hi, am trying to call your phone number everytime', 'KuxXIK0', '01dxe8', '1532983531', 'kQ9rQG5', '0'),
(2, 'Kosi Eric', 'Message subject goes here', 'hi i\'ve been trying your number all these while and it has not been going through', 'L8JTFsm', '01dxe8', '1532989702', 'kQ9rQG5', '0'),
(3, 'Kosi Eric', 'Message subject goes here', 'hi i\'ve been trying your number all these while and it has not been going through', '7SOkcjS', '01dxe8', '1532989798', 'kQ9rQG5', '0'),
(4, 'Kosi Eric', 'Message subject goes here', 'hi i\'ve been trying your number all these while and it has not been going through', 'BS8swzk', '01dxe8', '1532990241', 'kQ9rQG5', '0'),
(5, 'Kosi Eric', 'Message subject goes here', 'hi i\'ve been trying your number all these while and it has not been going through', 'WX2Z_9y', '01dxe8', '1532990320', 'kQ9rQG5', '0'),
(6, 'Kosi Eric', 'Message subject goes here', 'hi i\'ve been trying your number all these while and it has not been going through', '1cPyqjf', '01dxe8', '1532990448', 'kQ9rQG5', '0'),
(7, 'Kosi Eric', 'Message subject goes here', 'hi i\'ve been trying your number all these while and it has not been going through', 'hVIIIHL', '01dxe8', '1532990670', 'kQ9rQG5', '0');

-- --------------------------------------------------------

--
-- Table structure for table `reported_ads`
--

CREATE TABLE `reported_ads` (
  `id` int(11) NOT NULL,
  `ad_id` varchar(100) NOT NULL,
  `report_id` varchar(100) NOT NULL,
  `time_reported` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reported_ads`
--

INSERT INTO `reported_ads` (`id`, `ad_id`, `report_id`, `time_reported`, `reason`, `comment`) VALUES
(1, 'rW6utcc', 'hqcNXv1', '1532162452', 'Duplicate ad', 'I noticed that this particular ad had been posted many times previously on this platform'),
(2, 'rW6utcc', 'SVfZAXg', '1532162588', 'Duplicate ad', 'i noticed that this particular ad had been posted previously several times on this platform.'),
(3, 'kQ9rQG5', '8U3uuJW', '1532163449', 'Fraud', 'i noticed that this particular ad had been posted several times on this particular platform.'),
(4, '4ieXrnS', 'hK2I7wq', '1532433791', 'Fraud', 'hi, i noticed that this particular ad had been posted several times'),
(5, 'kQ9rQG5', '9zqzGzZ', '1532982437', 'Fraud', 'this is a fake ad'),
(6, 'kQ9rQG5', 'CAF2q8V', '1532982545', 'Fraud', 'this is a fake ad'),
(7, '4ieXrnS', 'EsKrAia', '1533488073', 'Fraud', 'this is fraud');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `primary_phone` varchar(100) NOT NULL,
  `secondary_phone` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `school` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `registration_date` varchar(100) NOT NULL,
  `registration_timestamp` varchar(100) NOT NULL,
  `email_verified` varchar(100) NOT NULL,
  `last_seen` varchar(100) NOT NULL,
  `active` varchar(100) NOT NULL,
  `password_reset_code` varchar(100) NOT NULL,
  `email_verification_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `user_id`, `email_address`, `primary_phone`, `secondary_phone`, `profile`, `full_name`, `state`, `school`, `country`, `registration_date`, `registration_timestamp`, `email_verified`, `last_seen`, `active`, `password_reset_code`, `email_verification_code`) VALUES
(1, 'megakosi', '01dxe8', 'juulskosi@gmail.com', '07084419530', '08060087603', '01dxe8.jpg', 'Kosi Eric', 'Imo', 'IMSU Imo State University, Owerri', 'Nigeria', '17-07-2018', '1531871738', '1', '1535466586', '1', 'tE_Vk2dt_ALwpAgQxygsr3nbhpiLoeQf', 'ggJxX0c5RoNd7Mq2'),
(4, 'realkosieric', 'uMwIbF', 'kosiuniverse@gmail.com', '07084419534', '08036672037', 'uMwIbF.jpg', 'Kosi Eric', 'Imo', 'FUTO Fed University Of Technology, Owerri', 'Nigeria', '27-07-2018', '1532666125', '1', '1535719794', '1', 'UFD1uZr5rPHXGPhL9vx2ZLIz2SG1VtxF', 'ESF2TEQYc_Zrd6Zb'),
(5, 'moonwalker', 'AqqeZl', 'itskosieric@gmail.com', '07084419538', '08036672039', 'AqqeZl.jpg', 'Kosi Eric', 'Imo', 'FUTO Fed University Of Technology, Owerri', 'Nigeria', '31-07-2018', '1533039363', '0', '1533039429', '1', 'aC5sqpMV9xU9A8z6oQTqPFmLz9VIdDFA', '4XT3Dd33uTh9sEbz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_ads`
--
ALTER TABLE `favorite_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_ads`
--
ALTER TABLE `reported_ads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `report_id` (`report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `favorite_ads`
--
ALTER TABLE `favorite_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reported_ads`
--
ALTER TABLE `reported_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
