CREATE TABLE `anonymized_data` (
  `anonymized_data_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Indicated whether anyting has been excluded, removed or altered in the dataset in order to protect the identities, integrity and rights of participants.',
  `label` varchar(100) DEFAULT NULL COMMENT 'Indicates oversight type, choose one: IRB, REB, REC',
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`anonymized_data_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `anonymized_data_research_object_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `dates` (
  `date` datetime DEFAULT NULL,
  `dates_id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) DEFAULT NULL,
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`dates_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `dates_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `format` varchar(20) NOT NULL,
  `abstract` varchar(500) DEFAULT NULL,
  `size` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `checksum` varchar(50) NOT NULL,
  `research_object_id` int(10) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `files_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `locations` (
  `location_id` int(10) NOT NULL,
  `URL` varchar(64) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `locations_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `publication` (
  `publication_id` int(10) NOT NULL,
  `publication` varchar(100) DEFAULT NULL,
  `research_object_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `publication_research_objects_key_idx` (`research_object_id`),
  CONSTRAINT `publication_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
