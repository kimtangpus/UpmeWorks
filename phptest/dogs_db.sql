-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 10:24 AM
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
-- Database: `dogs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogbreeds`
--

CREATE TABLE `dogbreeds` (
  `breedID` int(11) NOT NULL,
  `breedName` varchar(50) NOT NULL,
  `sizeID` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `backgroundColor` varchar(7) DEFAULT NULL,
  `shortDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dogbreeds`
--

INSERT INTO `dogbreeds` (`breedID`, `breedName`, `sizeID`, `description`, `image`, `backgroundColor`, `shortDescription`) VALUES
(1, 'Chihuahua', 1, 'Small breed known for its tiny size and big personality.', 'pic/chihuahua.jpg', '#0078D0', 'Chihuahuas may be small, but their personalities are larger than life. Known for their loyalty and big attitudes, they are perfect companions for those who can provide them with plenty of attention and love. Their feisty nature and love for cuddling make them a perfect lapdog.'),
(2, 'Pomeranian', 1, 'Fluffy and small, Pomeranians are playful and lively.', 'pic/pomeranian.jpg', '#0078D0', 'Pomeranians are energetic, fluffy little balls of joy. With their stunning coats and playful demeanor, they love to be the center of attention. Though small in size, they have bold personalities and are known for being affectionate, confident, and alert.'),
(3, 'Yorkshire Terrier', 1, 'Tiny terrier with a lot of energy and a bold personality.', 'pic/yorkie.jpg', '#0078D0', 'Yorkshire Terriers, or Yorkies, are small yet courageous and full of personality. They have a sleek, silky coat and are often described as having a terrier spirit—feisty, loyal, and always up for an adventure. Despite their tiny size, they’re big on personality and can be quite protective.'),
(4, 'Shih Tzu', 1, 'Small, friendly, and a favorite for companionship.', 'pic/shihtzu.jpg', '#0078D0', 'Shih Tzus are charming and affectionate little dogs with a long, flowing coat and a sweet temperament. Originally bred as lapdogs for Chinese royalty, they’re friendly, confident, and enjoy being pampered, making them excellent companions for families and individuals alike.'),
(5, 'Beagle', 2, 'Friendly and curious breed, known for its excellent sense of smell.', 'pic/beagle.jpg', '#0078D0', 'Beagles are curious, merry, and affectionate dogs known for their love of exploration. With their keen sense of smell, they make excellent hunters, but they’re also friendly and great with children. They thrive in active homes and enjoy lots of outdoor play.'),
(6, 'Bulldog', 2, 'Muscular and medium-sized, known for their loose, wrinkled skin.', 'pic/bulldog.jpg', '#0078D0', 'Bulldogs are known for their muscular build and relaxed attitude. They are sweet-natured, loyal, and calm, making them ideal companions for families and individuals who prefer a low-energy pet. Despite their gruff appearance, Bulldogs are affectionate and love lounging with their owners.'),
(7, 'Cocker Spaniel', 2, 'Affectionate breed with soft ears and a compact, medium build.', 'pic/CockerSpaniel.jpg', '#0078D0', 'Cocker Spaniels are gentle and loving dogs with an affectionate nature. They’re known for their beautiful, flowing coats and their joyful, playful personalities. They thrive in active homes and are great companions for children, always eager to participate in family activities.'),
(8, 'Border Collie', 2, 'Intelligent and energetic, often used as a herding dog.', 'pic/Bordercollie.jpg', '#0078D0', 'Border Collies are highly intelligent, energetic, and work-driven dogs. Often considered one of the smartest dog breeds, they excel in agility and herding tasks. With their boundless energy, they require plenty of mental and physical stimulation, making them ideal for active families or individuals.'),
(9, 'German Shepherd', 3, 'Highly intelligent and versatile working dog, often used in police and military work.', 'pic/german.jpg', '#0078D0', 'German Shepherds are noble, loyal, and protective dogs. Known for their intelligence and versatility, they excel in various roles such as police, military, and service work. They’re deeply devoted to their families, making them excellent guard dogs as well as affectionate companions.'),
(10, 'Golden Retriever', 3, 'Large, friendly breed known for their loyalty and intelligence.', 'pic/golden.jpg', '#0078D0', 'Golden Retrievers are friendly, loyal, and trustworthy dogs with an easygoing temperament. Known for their intelligence and eagerness to please, they make excellent family pets and therapy dogs. Their loving nature and playful demeanor make them great companions for active households.'),
(11, 'Great Dane', 3, 'Giant breed with a gentle and friendly temperament.', 'pic/greatdane.jpg', '#0078D0', 'Great Danes are gentle giants known for their impressive size and sweet nature. Despite their towering presence, they’re affectionate, calm, and excellent with children. They enjoy spending time with their family and thrive in spacious homes where they can stretch out comfortably.'),
(12, 'Rottweiler', 3, 'Large, powerful breed often used as guard dogs, with a confident personality.', 'pic/rottie.jpg', '#0078D0', 'Rottweilers are powerful, confident, and protective dogs. They are fiercely loyal to their families and excel at guarding and protecting. With proper training and socialization, they make great family pets, balancing their protective instincts with a loving and loyal nature.'),
(29, '', 0, '', NULL, NULL, ''),
(31, '', 0, '', NULL, NULL, ''),
(33, '', 0, '', NULL, NULL, ''),
(44, '', 0, '', NULL, NULL, ''),
(46, '', 0, '', NULL, NULL, ''),
(48, '', 0, '', NULL, NULL, ''),
(51, '', 0, '', NULL, NULL, ''),
(52, '', 0, '', NULL, NULL, ''),
(54, '', 0, '', NULL, NULL, ''),
(56, '', 0, '', NULL, NULL, ''),
(57, '', 0, '', NULL, NULL, ''),
(59, '', 0, '', NULL, NULL, ''),
(61, '', 0, '', NULL, NULL, ''),
(63, '', 0, '', NULL, NULL, ''),
(64, 'German Shepherd', 0, 'Highly intelligent and versatile working dog, often used in police and military work.', NULL, NULL, 'German Shepherds are noble, loyal, and protective dogs. Known for their intelligence and versatility, they excel in various roles such as police, military, and service work. They’re deeply devoted to their families, making them excellent guard dogs as well as affectionate companions.'),
(65, 'German Shepherd', 0, 'Highly intelligent and versatile working dog, often used in police and military work.', NULL, NULL, 'German Shepherds are noble, loyal, and protective dogs. Known for their intelligence and versatility, they excel in various roles such as police, military, and service work. They’re deeply devoted to their families, making them excellent guard dogs as well as affectionate companions.'),
(67, '', 0, '', NULL, NULL, ''),
(69, '', 0, '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `dogsize`
--

CREATE TABLE `dogsize` (
  `sizeID` int(11) NOT NULL,
  `sizeName` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dogsize`
--

INSERT INTO `dogsize` (`sizeID`, `sizeName`, `description`) VALUES
(1, 'Small', 'Dogs weighing less than 20 lbs'),
(2, 'Medium', 'Dogs weighing between 20 and 50 lbs'),
(3, 'Large', 'Dogs weighing over 50 lbs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogbreeds`
--
ALTER TABLE `dogbreeds`
  ADD PRIMARY KEY (`breedID`),
  ADD KEY `sizeID` (`sizeID`);

--
-- Indexes for table `dogsize`
--
ALTER TABLE `dogsize`
  ADD PRIMARY KEY (`sizeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogbreeds`
--
ALTER TABLE `dogbreeds`
  MODIFY `breedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `dogsize`
--
ALTER TABLE `dogsize`
  MODIFY `sizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
