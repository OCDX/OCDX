DELIMITER $$
CREATE DEFINER=`daniel`@`%` PROCEDURE `pInsertAnonymizedData`(IN research_object_id_in INT(10), IN label_in VARCHAR(100))
BEGIN
	INSERT INTO `OCDXGroup1`.`anonymized_data`
	(`label`,
	`research_object_id`)
	VALUES
	(label_in,
	research_object_id_in);
    END$$
DELIMITER ;
