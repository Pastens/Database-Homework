-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-01-12 16:04:53
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
(1, 'developer', '系统开发人员', 'e10adc3949ba59abbe56e057f20f883e', 47, 1, 0),
(2, 'sysadmin', '系统管理员', 'e10adc3949ba59abbe56e057f20f883e', 32, 1, 1),
(3, 'shopadmin', '商店管理员', 'e10adc3949ba59abbe56e057f20f883e', 27, 1, 2),
(4, 'orderadmin', '订单管理员', 'e10adc3949ba59abbe56e057f20f883e', 5, 1, 3),
(5, 'useradmin', '用户管理员', 'e10adc3949ba59abbe56e057f20f883e', 5, 1, 4),
(6, 'shopowner', '加盟客户', 'e10adc3949ba59abbe56e057f20f883e', 5, 1, 5);

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
(1, 2, 3),
(2, 1, 100);

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
(1, 1, 13, 0, 1, 0),
(2, 1, 100, 0, 1, 0);

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
  `coverUrl` varchar(255) DEFAULT NULL,
  `productCount` int(32) NOT NULL,
  `shopId` int(32) NOT NULL,
  `priority` int(32) NOT NULL DEFAULT '1',
  `enable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `es_products`
--

INSERT INTO `es_products` (`productId`, `productName`, `productPrice`, `productIntro`, `productAmount`, `coverUrl`, `productCount`, `shopId`, `priority`, `enable`) VALUES
(1, '电脑', 5000, '电脑 5000元上船带回家', 200, '0', 1, 1, 1, 1),
(2, '机械键盘', 699, 'Cherry G80-3000', 500, '0', 1, 1, 1, 1),
(3, '移动硬盘', 499, '2TB', 0, '0', 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `es_shop`
--

CREATE TABLE `es_shop` (
  `shopId` int(32) NOT NULL,
  `shopName` varchar(255) NOT NULL,
  `adminId` int(32) DEFAULT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `es_shop`
--

INSERT INTO `es_shop` (`shopId`, `shopName`, `adminId`, `enable`) VALUES
(1, '系统店面', NULL, 1),
(2, '测试店面', NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `es_systemlog`
--

CREATE TABLE `es_systemlog` (
  `logId` int(32) NOT NULL,
  `operationName` varchar(255) NOT NULL,
  `operationUserId` int(32) NOT NULL,
  `operationUserType` tinyint(1) NOT NULL,
  `timestamp` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `es_systemlog`
--

INSERT INTO `es_systemlog` (`logId`, `operationName`, `operationUserId`, `operationUserType`, `timestamp`) VALUES
(1, '登录', 1, 0, 0),
(2, '登录', 6, 0, 1452612862),
(3, '登录', 1, 0, 1452612874);

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
-- 转存表中的数据 `es_users`
--

INSERT INTO `es_users` (`userId`, `userName`, `userPassword`, `enable`) VALUES
(1, 'user', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'user_disabled', 'e10adc3949ba59abbe56e057f20f883e', 0);

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
-- Indexes for table `es_shop`
--
ALTER TABLE `es_shop`
  ADD PRIMARY KEY (`shopId`),
  ADD UNIQUE KEY `shopName` (`shopName`),
  ADD UNIQUE KEY `adminId` (`adminId`);

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
  MODIFY `adminId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `es_orders`
--
ALTER TABLE `es_orders`
  MODIFY `orderId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `es_productreview`
--
ALTER TABLE `es_productreview`
  MODIFY `reviewId` int(32) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `es_products`
--
ALTER TABLE `es_products`
  MODIFY `productId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `es_shop`
--
ALTER TABLE `es_shop`
  MODIFY `shopId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `es_systemlog`
--
ALTER TABLE `es_systemlog`
  MODIFY `logId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `es_userinfo`
--
ALTER TABLE `es_userinfo`
  MODIFY `Id` int(32) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `es_users`
--
ALTER TABLE `es_users`
  MODIFY `userId` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
