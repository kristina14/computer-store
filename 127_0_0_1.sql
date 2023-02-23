-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2017 at 11:24 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `std201706db`
--
CREATE DATABASE IF NOT EXISTS `std201706db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `std201706db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(9) UNSIGNED NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'מחשבים נייחים'),
(2, 'מחשבים ניידים'),
(3, 'טאבלטים');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_id` int(9) UNSIGNED NOT NULL,
  `Customer_name` varchar(20) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `Customer_Lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_id`, `Customer_name`, `phone`, `address`, `pass`, `gender`, `email`, `Customer_Lname`) VALUES
(444444444, 'ישראל', '0544444444', 'תל אביב', '$2y$10$up8dkIQoLpavtaGT4QQU3ucwU9g4t2fHELX0J/MrJaxuMygB0SLDC', 'male', 'telaviv@check.com', 'ישראלי'),
(555555555, 'תמר', '0777777777', 'אשדוד', '$2y$10$vAfC3nnMO2yaidCjwbY98.q193jUFCYpIl94fe0YjAnkxqlv.klkO', 'female', 'ashdod@check.com', 'פרץ'),
(666666666, 'רונית', '0556666666', 'הרצליה', '$2y$10$G4rMGMLOj6.vJzwmHll3AemaZyAD9Sk.UKEnHyHgHPvGGhqXwCjG6', 'female', 'ronith@harush.com', 'הרוש'),
(777777777, 'שאול', '0577777777', 'רמת הגולן', '$2y$10$coAH8FbgzKuqdBpnlgY26uRBeYDtUyQAQJGU0ZJLlLdVOzDDAC/lq', 'male', 'shaul@shaul.com', 'כץ');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `Employee_id` int(9) UNSIGNED NOT NULL,
  `First_name` varchar(20) NOT NULL,
  `Last_name` varchar(20) NOT NULL,
  `Manager` varchar(3) DEFAULT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Employee_id`, `First_name`, `Last_name`, `Manager`, `password`) VALUES
(111111111, 'יוסי', 'כהן', 'לא', '$2y$10$SyB3xFlxneRigAdOzKPF2ekM//Isp6AUBQsrQIzatXl1BAoWxDkKG'),
(206232977, 'מאי', 'חמדוני', 'כן', '$2y$10$hWttNiuYeFZZ0gTNV98odeghzb.w.rffswYBPrXQjR2kHH0dIU8Qy'),
(222222222, 'יצחק', 'לוי', 'לא', '$2y$10$i4C48Vpuz.LgLkjGXCatq.qBMaR8pUd1DLZaX.eErsOII1WvpwEsy'),
(321133019, 'כריסטינה', 'מושקוב', 'כן', '$2y$10$9X2PpwE.dec/2SUiSS13euREtWRf4tIbj9/TFYVCIHYsYKTK1ilRq'),
(333333333, 'דוד', 'יוסף', 'לא', '$2y$10$39khYCWWMrZ3f3JLnK4yOu9.EWKF75lccTsuRn8Mam2VgBA0tm6iG');

-- --------------------------------------------------------

--
-- Table structure for table `employee_order`
--

