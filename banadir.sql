-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 01:07 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banadir`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_sp` (IN `_employeeId` INT(15), IN `_name` VARCHAR(100), IN `_Number` VARCHAR(50), IN `_status` VARCHAR(100), IN `_fee` FLOAT(10,2), IN `_type` VARCHAR(50), IN `_userId` VARCHAR(50), IN `_date` DATE)  NO SQL
BEGIN

IF EXISTS (SELECT * FROM employees WHERE employees.employee_id = _employeeId) THEN 

UPDATE employees SET employees.name =_name ,employees.Number=_Number, employees.status = _status, employees.fee =_fee , employees.type =_type , employees.user_id =_userId , employees.created_date =_date   WHERE employees.employee_id = _employeeId;

SELECT 'Updated' as Message;

ELSE

INSERT INTO `employees`(`name`,`Number`, `status`, `fee`, `type`, `user_id`, `created_date`) VALUES (_name, _Number, _status, _fee, _type,_userId ,_date);


SELECT 'Inserted' as Message;

END IF;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `expense_sp` (IN `_id` VARCHAR(11), IN `_description` TEXT, IN `_amount` FLOAT(10,2), IN `_userId` VARCHAR(50), IN `_date` DATE)  NO SQL
BEGIN

IF EXISTS (SELECT * FROM expenses WHERE expenses.id = _id) THEN 

UPDATE expenses SET expenses.description = _description, expenses.amount = _amount, expenses.user_id = _userId, expenses.created_date = _date WHERE expenses.id = _id;

SELECT 'Updated' as Message;

ELSE

INSERT INTO `expenses`(`description`, `amount`, `user_id`, `created_date`) VALUES (_description, _amount, _userId, _date);

SELECT 'Inserted' as Message;

END IF;



END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_customer_statement_sp` (IN `_customerId` INT(15), IN `_from` DATE, IN `_to` DATE)  NO SQL
BEGIN


CREATE TEMPORARY TABLE statement (
    Date date,
    Type varchar(50),
    Description varchar(150),
    Amount Float(10,2)
);

if ( _from= '000-00-00') THEN


INSERT INTO statement SELECT payrolls.created_date, 'Payment', payrolls.description,payrolls.amount FROM payrolls WHERE payrolls.employee_id =_customerId;


ELSE


INSERT INTO statement SELECT payrolls.created_date, 'Payment', payrolls.description,payrolls.amount FROM payrolls WHERE payrolls.employee_id = _customerId AND payrolls.created_date BETWEEN _from AND _to;


END IF;


CREATE TEMPORARY TABLE output SELECT * FROM statement ORDER BY Date ASC;

SELECT '' as 'Date', '' as 'Type', 'Openning Balance' as 'Description', 0 as 'Amount'

UNION

SELECT Date, Type, Description, Amount FROM output

UNION 


SELECT '' as 'Date', '' as 'Type', 'Total' as 'Description',SUM(Amount) as 'Amount' FROM statement;




END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_employee_info_sp` (IN `_employeeId` VARCHAR(15))  NO SQL
BEGIN


SELECT employees.Number,employees.status, employees.type, employees.fee FROM employees WHERE employees.employee_id =_employeeId ;




