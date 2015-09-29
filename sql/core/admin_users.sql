#
# TABLE STRUCTURE FOR: admin_users
#

DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` enum('admin','staff') NOT NULL DEFAULT 'staff',
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `admin_users` (`id`, `role`, `username`, `password`, `full_name`, `active`, `created_at`) VALUES ('1', 'admin', 'admin', '$2y$10$7lw24RIkDD4z/P4ZrdWcBuLf3MfvkDAZyZi5k7oJqA.s2hBFvOJiG', 'Administrator', '1', '2014-07-31 12:56:41');
INSERT INTO `admin_users` (`id`, `role`, `username`, `password`, `full_name`, `active`, `created_at`) VALUES ('2', 'staff', 'staff', '$2y$10$uvx0ySA7s2GZDsKcrlv40.Wev5q9xkjVg.pirwZOH9n2K4lPrIOvC', 'Staff', '1', '2014-08-11 18:10:37');


