/*
* Receives all the fields of a file and inserts into a new row. Returns key of newly created row.
* Abstract is the only optional field. All other parameters must be non-NULL.
*/
DELIMITER //

CREATE PROCEDURE create_file(OUT file_id_out INT(10), IN name_in VARCHAR(50), IN format_in VARCHAR(20), IN abstract_in VARCHAR(500), 
	IN size_in INT(11), IN url_in VARCHAR(100), IN checksum_in VARCHAR(50), IN created_on_in DATETIME, IN research_object_id_in INT(10))
    BEGIN
		INSERT INTO `OCDXGroup1`.`files`
		(`name`,
		`format`,
		`abstract`,
		`size`,
		`url`,
		`checksum`,
		`research_object_id`,
		`created_on`)
		VALUES
		(name_in,
		format_in,
		abstract_in,
		size_in,
		url_in,
		checksum_in,
		reseach_object_id_in,
		created_on_in);
        
        SELECT LAST_INSERT_ID() INTO file_id_out;
	END
//

DELIMITER ;
