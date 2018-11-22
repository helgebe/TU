CREATE DATABASE data;
ALTER DATABASE data CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE data;

-- -------------------------
-- Table structure for sites
-- -------------------------
DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `site_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`site_id`)
);

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `heading` varchar(255) NOT NULL,
  `sub_heading` varchar(255),
  `preabmle` varchar(1000),
  `relative_url` varchar(255) NOT NULL,
  `site_id` int(10) NOT NULL,
  `published_date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`),
  FOREIGN KEY (`site_id`) REFERENCES site(`site_id`)

);

-- ----------------------------
-- Table structure for authors
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `author_id` int(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  PRIMARY KEY (`author_id`)
);

-- -----------------------------------
-- Table structure for article_authors
-- -----------------------------------
DROP TABLE IF EXISTS `article_authors`;
CREATE TABLE `article_authors`(
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `author_id` int(10) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`author_id`) REFERENCES authors(`author_id`),
  FOREIGN KEY (`article_id`) REFERENCES articles(`article_id`)
);

-- -----------------------------------
-- Table structure for article_content
-- -----------------------------------
DROP TABLE IF EXISTS `article_content`;
CREATE TABLE `article_content`(
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`article_id`) REFERENCES articles(`article_id`)
);

-- -----------------------------------
-- Table structure for article_images
-- -----------------------------------
DROP TABLE IF EXISTS `article_images`;
CREATE TABLE `article_images`(
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `image_id` int(10) NOT NULL,
  `article_id` int(11) NOT NULL,
  `image_source` text,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`article_id`) REFERENCES articles(`article_id`)
);