END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_sp` (IN `_username` VARCHAR(100), IN `_password` VARCHAR(100))  NO SQL
BEGIN


IF EXISTS (SELECT * FROM users WHERE users.username = _username AND users.password = PASSWORD(_password) and users.status = 'InActive') THEN 

SELECT 'Locked' as Message;

ELSEIF EXISTS (SELECT * FROM users WHERE users.username = _username AND users.password = PASSWORD(_password)) THEN

SELECT users.user_id, users.name, users.username, users.Privileges ,users.status FROM users WHERE users.username = _username AND users.password = PASSWORD(_password);

ELSE

SELECT 'Denied' as Message;

END IF;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `payroll_sp` (IN `_id` VARCHAR(15), IN `_employeeId` VARCHAR(15), IN `_description` TEXT, IN `_amount` FLOAT(10,2), IN `_userId` VARCHAR(50), IN `_date` DATE)  NO SQL
BEGIN

IF EXISTS (SELECT * FROM payrolls WHERE payrolls.id =_id) THEN 

UPDATE payrolls SET payrolls.description =_description , payrolls.amount =_amount , payrolls.user_id =_userId , payrolls.created_date = _date WHERE payrolls.id = _id;

SELECT 'Updated' as Message;

ELSE

INSERT INTO payrolls(payrolls.employee_id, `description`, `amount`, `user_id`, `created_date`) VALUES (_employeeId,_description , _amount,_userId ,_date );

SELECT payrolls.id as `Id`,'Insert' as Message FROM payrolls ORDER BY payrolls.id DESC LIMIT 1;

END IF;



END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_sp` (IN `_userId` VARCHAR(15), IN `_name` VARCHAR(100), IN `_username` VARCHAR(100), IN `_password` VARCHAR(250), IN `_status` VARCHAR(50), IN `_Privileges` VARCHAR(50), IN `_date` DATE)  NO SQL
BEGIN

IF EXISTS (SELECT * FROM users WHERE users.user_id =_userId ) THEN 

UPDATE users SET users.name =_name , users.username = _username, users.password = PASSWORD(_password), users.status =_status ,users.Privileges=_Privileges, users.created_date =_date  WHERE users.user_id =_userId ;

SELECT 'Updated' as Message;

ELSE

INSERT INTO `users`(`user_id`, `name`, `username`, `password`, `status`,users.Privileges, `created_date`) VALUES (_userId, _name, _username, PASSWORD(_password), _status, _Privileges,_date);

SELECT 'Inserted' as Message;

END IF;



END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Number` varchar(150) NOT NULL,
  `status` varchar(100) NOT NULL,
  `fee` float(10,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `Number`, `status`, `fee`, `type`, `user_id`, `created_date`, `modified_date`) VALUES
(1, 'Mohamed Jamac', '+252617340094', 'Active', 15.00, 'Afternoon', 'USR004', '2021-11-01', '2021-11-10 12:22:36'),
(3, 'Abdullahi Ali Moalim Abdi', '+252617734704', 'Active', 15.00, 'Afternoon', 'USR004', '2021-11-01', '2021-11-10 07:43:37'),
(13, 'Mowliid Dahir', '+252617734704', 'Inactive', 10.00, 'Morning', 'USR004', '2021-11-10', '2021-11-29 06:13:10'),
(15, 'Mohamed Omar geedi', '+252617340096', 'Active', 20.00, 'Morning', 'USR004', '2021-11-30', '2021-11-30 11:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` float(10,2) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `description`, `amount`, `user_id`, `created_date`, `modified_date`) VALUES
(1, 'Biilka Korontada', 50.00, 'USR001', '2019-08-23', '2019-08-23 18:42:12'),
(3, 'Biyaha', 12.00, 'USR004', '2021-11-30', '2021-11-30 11:52:55'),
(4, 'MIIS', 30.00, 'USR004', '2021-11-30', '2021-11-30 11:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` float(10,2) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `employee_id`, `description`, `amount`, `user_id`, `created_date`, `modified_date`) VALUES
(1, 1, 'Aug', 400.00, 'USR001', '2019-08-24', '2019-08-25 06:45:05'),
(5, 3, 'April-jan', 10.00, 'USR004', '2021-11-01', '2021-11-09 11:44:57'),
(60, 13, 'Marso', 30.00, 'USR004', '2021-11-30', '2021-11-30 11:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  `Privileges` varchar(50) NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `status`, `Privileges`, `created_date`, `modified_date`) VALUES
('USR001', 'Mohamed Jamac', 'jamac', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Active', 'User', '2019-08-23', '2021-11-29 08:49:26'),
('USR004', 'Mohamed Ali Moalim Abdi', 'maheesh', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Active', 'Admin', '2021-11-09', '2021-11-29 08:51:47'),
('USR005', 'Admin', 'Admin', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Active', 'Admin', '2021-11-30', '2021-11-30 12:04:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_user_id` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_user_id` (`user_id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_user_id` (`user_id`),
  ADD KEY `payroll_employee_id` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employee_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expense_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `payroll_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
