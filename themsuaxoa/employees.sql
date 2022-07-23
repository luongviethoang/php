CREATE TABLE  IF NOT EXISTS `employees`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `address` varchar(100) NOT NULL,
    `salary` int(10) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET= latin1 AUTO_INCREMENT = 4;

INSERT INTO `employees` (`id`, `name`, `address`, `salary`) VALUES
(1, 'Roland Mwna', 'C/Araquil, 67, Madrid', 5000),
(2, 'Victoria Ashworth', '35 king george, london', 6500),
(3, 'Martin Blank','25, Rue Laursin, Paris', 8000);