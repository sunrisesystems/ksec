#2nd Oct 2016

ALTER TABLE `cities` CHANGE `City` `city` VARCHAR( 100 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

#4th Oct 2016
ALTER TABLE  `call_types` ADD  `description` VARCHAR( 255 ) NOT NULL AFTER  `status` ;

# 16th Oct 2016
CREATE TABLE IF NOT EXISTS `code` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `code` (`id`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Employee Category', '2016-10-02 11:52:52', '2016-10-02 11:52:52', NULL),
(2, 'Call Duration', '2016-10-02 11:52:52', '2016-10-02 11:52:52', NULL),
(3, 'Fatal Reason', '2016-10-02 11:52:52', '2016-10-02 11:52:52', NULL);


CREATE TABLE IF NOT EXISTS `code_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_id` int(11) NOT NULL,
  `code_value` varchar(255) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


INSERT INTO `code_values` (`id`, `code_id`, `code_value`, `status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Production', 'A', 'Production', '2016-10-02 17:23:33', '2016-10-02 17:23:33', NULL),
(2, 2, '1', 'A', 'call duration - 1', '2016-10-16 19:14:05', '2016-10-16 19:14:05', NULL);

