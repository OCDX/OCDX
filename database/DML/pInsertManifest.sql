DELIMITER $$
CREATE DEFINER=`daniel`@`%` PROCEDURE `pInsertManifest`(IN standards_versions_in VARCHAR(64), IN comment_in VARCHAR(500), 
	IN user_id_in INT(10), IN title_in VARCHAR(50))
BEGIN
		INSERT INTO `OCDXGroup1`.`manifest`
		(`standards_versions`,
		`date_created`,
		`comment`,
		`user_id`,
		`title`)
		VALUES
		(standards_versions_in,
		NOW(),
		comment_in,
		user_id_in,
		title_in);
        
        SELECT LAST_INSERT_ID() AS 'id';
	END$$
DELIMITER ;
