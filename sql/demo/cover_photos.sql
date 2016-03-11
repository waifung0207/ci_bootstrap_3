#
# TABLE STRUCTURE FOR: demo_cover_photos
#

DROP TABLE IF EXISTS `demo_cover_photos`;

CREATE TABLE `demo_cover_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','hidden') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `demo_cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES ('1', '2', '45296-2.jpg', 'active');
INSERT INTO `demo_cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES ('2', '1', '2934f-1.jpg', 'active');
INSERT INTO `demo_cover_photos` (`id`, `pos`, `image_url`, `status`) VALUES ('3', '3', '3717d-3.jpg', 'active');


