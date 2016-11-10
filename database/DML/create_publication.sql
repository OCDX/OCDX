/*
* Receives key to research_object and publication and creates a new row in publication table.
*/
DELIMITER //

CREATE PROCEDURE create_publication(IN research_object_id_in INT(10), IN publication_in VARCHAR(100))
	BEGIN
	INSERT INTO `OCDXGroup1`.`publication`
	(`publication`,
	`research_object_id`)
	VALUES
	(publication_in,
	research_object_id_in);
    END
//

DELIMITER ;

