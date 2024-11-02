-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: adlertz.se.mysql.service.one.com:3306
-- Tid vid skapande: 02 nov 2024 kl 07:00
-- Serverversion: 10.6.18-MariaDB-ubu2204
-- PHP-version: 7.4.3-4ubuntu2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `adlertz_se`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryNavOrder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `CATEGORY`
--

INSERT INTO `CATEGORY` (`CategoryID`, `CategoryName`, `CategoryNavOrder`) VALUES
(1, 'History', 1),
(2, 'Programming', 4),
(3, 'Religion', 2),
(4, 'Network', 5),
(5, 'IT Security', 6),
(6, 'Web Design', 7),
(7, 'Nature', 3);

-- --------------------------------------------------------

--
-- Tabellstruktur `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `CustomerID` int(11) NOT NULL,
  `CustomerFirstName` varchar(50) DEFAULT NULL,
  `CustomerLastName` varchar(50) DEFAULT NULL,
  `CustomerAddress` varchar(100) DEFAULT NULL,
  `CustomerPostCode` varchar(10) DEFAULT NULL,
  `CustomerCity` varchar(100) DEFAULT NULL,
  `CustomerEmail` varchar(100) DEFAULT NULL,
  `CustomerPhone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`CustomerID`, `CustomerFirstName`, `CustomerLastName`, `CustomerAddress`, `CustomerPostCode`, `CustomerCity`, `CustomerEmail`, `CustomerPhone`) VALUES
(1, 'Anna', 'Svensson', 'Storgatan 1', '12345', 'Stockholm', 'anna.svensson@example.com', '070-123 45 67'),
(2, 'Erik', 'Johansson', 'Lillgatan 2', '23456', 'Stockholm', 'erik.johansson@example.com', '070-234 56 78'),
(3, 'Maria', 'Karlsson', 'Huvudgatan 3', '34567', 'Stockholm', 'maria.karlsson@example.com', '070-345 67 89'),
(4, 'Johan', 'Andersson', 'Köpgatan 4', '45678', 'Stockholm', 'johan.andersson@example.com', '070-456 78 90'),
(5, 'Sara', 'Nilsson', 'Brogatan 5', '56789', 'Stockholm', 'sara.nilsson@example.com', '070-567 89 01'),
(6, 'Lars', 'Pettersson', 'Vägggatan 6', '67890', 'Stockholm', 'lars.pettersson@example.com', '070-678 90 12'),
(7, 'Karin', 'Olofsson', 'Skolgatan 7', '78901', 'Stockholm', 'karin.olofsson@example.com', '070-789 01 23'),
(8, 'Mikael', 'Lindström', 'Parkgatan 8', '89012', 'Stockholm', 'mikael.lindstrom@example.com', '070-890 12 34'),
(9, 'Elin', 'Bergström', 'Fabriksgatan 9', '90123', 'Stockholm', 'elin.bergstrom@example.com', '070-901 23 45'),
(10, 'Fredrik', 'Hansson', 'Torggatan 10', '01234', 'Stockholm', 'fredrik.hansson@example.com', '070-012 34 56'),
(11, 'Sofia', 'Gustafsson', 'Västra Gatan 11', '12345', 'Stockholm', 'sofia.gustafsson@example.com', '070-123 45 67'),
(12, 'David', 'Sjöberg', 'Östra Gatan 12', '23456', 'Stockholm', 'david.sjoberg@example.com', '070-234 56 78'),
(13, 'Nina', 'Lindqvist', 'Norra Gatan 13', '34567', 'Stockholm', 'nina.lindqvist@example.com', '070-345 67 89'),
(14, 'Patrik', 'Mårtensson', 'Södra Gatan 14', '45678', 'Stockholm', 'patrik.martensson@example.com', '070-456 78 90'),
(15, 'Julia', 'Fransson', 'Kyrkogatan 15', '56789', 'Stockholm', 'julia.fransson@example.com', '070-567 89 01'),
(16, 'Simon', 'Eklund', 'Industrigatan 16', '67890', 'Stockholm', 'simon.eklund@example.com', '070-678 90 12'),
(17, 'Emma', 'Hedlund', 'Skärgårdsgatan 17', '78901', 'Stockholm', 'emma.hedlund@example.com', '070-789 01 23'),
(18, 'Oscar', 'Berg', 'Havsgatan 18', '89012', 'Stockholm', 'oscar.berg@example.com', '070-890 12 34'),
(19, 'Tina', 'Lund', 'Fjällgatan 19', '90123', 'Stockholm', 'tina.lund@example.com', '070-901 23 45'),
(20, 'Jonas', 'Sundström', 'Bergsgatan 20', '01234', 'Stockholm', 'jonas.sundstrom@example.com', '070-012 34 56'),
(21, 'Linda', 'Wikström', 'Vintergatan 21', '12345', 'Stockholm', 'linda.wikstrom@example.com', '070-123 45 67'),
(22, 'Daniel', 'Kjellström', 'Sommarvägen 22', '23456', 'Stockholm', 'daniel.kjellstrom@example.com', '070-234 56 78'),
(23, 'Cecilia', 'Lindgren', 'Vårgatan 23', '34567', 'Stockholm', 'cecilia.lindgren@example.com', '070-345 67 89'),
(24, 'Henrik', 'Sundqvist', 'Höstgatan 24', '45678', 'Stockholm', 'henrik.sundqvist@example.com', '070-456 78 90'),
(25, 'Maja', 'Forsberg', 'Regnvägen 25', '56789', 'Stockholm', 'maja.forsberg@example.com', '070-567 89 01'),
(26, 'Alfred', 'Ström', 'Snövägen 26', '67890', 'Stockholm', 'alfred.strom@example.com', '070-678 90 12'),
(27, 'Signe', 'Björk', 'Vindgatan 27', '78901', 'Stockholm', 'signe.bjork@example.com', '070-789 01 23'),
(28, 'Filip', 'Lundgren', 'Kustgatan 28', '89012', 'Stockholm', 'filip.lundgren@example.com', '070-890 12 34'),
(29, 'Nellie', 'Håkansson', 'Ängsgatan 29', '90123', 'Stockholm', 'nellie.hakansson@example.com', '070-901 23 45');

