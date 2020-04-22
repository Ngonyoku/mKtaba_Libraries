-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2020 at 10:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mKtaba_Libraries`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `middle_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books_bought`
--

CREATE TABLE `books_bought` (
  `id` int(14) NOT NULL,
  `book_id` int(12) NOT NULL,
  `date_bought` date NOT NULL,
  `amount_bought` int(10) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `book_edition_id` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `book_author_id` int(12) NOT NULL,
  `book_id` int(12) NOT NULL,
  `author_id` int(12) NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_details`
--

CREATE TABLE `book_details` (
  `book_id` int(12) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author_id_1` int(11) NOT NULL,
  `author_id_2` int(11) DEFAULT NULL,
  `author_id_3` int(11) DEFAULT NULL,
  `category_id` varchar(10) NOT NULL,
  `book_photo_url` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `book_edition`
--

CREATE TABLE `book_edition` (
  `book_edition_id` int(14) NOT NULL,
  `book_id` int(12) NOT NULL,
  `edition` varchar(30) NOT NULL,
  `year_published` year(4) NOT NULL,
  `ISBN` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `borrowers_id` int(12) NOT NULL,
  `book_id` int(12) NOT NULL,
  `member_number` varchar(14) NOT NULL,
  `date_borrowed` date NOT NULL,
  `deadline` date NOT NULL,
  `OverdueFee` decimal(10,2) NOT NULL,
  `data_returned` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_name` varchar(100) NOT NULL,
  `category_id` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_name`, `category_id`) VALUES
('Agriculture', 'S'),
('Auxilary Science of History', 'C'),
('Bibliography,Library Science', 'Z'),
('Education', 'L'),
('Fine Arts', 'N'),
('General Works', 'A'),
('Geography,Anthropology,Recreation', 'G'),
('History of  America', 'E'),
('Language and Literature', 'P'),
('Law', 'K'),
('Local History of America', 'F'),
('Medicine', 'R'),
('Miltary Science', 'U'),
('Music', 'M'),
('Naval Science', 'V'),
('Phylosophy,Psychology,Religion', 'B'),
('Political Science', 'J'),
('Science', 'Q'),
('Social Sciences', 'H'),
('Technogy', 'T'),
('Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `debtors`
--

CREATE TABLE `debtors` (
  `debtor_id` int(11) NOT NULL,
  `member_no` varchar(15) NOT NULL,
  `total_debt` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(15) NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `library_sections`
--

CREATE TABLE `library_sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(30) NOT NULL,
  `section_description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `member_number` varchar(15) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` int(15) NOT NULL,
  `groups` varchar(15) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `phone_number` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL,
  `publisher_name` varchar(50) NOT NULL,
  `location` varchar(30) NOT NULL,
  `phone_number` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `subcategory_id` char(5) NOT NULL,
  `subcategory_name` varchar(120) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`subcategory_id`, `subcategory_name`, `category_name`) VALUES
