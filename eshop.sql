-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-01-05 16:05:54
-- 服务器版本： 5.6.27
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `es_admin`
--

CREATE TABLE `es_admin` (
  `adminId` int(32) NOT NULL,
  `adminName` varchar(16) NOT NULL,
  `adminNickname` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `adminCount` int(32) NOT NULL DEFAULT '0',
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  `superior` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `es_admin`
--

INSERT INTO `es_admin` (`adminId`, `adminName`, `adminNickname`, `adminPassword`, `adminCount`, `enable`, `superior`) VALUES
(1, 'admin', '系统开发人员', 'e10adc3949ba59abbe56e057f20f883e', 16, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `es_orderitems`
--

CREATE TABLE `es_orderitems` (
  `orderId` int(32) NOT NULL,
  `productId` int(32) NOT NULL,
  `quantity` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `es_orderitems`
--

INSERT INTO `es_orderitems` (`orderId`, `productId`, `quantity`) VALUES
(1, 1, 12),
(1, 2, 10);

-- --------------------------------------------------------

--
-- 表的结构 `es_orders`
--

CREATE TABLE `es_orders` (
  `orderId` int(32) NOT NULL,
  `userId` int(32) NOT NULL,
  `orderPrice` int(32) NOT NULL,
  `timestamp` int(32) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `es_orders`
--

INSERT INTO `es_orders` (`orderId`, `userId`, `orderPrice`, `timestamp`, `enable`, `status`) VALUES
(1, 1, 13, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `es_productreview`
--

CREATE TABLE `es_productreview` (
  `reviewId` int(32) NOT NULL,
  `productId` int(32) NOT NULL,
  `reviewContent` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `es_products`
--

CREATE TABLE `es_products` (
  `productId` int(32) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` int(32) NOT NULL,
  `productIntro` varchar(255) NOT NULL,
  `productAmount` int(32) NOT NULL,
  `coverUrl` varchar(255) NOT NULL,
  `productCount` int(32) NOT NULL,
  `priority` int(32) NOT NULL DEFAULT '1',
  `enable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `es_products`
--

INSERT INTO `es_products` (`productId`, `productName`, `productPrice`, `productIntro`, `productAmount`, `coverUrl`, `productCount`, `priority`, `enable`) VALUES
(1, '电脑', 1200, '你好电脑啊！', 500, '0', 1, 1, 1),
(2, '书本', 50, '你好书本啊', 500, '0', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `es_systemlog`
--

CREATE TABLE `es_systemlog` (
  `logId` int(32) NOT NULL,
  `operationName` varchar(255) NOT NULL,
  `operationUserId` int(32) NOT NULL,
  `operationUserType` int(4) NOT NULL,
  `timestamp` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `es_userinfo`
--

CREATE TABLE `es_userinfo` (
  `Id` int(32) NOT NULL,
  `userId` int(32) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `es_users`
--

CREATE TABLE `es_users` (
  `userId` int(32) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `es_admin`
--
ALTER TABLE `es_admin`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `adminName` (`adminName`);

--
-- Indexes for table `es_orderitems`
--
ALTER TABLE `es_orderitems`
  ADD PRIMARY KEY (`orderId`,`productId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `es_orders`
--
ALTER TABLE `es_orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `es_productreview`
--
ALTER TABLE `es_productreview`
  ADD PRIMARY KEY (`reviewId`);

--
-- Indexes for table `es_products`
--
ALTER TABLE `es_products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `es_systemlog`
--
ALTER TABLE `es_systemlog`
  ADD PRIMARY KEY (`logId`);

--
-- Indexes for table `es_userinfo`
--
ALTER TABLE `es_userinfo`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `es_users`
--
ALTER TABLE `es_users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `es_admin`
--
ALTER TABLE `es_admin`
  MODIFY `adminId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `es_orders`
--
ALTER TABLE `es_orders`
  MODIFY `orderId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `es_productreview`
--
ALTER TABLE `es_productreview`
  MODIFY `reviewId` int(32) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `es_products`
--
ALTER TABLE `es_products`
  MODIFY `productId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `es_systemlog`
--
ALTER TABLE `es_systemlog`
  MODIFY `logId` int(32) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `es_userinfo`
--
ALTER TABLE `es_userinfo`
  MODIFY `Id` int(32) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `es_users`
--
ALTER TABLE `es_users`
  MODIFY `userId` int(32) NOT NULL AUTO_INCREMENT;
--
-- 限制导出的表
--

--
-- 限制表 `es_orderitems`
--
ALTER TABLE `es_orderitems`
  ADD CONSTRAINT `es_orderitems_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `es_orders` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `es_orderitems_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `es_products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `es_userinfo`
--
ALTER TABLE `es_userinfo`
  ADD CONSTRAINT `es_userinfo_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `es_users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
