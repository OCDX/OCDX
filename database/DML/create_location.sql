/*
* Receives key to research_object and fields to a location and makes a new row in the locations table.
* Url and Comment are optional parameters. Research_object_id is required.
*/
DELIMITER //

CREATE PROCEDURE create_location(IN research_object_id_in INT(10), IN url_in VARCHAR(100), IN comment_in VARCHAR(500))
	BEGIN
	INSERT INTO `OCDXGroup1`.`locations`
	(`URL`,
	`comment`,
	`research_object_id`)
	VALUES
	(url_in,
	comment_in,
	research_object_id_in);
    END
//

DELIMITER ;
