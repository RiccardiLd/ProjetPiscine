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
    `username` VARCHAR(12),
    `email` VARCHAR(40) NOT NULL,
    `password` VARCHAR(40) NOT NULL,
    `first_name` VARCHAR(12) NOT NULL,
    `last_name` VARCHAR(12) NOT NULL,
    `profile_photo` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Link to the profile photo',
    `summary` MEDIUMTEXT NULL DEFAULT NULL,
    `status` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Normal user, enterprise, admin',
    `graduation` YEAR NULL DEFAULT NULL,
    PRIMARY KEY (`username`)
);

-- ---
-- Table 'posts'
-- 
-- ---

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
    `post_id` INTEGER NOT NULL AUTO_INCREMENT,
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
    `username_user1` VARCHAR(12),
    `username_user2` VARCHAR(12),
    `type` VARCHAR(20) NULL DEFAULT NULL COMMENT 'friend/professional',
    `connected` TINYINT NULL DEFAULT 0 COMMENT 'decides if two people are connected to each other',
    `timestamp` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`username_user1`, `username_user2`)
);

-- ---
-- Table 'comments'
-- 
-- ---

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
    `comment_id` INTEGER NOT NULL AUTO_INCREMENT,
    `post_id` INTEGER,
    `username_user` VARCHAR(12),
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
    `username_user` VARCHAR(12),
    `post_id` INTEGER,
    `timestamp` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`post_id`, `username_user`)
);

-- ---
-- Table 'conversations'
-- 
-- ---

DROP TABLE IF EXISTS `conversations`;

CREATE TABLE `conversations` (
    `conv_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(40) NULL DEFAULT NULL,
    PRIMARY KEY (`conv_id`)
);

-- ---
-- Table 'member'
-- 
-- ---

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
    `conv_id` INTEGER,
    `username` VARCHAR(12),
    PRIMARY KEY (`username`, `conv_id`)
);

-- ---
-- Table 'messages'
-- 
-- ---

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
    `message_id` INTEGER NOT NULL AUTO_INCREMENT,
    `conv_id` INTEGER,
    `username` VARCHAR(12),
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
    `skill_id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(12),
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
    `notif_id` INTEGER NOT NULL AUTO_INCREMENT,
    `parent_id` INTEGER NULL DEFAULT NULL COMMENT 'id of parent (msg, comment, like)',
    `type` VARCHAR(20) NULL DEFAULT NULL COMMENT 'Type of notification (msg, comment, like, etc)',
    `seen` TINYINT NULL DEFAULT 0,
    `timestamp` TIMESTAMP NULL DEFAULT NULL,
    `user_create` VARCHAR(12),
    `user_receive` VARCHAR(12),
    PRIMARY KEY (`notif_id`)
);

-- ---
-- Table 'group_member'
-- 
-- ---

DROP TABLE IF EXISTS `group_member`;

CREATE TABLE `group_member` (
    `group_id` INTEGER,
    `username` VARCHAR(12),
    PRIMARY KEY (`username`, `group_id`)
);

