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


