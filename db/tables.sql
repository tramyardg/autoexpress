CREATE TABLE IF NOT EXISTS `UserAccount` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(128) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `middleName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Administrator` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(30) NOT NULL,
  `privilege` varchar(5) DEFAULT '3',
  PRIMARY KEY (`adminId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;


CREATE TABLE `CarDiagram` (
  `diagramId` int(11) NOT NULL AUTO_INCREMENT,
  `diagram` blob,
  PRIMARY KEY (`diagramId`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `Vehicle` (
  `vehicleId` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(30) NOT NULL,
  `yearMade` year(4) NOT NULL,
  `model` varchar(35) NOT NULL,
  `price` decimal(8,0) NOT NULL,
  `mileage` int(11) NOT NULL,
  `transmission` varchar(100) NOT NULL,
  `drivetrain` varchar(100) NOT NULL,
  `engineCapacity` varchar(5) DEFAULT NULL,
  `category` varchar(40) DEFAULT NULL,
  `cylinder` varchar(4) DEFAULT NULL,
  `doors` varchar(4) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'available',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vehicleId`),
  KEY `vehicleId` (`vehicleId`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;