CREATE TABLE `employee_order` (
  `Order_id` int(9) UNSIGNED NOT NULL,
  `Employee_id` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_order`
--

INSERT INTO `employee_order` (`Order_id`, `Employee_id`) VALUES
(42, 111111111),
(67, 111111111),
(68, 111111111),
(69, 111111111),
(70, 111111111),
(71, 111111111),
(72, 111111111),
(73, 111111111),
(74, 111111111);

-- --------------------------------------------------------

--
-- Table structure for table `managercategories`
--

CREATE TABLE `managercategories` (
  `ManagerCategories_id` int(9) NOT NULL,
  `ManagerCategories_name` varchar(20) NOT NULL,
  `manager` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managercategories`
--

INSERT INTO `managercategories` (`ManagerCategories_id`, `ManagerCategories_name`, `manager`) VALUES
(1, 'ניהול האתר', 'כן'),
(2, 'ניהול מלאי', 'לא'),
(3, 'ניהול משתמשים', 'לא'),
(4, 'ניהול עובדים', 'כן'),
(5, 'ניהול הזמנות', 'לא'),
(6, 'דוחות', 'כן');

-- --------------------------------------------------------

--
-- Table structure for table `managersubcategories`
--

CREATE TABLE `managersubcategories` (
  `ManagerCategories_id` int(9) NOT NULL,
  `ManagerSubCategories_id` int(9) NOT NULL,
  `ManagerSubCategories_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managersubcategories`
--

INSERT INTO `managersubcategories` (`ManagerCategories_id`, `ManagerSubCategories_id`, `ManagerSubCategories_name`) VALUES
(1, 11, 'מחיקת תת קטגוריה'),
(1, 12, 'הוספת קטגוריה'),
(1, 13, 'מחיקת קטגוריה'),
(5, 14, 'חילוק הזמנות'),
(1, 15, 'הוספת תת קטגוריה'),
(5, 16, 'היסטורית הזמנות'),
(5, 17, 'הזמנות שלי'),
(5, 18, 'כלל ההזמנות'),
(2, 21, 'הוספת מוצר'),
(2, 22, 'מחיקת מוצר'),
(2, 23, 'עדכון מוצר'),
(2, 24, 'הצגת מלאי החנות'),
(3, 32, 'יצירת קשר עם הלקוחות'),
(3, 33, 'צפייה בלקוחות'),
(3, 34, 'מחיקת לקוחות רשומים'),
(3, 35, 'עדכון לקוח'),
(3, 36, 'הוספת לקוח'),
(4, 41, 'הוספת עובד'),
(4, 42, 'מחיקת עובד'),
(4, 43, 'צפייה בעובדים'),
(6, 61, 'מוצרים שאזלו מהמלאי'),
(6, 62, 'מוצרים נמכרים ביותר'),
(6, 63, 'הזמנות לפי תאריך'),
(6, 64, 'הזמנות שבטיפול מעל שבוע'),
(6, 65, 'הזמנות לפי עובד');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_id` int(9) UNSIGNED NOT NULL,
  `Order_date` date NOT NULL,
  `Customer_id` int(9) UNSIGNED DEFAULT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_id`, `Order_date`, `Customer_id`, `Status`) VALUES
(42, '2017-09-03', 555555555, 'End Process'),
(67, '2017-12-05', 444444444, 'End Process'),
(68, '2017-08-05', 444444444, 'DONE'),
(69, '2017-12-06', 555555555, 'End Process'),
(70, '2017-10-06', 555555555, 'DONE'),
(71, '2017-11-06', 555555555, 'DONE'),
(72, '2017-12-06', 555555555, 'DONE'),
(73, '2017-12-06', 555555555, 'DONE'),
(74, '2017-12-06', 555555555, 'DONE'),
(78, '2017-12-07', 444444444, 'In Process'),
(79, '2017-12-07', 444444444, 'In Process');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `Order_id` int(9) UNSIGNED NOT NULL,
  `product_id` int(9) UNSIGNED NOT NULL,
  `Quantity` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`Order_id`, `product_id`, `Quantity`) VALUES
(42, 110, 1),
(67, 101, 1),
(68, 101, 1),
(69, 101, 1),
(70, 101, 1),
(71, 100, 1),
(72, 102, 1),
(73, 101, 1),
(74, 100, 1),
(74, 101, 1),
(74, 123, 1),
(78, 101, 1),
(79, 115, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(9) UNSIGNED NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `description` longtext NOT NULL,
  `unit_price` int(5) UNSIGNED NOT NULL,
  `category_id` int(9) UNSIGNED DEFAULT NULL,
  `image` text NOT NULL,
  `subcategory_id` int(30) DEFAULT NULL,
  `Quantity` int(9) UNSIGNED NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `unit_price`, `category_id`, `image`, `subcategory_id`, `Quantity`, `Status`) VALUES
