CREATE TABLE `locations` (
  `location_id` int(10) NOT NULL,
  `URL` varchar(64) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `locations_research_objects_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
