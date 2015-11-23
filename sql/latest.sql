#
# TABLE STRUCTURE FOR: blog_categories
#

DROP TABLE IF EXISTS `blog_categories`;

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_categories` (`id`, `pos`, `title`) VALUES ('1', '1', 'Category 1');
INSERT INTO `blog_categories` (`id`, `pos`, `title`) VALUES ('2', '2', 'Category 2');
INSERT INTO `blog_categories` (`id`, `pos`, `title`) VALUES ('3', '3', 'Category 3');


#
# TABLE STRUCTURE FOR: blog_post_tag_rel
#

DROP TABLE IF EXISTS `blog_post_tag_rel`;

CREATE TABLE `blog_post_tag_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_post_tag_rel` (`id`, `post_id`, `tag_id`) VALUES ('1', '1', '2');
INSERT INTO `blog_post_tag_rel` (`id`, `post_id`, `tag_id`) VALUES ('2', '1', '1');
INSERT INTO `blog_post_tag_rel` (`id`, `post_id`, `tag_id`) VALUES ('3', '1', '3');


#
# TABLE STRUCTURE FOR: blog_posts
#

DROP TABLE IF EXISTS `blog_posts`;

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `author_id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `content_brief` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('draft','active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_posts` (`id`, `category_id`, `author_id`, `title`, `content_brief`, `content`, `publish_time`, `status`) VALUES ('1', '1', '1', 'Blog Post 1', '<p>\r\n	Blog Post 1 Content Brief</p>\r\n', '<p>\r\n	Blog Post 1 Content</p>\r\n', '2015-09-26 00:00:00', 'active');


#
# TABLE STRUCTURE FOR: blog_tags
#

DROP TABLE IF EXISTS `blog_tags`;

CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `blog_tags` (`id`, `title`) VALUES ('1', 'Tag 1');
INSERT INTO `blog_tags` (`id`, `title`) VALUES ('2', 'Tag 2');
INSERT INTO `blog_tags` (`id`, `title`) VALUES ('3', 'Tag 3');


#
# TABLE STRUCTURE FOR: cover_photos
#

DROP TABLE IF EXISTS `cover_photos`;

CREATE TABLE `cover_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES ('1', '2', '45296-2.jpg', 'active');
INSERT INTO `cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES ('2', '1', '2934f-1.jpg', 'active');
INSERT INTO `cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES ('3', '3', '3717d-3.jpg', 'active');


#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('1', 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('2', 'manager', 'Manager');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('3', 'staff', 'Staff');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('4', 'members', 'General User');


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('1', '127.0.0.1', 'admin', '$2y$08$2ARPIbr6jpuorpV8kXb5UuY577jjZ2wIsCBlZsXO6UUNvmGbc3fLe', NULL, '', NULL, NULL, NULL, NULL, '1447915390', '1448264061', '1', 'Admin', NULL, NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('2', '127.0.0.1', 'manager', '$2y$08$HNeY0TJaGvLywt6AY5Bo3ujl4sPwPzSGOv/R9Y6nuYopBQUdWwU2O', NULL, '', NULL, NULL, NULL, NULL, '1447915390', '1447915490', '1', 'Manager', NULL, NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('3', '127.0.0.1', 'staff', '$2y$08$.HZ5N74rMwtL8eX1eySehe3QsEg/n0vpWJSx3IZPYHp.PlvnO6hjO', NULL, '', NULL, NULL, NULL, NULL, '1447915390', '1447915481', '1', 'Staff', NULL, NULL, NULL);
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('4', '127.0.0.1', 'member', '$2y$08$0EELOw5PYr0k43Rga2M4QOw.JF5WE68Qwp80KHHV1omwYUn.OYPOm', NULL, '', NULL, NULL, NULL, NULL, '1447915463', NULL, '1', 'Member', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('1', '1', '1');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('2', '2', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('3', '3', '3');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('4', '4', '4');


