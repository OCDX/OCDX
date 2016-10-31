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
