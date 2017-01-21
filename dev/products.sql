CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- dumping sample data to be used

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES (1, 'Football', 'A game played by 11 players from each side', 23.50, '2016-12-21 12:04:03', '2016-12-27 12:05:03');

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES (2, 'DustBin', 'This is essential if we want to maintain proper hygiene', 12.50, '2016-12-21 13:04:03', '2016-12-27 12:05:03');

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES (3, 'Sunglasses', 'You would need this when going to the beach', 20.99, '2016-12-21 14:04:03', '2016-12-27 12:05:03');

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES (4, 'Newspaper', 'To remain abreast of happenings in the society', 4.99, '2016-12-21 16:04:03', '2016-12-27 12:05:03');

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES (5, 'Pillow', 'Use this to spice up your nightsleep', 11.50, '2016-12-21 17:04:03', '2016-12-27 12:05:03');

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES (6, 'Earphones', 'This is very important to people who love music', 25.50, '2016-12-21 11:04:03', '2016-12-27 12:05:03');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `created`, `modified`) VALUES (7, 'PC', 'Used for development, work and fun stuffs', 100.25, '2017-01-21', '2017-01-22 00:43:00');