(100, ' Samsung Galaxy Tab E SM-T560', 'טאבלט איכותי מבית Samsung, בעל מסך 9.6 אינטש מולטי-טאץ, מעבד מרובע ליבות במהירות 1.3GHz, מצלמה אחורית 5 מגה פיקסל, מצלמת סלפי, מערכת הפעלה אנדרואיד וסוללה חזקה 5000mAh יצרן:  Samsung‏,  דגם:  Galaxy Tab E SM-T560‏,  גודל:  9.6\'‏,  מעבד:  Qualcomm‏,  מערכת הפעלה:  Android‏,', 750, 3, 'images/b_21.jpg', 32, 18, 'פעיל'),
(101, 'מחשב נייד משולב טאבלט Lenovo Miix', 'מחשב נייד משולב טאבלט מבית Lenovo בעל מסך מגע בגודל 10.1 אינטש, מעבד Intel® Atom x5-Z8350 1.44GHz, זיכרון RAM בנפח 2GB, אחסון בנפח 64GB וקישוריות WIFI ו-Bluetooth, בעל מערכת הפעלה Windows 10', 1080, 2, 'images/b_2.jpg', 21, 36, 'פעיל'),
(102, 'HP Notebook 15-AY025NJ', 'מחשב נייד מבית HP בעל מסך בגודל 15.6 אינטש, מעבד Intel® Core i3-6006U - 2.0GHz, זיכרון פנימי 6GB, כונן קשיח 1TB ומקלדת מלאה', 2599, 2, 'images/b_1.jpg', 24, 28, 'פעיל'),
(105, ' Desktop Intel Pentium G4560 3.5GHz ', ' סוג:  Intel‏,  מעבד:  Intel Pentium‏,  נפח:  1TB‏,  גודל זכרון:  4GB‏,  ערכת שבבים:  H110‏,', 1099, 1, 'images/c_1.jpg', 12, 52, 'פעיל'),
(107, ' Lenovo Miix 320-10 80XF001FIV', 'מחשב נייד משולב טאבלט מבית Lenovo בעל מסך מגע בגודל 10.1 אינטש, מעבד Intel® Atom x5-Z8350 1.44GHz, זיכרון RAM בנפח 2GB, אחסון בנפח 32GB וקישוריות WIFI ו-Bluetooth, בעל מערכת הפעלה Windows 10', 1140, 3, 'images/b_13.jpg', 21, 80, 'פעיל'),
(108, ' ASUS VivobookL200HA-FD0053T ', 'מחשב נייד מבית Asus בעל מסך 11.6 אינטש, מעבד Intel® Atom Quad Core Z8350 1.44GHz - 1.92GHz, זיכרון פנימי בנפח 2GB, כונן קשיח בנפח 32GB, ללא כונן אופטי\r\n יצרן:  Asus‏,  דגם:  Vivobook E200HA / L200HA‏,  גודל:  11.6\'\'‏,  מעבד:  Intel® Atom‏,  מערכת הפעלה:  Windows 10 Home‏,\r\n', 845, 2, 'images/b_11.jpg', 22, 40, 'פעיל'),
(109, 'Lenovo IdeaPad 320-15 80XV008HIV', 'מחשב נייד מבית Lenovo בעל מסך 15.6 אינטש, מעבד AMD E2-9000 1.8GHz - 2.20GHz, זיכרון פנימי בנפח 4GB, כונן קשיח בנפח 500GB ללא מערכת הפעלה וללא צורב\r\n יצרן:  Lenovo‏,  דגם:  IdeaPad 320‏,  גודל:  15.6\'\'‏,  מעבד:  AMD E-Series‏,  מערכת הפעלה:  ללא מערכת הפעלה‏', 1090, 2, 'images/m_3.jpg', 21, 22, 'פעיל'),
(110, 'Lenovo Pad 110S-11 80WG0024IV', 'מחשב נייד מבית Lenovo בעל מסך 11.6 אינטש, מעבד Intel® Pentium N3710 1.6GHz - 2.50GHz, זיכרון פנימי בנפח 4GB, כונן SSD בנפח 32GB מצלמת רשת באיכות HD 720P ומערכת הפעלה Windows 10\r\n יצרן:  Lenovo‏,  דגם:  IdeaPad 110S‏,  גודל:  11.6\'\'‏,  מעבד:  Intel Pentium - N‏,  מערכת הפעלה:  Windows 10 Home‏,', 1140, 2, 'images/m_2.jpg', 21, 40, 'פעיל'),
(111, 'ASUS Vivobook E200HA', 'מחשב נייד מבית Asus בעל מסך 11.6 אינטש, מעבד Intel® Atom Quad Core Z8350 1.44GHz - 1.92GHz, זיכרון פנימי בנפח 2GB, כונן קשיח בנפח 32GB, ללא כונן אופטי\r\n', 845, 2, 'images/b_6.jpg', 22, 35, 'פעיל'),
(112, 'Lenovo IdeaPad 110S-11 80WG0023IV ', 'מחשב נייד מבית Lenovo בעל מסך 11.6 אינטש, מעבד Intel® Pentium N3710 1.6GHz - 2.50GHz, זיכרון פנימי בנפח 4GB, כונן SSD בנפח 32GB מצלמת רשת באיכות HD 720P ומערכת הפעלה Windows 10\r\n', 1140, 2, 'images/b_7.jpg', 21, 50, 'פעיל'),
(113, ' Lenovo N23 Chromebook 80YS002UIV ', 'מחשב נייד מבית Lenovo בעל מסך 11.6 אינטש, מעבד Intel® Celeron® N3160 2.6GHz - 2.24GHz, זיכרון פנימי בנפח 4GB, כונן SSD בנפח 16GB, מצלמת רשת באיכות HD ומערכת הפעלה Chrome OS\r\n יצרן:  Lenovo‏,  דגם:  N23‏ Chromebook‏,  גודל:  11.6\'\'‏,  מעבד:  Intel Celeron‏,  מערכת הפעלה:  Chrome OS‏,\r\n', 1090, 2, 'images/bb_4.jpg', 21, 35, 'פעיל'),
(115, 'מחשב נייד - ASUS X540YA-XX017D ', 'חשב נייד מבית Asus בעל מסך 15.6 אינטש, מעבד AMD E1-7010 1.5GHz, זיכרון פנימי בנפח 4GB, כונן קשיח בנפח 500GB, מקלדת מלאה וללא מערכת הפעלה\r\n יצרן:  Asus‏,  דגם:  VivoBook X454 / X540 / K540‏,  גודל:  15.6\'\'‏,  מעבד:  AMD E-Series‏,  מערכת הפעלה:  ללא מערכת הפעלה‏,', 1040, 2, 'images/b_5.jpg', 22, 19, 'פעיל'),
(117, 'Asus Vivo AiO V241ICUK-WA013T ', 'חשב AIO הכולל את כל רכיבי המחשב במסך המחשב עצמו, למחשב מסך 23.8 אינץ, מעבד Intel® Core i3-7100U 2.4GHz, זיכרון RAM 8GB, כונן קשיח 1TB וכולל מערכת הפעלה, למחשב זה מצורפים עכבר ומקלדת\r\n יצרן:  Asus‏,  דגם:  Vivo AiO V241‏,  גודל:  23.8\'\'‏,  מעבד:  Intel Core i3 - U‏,  מערכת הפעלה:  Windows 10 Home‏,', 3900, 2, 'images/asusVivo.jpg', 22, 50, 'פעיל'),
(118, ' Samsung Galaxy Tab A 2016 SM-T280', 'טאבלט איכותי מבית Samsung, בעל מסך 7 אינטש מולטי-טאץ, מעבד מרובע ליבות במהירות 1.3GHz, מצלמה אחורית 5 מגה פיקסל, מצלמת סלפי, מערכת הפעלה אנדרואיד וסוללה חזקה 4000mAh יצרן:  Samsung‏,  דגם:  Galaxy Tab A 2016 SM-T280‏,  גודל:  7\'‏,  מעבד:  Cortex‏,  מערכת הפעלה:  Android‏,', 1000, 3, 'images/Samsung-Galaxy-Tab-E-7.0.jpg', 32, 30, 'פעיל'),
(119, ' Samsung Galaxy Tab E SM-T560', 'טאבלט איכותי מבית Samsung, בעל מסך 9.6 אינטש מולטי-טאץ, מעבד מרובע ליבות במהירות 1.3GHz, מצלמה אחורית 5 מגה פיקסל, מצלמת סלפי, מערכת הפעלה אנדרואיד וסוללה חזקה 5000mAh\r\n יצרן:  Samsung‏,  דגם:  Galaxy Tab E SM-T560‏,  גודל:  9.6\'\'‏,  מעבד:  Qualcomm‏,  מערכת הפעלה:  Android‏,', 750, 3, 'images/b_34.jpg', 32, 66, 'פעיל'),
(120, 'Lenovo Yoga 720-13 80X600EEIV ', 'מחשב נייד מבית Lenovo עם מסך מגע 13.3 אינטש ברזולוצית FHD, מעבד Intel® Core i5-7200U 2.5GHz - 3.1GHz, זיכרון פנימי בנפח 8GB, כונן SSD בנפח 256GB, ללא כונן אופטי וכולל מערכת הפעלה\r\n יצרן:  Lenovo‏,  דגם:  Yoga 720‏,  גודל:  13.3\'\'‏,  מעבד:  Intel Core i5 - U‏,  מערכת הפעלה:  Windows 10 Home‏,', 4390, 2, 'images/b_35.jpg', 21, 29, 'פעיל'),
(121, 'Lenovo Yoga A12 ', 'מחשב נייד משולב טאבלט מבית Lenovo בעל מסך מגע בגודל 12.2 אינטש, מעבד Intel® Atom x5-Z8550 1.44 GHz - 2.4 GHz, זיכרון RAM בנפח 2GB, אחסון בנפח 32GB וקישוריות WIFI ו-Bluetooth, בעל מערכת הפעלה Andriod\r\n יצרן:  Lenovo‏,  דגם:  Yoga A12 YB-Q501‏,  גודל:  12.2\'\'‏,  מעבד:  Intel Atom‏,  מערכת הפעלה:  Android‏,', 1350, 2, 'images/b_21.jpg', 21, 60, 'פעיל'),
(122, 'iPad Air 2 Wi-Fi 64GB - Silver', 'Originally released October 2014\r\nWi-Fi (802.11a/b/g/n/ac)\r\nBluetooth 4.0 technology\r\n9.7-inch Retina display\r\n8-megapixel iSight camera\r\nFaceTime HD camera\r\n1080p HD video recording\r\nA8X chip with 64-bit architecture\r\nM8 motion coprocessor\r\n10-hour battery life\r\n', 1875, 3, 'images/Apple.jpg', 31, 40, 'פעיל'),
(123, ' Dell Inspiron 11 3000 3179-7Y304G54IT3Y', 'מחשב נייד מבית DELL בעל מסך מגע בגודל 11.6 אינטש, מעבד Intel® Core M3-7Y30 1.0 GHz - 2.60 GHz, זיכרון פנימי בנפח 4GB, כונן קשיח בנפח 500GB, כולל מערכת הפעלה\r\n יצרן:  Dell‏,  דגם:  Inspiron 11 3000 3179‏,  גודל:  11.6\'\'‏,  מעבד:  Intel Core m3‏,  מערכת הפעלה:  Windows 10 Home‏,', 2050, 2, 'images/b_52.jpg', 23, 30, 'פעיל'),
(124, ' Dell Inspiron 15 5000 5567-72004G54ABFY', 'מחשב נייד מבית Dell בעל מסך 15.6 אינטש ברזולוציית HD, מעבד Intel® Core i5-7200U 2.5GHz - 3.1GHz, זיכרון פנימי בנפח 4GB, כונן קשיח בנפח 500GB ומאיץ גרפי AMD Radeon R7 M445 2GB\r\n יצרן:  Dell‏,  דגם:  Inspiron 15 5000 5567‏,  גודל:  15.6\'\'‏,  מעבד:  Intel Core i5 - U‏,  מערכת הפעלה:  Windows 10 Home‏,', 2425, 2, 'images/b_19.jpg', 23, 50, 'פעיל'),
(125, 'Lenovo Y920-17', 'מחשב נייד מבית Lenovo בעל מסך 17.3 אינטש ברזולוציית FHD בטכנולוגיית G-Sync NVIDIA, מעבד Intel® Core i7-7820HK 2.9GHz - 3.9GHz, זיכרון פנימי בנפח 64GB, כונן קשיח בנפח 1TB, כונן SSD בנפח 512GB ומאיץ גרפי NVIDIA® GTX 1070 8GB\r\n יצרן:  Lenovo‏,  דגם:  IdeaPad Y920‏,  גודל:  17.3\'\'‏,  מעבד:  Intel Core i7 - HK‏,  מערכת הפעלה:  Windows 10 Home‏,', 215, 2, 'images/b_60.jpg', 21, 0, 'פעיל'),
(127, 'Lenovo 320-14 80XK00WRIV', 'מחשב נייד מבית Lenovo בעל מסך 14 אינטש, מעבד Intel® Core™ i5-7200U 2.5GHz - 3.1GHz, זיכרון פנימי בנפח 8GB, כונן SSD בנפח 256GB וכרטיס מסך NVIDIA® GeForce® 920MX 2GB ללא מערכת הפעלה\r\n יצרן:  Lenovo‏,  דגם:  IdeaPad 320‏,  גודל:  14.0\'\'‏,  מעבד:  Intel Core i5 - U‏,  מערכת הפעלה:  ללא מערכת הפעלה‏,', 2620, 2, 'images/b_51.jpg', 21, 0, 'פעיל'),
(128, 'HP ProBook 455', 'עם מעבד Intel® Core™ i המתקדם ביותר (כרטיס גרפי אופציונלי NVIDIA® GeForce™ MX150‎), זיכרון RAM של עד 16‎ GB ועד 10 שעות של חיי סוללה2, התכונן להתעלות על כל מה שניתן לבצע במחשב נייד.', 10450, 2, 'images/cHplap.png', 24, 30, 'פעיל'),
(139, 'ASUS Tower Desktop PC Intel Core i3 ', 'ASUS Computers K31cd-eh31 K31cd Tower Desktop PC Intel Core I3 Processor\r\nLarge 1TB 7200 HDD Storage capacity and latest 8GB DDR4 Memory for robust multitasking\r\nSmart Cooling System for quiet operation registering just 28dB upon idle\r\n24x DVD-RW, 802.11ac WiFi, Bluetooth 4.0, included chiclet keyboard, Windows 10\r\n', 1500, 1, 'images/Asus-Desk.jpg', 12, 30, 'פעיל'),
(140, 'ASUS G11CD Oculus Ready Gaming Computer ', 'G11CD is certified to support Oculus Rift headset giving you the best experiences on both Virtual Reality (VR) and PC gaming\r\nLatest 6th generation Intel Core i5-6400 Quad Core 2.7 GHz processor (Turbo Boost up to 3.3 GHz)\r\nFast performance with 8GB DDR4 (2133Mhz) memory and 1TB 7200RPM\r\nImmerse yourself in astounding visuals with NVIDIA GTX 970 4GB DDR5\r\n802.11 AC with Bluetooth 4.0 for faster web browsing, Windows 10 (64bit) OS', 3000, 1, 'images/AsusDESKTOP0.jpg', 12, 20, 'פעיל'),
(141, 'Lenovo ThinkCentre Mid-Tower Computer', ' Intel Core 2 DUO vPro 3.0GHz CPU\r\n4GB DDR3 Desktop Memory Package (standard)\r\n250GB Desktop HDD 3.5-Inch Internal Drive \r\n(standard)Windows 10 Pro 64 (standard) or Windows 7 Pro 64 (downgrade)\r\nFree Top Rated Anti-Virus Software, Adobe PDF Reader, Google Chrome Web Browser, Free Microsoft Compatible Office Suite, MS office Trial and other useful utilities and programs.', 900, 1, 'images/LenovoDesktop1.jpg', 11, 60, 'פעיל'),
(142, 'Lenovo ThinkStation P320 Tower ', 'Up to 7th Gen Intel® Core™ vPro i7-7700K Processor (8MB Cache, 3.60 GHz)\r\nUp Intel® Xeon® vPro E3-1245 v6 Processor (8MB Cache, 3.70GHz)\r\nWindows 10 Pro -  Lenovo recommends Windows 10 Pro\r\nUp to NVIDIA® Quadro® P4000 8GB\r\n3.5\" SATA 7200 rpm up to 2 TB\r\n2.5\" SATA SSD Up to 1 TB\r\nm.2 PCIe Opal SSD up to 1TB SDD *via pci-e add-in-card', 2500, 1, 'images/LenovoDesktop2.png', 11, 30, 'פעיל'),
(143, 'Lenovo ideacentre Y710 Cube', 'The Y710 Cube gives you the speed and power to play intense games while multitasking, yet it’s easy to carry and set up anywhere in your home, like a game console. Enjoy high-performance processing, sharp graphics, lag-free online gaming, and lightning-fast controls wherever you want to play. It can play the latest titles, with high frame rates up to 4K HD, and it packs plenty of memory for multitasking between games and other apps.', 3500, 1, 'images/LenovoDesktop3.png', 11, 30, 'פעיל'),
(144, 'DELL  Inspiron 5675 i5675-A128BLU-PUS', 'Ryzen 7 1700X (3.40 GHz) 8 GB DDR4 1 TB HDD \r\nAMD Radeon RX 570 Windows 10 Home 64-Bit\r\n', 4000, 1, 'images/DellCOMPdesk1.jpg', 13, 25, 'פעיל'),
(145, 'DELL  OptiPlex 3050', 'Intel Core i5 7th Gen 7500 (3.40 GHz) 8 GB DDR4 1 TB HDD Intel HD Graphics 630 Windows 10 Pro 64-Bit', 2200, 1, 'images/DellDK3.jpg', 13, 25, 'פעיל'),
(146, 'Dell XPS 8500 and Vostro 470 ', 'Dell India has added to its desktop lineup by unveiling the XPS 8500 and the Vostro 470 featuring Intel\'s latest Ivy Bridge processors.\r\nThe XPS 8500 is designed for users engaged in a lot of multimedia-oriented work like video editing, graphic designing, music composing and gaming as well. Users have the option to customise the desktop either with i5 or i7 Intel quad-core processor along with graphic cards options from AMD Radeon and NVIDIA, both with 1 GB of video-RAM.', 2600, 1, 'images/DellDKK.jpg', 13, 25, 'פעיל'),
(147, 'LG G PAD', '1.7GHz מעבד עוצמתי 4 ליבות במהירותמסך מגע ”8.3 FULL HD-IPSזיכרון גדול במיוחד 2GB RAM נפח איחסון 16GB (ניתן להרחבה עד 64GB)מצלמה 5 מגה פיקסל וסוללה 4600mAhמערכת הפעלה Android Jellybean v4.2.2 עם עדכוני תוכנה FOTA', 1300, 3, 'images/large05-G-PAD.jpg', 33, 30, 'פעיל');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `Customer_id` int(9) UNSIGNED NOT NULL,
  `Product_id` int(9) UNSIGNED NOT NULL,
  `Quantity` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`Customer_id`, `Product_id`, `Quantity`) VALUES
