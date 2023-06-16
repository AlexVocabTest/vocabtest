-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 09:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vocabtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `idanswer` int(11) NOT NULL,
  `idstudent` int(11) NOT NULL,
  `idtest` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `answer1` text NOT NULL,
  `answer2` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`idanswer`, `idstudent`, `idtest`, `points`, `answer1`, `answer2`, `date`) VALUES
(1, 3, 1, 2, 'hola', 'adios', '2023-03-05 21:07:38'),
(2, 3, 1, 1, 'hello', 'good bye', '2023-03-05 21:13:22'),
(7, 2, 8, 2, 'ordenador', 'jugar', '2023-03-24 23:28:48'),
(8, 2, 9, 1, 'avión', 'varco', '2023-03-25 16:51:12'),
(9, 3, 4, 2, 'vacaciones', 'montañas', '2023-03-25 17:02:23'),
(13, 3, 5, 2, 'Buenos días', 'Buenas noches', '2023-03-27 16:36:29'),
(14, 3, 4, 2, 'Vacaciones', 'Montañas', '2023-03-28 12:21:28'),
(15, 2, 7, 2, 'mesa', 'puerta', '2023-04-01 20:07:36'),
(16, 2, 7, 1, 'mesa', 'porta', '2023-04-01 20:21:59'),
(24, 2, 5, 0, '', '', '2023-04-01 23:11:57'),
(25, 3, 7, 0, '', '', '2023-04-02 10:37:22'),
(26, 17, 8, 0, 'avión', 'barco', '2023-05-01 22:11:26'),
(27, 17, 8, 0, 'avión', 'barco', '2023-05-01 22:15:47'),
(28, 17, 8, 0, 'vacaciones', 'Buenas noches', '2023-05-01 22:16:08'),
(29, 17, 8, 0, 'mesa', 'montañas', '2023-05-01 22:16:43'),
(30, 17, 8, 0, 'avión', 'porta', '2023-05-01 22:16:53'),
(31, 17, 8, 0, 'vacaciones', 'puerta', '2023-05-01 22:17:07'),
(32, 17, 8, 0, '', '', '2023-05-01 22:18:42'),
(33, 17, 8, 0, '', '', '2023-05-01 22:19:32'),
(34, 17, 8, 0, '', '', '2023-05-01 22:22:23'),
(35, 17, 8, 0, '', '', '2023-05-01 22:23:12'),
(36, 17, 18, 1, 'avion', 'meso', '2023-05-01 22:24:53'),
(40, 17, 1, 0, 'nueve', 'puerta', '2023-05-21 12:47:12'),
(41, 17, 1, 0, '', '', '2023-05-21 12:59:50'),
(42, 17, 1, 1, 'hola', 'adios', '2023-05-21 13:16:13'),
(43, 17, 1, 1, 'hola', 'adios', '2023-05-21 13:17:12'),
(44, 17, 1, 1, 'hola', 'adios', '2023-05-21 13:17:25'),
(45, 17, 1, 1, 'hola', 'adios', '2023-05-21 13:18:50'),
(46, 17, 1, 1, 'hola', 'adios', '2023-05-21 13:20:03'),
(47, 17, 1, 1, 'hola', 'adios', '2023-05-21 13:22:13'),
(48, 17, 1, 0, 'zzzz', 'zzzz', '2023-05-21 13:22:17'),
(49, 17, 1, 1, 'HOLA', 'ADIOS', '2023-05-21 13:30:05'),
(50, 17, 1, 1, 'HOLA', 'ADIOS', '2023-05-21 13:36:18'),
(51, 17, 1, 1, 'HOLA', 'ADIOS', '2023-05-21 13:37:49'),
(52, 17, 1, 1, 'holA', 'adios', '2023-05-21 13:39:03'),
(53, 17, 1, 2, 'Hola', 'Adiós', '2023-05-21 14:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `idstudent` int(11) NOT NULL,
  `studentname` varchar(50) NOT NULL,
  `studentemail` varchar(50) NOT NULL,
  `class` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`idstudent`, `studentname`, `studentemail`, `class`) VALUES
(2, 'Kara Robin', 'kararobin@hotmail.com', '10.1'),
(3, 'Alex Lopez', 'alex.lopez.perez00@gmail.com', '10.1'),
(7, 'Alex Lopez', 'alex.lopez.perez00@gmail.com', '10.4'),
(8, 'Kara Robin', 'kararobin@hotmail.com', '10.4'),
(17, 'Alex Lopez', 'alex.lopez.perez00@gmail.com', '11.2');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `idtest` int(11) NOT NULL,
  `unit` text NOT NULL,
  `question1` text NOT NULL,
  `answer1` text NOT NULL,
  `question2` text NOT NULL,
  `answer2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`idtest`, `unit`, `question1`, `answer1`, `question2`, `answer2`) VALUES
(1, 'Unit 1', 'hello', 'hola', 'goodbye', 'adiós'),
(2, 'Unit 4', 'car', 'coche', 'train', 'tren'),
(4, 'Unit 3', 'holidays', 'vacaciones', 'mountains', 'montañas'),
(5, 'Unit 1', 'Good morning', 'Buenos días', 'Good night', 'Buenas noches'),
(6, 'Unit 7', 'Word', 'Palabra', 'King', 'Rey'),
(7, 'Unit 8', 'table', 'mesa', 'door', 'puerta'),
(8, 'Unit 1', 'paper', 'papel', 'pencil', 'lápiz'),
(9, 'Unit 2', 'plane', 'avión', 'ship', 'barco'),
(18, 'Unit 2', 'plane', 'avion', 'table', 'mesa'),
(19, 'Unit 4', 'bike', 'bicicleta', 'wheel', 'rueda'),
(21, 'Unit 6', 'mouse', 'raton', 'dog', 'perro'),
(22, 'Unit 7', 'printer', 'impresora', 'pen', 'boligrafo'),
(23, 'Unit 8', 'notebook', 'cuaderno', 'answer', 'respuesta'),
(27, 'Unit 9', 'energy', 'energia', 'desire', 'deseo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`idanswer`),
  ADD KEY `idstudent` (`idstudent`),
  ADD KEY `idtest` (`idtest`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idstudent`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`idtest`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `idanswer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idstudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `idtest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`idtest`) REFERENCES `test` (`idtest`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
