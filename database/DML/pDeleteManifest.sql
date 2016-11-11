DELIMITER $$
CREATE DEFINER=`daniel`@`%` PROCEDURE `pDeleteManifest`(IN manifest_id_in INT)
BEGIN
	DELETE FROM `OCDXGroup1`.`manifest`
	WHERE manifest_id = manifest_id_in;
	END$$
DELIMITER ;