('AC', 'Collections', 'General Works'),
('AE', 'Encyclopedias', 'General Works'),
('AG', 'Dictionaries and other general reference works', 'General Works'),
('AI', 'Indexes', 'General Works'),
('AM', 'Museums. Collectors and collecting', 'General Works'),
('AN', 'Newspapers', 'General Works'),
('AP', 'Priodicals', 'General Works'),
('AS', ' Academies and learned societies', 'General Works'),
('AY', 'Yearbooks. Almanacs. Directories', 'General Works'),
('AZ', 'History of scholarship and learning. The humanities', 'General Works'),
('B', ' Philosophy (General)', 'Phylosophy,Psychology,Religion'),
('BC', 'Logic', 'Phylosophy,Psychology,Religion'),
('BD', 'Speculative philosophy', 'Phylosophy,Psychology,Religion'),
('BF', 'Psychology', 'Phylosophy,Psychology,Religion'),
('BH', 'Aesthetics', 'Phylosophy,Psychology,Religion'),
('BJ', 'Ethics', 'Phylosophy,Psychology,Religion'),
('BL', 'Religions. Mythology. Rationalism', 'Phylosophy,Psychology,Religion'),
('BM', 'Judaism', 'Phylosophy,Psychology,Religion'),
('BP', 'Islam. Bahaism. Theosophy, etc.', 'Phylosophy,Psychology,Religion'),
('BQ', 'Buddhism', 'Phylosophy,Psychology,Religion'),
('BR', 'Christianity', 'Phylosophy,Psychology,Religion'),
('BS', 'The Bible', 'Phylosophy,Psychology,Religion'),
('BT', 'Doctrinal theology', 'Phylosophy,Psychology,Religion'),
('BV', 'Practical Theology', 'Phylosophy,Psychology,Religion'),
('BX', 'Christian Denominations', 'Phylosophy,Psychology,Religion'),
('C', 'Auxiliary Sciences of History', 'Auxilary Science of History'),
('CB', 'History of Civilization', 'Auxilary Science of History'),
('CC', 'Archaeology', 'Auxilary Science of History'),
('CD', 'Diplomatics. Archives. Seals', 'Auxilary Science of History'),
('CE', 'Technical Chronology. Calendar', 'Auxilary Science of History'),
('CJ', 'Numismatics', 'Phylosophy,Psychology,Religion'),
('CN', 'Inscriptions. Epigraphy', 'Phylosophy,Psychology,Religion'),
('CR', 'Heraldry', 'Auxilary Science of History'),
('CS', 'Genealogy', 'Auxilary Science of History'),
('D', 'History (General)', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DA', 'Great Britain', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DAW', 'Central Europe', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DB', 'Austria â€“ Liechtenstein â€“ Hungary â€“ Czechoslovakia', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DC', 'France â€“ Andorra â€“ Monaco', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DD', 'Germany', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DE', 'Greco-Roman World', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DF', 'Greece', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DG', 'Italy â€“ Malta', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DH', 'Low Countries â€“ Benelux Countries', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DJ', 'Netherlands (Holland)', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DJK', 'Eastern Europe (General)', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DK', 'Russia. Soviet Union. Former Soviet Republics â€“ Poland', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DL', 'Northern Europe. Scandinavia', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DP', 'Spain â€“ Portugal', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DQ', 'Switzerland', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DR', 'Balkan Peninsula', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DS', 'Asia', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DT', 'Africa', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DU', 'Oceania (South Seas)', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('DX', 'Romanies', 'Wolrd History and History of Europe,Asia,Africa,Australia,New Zeeland,etc'),
('G', 'Geography (General). Atlases. Maps', 'Geography,Anthropology,Recreation'),
('GA', 'Mathematical geography. Cartography', 'Geography,Anthropology,Recreation'),
('GB', 'Physical geography', 'Geography,Anthropology,Recreation'),
('GC', 'Oceanography', 'Geography,Anthropology,Recreation'),
('GE', 'Environmental Sciences', 'Geography,Anthropology,Recreation'),
('GF', 'Human ecology. Anthropogeography', 'Geography,Anthropology,Recreation'),
('GN', 'Anthropology', 'Geography,Anthropology,Recreation'),
('GR', 'Folklore', 'Geography,Anthropology,Recreation'),
('GT', 'Manners and customs (General)', 'Geography,Anthropology,Recreation'),
('GV', 'Recreation. Leisure', 'Geography,Anthropology,Recreation'),
('H', 'Social sciences (General)', 'Social Sciences'),
('HA', 'Statistics', 'Social Sciences'),
('HB', 'Economic theory. Demography', 'Social Sciences'),
('HC', 'Economic history and conditions', 'Social Sciences'),
('HD', 'Industries. Land use. Labor', 'Social Sciences'),
('HE', 'Transportation and communications', 'Social Sciences'),
('HF', 'Commerce', 'Social Sciences'),
('HG', 'Finance', 'Social Sciences'),
('HJ', 'Public finance', 'Social Sciences'),
('HM', 'Sociology (General)', 'Social Sciences'),
('HN', 'Social history and conditions. Social problems. Social reform', 'Social Sciences'),
('HQ', 'The family. Marriage, Women and Sexuality', 'Social Sciences'),
('HS', 'Societies: secret, benevolent, etc.', 'Social Sciences'),
('HT', 'Communities. Classes. Races', 'Social Sciences'),
('HV', 'Social pathology. Social and public welfare. Criminology', 'Social Sciences'),
('HX', 'Socialism. Communism. Anarchism', 'Social Sciences'),
('J', 'General legislative and executive papers', 'Political Science'),
('JA', 'Political science (General)', 'Political Science'),
('JC', 'Political theory', 'Political Science'),
('JF', 'Political institutions and public administration', 'Political Science'),
('JJ', 'Political institutions and public administration (North America)', 'Political Science'),
('JK', 'Political institutions and public administration (United States)', 'Political Science'),
('JL', 'Political institutions and public administration (Canada, Latin America, etc.)', 'Political Science'),
('JN', 'Political institutions and public administration (Europe)', 'Political Science'),
('JQ', 'Political institutions and public administration (Asia, Africa, Australia, Pacific Area, etc.)', 'Political Science'),
('JS', 'Local government. Municipal government', 'Political Science'),
('JV', 'Colonies and colonization. Emigration and immigration. International migration', 'Political Science'),
('JX', 'International law, see JZ and KZ (obsolete)', 'Political Science'),
('JZ', 'International relations', 'Political Science'),
('K', 'Law in general. Comparative and uniform law. Jurisprudence', 'Law'),
('KB', 'Religious law in general. Comparative religious law. Jurisprudence', 'Law'),
('KBM', 'Jewish law', 'Law'),
('KBP', 'Islamic law', 'Law'),
('KBR', 'History of canon law', 'Law'),
('KBS', 'Canon law of Eastern churches', 'Law'),
('KBT', 'Canon law of Eastern Rite Churches in Communion with the Holy See of Rome', 'Law'),
('KBU', 'Law of the Roman Catholic Church. The Holy See', 'Law'),
('KD', 'United Kingdom and Ireland', 'Law'),
('KDK', 'United Kingdom and Ireland', 'Law'),
('KDZ', 'America. North America', 'Law'),
('KE', 'Canada', 'Law'),
('KF', 'United States', 'Law'),
('KG', 'Latin America â€“ Mexico and Central America â€“ West Indies. Caribbean area', 'Law'),
('KH', 'South America', 'Law'),
('KJ-KK', 'Europe', 'Law'),
('KL-KW', 'Asia and Eurasia, Africa, Pacific Area, and Antarctica', 'Law'),
('KU', 'Law of Australia and New Zealand', 'Law'),
('KUQ', 'Law of Australia and New Zealand', 'Law'),
('KZ', 'Law of nations', 'Law'),
('L', 'Education (General)', 'Education'),
('LA', 'History of education', 'Education'),
('LB', 'Theory and practice of education', 'Education'),
('LC', 'Special aspects of education', 'Education'),
('LD', 'Individual institutions â€“ United States', 'Education'),
('LE', 'Individual institutions â€“ America (except United States)', 'Education'),
('LF', 'Individual institutions â€“ Europe', 'Education'),
('LG', 'Individual institutions â€“ Asia, Africa, Indian Ocean islands, Australia, New Zealand, Pacific islands', 'Education'),
('LH', 'College and school magazines and papers', 'Education'),
('LJ', 'Student fraternities and societies, United States', 'Education'),
('LT', 'Textbooks', 'Education'),
('M', 'Music', 'Music'),
('ML', 'Literature on music', 'Music'),
('MT', 'Instruction and study', 'Music'),
('N', 'Visual arts', 'Fine Arts'),
('NA', 'Architecture', 'Fine Arts'),
('NB', 'Sculpture', 'Fine Arts'),
('NC', 'Drawing. Design. Illustration', 'Fine Arts'),
('ND', 'Painting', 'Fine Arts'),
('NE', 'Print media', 'Fine Arts'),
('NK', 'Decorative arts', 'Fine Arts'),
('NX', 'Arts in general', 'Fine Arts'),
('P', 'Philology. Linguistics', 'Language and Literature'),
('PA', 'Greek language and literature. Latin language and literature', 'Language and Literature'),
('PB', 'Modern languages. Celtic languages and literature', 'Language and Literature'),
('PC', 'Romanic languages', 'Language and Literature'),
('PD', 'Germanic languages. Scandinavian languages', 'Language and Literature'),
('PE', 'English language', 'Language and Literature'),
('PF', 'West Germanic languages', 'Language and Literature'),
('PG', 'Slavic languages and literatures. Baltic languages. Albanian language', 'Language and Literature'),
('PH', 'Uralic languages. Basque language', 'Language and Literature'),
('PJ', 'Oriental languages and literatures', 'Language and Literature'),
('PK', 'Indo-Iranian languages and literatures', 'Language and Literature'),
('PL', 'Languages and literatures of Eastern Asia, Africa, Oceania', 'Language and Literature'),
('PM', 'Hyperborean, Native American, and artificial languages', 'Language and Literature'),
('PN', 'Literature (General)', 'Language and Literature'),
('PQ', 'French literature â€“ Italian literature â€“ Spanish literature â€“ Portuguese literature', 'Language and Literature'),
('PR', 'English literature', 'Language and Literature'),
('PS', 'American literature', 'Language and Literature'),
('PT', 'German literature â€“ Dutch literature â€“ Flemish literature since 1830 â€“ Afrikaans literature -Scandinavian literatu', 'Language and Literature'),
('PZ', 'Fiction and juvenile belles lettres', 'Language and Literature'),
('Q', 'Science (General)', 'Science'),
('QA', 'Mathematics', 'Science'),
('QB', 'Astronomy', 'Science'),
('QC', 'Physics', 'Science'),
('QD', 'Chemistry', 'Science'),
('QE', 'Geology', 'Science'),
('QH', 'Natural history â€“ Biology', 'Science'),
('QK', 'Botany', 'Science'),
('QL', 'Zoology', 'Science'),
('QM', 'Human anatomy', 'Science'),
('QP', 'Physiology', 'Science'),
('QR', 'Microbiology', 'Science'),
('R', 'Medicine (General)', 'Medicine'),
('RA', 'Public aspects of medicine', 'Medicine'),
('RC', 'Internal medicine', 'Medicine'),
('RD', 'Surgery', 'Medicine'),
('RE', 'Ophthalmology', 'Medicine'),
('RF', 'Otorhinolaryngology', 'Medicine'),
('RG', 'Gynecology and Obstetrics', 'Medicine'),
('RJ', 'Pediatrics', 'Medicine'),
('RK', 'Dentistry', 'Medicine'),
('RL', 'Dermatology', 'Medicine'),
('RM', 'Therapeutics. Pharmacology', 'Medicine'),
('RS', 'Pharmacy and materia medica', 'Medicine'),
('RT', 'Nursing', 'Medicine'),
('RV', 'Botanic, Thomsonian, and Eclectic medicine', 'Medicine'),
('RX', 'Homeopathy', 'Medicine'),
('RZ', 'Other systems of medicine', 'Medicine'),
('S', 'Agriculture (General)', 'Agriculture'),
('SB', 'Horticulture. Plant propagation. Plant breeding', 'Agriculture'),
('SD', 'Forestry. Arboriculture. Silviculture', 'Agriculture'),
('SF', 'Animal husbandry. Animal science', 'Agriculture'),
('SH', 'Aquaculture. Fisheries. Angling', 'Agriculture'),
('SK', 'Hunting', 'Agriculture'),
('T', 'Technology (General)', 'Technogy'),
('TA', 'Engineering Civil engineering (General).', 'Technogy'),
('TC', 'Hydraulic engineering. Ocean engineering', 'Technogy'),
('TD', 'Environmental technology. Sanitary engineering', 'Technogy'),
('TE', 'Highway engineering. Roads and pavements', 'Technogy'),
('TF', 'Railroad engineering and operation', 'Technogy'),
('TG', 'Bridges', 'Technogy'),
('TH', 'Building construction', 'Technogy'),
('TJ', 'Mechanical engineering and machinery', 'Technogy'),
('TK', 'Electrical engineering. Electronics. Nuclear engineering', 'Technogy'),
('TL', 'Motor vehicles. Aeronautics. Astronautics', 'Technogy'),
('TN', 'Mining engineering. Metallurgy', 'Technogy'),
('TP', 'Chemical technology', 'Technogy'),
('TR', 'Photography', 'Technogy'),
('TS', 'Manufacturing engineering. Mass production', 'Technogy'),
('TT', 'Handicrafts. Arts and crafts', 'Technogy'),
('TX', 'Home economics', 'Technogy'),
('U', 'Military science (General)', 'Miltary Science'),
('UA', 'Armies: Organization, distribution, military situation', 'Miltary Science'),
('UB', 'Military administration', 'Miltary Science'),
('UC', 'Military maintenance and transportation', 'Miltary Science'),
('UD', 'Infantry', 'Miltary Science'),
('UE', 'Cavalry. Armor', 'Miltary Science'),
('UF', 'Artillery', 'Miltary Science'),
('UG', 'Military engineering. Air forces', 'Miltary Science'),
('UH', 'Other military services', 'Miltary Science'),
('V', 'Naval science (General)', 'Naval Science'),
('VA', 'Navies: Organization, distribution, naval situation', 'Naval Science'),
('VB', 'Naval administration', 'Naval Science'),
('VC', 'Naval maintenance', 'Naval Science'),
('VD', 'Naval seamen', 'Naval Science'),
('VE', 'Marines', 'Naval Science'),
('VF', 'Naval ordnance', 'Naval Science'),
('VG', 'Minor services of navies', 'Naval Science'),
('VK', 'Navigation. Merchant marine', 'Naval Science'),
('VM', 'Naval architecture. Shipbuilding. Marine engineering', 'Naval Science'),
('Z', 'Books (General). Writing. Paleography. Book industries and trade. Libraries. Bibliography', 'Bibliography,Library Science'),
('ZA', 'Information resources/materials', 'Bibliography,Library Science');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(15) NOT NULL,
  `location` varchar(20) NOT NULL,
  `phone_number` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `member_number` varchar(15) NOT NULL,
  `password` varchar(70) NOT NULL,
  `date_joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(30) NOT NULL,
  `value` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`);

