DELIMITER $$
CREATE DEFINER=`daniel`@`%` PROCEDURE `pInsertLocation`(IN research_object_id_in INT(10), IN url_in VARCHAR(100), IN comment_in VARCHAR(500))
BEGIN
	INSERT INTO `OCDXGroup1`.`locations`
	(`URL`,
	`comment`,
	`research_object_id`)
	VALUES
	(url_in,
	comment_in,
	research_object_id_in);
    END$$
DELIMITER ;
