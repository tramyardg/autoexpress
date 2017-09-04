CREATE TABLE `administrator` (
  `adminId`     INT(11)      NOT NULL,
  `username`    VARCHAR(10)  NOT NULL,
  `password`    VARCHAR(100) NOT NULL,
  `email`       VARCHAR(30)  NOT NULL,
  `privilege`   VARCHAR(20)       DEFAULT '1,2,3',
  `last_update` TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminId`)
);

CREATE TABLE `cardiagram` (
  `diagramId` INT(11) NOT NULL,
  `diagram`   LONGBLOB,
  `vehicleId` INT(11) NOT NULL,
  PRIMARY KEY (`diagramId`),
  CONSTRAINT `vehicleId` FOREIGN KEY (`vehicleId`)
  REFERENCES `vehicle` (`vehicleId`)
    ON DELETE CASCADE
);

CREATE TABLE `useraccount` (
  `userId`      INT(11)      NOT NULL,
  `username`    VARCHAR(10)  NOT NULL,
  `password`    VARCHAR(128) NOT NULL,
  `firstName`   VARCHAR(20)  NOT NULL,
  `middleName`  VARCHAR(20) DEFAULT NULL,
  `lastName`    VARCHAR(20)  NOT NULL,
  `gender`      CHAR(1)     DEFAULT NULL,
  `phoneNumber` VARCHAR(15) DEFAULT NULL,
  `email`       VARCHAR(30)  NOT NULL,
  PRIMARY KEY (`userId`)
);

CREATE TABLE `vehicle` (
  `vehicleId`      INT(11)            NOT NULL,
  `make`           VARCHAR(30)
                   CHARACTER SET utf8 NOT NULL,
  `yearMade`       YEAR(4)            NOT NULL,
  `model`          VARCHAR(35)
                   CHARACTER SET utf8 NOT NULL,
  `price`          VARCHAR(10)        NOT NULL,
  `mileage`        VARCHAR(11)        NOT NULL,
  `transmission`   VARCHAR(100)
                   CHARACTER SET utf8 NOT NULL,
  `drivetrain`     VARCHAR(100)
                   CHARACTER SET utf8 NOT NULL,
  `engineCapacity` VARCHAR(5)
                   CHARACTER SET utf8          DEFAULT NULL,
  `category`       VARCHAR(40)
                   CHARACTER SET utf8          DEFAULT 'Not specified',
  `cylinder`       DOUBLE                      DEFAULT NULL,
  `doors`          INT(2)                      DEFAULT NULL,
  `status`         VARCHAR(10)
                   CHARACTER SET utf8          DEFAULT 'Available',
  `dateAdded`      TIMESTAMP          NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vehicleId`)
);

