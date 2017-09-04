--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `adminId` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `privilege` varchar(20) DEFAULT '1,2,3',
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`adminId`, `username`, `password`, `email`, `privilege`, `last_update`) VALUES
  (242, 'asd', 'leoleo', 'asd@gmail.com', '1,2,3,4', '2017-08-24 01:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `cardiagram`
--

CREATE TABLE `cardiagram` (
  `diagramId` int(11) NOT NULL,
  `diagram` longblob,
  `vehicleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `userId` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(128) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `middleName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleId` int(11) NOT NULL,
  `make` varchar(30) CHARACTER SET utf8 NOT NULL,
  `yearMade` year(4) NOT NULL,
  `model` varchar(35) CHARACTER SET utf8 NOT NULL,
  `price` varchar(10) NOT NULL,
  `mileage` varchar(11) NOT NULL,
  `transmission` varchar(100) CHARACTER SET utf8 NOT NULL,
  `drivetrain` varchar(100) CHARACTER SET utf8 NOT NULL,
  `engineCapacity` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(40) CHARACTER SET utf8 DEFAULT 'Not specified',
  `cylinder` double DEFAULT NULL,
  `doors` int(2) DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8 DEFAULT 'Available',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleId`, `make`, `yearMade`, `model`, `price`, `mileage`, `transmission`, `drivetrain`, `engineCapacity`, `category`, `cylinder`, `doors`, `status`, `dateAdded`) VALUES
  (1, 'Toyota', 2003, 'CELICA', '6,997', '93,020', 'Manual', 'FWD', '1.8', 'Subcompact car', 4, 2, 'Available', '2017-09-03 03:06:59'),
  (2, 'Toyota', 2015, 'COROL', '16,890', '62,362', 'Automatic', 'FWD', '1.8', 'Compact car', 4, 4, 'Available', '2017-09-03 03:08:31'),
  (22, 'Honda', 2017, 'ACCORD', '28,900', '34,560', 'Automatic', 'FWD', '2.4', 'Mid-size car', 4, 4, 'Available', '2017-09-03 00:14:06'),
  (23, 'BMW', 2016, 'X5', '54,998', '37,114', 'Automatic', 'AWD', '3', 'Mid-size SUV', 6, 4, 'Available', '2017-09-03 04:28:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cardiagram`
--
ALTER TABLE `cardiagram`
  ADD PRIMARY KEY (`diagramId`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleId`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT for table `cardiagram`
--
ALTER TABLE `cardiagram`
  MODIFY `diagramId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cardiagram`
--
ALTER TABLE `cardiagram`
  ADD CONSTRAINT `vehicleId` FOREIGN KEY (`vehicleId`) REFERENCES `vehicle` (`vehicleId`) ON DELETE CASCADE;
