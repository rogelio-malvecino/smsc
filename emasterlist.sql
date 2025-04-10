-- phpMyAdmin SQL Dump
-- version 2.11.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2012 at 05:16 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emasterlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandaccess`
--

CREATE TABLE IF NOT EXISTS `commandaccess` (
  `EmpNumber` varchar(15) character set latin1 default NULL,
  `MenuCode` varchar(40) character set latin1 default NULL,
  `SubMenuCode` varchar(40) character set latin1 default NULL,
  `CmdName` varchar(20) character set latin1 default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandaccess`
--

INSERT INTO `commandaccess` (`EmpNumber`, `MenuCode`, `SubMenuCode`, `CmdName`) VALUES
('PRINCESS', 'HR', 'EmployeeInformation', 'ADD'),
('PRINCESS', 'HR', 'EmployeeInformation', 'SAVE'),
('PRINCESS', 'HR', 'EmployeeInformation', 'EDIT'),
('PRINCESS', 'HR', 'EmployeeInformation', 'DELETE'),
('PRINCESS', 'HR', 'EmployeeInformation', 'SEARCH'),
('PRINCESS', 'Reports', 'Accounting', 'PRINT'),
('123456', 'HR', 'EmployeeInformation', 'ADD'),
('123456', 'HR', 'EmployeeInformation', 'SAVE'),
('123456', 'HR', 'EmployeeInformation', 'EDIT'),
('123456', 'HR', 'EmployeeInformation', 'DELETE'),
('123456', 'HR', 'EmployeeInformation', 'SEARCH'),
('123456', 'Administrator', 'UserSubModule', 'ADD'),
('123456', 'Administrator', 'UserSubModule', 'SAVE'),
('123456', 'Administrator', 'UserSubModule', 'EDIT'),
('123456', 'Administrator', 'UserSubModule', 'DELETE'),
('123456', 'Administrator', 'UserSubModule', 'SEARCH'),
('123456', 'Administrator', 'UserCommand', 'ADD'),
('123456', 'System', 'Company', 'ADD');

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE IF NOT EXISTS `commands` (
  `CmdID` int(11) NOT NULL auto_increment,
  `SubMenu` varchar(40) character set latin1 default NULL,
  `CmdName` varchar(20) character set latin1 NOT NULL,
  `CmdDescription` varchar(30) character set latin1 default NULL,
  `CmdOrder` int(11) default NULL,
  PRIMARY KEY  (`CmdID`),
  UNIQUE KEY `cmdID` (`CmdID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`CmdID`, `SubMenu`, `CmdName`, `CmdDescription`, `CmdOrder`) VALUES
(1, 'accounts', 'SAVE', 'SAVE', 2),
(2, 'accounts', 'ADD', 'ADD', 1),
(3, 'accounts', 'EDIT', 'EDIT', 3),
(4, 'accounts', 'DELETE', 'DELETE', 4),
(5, 'accounts', 'SEARCH', 'SEARCH', 5),
(6, 'accounts', 'PRINT', 'PRINT', 6),
(7, 'accounts', 'POST', 'POST', 7),
(8, 'subaccounts', 'ADD', 'ADD', 1),
(9, 'subaccounts', 'SAVE', 'SAVE', 2),
(10, 'subaccounts', 'EDIT', 'EDIT', 3),
(11, 'Users', 'ADD', 'ADD', 1),
(12, 'Users', 'SAVE', 'SAVE', 2),
(13, 'Users', 'EDIT', 'EDIT', 3),
(14, 'Users', 'DELETE', 'DELETE', 4),
(15, 'Users', 'SEARCH', 'SEARCH', 5),
(16, 'UserModule', 'ADD', 'ADD', 1),
(17, 'UserModule', 'EDIT', 'EDIT', 3),
(18, 'UserModule', 'SAVE', 'SAVE', 2),
(19, 'UserModule', 'DELETE', 'DELETE', 4),
(20, 'UserSubModule', 'ADD', 'ADD', 1),
(21, 'UserSubModule', 'SAVE', 'SAVE', 2),
(22, 'UserSubModule', 'EDIT', 'EDIT', 3),
(23, 'UserSubModule', 'DELETE', 'DELETE', 4),
(24, 'EmployeeInformation', 'ADD', 'ADD', 1),
(25, 'EmployeeInformation', 'SAVE', 'SAVE', 2),
(26, 'EmployeeInformation', 'EDIT', 'EDIT', 3),
(27, 'EmployeeInformation', 'DELETE', 'DELETE', 4),
(28, 'EmployeeInformation', 'SEARCH', 'SEARCH', 5),
(29, 'UserModule', 'SEARCH', 'SEARCH', 5),
(30, 'UserSubModule', 'SEARCH', 'SEARCH', 5),
(31, 'usercommand', 'ADD', 'ADD', 1),
(32, 'cashreceipts', 'ADD', 'ADD', 1),
(33, 'cashsales', 'ADD', 'ADD', 1),
(34, 'chargesales', 'ADD', 'ADD', 1),
(35, 'Checkdisbursement', 'ADD', 'ADD', 1),
(36, 'purchases', 'ADD', 'ADD', 1),
(37, 'Journal', 'ADD', 'ADD', 1),
(38, 'Accounting', 'PRINT', 'PRINT', 1),
(39, 'AknowledgementReceipt', 'ADD', 'ADD', 1),
(40, 'Command', 'ADD', 'ADD', 1),
(41, 'Company', 'ADD', 'ADD', 1),
(42, 'DeliveryReceipt', 'ADD', 'ADD', 1),
(43, 'Dispatching', 'ADD', 'ADD', 1),
(44, 'Market', 'ADD', 'ADD', 1),
(45, 'Menu', 'ADD', 'ADD', 1),
(46, 'Preparation', 'ADD', 'ADD', 1),
(47, 'Remittance', 'ADD', 'ADD', 1),
(48, 'SalesInvoice', 'ADD', 'ADD', 1),
(49, 'SalesLedger', 'ADD', 'ADD', 1),
(50, 'SubMenu', 'ADD', 'ADD', 1),
(51, 'UserCommand', 'ADD', 'ADD', 1),
(52, 'EmployeeInformation', 'PRINT', 'PRINT', 6);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `companyid` varchar(30) character set latin1 NOT NULL,
  `companyname` varchar(100) character set latin1 NOT NULL,
  `Address` varchar(150) character set latin1 default NULL,
  `author` varchar(45) character set latin1 NOT NULL,
  `stamp` datetime NOT NULL,
  `TinNumber` varchar(20) character set latin1 default NULL,
  `Email1` varchar(80) character set latin1 default NULL,
  PRIMARY KEY  (`companyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyid`, `companyname`, `Address`, `author`, `stamp`, `TinNumber`, `Email1`) VALUES
('everwing', 'Everwing Enterprises', NULL, 'rogelio', '2010-07-12 01:40:09', NULL, NULL),
('gadgets', 'Gadgets Plus', NULL, 'rogelio', '2010-07-15 11:47:13', NULL, NULL),
('games', 'Games and Gadgets', ' ', 'rogelio', '2010-07-15 11:46:52', NULL, NULL),
('profem', 'Profem Enterprises', NULL, 'rogelio', '2010-07-12 01:40:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employeeinformation`
--

CREATE TABLE IF NOT EXISTS `employeeinformation` (
  `EmpNumber` varchar(15) character set latin1 NOT NULL,
  `EmpFirstName` varchar(20) character set latin1 NOT NULL,
  `EmpMiddleName` varchar(20) character set latin1 NOT NULL,
  `EmpLastName` varchar(20) character set latin1 NOT NULL,
  `EmpEmail` varchar(20) character set latin1 NOT NULL,
  `EmpCElpnumber` varchar(20) character set latin1 NOT NULL,
  `EmpMobileNumber` varchar(20) character set latin1 NOT NULL,
  `EmpGender` varchar(20) character set latin1 NOT NULL,
  `EmpStatus` varchar(20) character set latin1 NOT NULL,
  `EmpReligion` varchar(20) character set latin1 NOT NULL,
  `EmpMonth` varchar(20) character set latin1 NOT NULL,
  `EmpDay` varchar(20) character set latin1 NOT NULL,
  `EmpYear` varchar(20) character set latin1 NOT NULL,
  `EmpHeight` varchar(20) character set latin1 NOT NULL,
  `EmpWeight` varchar(20) character set latin1 NOT NULL,
  `EmpHomeAddress` varchar(200) character set latin1 NOT NULL,
  `EmpCollege` varchar(200) character set latin1 NOT NULL,
  `EmpCYAttended` varchar(20) character set latin1 NOT NULL,
  `EmpHigh` varchar(200) character set latin1 NOT NULL,
  `EmpYRHattended` varchar(20) character set latin1 NOT NULL,
  `EmpElem` varchar(200) character set latin1 NOT NULL,
  `EmpELEYRattended` varchar(20) character set latin1 NOT NULL,
  `EmpBirthDay` date NOT NULL,
  `Status` int(2) default '1',
  PRIMARY KEY  (`EmpNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employeeinformation`
--

INSERT INTO `employeeinformation` (`EmpNumber`, `EmpFirstName`, `EmpMiddleName`, `EmpLastName`, `EmpEmail`, `EmpCElpnumber`, `EmpMobileNumber`, `EmpGender`, `EmpStatus`, `EmpReligion`, `EmpMonth`, `EmpDay`, `EmpYear`, `EmpHeight`, `EmpWeight`, `EmpHomeAddress`, `EmpCollege`, `EmpCYAttended`, `EmpHigh`, `EmpYRHattended`, `EmpElem`, `EmpELEYRattended`, `EmpBirthDay`, `Status`) VALUES
('09', 'PRINCESS', 'TANGLAO', 'MALVECINO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('1', 'Prince Jm', 'Tanglao', 'Malvecino', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('111111', 'kelly', 'kelly', 'kelly', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('12', 'Marlin', 's', 'Salvador', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('121212', 'as', 'as', 'as', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('123', 'Marlin', 's', 'Salvador', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('123456', 'Rogelio', 'Sunga', 'Malvecino', 'ujionel@yahoo.com', 'Cellphone Number', '0990-9009', 'female', 'married', 'catholic', 'February', '21', '`82190', 'jionel', 'ubalde', 'all the following is in the national all the following from one of the following fda', 'jionel', 'ubalde', 'ubaldejionel', 'ubalde', 'jioneljionelfda', 'gubalde', '2010-07-12', 1),
('1234567', 'Marivic', 'Viray', 'Tanglao', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('123ARNOLD', 'Arnold', 'C', 'Binamira', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 1),
('123JEFF', 'Jeffrey', 'Jeffrey', 'Jeffrey', 'dddssads', 'dsa', 'da', 'male', 'single', 'fda', 'January', 'fdfa', 'fda', 'fda', 'fdafa', 'fdafda', 'fdafa', 'fafda', 'fdafa', 'fda', 'fdf', 'fdaa', '0000-00-00', 1),
('2', 'Prince Jm', 'Tanglao', 'Malvecino', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('21', 'John', 'P', 'Siy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('23', 'Michael', 'Jordan', 'Jordan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('3', 'Prince Jm', 'Sunga', 'Malvecino', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('321', 'randy', 'randy', 'randy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('4242', 'mary', 'jan', 'jan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('4321', 'jeff', 'jeff', 'jeff', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('435', 'bong', 'bong', 'bong', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('45', 'Jeff', 'Jeff', 'Jeff', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('5', 'Princess', 'Tanglao', 'Malvecino', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('789', 'Michael', 'J', 'Jordan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('8', 'Marlin', 'Tanglao', 'Malvecino', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('8888', 'ROGELIO*', '', '%SUNGA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('a', 'a', 'a', 'a', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('a123456', 'Jimmy', 'P', 'Siy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('a123456a', 'Jimmy', 'Paw', 'Siy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('a1b2c3', 'Mario', 'V', 'Tanglao', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('abcde', 'Violy', 'virya', 'Tanglao', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('ag', 'ag', 'ag', 'ag', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('fda', 'fda', 'fda', 'fda', 'fda', 'fda', 'fda', 'female', 'married', '', '', '', '', 'fda', 'fda', '', 'fda', '', 'fda', '', 'fda', '', '0000-00-00', 5),
('fdafda', 'fda', 'fda', 'fda', 'fdaf', 'dafda', '', 'male', 'single', 'fdafa', '-Select Month-', 'fda', 'fdaf', 'fda', 'fda', 'fdafda', 'fdafa', 'fdafda', 'fdafda', 'fdafa', 'fdafda', 'fdafda', '0000-00-00', 5),
('fdafdaafda', 'jionel', 'joien', 'lubalde', 'ujionel@yahoo.com', 'jionel', 'jieooi', 'male', 'single', 'fdaa', 'January', 'fda', 'fd', 'fdaa', 'fda', 'fda', 'fda', 'fd', 'fda', 'fda', 'fda', 'fa', '0000-00-00', 5),
('fdafdaf', '03', 'fdafda', 'fdafdafda', 'fdafda', 'fdafa', 'fdafdafda', 'male', 'single', 'fdafda', '-Select Month-', 'fda', 'fa', 'fda', 'fda', 'fda', 'fda', 'fda', 'fda', 'fda', 'dfa', 'fda', '0000-00-00', 5),
('fffffffffffaaaa', '2', 'ddddddd', 'ddddddddda', 'fda', 'fda', '', 'male', 'married', 'fda', 'November', 'fda', 'fdafdafda', 'fdafda', 'Weight', 'fdfa', 'fdaf', 'fdafa', 'fda', 'fdafda', 'fdafda', '-school year-', '0000-00-00', 5),
('g', 'g', 'g', 'g', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('JEFF123', 'Jeffrey', 'Jeffrey', 'Jeffrey', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('jionel', 'ubalde', 'ubaldeb', 'ubalde', 'ubale@yahoo.xom', '12434321`', '321431', 'male', 'married', '', '', '', '', 'fda', 'fda', '', 'fda', '', 'fda', '', 'fda', '', '0000-00-00', 5),
('jjjiioeqp', '06', 'jionel', 'jjkkfjkdla', 'ipipoi', 'pipoip', '', 'male', 'single', 'ipoipoi', '-Select Month-', 'ipoipoi', 'poipo', 'ipoipo', 'ipoi', 'fdapoipo', 'fdaipoipo', 'iop', 'fdaipoipo', '-school year-', 'fdapoipipoi', 'oppo', '0000-00-00', 5),
('ljfldalk', 'jionel', 'ubale', 'uuoi', 'jfldkjalj', 'ljfdlajlk', '', 'male', 'single', 'fdaf', 'February', 'fda', 'fda', 'fda', 'fda', 'fdafa fdafda', 'fdafa', 'fdafa', 'fda', 'fda', 'fda', 'fda', '0000-00-00', 5),
('MARLINA', 'MARLIN', 'VIRAY', 'TANGLAO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 1),
('PRINCESS', 'PRINCESS', 'PRINCESS', 'PRINCESS', 'sada', 'dd', 'da', 'male', 'married', 'fdaf', 'February', 'fda', 'fda', 'fda', 'fda', 'fda', 'dfda', 'fdafa', 'fdafd', 'afdafa', 'fdafda', 'fdafda', '0000-00-00', 1),
('sa', 'sa', 'sa', 'sa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5),
('sss', 'sss', 'sss', 'sss', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `item_group`
--

CREATE TABLE IF NOT EXISTS `item_group` (
  `GroupNumber` int(10) unsigned NOT NULL auto_increment,
  `GroupName` varchar(100) character set latin1 NOT NULL,
  `Author` varchar(100) character set latin1 NOT NULL,
  `Stamp` datetime NOT NULL,
  PRIMARY KEY  USING BTREE (`GroupNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `item_group`
--

INSERT INTO `item_group` (`GroupNumber`, `GroupName`, `Author`, `Stamp`) VALUES
(1, 'wings', 'author', '0000-00-00 00:00:00'),
(2, 'cuddles', 'author', '0000-00-00 00:00:00'),
(3, 'koala', 'author', '0000-00-00 00:00:00'),
(4, 'unkle john', 'author', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_list_detail_price`
--

CREATE TABLE IF NOT EXISTS `item_list_detail_price` (
  `ItemNumber` varchar(20) character set latin1 NOT NULL,
  `ItemPriceId` varchar(10) character set latin1 NOT NULL,
  `ItemPrice` decimal(10,0) NOT NULL,
  PRIMARY KEY  USING BTREE (`ItemPriceId`),
  KEY `FK_item_list_detail_price_1` USING BTREE (`ItemNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_list_detail_price`
--


-- --------------------------------------------------------

--
-- Table structure for table `item_list_detail_uom`
--

CREATE TABLE IF NOT EXISTS `item_list_detail_uom` (
  `ItemNumber` varchar(15) character set latin1 NOT NULL,
  `UOMName` varchar(20) character set latin1 NOT NULL,
  `Item_Qty` int(10) NOT NULL,
  PRIMARY KEY  USING BTREE (`UOMName`),
  KEY `FK_item_list_detail_uom_1` USING BTREE (`ItemNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_list_detail_uom`
--


-- --------------------------------------------------------

--
-- Table structure for table `item_list_header`
--

CREATE TABLE IF NOT EXISTS `item_list_header` (
  `ItemNumber` varchar(20) character set latin1 NOT NULL,
  `ItemName` varchar(30) character set latin1 NOT NULL,
  `GroupName` varchar(30) character set latin1 NOT NULL,
  `Author` varchar(30) character set latin1 NOT NULL,
  `Stamp` datetime NOT NULL,
  PRIMARY KEY  USING BTREE (`ItemNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_list_header`
--


-- --------------------------------------------------------

--
-- Table structure for table `item_uom`
--

CREATE TABLE IF NOT EXISTS `item_uom` (
  `UOMNumber` int(10) unsigned NOT NULL auto_increment,
  `UOMName` varchar(45) NOT NULL,
  PRIMARY KEY  (`UOMNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `item_uom`
--


-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE IF NOT EXISTS `mainmenu` (
  `MenuCode` varchar(40) NOT NULL,
  `MenuName` varchar(100) NOT NULL default ' ',
  `MenuOrder` int(11) default NULL,
  `Author` varchar(15) NOT NULL,
  `Stamp` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`MenuCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`MenuCode`, `MenuName`, `MenuOrder`, `Author`, `Stamp`) VALUES
('Administrator', 'Administrator Setup', 7, '123456', '2012-06-13 13:13:49'),
('gelo', 'gelo', 10, '123456', '2012-06-13 13:13:49'),
('Help', 'Help', 10, '123456', '2012-06-13 13:13:49'),
('HR', 'Human Resources', 1, '123456', '2012-06-13 13:13:49'),
('Marketing', 'Marketings', 3, '123456', '2012-06-13 13:13:49'),
('Masterfile', 'Masterfiles', 2, '123456', '2012-06-13 13:13:49'),
('Reports', 'Reporting', 6, '123456', '2012-06-13 13:13:49'),
('Sales', 'Item Management', 4, '123456', '2012-06-13 13:13:49'),
('System', 'System Setup', 8, '123456', '2012-06-13 13:13:49'),
('Warehouse', ' Warehouse', 9, '123456', '2012-06-13 13:13:49');

-- --------------------------------------------------------

--
-- Table structure for table `mainmenuaccess`
--

CREATE TABLE IF NOT EXISTS `mainmenuaccess` (
  `EmpNumber` varchar(15) character set latin1 default NULL,
  `MenuCode` varchar(40) character set latin1 default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mainmenuaccess`
--

INSERT INTO `mainmenuaccess` (`EmpNumber`, `MenuCode`) VALUES
('1', 'Accounting'),
('12', 'Accounting'),
('12', 'HR'),
('12', 'Marketing'),
('12', 'Reports'),
('12', 'Sales'),
('12', 'Administrator'),
('12', 'Warehouse'),
('8888', 'Warehouse'),
('435', 'Accounting'),
('435', 'HR'),
('21', 'Accounting'),
('a', 'Accounting'),
('123JEFF', 'Administrator'),
('MARLINA', 'HR'),
('123ARNOLD', 'Accounting'),
('123ARNOLD', 'Administrator'),
('123ARNOLD', 'HR'),
('123ARNOLD', 'Marketing'),
('123ARNOLD', 'Reports'),
('123ARNOLD', 'Sales'),
('123ARNOLD', 'System'),
('123ARNOLD', 'Warehouse'),
('234567', 'Accounting'),
('234567', 'HR'),
('234567', 'Marketing'),
('1234567', 'Accounting'),
('1234567', 'Administrator'),
('1234567', 'Help'),
('1234567', 'HR'),
('1234567', 'Marketing'),
('1234567', 'Masterfile'),
('1234567', 'Reports'),
('1234567', 'Sales'),
('1234567', 'System'),
('1234567', 'Warehouse'),
('PRINCESS', 'Accounting'),
('PRINCESS', 'Administrator'),
('PRINCESS', 'Help'),
('PRINCESS', 'HR'),
('PRINCESS', 'Marketing'),
('PRINCESS', 'Masterfile'),
('PRINCESS', 'Reports'),
('PRINCESS', 'Sales'),
('PRINCESS', 'System'),
('PRINCESS', 'Warehouse'),
('123456', 'Administrator'),
('123456', 'Help'),
('123456', 'HR'),
('123456', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `MenuCode` varchar(40) default NULL,
  `SubMenu` varchar(40) NOT NULL,
  `SubMenuName` varchar(100) default NULL,
  `Pages` varchar(150) default NULL,
  `SubMenuOrder` int(11) default NULL,
  PRIMARY KEY  (`SubMenu`),
  UNIQUE KEY `SubMenu` (`SubMenu`),
  KEY `FK_submenu_1` (`MenuCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`MenuCode`, `SubMenu`, `SubMenuName`, `Pages`, `SubMenuOrder`) VALUES
('Reports', 'Accounting', 'Accounting Report', 'fsfsa', 1),
('Accounting', 'accounts', 'Master Accounts', 'accounts.php', 1),
('Sales', 'AknowledgementReceipt', 'AcknowlegmentReceipt', 'acknowledgement_receipts.php', 1),
('Accounting', 'cashreceipts', 'Cash Receipts Book', 'cash_receipts.php', 4),
('Accounting', 'cashsales', 'Cash Sales Book', 'cash_sales.php', 3),
('Accounting', 'chargesales', 'Charge Sales Book', 'charge_sales.php', 5),
('Accounting', 'Checkdisbursement', 'Check Disbursement Book', 'check_disbursement.php', 6),
('System', 'Command', 'Commands Module Setup', 'command_search.php', 4),
('System', 'Company', 'Company Setup', 'company_search.php', 1),
('Sales', 'DeliveryReceipt', 'Delivery Receipt', 'delivery_receipts.php', 2),
('Warehouse', 'Dispatching', 'Dispatching', 'dp.php', 2),
('HR', 'EmployeeInformation', 'Employee Information', 'employee_search.php', 1),
('Masterfile', 'ItemGroup', 'Item Group Setup', 'itemgroup_search.php', 7),
('Masterfile', 'ItemList', 'Item List Setup', 'itemlist_search.php', 8),
('Accounting', 'Journal', 'Journal Book', 'journal_book.php', 7),
('Marketing', 'Market', 'Market People', 'fsafa', 1),
('Masterfile', 'Marketing', 'Marketing Setup', 'marketing_search.php', 3),
('System', 'Menu', 'Menu Module Setup', 'menu_search.php', 2),
('Masterfile', 'Outlet', 'Outlet - Customer', 'outlet_search.php', 5),
('Warehouse', 'Preparation', 'Stock Preparation', 'stp.php', 1),
('Masterfile', 'Price', 'Price Setup', 'price_search.php', 2),
('Accounting', 'purchases', 'Purchase Book', 'pb.php', 8),
('Masterfile', 'Region', 'Region Setup', 'region_search.php', 1),
('Accounting', 'Remittance', 'Remittance', 'remittance_search.php', 9),
('Sales', 'SalesInvoice', 'Sales Invoice', 'sales_invoice.php', 3),
('Accounting', 'SalesLedger', 'Sales Ledger', 'salesledger.php', 10),
('Masterfile', 'Salesman', 'Salesman Setup', 'salesman_search.php', 4),
('Accounting', 'subaccounts', 'Sub Accounts', 'subaccounts.php', 2),
('System', 'SubMenu', 'Sub Menu Module Setup', 'submenu_search.php', 3),
('Masterfile', 'Supplier', 'Supplier Setup', 'supplier_search.php', 6),
('Administrator', 'UserCommand', 'User Access Command Setup', 'usercommand_search.php', 4),
('Administrator', 'UserModule', 'User Access Module Setup', 'usermainmodule_search.php', 2),
('Administrator', 'Users', 'Users Setup', 'user_search.php', 1),
('Administrator', 'UserSubModule', 'User Access Sub Module Setup', 'usersubmodule_search.php', 3);

-- --------------------------------------------------------

--
-- Table structure for table `submenuaccess`
--

CREATE TABLE IF NOT EXISTS `submenuaccess` (
  `EmpNumber` varchar(15) character set latin1 NOT NULL,
  `MenuCode` varchar(40) character set latin1 default NULL,
  `SubMenuCode` varchar(40) character set latin1 default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submenuaccess`
--

INSERT INTO `submenuaccess` (`EmpNumber`, `MenuCode`, `SubMenuCode`) VALUES
('8888', 'Warehouse', 'Preparation'),
('8888', 'Warehouse', 'Dispatching'),
('435', 'Accounting', 'accounts'),
('435', 'Accounting', 'subaccounts'),
('435', 'HR', 'EmployeeInformation'),
('21', 'Accounting', 'accounts'),
('21', 'Accounting', 'subaccounts'),
('12', 'Accounting', 'subaccounts'),
('12', 'Accounting', 'purchases'),
('12', 'Accounting', 'Journal'),
('12', 'Accounting', 'Checkdisbursement'),
('12', 'Accounting', 'chargesales'),
('12', 'Accounting', 'cashsales'),
('12', 'Accounting', 'cashreceipts'),
('12', 'Accounting', 'accounts'),
('123JEFF', 'Administrator', 'UserCommand'),
('MARLINA', 'Accounting', 'accounts'),
('MARLINA', 'Accounting', 'subaccounts'),
('MARLINA', 'HR', 'EmployeeInformation'),
('1234567', 'Accounting', 'accounts'),
('1234567', 'Accounting', 'subaccounts'),
('123ARNOLD', 'Accounting', 'accounts'),
('123ARNOLD', 'Accounting', 'cashreceipts'),
('123ARNOLD', 'Accounting', 'cashsales'),
('123ARNOLD', 'Accounting', 'chargesales'),
('123ARNOLD', 'Accounting', 'Checkdisbursement'),
('123ARNOLD', 'Accounting', 'Journal'),
('123ARNOLD', 'Accounting', 'purchases'),
('123ARNOLD', 'Accounting', 'Remittance'),
('123ARNOLD', 'Accounting', 'SalesLedger'),
('123ARNOLD', 'Accounting', 'subaccounts'),
('123ARNOLD', 'Administrator', 'UserCommand'),
('123ARNOLD', 'Administrator', 'UserModule'),
('123ARNOLD', 'Administrator', 'Users'),
('123ARNOLD', 'Administrator', 'UserSubModule'),
('123ARNOLD', 'System', 'Command'),
('123ARNOLD', 'System', 'Company'),
('123ARNOLD', 'System', 'Menu'),
('123ARNOLD', 'System', 'SubMenu'),
('234567', 'Accounting', 'Checkdisbursement'),
('234567', 'Accounting', 'purchases'),
('PRINCESS', 'Accounting', 'accounts'),
('PRINCESS', 'Accounting', 'cashreceipts'),
('PRINCESS', 'Accounting', 'cashsales'),
('PRINCESS', 'Accounting', 'chargesales'),
('PRINCESS', 'Accounting', 'Checkdisbursement'),
('PRINCESS', 'Accounting', 'Journal'),
('PRINCESS', 'Accounting', 'purchases'),
('PRINCESS', 'Accounting', 'Remittance'),
('PRINCESS', 'Accounting', 'SalesLedger'),
('PRINCESS', 'Accounting', 'subaccounts'),
('PRINCESS', 'Administrator', 'UserCommand'),
('PRINCESS', 'Administrator', 'UserModule'),
('PRINCESS', 'Administrator', 'Users'),
('PRINCESS', 'Administrator', 'UserSubModule'),
('PRINCESS', 'HR', 'EmployeeInformation'),
('PRINCESS', 'Marketing', 'Market'),
('PRINCESS', 'Masterfile', 'ItemGroup'),
('PRINCESS', 'Masterfile', 'ItemList'),
('PRINCESS', 'Masterfile', 'Marketing'),
('PRINCESS', 'Masterfile', 'Outlet'),
('PRINCESS', 'Masterfile', 'Price'),
('PRINCESS', 'Masterfile', 'Region'),
('PRINCESS', 'Masterfile', 'Salesman'),
('PRINCESS', 'Masterfile', 'Supplier'),
('PRINCESS', 'Reports', 'Accounting'),
('PRINCESS', 'Sales', 'AknowledgementReceipt'),
('PRINCESS', 'Sales', 'DeliveryReceipt'),
('PRINCESS', 'Sales', 'SalesInvoice'),
('PRINCESS', 'System', 'Command'),
('PRINCESS', 'System', 'Company'),
('PRINCESS', 'System', 'Menu'),
('PRINCESS', 'System', 'SubMenu'),
('PRINCESS', 'Warehouse', 'Dispatching'),
('PRINCESS', 'Warehouse', 'Preparation'),
('123456', 'Administrator', 'UserCommand'),
('123456', 'Administrator', 'UserModule'),
('123456', 'Administrator', 'Users'),
('123456', 'Administrator', 'UserSubModule'),
('123456', 'System', 'Command'),
('123456', 'System', 'Company'),
('123456', 'System', 'Menu'),
('123456', 'System', 'SubMenu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_price`
--

CREATE TABLE IF NOT EXISTS `tbl_price` (
  `Price_Id` varchar(10) character set latin1 NOT NULL,
  `Price_description` varchar(30) character set latin1 NOT NULL,
  PRIMARY KEY  (`Price_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_price`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_themes`
--

CREATE TABLE IF NOT EXISTS `tbl_themes` (
  `EmpNumber` varchar(20) character set latin1 NOT NULL,
  `Code` text character set latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_themes`
--

INSERT INTO `tbl_themes` (`EmpNumber`, `Code`) VALUES
('123456', '		\r\n		.dmx {\r\n    font: 11px tahoma;\r\n	float:left;\r\n}\r\n\r\n.dmx .item1,.dmx .item1-active{\r\n\r\n\r\n	text-align:center;\r\n	color:#FFFFFF;\r\n	border:1px solid #FFFFFF;\r\n    text-decoration: none;\r\n	padding:10px;\r\n	border-radius:5px;\r\n	height:40px;\r\n	line-height:40px;\r\n    white-space: nowrap;\r\n    position: relative;\r\n\r\n}\r\n\r\n\r\n.dmx .item2,\r\n.dmx .item2:hover,\r\n.dmx .item2-active,\r\n.dmx .item2-active:hover{\r\npadding:7px;\r\n    font: 10px tahoma;\r\n    font-weight: bold;\r\n	text-decoration:none;\r\n    display: block;\r\n    white-space: nowrap;\r\n    position: relative;\r\n    z-index: 500;\r\n	color:#003300;\r\n}\r\n\r\n.dmx .item2:hover{\r\nbackground-color:#003300;\r\ncolor:#FFFFFF;\r\n}\r\n\r\n\r\n.dmx .item2:hover,\r\n.dmx .item2-active,\r\n.dmx .item2-active:hover {\r\n\r\n}\r\n.dmx .arrow,\r\n.dmx .arrow:hover {\r\n    padding: 3px 16px 4px 8px;\r\n}\r\n.dmx .item2 img,\r\n.dmx .item2-active img{\r\n    position: absolute;\r\n    top: 4px;\r\n    right: 1px;\r\n    border: 0;\r\n}\r\n.dmx .section{\r\nbackground-color:#FFFFFF;\r\nwidth:180px;\r\n    position: absolute;\r\n    visibility: hidden;\r\n    z-index: -1;\r\n	box-shadow:1px 1px 1px #006600;\r\n}\r\ndiv.content\r\n{\r\nbackground-color:#FFFFFF;\r\nfloat:left;\r\nwidth:773px;\r\npadding-bottom:20px;\r\n\r\n\r\n}\r\n\r\ndiv.contents_{\r\nfont-size:18px;}\r\n\r\n\r\n/*heading*/\r\ndiv.heading\r\n{\r\npadding-top:25px;\r\npadding-bottom:25px;\r\npadding-right:50px;\r\npadding-left:50px;\r\n\r\nbackground: #ECF1EF;\r\nmargin:0px;\r\n  font: 20px arial;\r\n    color: #000000;\r\n    font-weight: bold;\r\n    position: relative;\r\n    display: block;\r\n    white-space: nowrap;\r\n}\r\n\r\ndiv.loguser\r\n{\r\npadding-top:12.5px;\r\npadding-bottom:12.5px;\r\npadding-right:25px;\r\npadding-left:25px;\r\n/*padding:5px;*/\r\nbackground: #ECF1EF;\r\nmargin:0px;\r\n  font: 10px arial;\r\n    color: #000000;\r\n    font-weight: bold;\r\n    position: relative;\r\n     display: block;\r\n    white-space: nowrap;\r\n}\r\n\r\n\r\n\r\ndiv.borderheading\r\n{\r\n\r\nborder:1px solid black;\r\nposition: relative;\r\ndisplay: block;\r\n    white-space: nowrap;\r\n}\r\ndiv.bordercontents\r\n{\r\n\r\nborder:3px solid black;\r\nposition: relative;\r\ndisplay: block;\r\n    white-space: nowrap;\r\n	height:300px;\r\n}\r\n\r\n\r\n\r\n\r\n/*Title*/\r\nTit1 {\r\ntext-align:center;\r\ntext-transform:uppercase;	\r\n}\r\nbody{\r\nbackground-image:url(images2/body3.jpg);\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\n\r\ndiv.bordermenu\r\n{\r\nfont-family:Arial, Helvetica, sans-serif;\r\nline-height:60px;\r\ntext-indent:15px;\r\ncolor:#000000;\r\ntext-transform:capitalize;\r\ntext-align:left;\r\n}\r\ndiv.outercontent{\r\n\r\n}\r\ndiv.container{\r\nbackground-color:#FFFFFF;\r\nborder:1px groove #A7C942;\r\nheight:720px;\r\nwidth:1150px;\r\n}\r\ndiv.header{\r\nbackground-image:url(images2/nablink.jpg);\r\nbackground-size:100% 100%;\r\nheight:150px;\r\nwidth:100%;\r\nline-height:150px;}\r\n\r\n#leftp{\r\nmargin:0;\r\npadding:0;\r\ntext-indent:20px;\r\ncolor:#FFFFFF;\r\nfloat:left;\r\ntext-shadow:1px 1px 1px #FFFFFF;\r\nfont-family:arial;\r\nfont-size:2.6em;\r\nposition:relative;\r\nanimation:myfirst 5s;\r\n-moz-animation:myfirst 5s; /* Firefox */\r\n-webkit-animation:myfirst 5s; /* Safari and Chrome */\r\n}\r\n\r\n\r\n\r\n\r\n@keyframes myfirst\r\n{\r\n0%   {background:red; left:0px; top:0px;}\r\n25%  {background:yellow; left:200px; top:0px;}\r\n50%  {background:blue; left:200px; top:200px;}\r\n75%  {background:green; left:0px; top:200px;}\r\n100% {background:red; left:0px; top:0px;}\r\n}\r\n\r\n@-moz-keyframes myfirst /* Firefox */\r\n{\r\n0%   {color:red; left:0px; top:0px;}\r\n25%  {color:yellow; left:400px; top:500px;}\r\n50%  {color:blue; left:700px; top:400px;}\r\n75%  {color:green; left:0px; top:100px;}\r\n100% {color:red; left:0px; top:0px;-moz-transform:rotate(720deg);}\r\n}\r\n\r\n@-webkit-keyframes myfirst /* Safari and Chrome */\r\n{\r\n0%   {color:red; left:0px; top:0px;}\r\n25%  {color:yellow; left:400px; top:500px;}\r\n50%  {color:blue; left:700px; top:400px;}\r\n75%  {color:green; left:0px; top:100px;}\r\n100% {color:red; left:0px; top:0px;-moz-transform:rotate(720deg);}\r\n}\r\n\r\n\r\n\r\n\r\n#rightp{\r\nfont-size:9px;\r\nfloat:right;\r\ncolor:#FFFFFF;\r\nmargin-right:10px;\r\nfont-family:arial;}\r\n\r\n\r\ndiv.navlink{\r\nbackground-image:url(images2/nablink.jpg);\r\nbackground-size:100% 100%;\r\nheight:50px;\r\nwidth:100%;}\r\n\r\n\r\n\r\n\r\ndiv.footer{\r\nwidth:1150px;\r\nheight:40px;\r\nbackground-color:#003300;\r\nline-height:40px;\r\ncolor:#FFFFFF;\r\nfont-family:Arial,Helvetica, sans-serif;\r\ntext-align:center;\r\nfont-size:10px;\r\ntext-indent:80px;}\r\n\r\ndiv.contentheader{\r\ncolor:#000000;\r\nheight:60px;\r\nwidth:100%;\r\n}\r\n\r\na.themes{\r\ntext-decoration:none;\r\ncolor:#FFFFFF;\r\nfont-size:9px;\r\n}\r\na.themes:hover{\r\ntext-decoration:underline;}\r\ndiv.contentright{\r\nborder-left:4px dotted #006600;\r\nheight:517px;\r\nwidth:370px;\r\nfloat:right;\r\n}\r\n\r\n\r\n\r\n\r\n* html .dmx td { position: relative; } /* ie 5.0 fix */\r\n\r\n\r\n\r\n/*______________________________________________________________________________*/\r\n\r\n\r\n\r\n.sortable{\r\nfont-family:Arial, Helvetica, sans-serif;\r\nwidth:100%;\r\nborder-collapse:collapse;}\r\n\r\n.sortable td, .sortable th{\r\n\r\nfont-size:1em;\r\nborder:1px solid #98bf21;\r\npadding:3px 7px 2px 7px;\r\n\r\n}\r\n\r\n.sortable th{\r\nfont-size:.9em;\r\ntext-align:left;\r\npadding-top:8px;\r\npadding-bottom:7px;\r\nbackground-color:#A7C942;\r\ncolor:#ffffff;\r\n}\r\n.sortable th a{\r\ntext-decoration:none;\r\ncolor:#ffffff;\r\nfont-size:9px;}\r\n\r\n\r\n.unsortable{\r\ncolor:#FFFFFF;\r\n-moz-border-radius-topright:10px;\r\n}\r\n\r\n.left{-moz-border-radius-topleft:10px;}\r\n\r\n\r\n\r\ntable.sortable td {\r\nfont-size:12px;\r\nfont-family:Arial, Helvetica, sans-serif;\r\ncolor:#999999;\r\n		border-width:0px;\r\n		text-align:left;\r\n		text-indent:10px;\r\n}\r\ntable.sortable td a{\r\ntext-decoration:none;\r\ncolor:#999999;\r\n}\r\ntable.sortable tr.odd td {\r\ncolor:#999999;\r\nbackground-color:#EAF2D3;\r\n}\r\n\r\ntable.sortable tr.odd td a:hover{\r\n\r\ntext-decoration:underline;}\r\n\r\ntable.sortable tr.even td {\r\n}\r\n\r\n\r\ntable.sortable tr.even td a:hover{\r\ncolor:#999999;\r\ntext-decoration:underline;\r\n}\r\n\r\n\r\n\r\ntable.sortable tr.sortbottom td {\r\n	border-top: 1px solid #444;\r\n	background-color: #ccc;\r\n	font-weight: bold;\r\n}\r\n\r\n\r\n.sortableto{\r\n}\r\n.sortableto tr td{\r\nfont-family:Arial, Helvetica, sans-serif;\r\ncolor:#000000;\r\nfont-size:12px;}\r\n.sortableto tr td input{\r\npadding:3px;\r\nborder:0;\r\nborder:1px solid #CCCCCC;\r\ncolor:#666666;\r\nborder-radius:5px;}\r\n\r\n.sortableto tr td input.send{\r\nbackground-color:#006600;\r\npadding:5px;\r\ncolor:#FFFFFF;\r\nborder-radius:10px;\r\nborder:0;}\r\ndiv.footerto{\r\n\r\nbackground-color:#A7C942;\r\nheight:20px;\r\nline-height:20px;\r\ntext-align:left;\r\n}\r\n\r\ndiv.footerto input.footer{\r\nbackground-color:#A7C942;\r\nborder:0;\r\ncolor:#FFFFFF;}\r\ndiv.footerto input.footer:hover{\r\ntext-decoration:underline;}\r\n\r\n.sortabletree{\r\nmargin-left:40px;\r\n}\r\n.sortabletree tr td{\r\ncolor:#FFFFFF;}\r\n.sortabletree tr td input{\r\npadding:5px;\r\ncolor:#666666;\r\nborder-radius:5px;}\r\n.sortabletree tr td input.send{\r\nbackground-color:#666666;\r\npadding:10px;\r\ncolor:#FFFFFF;\r\nborder-radius:10px;\r\nborder:0;}\r\n\r\n\r\n.sample tr td{\r\nfont-family:Arial, Helvetica, sans-serif;\r\ncolor:#999999;\r\ntext-transform:capitalize;\r\nwidth:300px;\r\nmargin:0;\r\n}\r\n.sample{\r\nborder:1px groove #666666;\r\nborder-radius:10px;\r\npadding:10px;}\r\n.sample tr th{\r\nbackground-color:#333333;\r\ncolor:#FFFFFF;\r\nfont-size:16px;\r\nborder-radius:10px;}\r\n\r\n'),
('234567', '		\r\n		.dmx {\r\n    font: 11px tahoma;\r\n	float:left;\r\n}\r\n\r\n.dmx .item1,.dmx .item1-active{\r\n\r\n\r\n	text-align:center;\r\n	color:#FFFFFF;\r\n	border:1px solid #FFFFFF;\r\n    text-decoration: none;\r\n	padding:10px;\r\n	border-radius:5px;\r\n	height:40px;\r\n	line-height:40px;\r\n    white-space: nowrap;\r\n    position: relative;\r\n\r\n}\r\n\r\n\r\n.dmx .item2,\r\n.dmx .item2:hover,\r\n.dmx .item2-active,\r\n.dmx .item2-active:hover{\r\npadding:7px;\r\n    font: 10px tahoma;\r\n    font-weight: bold;\r\n	text-decoration:none;\r\n    display: block;\r\n    white-space: nowrap;\r\n    position: relative;\r\n    z-index: 500;\r\n	color:#003300;\r\n}\r\n\r\n.dmx .item2:hover{\r\nbackground-color:#003300;\r\ncolor:#FFFFFF;\r\n}\r\n\r\n\r\n.dmx .item2:hover,\r\n.dmx .item2-active,\r\n.dmx .item2-active:hover {\r\n\r\n}\r\n.dmx .arrow,\r\n.dmx .arrow:hover {\r\n    padding: 3px 16px 4px 8px;\r\n}\r\n.dmx .item2 img,\r\n.dmx .item2-active img{\r\n    position: absolute;\r\n    top: 4px;\r\n    right: 1px;\r\n    border: 0;\r\n}\r\n.dmx .section{\r\nbackground-color:#FFFFFF;\r\nwidth:180px;\r\n    position: absolute;\r\n    visibility: hidden;\r\n    z-index: -1;\r\n	box-shadow:1px 1px 1px #006600;\r\n}\r\ndiv.content\r\n{\r\nbackground-color:#FFFFFF;\r\nfloat:left;\r\nwidth:773px;\r\npadding-bottom:20px;\r\n\r\n\r\n}\r\n\r\ndiv.contents_{\r\nfont-size:18px;}\r\n\r\n\r\n/*heading*/\r\ndiv.heading\r\n{\r\npadding-top:25px;\r\npadding-bottom:25px;\r\npadding-right:50px;\r\npadding-left:50px;\r\n\r\nbackground: #ECF1EF;\r\nmargin:0px;\r\n  font: 20px arial;\r\n    color: #000000;\r\n    font-weight: bold;\r\n    position: relative;\r\n    display: block;\r\n    white-space: nowrap;\r\n}\r\n\r\ndiv.loguser\r\n{\r\npadding-top:12.5px;\r\npadding-bottom:12.5px;\r\npadding-right:25px;\r\npadding-left:25px;\r\n/*padding:5px;*/\r\nbackground: #ECF1EF;\r\nmargin:0px;\r\n  font: 10px arial;\r\n    color: #000000;\r\n    font-weight: bold;\r\n    position: relative;\r\n     display: block;\r\n    white-space: nowrap;\r\n}\r\n\r\n\r\n\r\ndiv.borderheading\r\n{\r\n\r\nborder:1px solid black;\r\nposition: relative;\r\ndisplay: block;\r\n    white-space: nowrap;\r\n}\r\ndiv.bordercontents\r\n{\r\n\r\nborder:3px solid black;\r\nposition: relative;\r\ndisplay: block;\r\n    white-space: nowrap;\r\n	height:300px;\r\n}\r\n\r\n\r\n\r\n\r\n/*Title*/\r\nTit1 {\r\ntext-align:center;\r\ntext-transform:uppercase;	\r\n}\r\nbody{\r\nbackground-image:url(images2/body3.jpg);\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\n\r\ndiv.bordermenu\r\n{\r\nfont-family:Arial, Helvetica, sans-serif;\r\nline-height:60px;\r\ntext-indent:15px;\r\ncolor:#000000;\r\ntext-transform:capitalize;\r\ntext-align:left;\r\n}\r\ndiv.outercontent{\r\n\r\n}\r\ndiv.container{\r\nbackground-color:#FFFFFF;\r\nborder:1px groove #A7C942;\r\nheight:720px;\r\nwidth:1150px;\r\n}\r\ndiv.header{\r\nbackground-image:url(images2/nablink.jpg);\r\nbackground-size:100% 100%;\r\nheight:150px;\r\nwidth:100%;\r\nline-height:150px;}\r\n\r\n#leftp{\r\nmargin:0;\r\npadding:0;\r\ntext-indent:20px;\r\ncolor:#FFFFFF;\r\nfloat:left;\r\ntext-shadow:1px 1px 1px #FFFFFF;\r\nfont-family:arial;\r\nfont-size:2.6em;\r\nposition:relative;\r\nanimation:myfirst 5s;\r\n-moz-animation:myfirst 5s; /* Firefox */\r\n-webkit-animation:myfirst 5s; /* Safari and Chrome */\r\n}\r\n\r\n\r\n\r\n\r\n@keyframes myfirst\r\n{\r\n0%   {background:red; left:0px; top:0px;}\r\n25%  {background:yellow; left:200px; top:0px;}\r\n50%  {background:blue; left:200px; top:200px;}\r\n75%  {background:green; left:0px; top:200px;}\r\n100% {background:red; left:0px; top:0px;}\r\n}\r\n\r\n@-moz-keyframes myfirst /* Firefox */\r\n{\r\n0%   {color:red; left:0px; top:0px;}\r\n25%  {color:yellow; left:400px; top:500px;}\r\n50%  {color:blue; left:700px; top:400px;}\r\n75%  {color:green; left:0px; top:100px;}\r\n100% {color:red; left:0px; top:0px;-moz-transform:rotate(720deg);}\r\n}\r\n\r\n@-webkit-keyframes myfirst /* Safari and Chrome */\r\n{\r\n0%   {color:red; left:0px; top:0px;}\r\n25%  {color:yellow; left:400px; top:500px;}\r\n50%  {color:blue; left:700px; top:400px;}\r\n75%  {color:green; left:0px; top:100px;}\r\n100% {color:red; left:0px; top:0px;-moz-transform:rotate(720deg);}\r\n}\r\n\r\n\r\n\r\n\r\n#rightp{\r\nfont-size:9px;\r\nfloat:right;\r\ncolor:#FFFFFF;\r\nmargin-right:10px;\r\nfont-family:arial;}\r\n\r\n\r\ndiv.navlink{\r\nbackground-image:url(images2/nablink.jpg);\r\nbackground-size:100% 100%;\r\nheight:50px;\r\nwidth:100%;}\r\n\r\n\r\n\r\n\r\ndiv.footer{\r\nwidth:1150px;\r\nheight:40px;\r\nbackground-color:#003300;\r\nline-height:40px;\r\ncolor:#FFFFFF;\r\nfont-family:Arial,Helvetica, sans-serif;\r\ntext-align:center;\r\nfont-size:10px;\r\ntext-indent:80px;}\r\n\r\ndiv.contentheader{\r\ncolor:#000000;\r\nheight:60px;\r\nwidth:100%;\r\n}\r\n\r\na.themes{\r\ntext-decoration:none;\r\ncolor:#FFFFFF;\r\nfont-size:9px;\r\n}\r\na.themes:hover{\r\ntext-decoration:underline;}\r\ndiv.contentright{\r\nborder-left:4px dotted #006600;\r\nheight:517px;\r\nwidth:370px;\r\nfloat:right;\r\n}\r\n\r\n\r\n\r\n\r\n* html .dmx td { position: relative; } /* ie 5.0 fix */\r\n\r\n\r\n\r\n/*______________________________________________________________________________*/\r\n\r\n\r\n\r\n.sortable{\r\nfont-family:Arial, Helvetica, sans-serif;\r\nwidth:100%;\r\nborder-collapse:collapse;}\r\n\r\n.sortable td, .sortable th{\r\n\r\nfont-size:1em;\r\nborder:1px solid #98bf21;\r\npadding:3px 7px 2px 7px;\r\n\r\n}\r\n\r\n.sortable th{\r\nfont-size:.9em;\r\ntext-align:left;\r\npadding-top:8px;\r\npadding-bottom:7px;\r\nbackground-color:#A7C942;\r\ncolor:#ffffff;\r\n}\r\n.sortable th a{\r\ntext-decoration:none;\r\ncolor:#ffffff;\r\nfont-size:9px;}\r\n\r\n\r\n.unsortable{\r\ncolor:#FFFFFF;\r\n-moz-border-radius-topright:10px;\r\n}\r\n\r\n.left{-moz-border-radius-topleft:10px;}\r\n\r\n\r\n\r\ntable.sortable td {\r\nfont-size:12px;\r\nfont-family:Arial, Helvetica, sans-serif;\r\ncolor:#999999;\r\n		border-width:0px;\r\n		text-align:left;\r\n		text-indent:10px;\r\n}\r\ntable.sortable td a{\r\ntext-decoration:none;\r\ncolor:#999999;\r\n}\r\ntable.sortable tr.odd td {\r\ncolor:#999999;\r\nbackground-color:#EAF2D3;\r\n}\r\n\r\ntable.sortable tr.odd td a:hover{\r\n\r\ntext-decoration:underline;}\r\n\r\ntable.sortable tr.even td {\r\n}\r\n\r\n\r\ntable.sortable tr.even td a:hover{\r\ncolor:#999999;\r\ntext-decoration:underline;\r\n}\r\n\r\n\r\n\r\ntable.sortable tr.sortbottom td {\r\n	border-top: 1px solid #444;\r\n	background-color: #ccc;\r\n	font-weight: bold;\r\n}\r\n\r\n\r\n.sortableto{\r\n}\r\n.sortableto tr td{\r\nfont-family:Arial, Helvetica, sans-serif;\r\ncolor:#000000;\r\nfont-size:12px;}\r\n.sortableto tr td input{\r\npadding:3px;\r\nborder:0;\r\nborder:1px solid #CCCCCC;\r\ncolor:#666666;\r\nborder-radius:5px;}\r\n\r\n.sortableto tr td input.send{\r\nbackground-color:#006600;\r\npadding:5px;\r\ncolor:#FFFFFF;\r\nborder-radius:10px;\r\nborder:0;}\r\ndiv.footerto{\r\n\r\nbackground-color:#A7C942;\r\nheight:20px;\r\nline-height:20px;\r\ntext-align:left;\r\n}\r\n\r\ndiv.footerto input.footer{\r\nbackground-color:#A7C942;\r\nborder:0;\r\ncolor:#FFFFFF;}\r\ndiv.footerto input.footer:hover{\r\ntext-decoration:underline;}\r\n\r\n.sortabletree{\r\nmargin-left:40px;\r\n}\r\n.sortabletree tr td{\r\ncolor:#FFFFFF;}\r\n.sortabletree tr td input{\r\npadding:5px;\r\ncolor:#666666;\r\nborder-radius:5px;}\r\n.sortabletree tr td input.send{\r\nbackground-color:#666666;\r\npadding:10px;\r\ncolor:#FFFFFF;\r\nborder-radius:10px;\r\nborder:0;}\r\n\r\n\r\n.sample tr td{\r\nfont-family:Arial, Helvetica, sans-serif;\r\ncolor:#999999;\r\ntext-transform:capitalize;\r\nwidth:300px;\r\nmargin:0;\r\n}\r\n.sample{\r\nborder:1px groove #666666;\r\nborder-radius:10px;\r\npadding:10px;}\r\n.sample tr th{\r\nbackground-color:#333333;\r\ncolor:#FFFFFF;\r\nfont-size:16px;\r\nborder-radius:10px;}\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `usersaccess`
--

CREATE TABLE IF NOT EXISTS `usersaccess` (
  `EmpNumber` varchar(15) character set latin1 default NULL,
  `MenuCode` varchar(40) character set latin1 NOT NULL,
  `SubMenu` varchar(40) character set latin1 NOT NULL,
  KEY `FK_epmaccess_1` (`MenuCode`),
  KEY `FK_epmaccess_2` (`SubMenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `usersaccess`
--

INSERT INTO `usersaccess` (`EmpNumber`, `MenuCode`, `SubMenu`) VALUES
('123456', 'Accounting', 'accounts'),
('123456', 'System', 'Users'),
('123456', 'Sales', 'DeliveryReceipt'),
('123456', 'Sales', 'SalesInvoice'),
('123456', 'Warehouse', 'Dispatching'),
('123456', 'Warehouse', 'Preparation'),
('123456', 'Accounting', 'subaccounts'),
('123456', 'HR', 'EmployeeInformation'),
('a123456', 'Accounting', 'accounts'),
('123456', 'System', 'UserModule'),
('123456', 'System', 'UserSubModule'),
('123456', 'Reports', 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `usersprofile`
--

CREATE TABLE IF NOT EXISTS `usersprofile` (
  `EmpNumber` varchar(15) character set latin1 NOT NULL,
  `EmpUserName` varchar(20) character set latin1 NOT NULL,
  `EmpPassword` varchar(20) character set latin1 default NULL,
  PRIMARY KEY  (`EmpNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `usersprofile`
--

INSERT INTO `usersprofile` (`EmpNumber`, `EmpUserName`, `EmpPassword`) VALUES
('1', 'Prince Jm', ' Malvecino'),
('12', 'a', 'a'),
('123456', 'Rogelio', 'Rogelio'),
('1234567', 'Marivic', 'Marivic'),
('123ARNOLD', 'Arnold', 'Arnold'),
('123JEFF', 'Jeffrey', 'Jeffrey'),
('21', 'John', 'John'),
('234567', 'Jonel', 'Ubalde'),
('321', 'a', 'a'),
('3423', 'dsa', ' rogelio'),
('435', 'bong', ' bong'),
('789', 'Michael', ' Jordan'),
('8888', 'ROGER', ' ROGER'),
('a', 'dsa', ' dsafsa'),
('a123456', 'Jimmy', 'Jimmy'),
('ag', 'ag', ' ag'),
('MARLINA', 'Marlin', 'Marlin'),
('PRINCESS', 'Princess', 'Princess');
