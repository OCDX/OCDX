/* 
* Receives all the fields of a manifest and inserts into a new row. Returns key of newly created row.
* Comment is the only optional field. All other parameters must be non-NULL.
*/
DELIMITER //

CREATE PROCEDURE create_manifest( OUT manifest_id_out INT(10), IN standards_versions_in VARCHAR(64), IN date_created_in DATETIME, IN comment_in VARCHAR(500), 
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
		date_created_in,
		comment_in,
		user_id_in,
		title_in);
        
        SELECT LAST_INSERT_ID() INTO manifest_id_out;
	END
//

DELIMITER ;

