-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: adlertz.se.mysql.service.one.com:3306
-- Tid vid skapande: 10 nov 2024 kl 00:56
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
(1, 'History', 110),
(2, 'Programming', 11),
(3, 'Religion', 200),
(4, 'Computer Network', 12),
(5, 'IT Security', 10),
(6, 'Web Design', 13),
(7, 'Nature', 100);

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
(10, 'Virtual Programming using modern languages', 'ISBN: 978-1-98765-432-2\r\nAuthor: Jordan Smith\r\n\r\n“Virtual Programming Using Modern Languages” by Jordan Smith is an essential guide for navigating the ever-evolving landscape of software development. This book delves into the latest programming languages such as Python, JavaScript, and Rust, highlighting their unique features and applications. Smith also explores leading software architectures, including microservices and serverless computing, which are revolutionizing how developers build and deploy applications. With practical examples and expert insights, “Virtual Programming Using Modern Languages” equips readers with the knowledge to leverage cutting-edge technologies and design robust, scalable systems for the future.', 99.99, 2),
(11, 'Shadows in the Firewall', 'ISBN: 978-1-98765-432-3 By Alex Mercer. This gripping novel explores the world of cybersecurity through the eyes of a hacker turned whistleblower. As he uncovers a conspiracy that threatens national security, he must navigate a web of deception and danger, revealing the dark side of the digital age.', 29.99, 5),
(12, 'The Last Line of Defense', 'ISBN: 978-1-98765-432-4 By Jamie Lin. In a future where cyber warfare is the norm, a team of elite security experts must protect their city from a devastating attack. With time running out, they race against hackers and rogue agents to secure the digital landscape.', 34.99, 5),
(13, 'Encrypted Secrets', 'ISBN: 978-1-98765-432-5 By Morgan Steele. This thrilling tale follows a cybersecurity analyst who stumbles upon a hidden code that could change everything. As she delves deeper, she uncovers a plot that could compromise the world’s most secure networks.', 24.99, 5),
(14, 'Phantom Protocols', 'ISBN: 978-1-98765-432-6 By Riley Quinn. A fast-paced adventure that takes readers into the heart of corporate espionage. When a tech giant’s secrets are leaked, a young programmer must use her skills to uncover the truth and protect her company from ruin.', 27.99, 5),
(15, 'Code Breakers', 'ISBN: 978-1-98765-432-7 By Samira Patel. This engaging guide takes readers through the fundamentals of programming, using real-world examples and hands-on projects. Perfect for beginners, it demystifies coding concepts and empowers readers to create their own applications.', 29.99, 2),
(16, 'The Algorithmic Mind', 'ISBN: 978-1-98765-432-8 By Leo Chen. Dive into the world of algorithms with this insightful book that combines theory and practice. Readers will learn how to design efficient algorithms and apply them to solve complex problems in various programming languages.', 34.99, 2),
(17, 'Debugging the Future', 'ISBN: 978-1-98765-432-9 By Jamie Torres. A thrilling narrative that follows a young programmer as she uncovers a conspiracy hidden within a popular software. This book blends storytelling with programming principles, making it both entertaining and educational.', 24.99, 2),
(18, 'Mastering Python', 'ISBN: 978-1-98765-433-0 By Alex Rivera. This comprehensive guide offers an in-depth look at Python programming, covering everything from basic syntax to advanced techniques. With practical exercises and projects, readers will gain the skills needed to excel in the tech industry.', 39.99, 2),
(19, 'Building Web Applications', 'ISBN: 978-1-98765-433-1 By Morgan Lee. This book provides a step-by-step approach to creating dynamic web applications. Covering essential technologies like HTML, CSS, and JavaScript, it equips readers with the tools to bring their ideas to life online.', 27.99, 2),
(20, 'Networking Essentials', 'ISBN: 978-1-98765-433-2 By Alex Johnson. This comprehensive guide covers the fundamental concepts of computer networking, including protocols, architectures, and security measures. Ideal for beginners, it provides practical examples and exercises to solidify understanding.', 29.99, 4),
(21, 'The Network Architect', 'ISBN: 978-1-98765-433-3 By Jamie Lee. Dive into the world of network design with this insightful book that explores the principles of creating robust and scalable networks. Readers will learn about the latest technologies and best practices in network architecture.', 34.99, 4),
(22, 'Securing the Network', 'ISBN: 978-1-98765-433-4 By Morgan Smith. This essential read focuses on the critical aspects of network security. It covers various threats and vulnerabilities, offering strategies to protect networks from cyber attacks and ensure data integrity.', 24.99, 4),
(23, 'Wireless Wonders', 'ISBN: 978-1-98765-433-5 By Riley Chen. Explore the fascinating realm of wireless networking in this engaging book. From Wi-Fi to Bluetooth, it explains the technologies behind wireless communication and their applications in modern networking.', 27.99, 4),
(24, 'Advanced Networking Techniques', 'ISBN: 978-1-98765-433-6 By Samira Patel. This book delves into advanced topics in networking, including virtualization, cloud networking, and software-defined networks. It’s perfect for professionals looking to enhance their skills and knowledge.', 39.99, 4),
(25, 'The Future of Networking', 'ISBN: 978-1-98765-433-7 By Leo Torres. A forward-looking exploration of emerging trends in computer networking, this book discusses the impact of AI, IoT, and 5G on the future landscape of connectivity and communication.', 32.99, 4),
(26, 'The Art of Web Design', 'ISBN: 978-1-98765-433-8 By Emma Carter. This book explores the principles of effective web design, focusing on aesthetics, usability, and user experience. With practical tips and case studies, it guides readers through creating visually appealing and functional websites.', 29.99, 6),
(27, 'Responsive Web Design Made Easy', 'ISBN: 978-1-98765-433-9 By Liam Johnson. A comprehensive guide to mastering responsive web design, this book covers techniques for creating websites that look great on any device. It includes step-by-step tutorials and best practices for modern web development.', 34.99, 6),
(28, 'Web Design for Everyone', 'ISBN: 978-1-98765-434-0 By Ava Smith. This accessible book introduces web design concepts to beginners. It breaks down complex topics into easy-to-understand sections, making it perfect for anyone looking to build their first website.', 24.99, 6),
(29, 'Mastering CSS: The Complete Guide', 'ISBN: 978-1-98765-434-1 By Noah Lee. Dive deep into CSS with this detailed guide that covers everything from basic styling to advanced layout techniques. With practical examples, readers will learn how to create stunning web designs.', 39.99, 6),
(30, 'User Experience Design: A Practical Approach', 'ISBN: 978-1-98765-434-2 By Mia Brown. This book emphasizes the importance of user experience in web design. It provides actionable insights and methodologies to enhance usability and create user-centered websites.', 27.99, 6),
(31, 'The Future of Web Design', 'ISBN: 978-1-98765-434-3 By Oliver Davis. A forward-thinking exploration of emerging trends in web design, this book discusses the impact of AI, VR, and new technologies on the future of web development and design practices.', 32.99, 6),
(32, 'Echoes of the Past', 'ISBN: 978-1-98765-434-4 By Clara Thompson. This captivating exploration of ancient civilizations delves into their cultures, achievements, and mysteries. From the pyramids of Egypt to the ruins of Rome, readers will uncover the stories that shaped our world.', 29.99, 1),
(33, 'The Age of Empires', 'ISBN: 978-1-98765-434-5 By Daniel Reed. This book examines the rise and fall of the great empires throughout history. It analyzes the political, economic, and social factors that led to their dominance and eventual decline, offering insights into their legacies.', 34.99, 1),
(34, 'Revolutionary Voices', 'ISBN: 978-1-98765-434-6 By Sarah Mitchell. A compelling narrative that highlights the key figures and events of major revolutions around the globe. From the American Revolution to the French and beyond, this book brings history to life through personal stories.', 24.99, 1),
(35, 'War and Peace: A Historical Perspective', 'ISBN: 978-1-98765-434-7 By James Carter. This insightful book explores the impact of war on societies throughout history. It discusses the causes, consequences, and the quest for peace, providing a comprehensive view of humanity’s struggles.', 39.99, 1),
(36, 'The Forgotten Histories', 'ISBN: 978-1-98765-434-8 By Emily Johnson. This intriguing work uncovers lesser-known events and figures that played significant roles in shaping history. Readers will discover fascinating stories that have been overshadowed by more prominent narratives.', 27.99, 1),
(37, 'Chronicles of Change', 'ISBN: 978-1-98765-434-9 By Oliver Grant. A detailed examination of pivotal moments in history that led to significant societal transformations. This book analyzes how these changes have influenced modern life and our understanding of progress.', 32.99, 1),
(38, 'Whispers of the Wild', 'ISBN: 978-1-98765-435-0 By Clara Woods. This enchanting book takes readers on a journey through the world’s most breathtaking natural landscapes. From lush forests to arid deserts, it explores the beauty and diversity of nature, inspiring a deeper appreciation for our planet.', 29.99, 7),
(39, 'The Secrets of Ecosystems', 'ISBN: 978-1-98765-435-1 By Liam Rivers. Delve into the intricate relationships within ecosystems in this informative guide. It uncovers the delicate balance of life, highlighting the importance of biodiversity and conservation efforts to protect our environment.', 34.99, 7),
(40, 'Nature’s Symphony', 'ISBN: 978-1-98765-435-2 By Ava Green. This beautifully illustrated book celebrates the sounds of nature, from the rustling of leaves to the songs of birds. It explores how these sounds impact our well-being and the environment, encouraging mindfulness and connection to the natural world.', 24.99, 7),
(41, 'The Changing Climate', 'ISBN: 978-1-98765-435-3 By Noah Brooks. A critical examination of climate change and its effects on our planet. This book provides insights into the science behind climate change, its impact on ecosystems, and what we can do to mitigate its effects for future generations.', 39.99, 7),
(42, 'Flora and Fauna: A Visual Guide', 'ISBN: 978-1-98765-435-4 By Mia Stone. This comprehensive guide showcases the incredible diversity of plant and animal life across various habitats. With stunning photography and detailed descriptions, it serves as an essential resource for nature enthusiasts and students alike.', 27.99, 7);

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
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
