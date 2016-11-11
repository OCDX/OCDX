/*
* Receives key to research_object and all the fields to an anonymized_data entry and creates a new row in anonymized_data table.
*/
DELIMITER //

CREATE PROCEDURE create_anonymized_data(IN research_object_id_in INT(10), IN label_in VARCHAR(100))
	BEGIN
	INSERT INTO `OCDXGroup1`.`anonymized_data`
	(`label`,
	`research_object_id`)
	VALUES
	(label_in,
	research_object_id_in);
    END
//

DELIMITER ;
