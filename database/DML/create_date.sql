/*
* Receives key to research_object and the fields to a date and creates a new row in dates table.
*/
DELIMITER //

CREATE PROCEDURE create_date(IN research_object_id_in INT(10), IN date_in DATETIME, IN label_in VARCHAR(100))
	BEGIN
	INSERT INTO `OCDXGroup1`.`dates`
	(`date`,
	`label`,
	`research_object_id`)
	VALUES
	(date_in,
	label_in,
	research_object_id_in);
    END
//

DELIMITER ;