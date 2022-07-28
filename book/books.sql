CREATE TABLE IF NOT EXISTS `books`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `author` varchar(100) NOT NULL,
    `price` int(10) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET= latin1 AUTO_INCREMENT = 4;
INSERT INTO `books` (`id`, `name`, `author`, `price`) VALUES
(1, 'chu voi con o ban don', 'Hoang', 5000.),
(2, 'once piece', 'kaiseowa', 6500),
(3, 'travel to paris','donkowote', 8000);
