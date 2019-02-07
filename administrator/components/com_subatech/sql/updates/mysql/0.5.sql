CREATE TABLE `#__jobs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_start` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `contacts` text CHARACTER SET utf8 NOT NULL,
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `how_to_apply` text CHARACTER SET utf8 NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `attribs` varchar(5120) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `alias` (`alias`)
);

CREATE TABLE `#__events` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pre_summary` longtext CHARACTER SET utf8 NOT NULL,
  `post_summary` longtext CHARACTER SET utf8 NOT NULL,
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `url_more_info` text CHARACTER SET utf8 NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `attribs` varchar(5120) CHARACTER SET utf8 NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `alias` (`alias`)
);

INSERT INTO `#__events` VALUES(4, '2012-09-18 00:00:00', '2012-09-20 00:00:00', '', 'rencontres-lcg-france', '<p>LCG-BZH</p>', '', 0, '0000-00-00 00:00:00', 'Rencontres LCG-France', '', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '2012-07-03 09:50:44', '0000-00-00 00:00:00', '');
