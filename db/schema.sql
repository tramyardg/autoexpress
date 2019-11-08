# tables
# [x] administrator
# [x] vehicle
# [x] cardiagram

CREATE TABLE administrator
(
    adminId     INT                                 NOT NULL AUTO_INCREMENT,
    username    VARCHAR(10)                         NOT NULL,
    password    VARCHAR(100)                        NOT NULL,
    email       VARCHAR(30)                         NOT NULL,
    admin_level ENUM ('0', '1', '2', '3')           NOT NULL,
    last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
    CONSTRAINT username UNIQUE (username),
    PRIMARY KEY (adminId)
);

CREATE TABLE vehicle
(
    vehicleId      INT                                   NOT NULL AUTO_INCREMENT,
    make           VARCHAR(30)                           NOT NULL,
    yearMade       YEAR                                  NOT NULL,
    model          VARCHAR(35)                           NOT NULL,
    price          VARCHAR(10)                           NOT NULL,
    mileage        VARCHAR(11)                           NOT NULL,
    transmission   VARCHAR(100)                          NOT NULL,
    drivetrain     VARCHAR(100)                          NOT NULL,
    engineCapacity VARCHAR(5)                            NULL,
    category       VARCHAR(40) DEFAULT 'Not specified'   NULL,
    cylinder       DOUBLE                                NULL,
    doors          INT(2)                                NULL,
    status         ENUM ('Available', 'SOLD')            NOT NULL,
    dateAdded      TIMESTAMP   DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (vehicleId)
);

CREATE TABLE `cardiagram`
(
    `diagramId` int(11)      NOT NULL AUTO_INCREMENT,
    `diagram`   longtext,
    `vehicleId` int(11)      NOT NULL,
    `imageType` varchar(100) NOT NULL,
    PRIMARY KEY (diagramId),
    FOREIGN KEY (vehicleId) REFERENCES vehicle (vehicleId) ON DELETE CASCADE
);