-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'users'
-- 
-- ---

DROP TABLE IF EXISTS `users`;
		
CREATE TABLE `users` (
  `username` VARCHAR(12) NULL DEFAULT NULL,
  `email` VARCHAR(40) NULL DEFAULT NULL,
  `password` VARCHAR(40) NULL DEFAULT NULL,
  `first_name` VARCHAR(12) NULL DEFAULT NULL,
  `last_name` VARCHAR(12) NULL DEFAULT NULL,
  `profile_photo` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Link to the profile photo',
  `summary` MEDIUMTEXT NULL DEFAULT NULL,
  `status` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Normal user, enterprise, admin',
  PRIMARY KEY (`username`)
);

-- ---
-- Table 'posts'
-- 
-- ---

DROP TABLE IF EXISTS `posts`;
		
CREATE TABLE `posts` (
  `post_id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `username` VARCHAR(12) NULL DEFAULT NULL,
  `privacy` VARCHAR(20) NULL DEFAULT NULL,
  `type` VARCHAR(20) NULL DEFAULT NULL COMMENT 'type of post',
  `text` MEDIUMTEXT NULL DEFAULT NULL,
  `content` VARCHAR(40) NULL DEFAULT NULL COMMENT 'Articles, sites',
  `timestamp` TIMESTAMP NULL DEFAULT NULL,
  `id_shared_post` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`)
);

-- ---
-- Table 'contacts'
-- 
-- ---

DROP TABLE IF EXISTS `contacts`;
		
CREATE TABLE `contacts` (
  `username_user1` VARCHAR(12) NULL DEFAULT NULL,
  `username_user2` VARCHAR(12) NULL DEFAULT NULL,
  `type` VARCHAR(20) NULL DEFAULT NULL COMMENT 'friend/professional',
  `connected` TINYINT NULL DEFAULT 0 COMMENT 'decides if two people are connected to each other, seeing th',
  `timestamp` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`username_user1`, `username_user2`)
);

-- ---
-- Table 'comments'
-- 
-- ---

DROP TABLE IF EXISTS `comments`;
		
CREATE TABLE `comments` (
  `comment_id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `post_id` INTEGER NULL DEFAULT NULL,
  `username_user` VARCHAR(12) NULL DEFAULT NULL,
  `content` MEDIUMTEXT NULL DEFAULT NULL,
  `timestamp` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`comment_id`, `post_id`)
);

-- ---
-- Table 'likes'
-- 
-- ---

DROP TABLE IF EXISTS `likes`;
		
CREATE TABLE `likes` (
  `username_user` VARCHAR(12) NULL DEFAULT NULL,
  `post_id` INTEGER NULL DEFAULT NULL,
  `timestamp` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`, `username_user`)
);

-- ---
-- Table 'conversations'
-- 
-- ---

DROP TABLE IF EXISTS `conversations`;
		
CREATE TABLE `conversations` (
  `conv_id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `title` VARCHAR(40) NULL DEFAULT NULL,
  PRIMARY KEY (`conv_id`)
);

-- ---
-- Table 'member'
-- 
-- ---

DROP TABLE IF EXISTS `member`;
		
CREATE TABLE `member` (
  `conv_id` INTEGER NULL DEFAULT NULL,
  `username` VARCHAR(12) NULL DEFAULT NULL,
  PRIMARY KEY (`username`, `conv_id`)
);

-- ---
-- Table 'messages'
-- 
-- ---

DROP TABLE IF EXISTS `messages`;
		
CREATE TABLE `messages` (
  `message_id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `conv_id` INTEGER NULL DEFAULT NULL,
  `username` VARCHAR(12) NULL DEFAULT NULL,
  `content` MEDIUMTEXT NULL DEFAULT NULL,
  `timestamp` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`message_id`)
);

-- ---
-- Table 'skills'
-- 
-- ---

DROP TABLE IF EXISTS `skills`;
		
CREATE TABLE `skills` (
  `skill_id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `username` VARCHAR(12) NULL DEFAULT NULL,
  `skill` VARCHAR(40) NULL DEFAULT NULL,
  `skill_level` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`skill_id`)
);

-- ---
-- Table 'notifications'
-- 
-- ---

DROP TABLE IF EXISTS `notifications`;
		
CREATE TABLE `notifications` (
  `notif_id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `parent_id` INTEGER NULL DEFAULT NULL COMMENT 'id of parent (msg, comment, like)',
  `type` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Type of notification (msg, comment, like, etc)',
  `seen` TINYINT NULL DEFAULT 0,
  `user_create` VARCHAR(12) NULL DEFAULT NULL,
  `user_receive` VARCHAR(12) NULL DEFAULT NULL,
  PRIMARY KEY (`notif_id`)
);

