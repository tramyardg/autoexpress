CREATE TABLE administrator
(
  adminId     INT                                 NOT NULL AUTO_INCREMENT
    PRIMARY KEY,
  username    VARCHAR(10)                         NOT NULL,
  password    VARCHAR(100)                        NOT NULL,
  email       VARCHAR(30)                         NOT NULL,
  privilege   VARCHAR(20) DEFAULT '1,2,3'         NULL,
  last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
  CONSTRAINT username
  UNIQUE (username)
);

CREATE TABLE cardiagram
(
  diagramId INT      NOT NULL AUTO_INCREMENT
    PRIMARY KEY,
  diagram   LONGBLOB NULL,
  vehicleId INT      NOT NULL
);

CREATE INDEX vehicleId
  ON cardiagram (vehicleId);

CREATE TABLE companies
(
  companyId       INT          NOT NULL AUTO_INCREMENT
    PRIMARY KEY,
  companyName     VARCHAR(255) NULL,
  repFirstName    VARCHAR(255) NULL,
  repMiddleInital VARCHAR(5)   NULL,
  repLastName     VARCHAR(255) NULL,
  emailId         VARCHAR(255) NULL,
  city            VARCHAR(255) NULL,
  province        VARCHAR(255) NULL,
  postalCode      VARCHAR(255) NULL
);

CREATE TABLE useraccount
(
  userId      INT          NOT NULL AUTO_INCREMENT
    PRIMARY KEY,
  username    VARCHAR(10)  NOT NULL,
  password    VARCHAR(128) NOT NULL,
  firstName   VARCHAR(20)  NOT NULL,
  middleName  VARCHAR(20)  NULL,
  lastName    VARCHAR(20)  NOT NULL,
  gender      CHAR         NULL,
  phoneNumber VARCHAR(15)  NULL,
  email       VARCHAR(30)  NOT NULL,
  CONSTRAINT username
  UNIQUE (username)
);

CREATE TABLE vehicle
(
  vehicleId      INT                                 NOT NULL AUTO_INCREMENT
    PRIMARY KEY,
  make           VARCHAR(30)                         NOT NULL,
  yearMade       YEAR                                NOT NULL,
  model          VARCHAR(35)                         NOT NULL,
  price          VARCHAR(10)                         NOT NULL,
  mileage        VARCHAR(11)                         NOT NULL,
  transmission   VARCHAR(100)                        NOT NULL,
  drivetrain     VARCHAR(100)                        NOT NULL,
  engineCapacity VARCHAR(5)                          NULL,
  category       VARCHAR(40) DEFAULT 'Not specified' NULL,
  cylinder       DOUBLE                              NULL,
  doors          INT(2)                              NULL,
  status         VARCHAR(10) DEFAULT 'Available'     NULL,
  dateAdded      TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE INDEX vehicleId
  ON vehicle (vehicleId);

ALTER TABLE cardiagram
  ADD CONSTRAINT vehicleId
FOREIGN KEY (vehicleId) REFERENCES autoexpress.vehicle (vehicleId)
  ON DELETE CASCADE;