-- ---
-- Table 'group'
-- 
-- ---

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
    `group_id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(20) NULL DEFAULT NULL,
    PRIMARY KEY (`group_id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `posts` ADD FOREIGN KEY (username) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `posts` ADD FOREIGN KEY (id_shared_post) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `contacts` ADD FOREIGN KEY (username_user1) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `contacts` ADD FOREIGN KEY (username_user2) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comments` ADD FOREIGN KEY (post_id) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comments` ADD FOREIGN KEY (username_user) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `likes` ADD FOREIGN KEY (username_user) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `likes` ADD FOREIGN KEY (post_id) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `member` ADD FOREIGN KEY (conv_id) REFERENCES `conversations` (`conv_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `member` ADD FOREIGN KEY (username) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `messages` ADD FOREIGN KEY (conv_id) REFERENCES `conversations` (`conv_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `messages` ADD FOREIGN KEY (username) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `skills` ADD FOREIGN KEY (username) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `notifications` ADD FOREIGN KEY (user_create) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `notifications` ADD FOREIGN KEY (user_receive) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `group_member` ADD FOREIGN KEY (group_id) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `group_member` ADD FOREIGN KEY (username) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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

 INSERT INTO `users` (`username`,`email`,`password`,`first_name`,`last_name`,`profile_photo`,`summary`,`status`) VALUES
 ('ECE','jpsegado@inseec.com','mdpece123','Jean-Pierre','Segado','https://yt3.ggpht.com/a-/AJLlDp2x-fgmhrERh8qNaRtLo86xQs09uviBihXZzg=s900-mo-c-c0xffffffff-rj-k-no','','admin'),
 ('RiccardiLd','gianni.riccardi@edu.ece.fr','cykablyat','Gianni','Riccardi','https://i0.wp.com/nerdgeekfeelings.com/wp-content/uploads/2014/12/nem-os-cavaleiros-do-zodiaco-escapam-da-zoeira-aldebaran-de-touro-ataca-de-hue-hue-no-meme-1409768309835_956x500.png','','admin'),
 ('JoVieira','joel.vieira@edu.ece.fr','cykablyat2','Joel','Vieira','https://i.imgur.com/jVGsvvF.jpg','','admin'),
 ('Reinim','theo.minier@edu.ece.fr','cykablyat3','Théo','Minier','http://a397.idata.over-blog.com/300x426/4/23/42/31/67/jesus.jpg','','admin');

 INSERT INTO `posts` (`username`,`privacy`,`type`,`text`,`content`,`timestamp`,`id_shared_post`) VALUES
 ('ECE','public','emploi','Offre de CDD - AXA','','2018-05-05 12:23:33',''),
 ('ECE','public','emploi','Offre de stage - Société Générale','','2018-05-05 12:25:24',''),
 ('ECE','public','emploi','Offre de CDD - Google','','2018-05-05 12:29:42',''),
 ('ECE','public','emploi','Offre de stage - Microsoft','','2018-05-05 12:33:34',''),
 ('ECE','public','emploi','Offre de stage - Apple','','2018-05-05 12:55:46',''),
 ('ECE','public','emploi','Offre de stage - ECE','','2018-05-05 13:02:32','');

 INSERT INTO `contacts` (`username_user1`,`username_user2`,`type`,`connected`,`timestamp`) VALUES
 ('ECE','RiccardiLd','','1','2018-04-20 13:23:44'),
 ('ECE','JoVieira','','1','2018-04-20 13:24:44'),
 ('ECE','Reinim','','1','2018-04-20 13:25:44');

-- INSERT INTO `comments` (`comment_id`,`post_id`,`username_user`,`content`,`timestamp`) VALUES
-- ('','','','','');

-- INSERT INTO `likes` (`username_user`,`post_id`,`timestamp`) VALUES
-- ('','','');

 INSERT INTO `conversations` (`title`) VALUES
 ('LinkedOff Official');

 INSERT INTO `member` (`conv_id`,`username`) VALUES
 ('1','RiccardiLd'),
 ('1','JoVieira'),
 ('1','Reinim');

-- INSERT INTO `messages` (`message_id`,`conv_id`,`username`,`content`,`timestamp`) VALUES
-- ('','','','','');

 INSERT INTO `skills` (`username`,`skill`,`skill_level`) VALUES
 ('Reinim','C++','Avancé'),
 ('RiccardiLd','Java','Avancé'),
 ('JoVieira','Web Design','Avancé');

 INSERT INTO `notifications` (`parent_id`,`type`,`seen`,`timestamp`,`user_create`,`user_receive`) VALUES
('0','post','0','NOW()', 'ECE', 'RiccardiLd'),
('0','post','0','NOW()', 'ECE', 'JoVieira'),
('0','post','0','NOW()', 'ECE', 'Reinim'),
('0','post','0','NOW()', 'ECE', 'ECE');

-- INSERT INTO `group_member` (`group_id`,`username`) VALUES
-- ('','');

-- INSERT INTO `group` (`group_id`,`title`) VALUES
-- ('','');