-- ---
-- Table 'group_member'
-- 
-- ---

DROP TABLE IF EXISTS `group_member`;
		
CREATE TABLE `group_member` (
  `group_id` INTEGER NULL DEFAULT NULL,
  `username` VARCHAR(12) NULL DEFAULT NULL,
  PRIMARY KEY (`username`, `group_id`)
);

-- ---
-- Table 'group'
-- 
-- ---

DROP TABLE IF EXISTS `group`;
		
CREATE TABLE `group` (
  `group_id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `title` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `posts` ADD FOREIGN KEY (username) REFERENCES `users` (`username`);
ALTER TABLE `posts` ADD FOREIGN KEY (id_shared_post) REFERENCES `posts` (`post_id`);
ALTER TABLE `contacts` ADD FOREIGN KEY (username_user1) REFERENCES `users` (`username`);
ALTER TABLE `contacts` ADD FOREIGN KEY (username_user2) REFERENCES `users` (`username`);
ALTER TABLE `comments` ADD FOREIGN KEY (post_id) REFERENCES `posts` (`post_id`);
ALTER TABLE `comments` ADD FOREIGN KEY (username_user) REFERENCES `users` (`username`);
ALTER TABLE `likes` ADD FOREIGN KEY (username_user) REFERENCES `users` (`username`);
ALTER TABLE `likes` ADD FOREIGN KEY (post_id) REFERENCES `posts` (`post_id`);
ALTER TABLE `member` ADD FOREIGN KEY (conv_id) REFERENCES `conversations` (`conv_id`);
ALTER TABLE `member` ADD FOREIGN KEY (username) REFERENCES `users` (`username`);
ALTER TABLE `messages` ADD FOREIGN KEY (conv_id) REFERENCES `conversations` (`conv_id`);
ALTER TABLE `messages` ADD FOREIGN KEY (username) REFERENCES `users` (`username`);
ALTER TABLE `skills` ADD FOREIGN KEY (username) REFERENCES `users` (`username`);
ALTER TABLE `notifications` ADD FOREIGN KEY (user_create) REFERENCES `users` (`username`);
ALTER TABLE `notifications` ADD FOREIGN KEY (user_receive) REFERENCES `users` (`username`);
ALTER TABLE `group_member` ADD FOREIGN KEY (group_id) REFERENCES `group` (`group_id`);
ALTER TABLE `group_member` ADD FOREIGN KEY (username) REFERENCES `users` (`username`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `posts` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `contacts` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `comments` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `likes` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `conversations` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `member` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `messages` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `skills` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `notifications` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `group_member` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `group` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `users` (`username`,`email`,`password`,`first_name`,`last_name`,`profile_photo`,`summary`,`status`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `posts` (`post_id`,`username`,`privacy`,`type`,`text`,`content`,`timestamp`,`id_shared_post`) VALUES
-- ('','','','','','','','');
-- INSERT INTO `contacts` (`username_user1`,`username_user2`,`type`,`connected`,`timestamp`) VALUES
-- ('','','','','');
-- INSERT INTO `comments` (`comment_id`,`post_id`,`username_user`,`content`,`timestamp`) VALUES
-- ('','','','','');
-- INSERT INTO `likes` (`username_user`,`post_id`,`timestamp`) VALUES
-- ('','','');
-- INSERT INTO `conversations` (`conv_id`,`title`) VALUES
-- ('','');
-- INSERT INTO `member` (`conv_id`,`username`) VALUES
-- ('','');
-- INSERT INTO `messages` (`message_id`,`conv_id`,`username`,`content`,`timestamp`) VALUES
-- ('','','','','');
-- INSERT INTO `skills` (`skill_id`,`username`,`skill`,`skill_level`) VALUES
-- ('','','','');
-- INSERT INTO `notifications` (`notif_id`,`parent_id`,`type`,`seen`,`user_create`,`user_receive`) VALUES
-- ('','','','','','');
-- INSERT INTO `group_member` (`group_id`,`username`) VALUES
-- ('','');
-- INSERT INTO `group` (`group_id`,`title`) VALUES
-- ('','');