(444444444, 108, 1),
(444444444, 113, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_name` varchar(60) NOT NULL,
  `subcategory_id` int(30) NOT NULL,
  `category_id` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_name`, `subcategory_id`, `category_id`) VALUES
('Lenovo', 11, 1),
('Asus', 12, 1),
('Dell', 13, 1),
('Lenovo', 21, 2),
('Asus', 22, 2),
('Dell', 23, 2),
('Hp', 24, 2),
('Apple', 31, 3),
('Samsung', 32, 3),
('LG', 33, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Employee_id`);

--
-- Indexes for table `employee_order`
--
ALTER TABLE `employee_order`
  ADD PRIMARY KEY (`Order_id`,`Employee_id`),
  ADD KEY `Order_id` (`Order_id`),
  ADD KEY `Employee_id` (`Employee_id`);

--
-- Indexes for table `managercategories`
--
ALTER TABLE `managercategories`
  ADD PRIMARY KEY (`ManagerCategories_id`);

--
-- Indexes for table `managersubcategories`
--
ALTER TABLE `managersubcategories`
  ADD PRIMARY KEY (`ManagerSubCategories_id`),
  ADD KEY `ManagerCategories_id` (`ManagerCategories_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`Order_id`,`product_id`),
  ADD KEY `Order_id` (`Order_id`,`product_id`),
  ADD KEY `Order_id_2` (`Order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`Customer_id`,`Product_id`),
  ADD KEY `Customer_id` (`Customer_id`,`Product_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=777777778;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_order`
--
ALTER TABLE `employee_order`
  ADD CONSTRAINT `employee_order_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `order` (`Order_id`),
  ADD CONSTRAINT `employee_order_ibfk_2` FOREIGN KEY (`Employee_id`) REFERENCES `employees` (`Employee_id`);

--
-- Constraints for table `managersubcategories`
--
ALTER TABLE `managersubcategories`
  ADD CONSTRAINT `managersubcategories_ibfk_1` FOREIGN KEY (`ManagerCategories_id`) REFERENCES `managercategories` (`ManagerCategories_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`Customer_id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`Order_id`) REFERENCES `order` (`Order_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`);

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `shoppingcart_ibfk_2` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`Customer_id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
