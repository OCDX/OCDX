/*
* Receives fields pertaining to a researcher and creates a new researcher entry.
*/
DELIMITER //

CREATE PROCEDURE create_researcher(IN name_in VARCHAR(100), IN role_in VARCHAR(50), IN contact_in VARCHAR(50))
	BEGIN
	INSERT INTO `OCDXGroup1`.`researchers`
	(`name`,
	`role`,
	`type`,
	`contact`)
	VALUES
	(name_in,
	role_in,
	type_in,
	contact_in);
    END
//

DELIMITER ;