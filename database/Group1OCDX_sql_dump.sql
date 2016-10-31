CREATE TABLE `researchers` (
  `researcher_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL COMMENT 'Educational institutions; Government; NGO; Individual; Private for profit entity, No Assertion.',
  `contact` varchar(50) NOT NULL,
  PRIMARY KEY (`researcher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `users`(
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
    `username` varchar(30) DEFAULT NULL,
  `hashed_password` varchar(200) DEFAULT NULL,
    `created_on` datetime NOT NULL,
      PRIMARY KEY (`user_id`)
)
CREATE TABLE `manifest` (
  `manifest_id` int(10) NOT NULL AUTO_INCREMENT,
  `standards_versions` varchar(64) NOT NULL COMMENT 'Declaration of start for a record using ocdxManifest schema v.1',
  `date_created` datetime NOT NULL,
  `comment` varchar(128) DEFAULT NULL,
  `user_id` INT(10) NOT NULL,
  PRIMARY KEY (`manifest_id`),
   CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
CREATE TABLE `research_object` (
  `title` varchar(20) DEFAULT NULL COMMENT 'A one sentence for the dataset. If a title is not given, provide one sentence that describes the dataset contents. Whenever possible copy from source.',
  `abstract` varchar(100) NOT NULL COMMENT 'A complete summary of the dataset ',
  `research_object_id` int(10) NOT NULL AUTO_INCREMENT,
  `oversight` tinyint(1) NOT NULL COMMENT 'Was institutional oversight applied to date collection and/or analysis',
  `oversight_type` varchar(30) DEFAULT NULL,
  `informed_consent` varchar(100) NOT NULL,
  `privacy_considerations` varchar(100) NOT NULL,
  `provenance` varchar(100) NOT NULL COMMENT 'A brief description of what the data set does ',
  `permissions` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `manifest_id` int(10) NOT NULL,
  PRIMARY KEY (`research_object_id`),
  KEY `manifest_id_idx` (`manifest_id`),
  CONSTRAINT `research_objects_manifest_key` FOREIGN KEY (`manifest_id`) REFERENCES `manifest` (`manifest_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE researcher_contributed_to_research_object (
 `researcher_id` INT(10) NOT NULL,
   `research_object_id` int(10) NOT NULL,
   `contributed_on` DATETIME NOT NULL,
  CONSTRAINT `researcher_id_fk` FOREIGN KEY (`researcher_id`) REFERENCES `researchers` (`researcher_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
   CONSTRAINT `research_object_id_fk` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
);