--
-- Indexes for table `books_bought`
--
ALTER TABLE `books_bought`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `book_edition_id` (`book_edition_id`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`book_author_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `book_details`
--
ALTER TABLE `book_details`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `title` (`title`),
  ADD KEY `author_id_1` (`author_id_1`),
  ADD KEY `author_id_2` (`author_id_2`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `book_edition`
--
ALTER TABLE `book_edition`
  ADD PRIMARY KEY (`book_edition_id`),
  ADD UNIQUE KEY `ISBN_2` (`ISBN`),
  ADD KEY `year_published` (`year_published`),
  ADD KEY `edition` (`edition`),
  ADD KEY `ISBN` (`ISBN`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`borrowers_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `member_number` (`member_number`),
  ADD KEY `date_borrowed` (`date_borrowed`),
  ADD KEY `data_returned` (`data_returned`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_name` (`category_name`);

--
-- Indexes for table `debtors`
--
ALTER TABLE `debtors`
  ADD PRIMARY KEY (`debtor_id`),
  ADD KEY `member_no` (`member_no`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_name`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `library_sections`
--
ALTER TABLE `library_sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `section_name` (`section_name`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_number`),
  ADD UNIQUE KEY `member_id` (`member_id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `groups` (`groups`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`),
  ADD KEY `publisher_name` (`publisher_name`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_name` (`category_name`),
  ADD KEY `subcategory_name` (`subcategory_name`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `supplier_name` (`supplier_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`member_number`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `password` (`password`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `book_author_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_details`
--
ALTER TABLE `book_details`
  MODIFY `book_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_edition`
--
ALTER TABLE `book_edition`
  MODIFY `book_edition_id` int(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `borrowers_id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debtors`
--
ALTER TABLE `debtors`
  MODIFY `debtor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_sections`
--
ALTER TABLE `library_sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books_bought`
--
ALTER TABLE `books_bought`
  ADD CONSTRAINT `books_bought_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book_details` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_bought_ibfk_2` FOREIGN KEY (`book_edition_id`) REFERENCES `book_edition` (`book_edition_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book_details` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_details`
--
ALTER TABLE `book_details`
  ADD CONSTRAINT `book_details_ibfk_1` FOREIGN KEY (`author_id_1`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_details_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_details_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `publishers` (`publisher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_details_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `library_sections` (`section_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `book_edition`
--
ALTER TABLE `book_edition`
  ADD CONSTRAINT `book_edition_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book_details` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD CONSTRAINT `borrowers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book_details` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowers_ibfk_2` FOREIGN KEY (`member_number`) REFERENCES `members` (`member_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `debtors`
--
ALTER TABLE `debtors`
  ADD CONSTRAINT `debtors_ibfk_1` FOREIGN KEY (`member_no`) REFERENCES `members` (`member_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`groups`) REFERENCES `groups` (`group_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_name`) REFERENCES `category` (`category_name`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users_session`
--
ALTER TABLE `users_session`
  ADD CONSTRAINT `users_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
