INSERT INTO `administrator` (`adminId`, `username`, `password`, `email`, `admin_level`, `last_update`)
VALUES (1, 'admin', 'admin', 'admin@gmail.com', '3', '2019-01-23 18:50:52'),
       (2, 'leo', 'leo', 'leo@gmail.com', '2', '2019-05-10 02:19:02'),
       (3, 'ray', 'ray', 'ray@gmail.com', '3', '2019-05-10 02:44:41');

INSERT INTO `vehicle` (`vehicleId`, `make`, `yearMade`, `model`, `price`, `mileage`, `transmission`, `drivetrain`,
                       `engineCapacity`, `category`, `cylinder`, `doors`, `status`, `dateAdded`)
VALUES (2, 'Acura', 2018, '2.3CL', '23,000', '1,233', 'Manual', 'RWD', '2.4', 'Mid-size car', 6, 3, 'Available',
        '2019-05-18 03:50:38'),
       (3, 'Toyota', 2019, 'RAV4', '35,000', '123', 'Automatic', 'AWD', '2.5', 'Compact SUV', 4, 5, 'Available',
        '2019-05-18 12:44:15');
