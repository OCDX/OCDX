DELIMITER $$
CREATE DEFINER=`daniel`@`%` PROCEDURE `pInsertPublication`(IN research_object_id_in INT(10), IN publication_in VARCHAR(100))
BEGIN
	INSERT INTO `OCDXGroup1`.`publication`
	(`publication`,
	`research_object_id`)
	VALUES
	(publication_in,
	research_object_id_in);
    END$$
DELIMITER ;
