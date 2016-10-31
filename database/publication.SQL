CREATE TABLE `publication` (
  `publication_id` int(10) NOT NULL,
  `publication` varchar(100) DEFAULT NULL,
  `research_object_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `publication_research_objects_key_idx` (`research_object_id`),
  CONSTRAINT `publication_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
