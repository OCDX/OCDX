CREATE TABLE `anonymized_data` (
  `anonymized_data_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Indicated whether anyting has been excluded, removed or altered in the dataset in order to protect the identities, integrity and rights of participants.',
  `label` varchar(100) DEFAULT NULL COMMENT 'Indicates oversight type, choose one: IRB, REB, REC',
  `research_object_id` int(10) NOT NULL,
  PRIMARY KEY (`anonymized_data_id`),
  KEY `research_object_id_idx` (`research_object_id`),
  CONSTRAINT `anonymized_data_research_object_key` FOREIGN KEY (`research_object_id`) REFERENCES `research_object` (`research_object_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
