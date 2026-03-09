-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql-container
-- Generation Time: Mar 09, 2026 at 11:31 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publisher_id` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `description` text,
  `cover_filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publisher_id`, `year`, `isbn`, `description`, `cover_filename`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', 2, 1960, '978-0061120084', 'A gripping tale of racial injustice and childhood innocence in the American South.', 'mockingbird.jpg'),
(2, '1984', 'George Orwell', 1, 1949, '978-0451524935', 'A dystopian novel about totalitarianism and surveillance.', '1984.jpg'),
(3, 'Pride and Prejudice', 'Jane Austen', 1, 1813, '978-0141439518', 'A romantic novel about the Bennet family and the proud Mr. Darcy.', 'pride-prejudice.jpg'),
(4, 'The Great Gatsby', 'F. Scott Fitzgerald', 3, 1925, '978-0743273565', 'A story of decadence and excess in Jazz Age America.', 'gatsby.jpg'),
(5, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 6, 1997, '978-0747532743', 'The first book in the beloved Harry Potter series.', 'hp-stone.jpg'),
(6, 'Learning PHP, MySQL & JavaScript', 'Robin Nixon', 7, 2018, '978-1491978917', 'A comprehensive guide to web development with PHP and MySQL.', 'learning-php.jpg'),
(7, 'Clean Code', 'Robert C. Martin', 1, 2008, '978-0132350884', 'A handbook of agile software craftsmanship.', 'clean-code.jpg'),
(8, 'The Hobbit', 'J.R.R. Tolkien', 2, 1937, '978-0547928227', 'A fantasy novel about Bilbo Baggins\' unexpected adventure.', 'hobbit.jpg'),
(9, 'Dune', 'Frank Herbert', 1, 1965, '978-0441172719', 'An epic science fiction novel set on the desert planet Arrakis.', 'dune.jpg'),
(10, 'The Catcher in the Rye', 'J.D. Salinger', 4, 1951, '978-0316769488', 'A coming-of-age story following Holden Caulfield in New York City.', 'catcher-rye.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book_format`
--

CREATE TABLE `book_format` (
  `book_id` int NOT NULL,
  `format_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book_format`
--

INSERT INTO `book_format` (`book_id`, `format_id`) VALUES
(1, 1),
(2, 1),
(4, 1),
(5, 1),
(8, 1),
(9, 1),
(10, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(1, 4),
(2, 4),
(4, 4),
(5, 4),
(8, 4),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `formats`
--

CREATE TABLE `formats` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `formats`
--

INSERT INTO `formats` (`id`, `name`) VALUES
(1, 'Hardcover'),
(2, 'Paperback'),
(3, 'Ebook'),
(4, 'Audiobook');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`) VALUES
(1, 'Penguin Random House'),
(2, 'HarperCollins'),
(3, 'Simon & Schuster'),
(4, 'Hachette Book Group'),
(5, 'Macmillan Publishers'),
(6, 'Scholastic'),
(7, 'O\'Reilly Media');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `book_format`
--
ALTER TABLE `book_format`
  ADD PRIMARY KEY (`book_id`,`format_id`),
  ADD KEY `format_id` (`format_id`);

--
-- Indexes for table `formats`
--
ALTER TABLE `formats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `formats`
--
ALTER TABLE `formats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `book_format`
--
ALTER TABLE `book_format`
  ADD CONSTRAINT `book_format_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_format_ibfk_2` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