-- --------------------------------------------------------

--
-- Tabellstruktur `PRODUCT`
--

CREATE TABLE `PRODUCT` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `ProductDescription` text DEFAULT NULL,
  `ProductPrice` decimal(10,2) DEFAULT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `PRODUCT`
--

INSERT INTO `PRODUCT` (`ProductID`, `ProductName`, `ProductDescription`, `ProductPrice`, `CategoryID`) VALUES
(1, 'Tree of Wisdom', 'ISBN: 978-1-23456-789-1\r\nAuthor: Eleanor Green\r\n\r\n\r\nIn “Tree of Wisdoms,” Eleanor Green explores the majestic oaks of Western Europe, revered for their strength and longevity. These ancient trees can be found in diverse landscapes, from the rolling hills of England to the dense forests of Germany and the sunlit groves of Spain. Green delves into the ecological significance of oaks, highlighting their role in supporting wildlife and maintaining biodiversity. With vivid descriptions and insightful anecdotes, “Tree of Wisdoms” offers readers a deep appreciation for these iconic trees and their enduring presence in the European landscape.', 19.99, 7),
(2, 'Angels Among Us by Sarah Lightwood', 'ISBN: 978-1-23456-789-0\r\nDive into the celestial realm with “Angels Among Us,” a captivating exploration of angelic beings and their divine missions. This book unveils the mysteries of angels, their roles as messengers of God, and their interactions with humanity. Perfect for those seeking spiritual enlightenment and a deeper connection with the divine.', 99.99, 3),
(3, 'The Holy Spirit: Breath of Life by Michael Rivers', 'ISBN: 978-1-23456-789-1\r\nDiscover the transformative power of the Holy Spirit in “The Holy Spirit: Breath of Life.” This inspiring book delves into the essence of the Holy Spirit, its presence in our lives, and its role in guiding and empowering believers. A must-read for anyone yearning for spiritual growth and renewal. ISBN: 978-1-23456-789-1', 39.99, 3),
(4, 'God’s Divine Plan by Rebecca Grace', 'ISBN: 978-1-23456-789-2\r\n“God’s Divine Plan” offers a profound journey into understanding God’s purpose for humanity. Through insightful teachings and biblical references, this book reveals how God’s love and wisdom shape our lives. Ideal for readers seeking to deepen their faith and comprehend the divine blueprint.', 49.99, 3),
(5, 'Heavenly Messengers by Daniel Hope', 'ISBN: 978-1-23456-789-3\r\n“Heavenly Messengers” takes you on a spiritual adventure, exploring the fascinating world of angels. Learn about their origins, duties, and the ways they communicate God’s will to us. This book is perfect for those curious about the unseen forces that guide and protect us.', 59.99, 3),
(6, 'The Trinity Explained by Laura Faith', 'ISBN: 978-1-23456-789-4\r\nUnravel the mystery of the Holy Trinity with “The Trinity Explained.” This enlightening book breaks down the complex concept of God as Father, Son, and Holy Spirit, offering clear and accessible explanations. A valuable resource for anyone looking to understand the foundation of Christian belief.', 99.99, 3),
(7, 'Angelic Encounters by Jonathan Wells', 'ISBN: 978-1-23456-789-5\r\n“Angelic Encounters” shares awe-inspiring stories of individuals who have experienced the presence of angels in their lives. These true accounts provide hope, comfort, and a deeper appreciation for the divine guardians watching over us. Perfect for readers seeking inspiration and reassurance.', 79.99, 3),
(8, 'Smart Cities: The Backbone of IT Innovation', 'ISBN: 978-1-23456-789-0\r\nAuthor: Alex Thompson\r\n\r\nIn “Smart Cities: The Backbone of IT Innovation,” Alex Thompson delves into the complexities of IT security in bustling metropolises. The book explores the unique challenges faced by large cities, from safeguarding critical infrastructure to protecting personal data amidst a sea of digital threats. Thompson provides practical strategies for urban IT professionals, emphasizing the importance of proactive measures and robust security frameworks. With real-world case studies and expert insights, “Smart Cities: The Backbone of IT Innovation” is an essential read for anyone involved in the cybersecurity landscape of major cities.', 89.99, 5),
(9, 'Digital Foundations: Building the Future of IT Infrastructure', 'ISBN: 978-1-98765-432-1\r\nAuthor: Jamie Lee\r\n\r\n“Digital Foundations: Building the Future of IT Infrastructure” by Jamie Lee offers a comprehensive guide to IT security in large urban environments. Lee examines the intricate web of networks that keep a city running and the vulnerabilities that come with them. The book covers a range of topics, including cybercrime prevention, incident response, and the role of government in maintaining digital safety. Through detailed analysis and actionable advice, Lee equips readers with the knowledge to fortify their city’s digital defenses against ever-evolving cyber threats.', 99.99, 5),
(10, 'Virtual Programming using modern languages', 'ISBN: 978-1-98765-432-2\r\nAuthor: Jordan Smith\r\n\r\n“Virtual Programming Using Modern Languages” by Jordan Smith is an essential guide for navigating the ever-evolving landscape of software development. This book delves into the latest programming languages such as Python, JavaScript, and Rust, highlighting their unique features and applications. Smith also explores leading software architectures, including microservices and serverless computing, which are revolutionizing how developers build and deploy applications. With practical examples and expert insights, “Virtual Programming Using Modern Languages” equips readers with the knowledge to leverage cutting-edge technologies and design robust, scalable systems for the future.', 99.99, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `View`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`adlertz_se`@`%` SQL SECURITY DEFINER VIEW `View`  AS SELECT `adlertz_se`.`Persons`.`PersonID` AS `PersonID`, `adlertz_se`.`Persons`.`LastName` AS `LastName`, `adlertz_se`.`Persons`.`FirstName` AS `FirstName`, `adlertz_se`.`Persons`.`Age` AS `Age`, `adlertz_se`.`Persons`.`Mail` AS `Mail` FROM `Persons` WHERE `adlertz_se`.`Persons`.`FirstName` = 'Stefan' ;
-- Error reading data for table adlertz_se.View: #1064 - Du har något fel i din syntax nära 'FROM `adlertz_se`.`View`' på rad 1

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Index för tabell `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Index för tabell `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_Category` (`CategoryID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT för tabell `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT för tabell `PRODUCT`
--
ALTER TABLE `PRODUCT`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD CONSTRAINT `FK_Category` FOREIGN KEY (`CategoryID`) REFERENCES `CATEGORY` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
