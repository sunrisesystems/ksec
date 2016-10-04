#2nd Oct 2016

ALTER TABLE `cities` CHANGE `City` `city` VARCHAR( 100 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ;

#4th Oct 2016
ALTER TABLE  `call_types` ADD  `description` VARCHAR( 255 ) NOT NULL AFTER  `status` ;
