/*
* Receives all the fields of a research_object and inserts into a new row. Returns key of newly created row.
* Oversigh_type, permissions, and date are optional fields. All other parameters must be non-NULL.
*/
DELIMITER //

CREATE PROCEDURE create_research_object(OUT research_object_id_out INT(10), IN title_in VARCHAR(50), IN abstract_in VARCHAR(500), IN oversight_in TINYINT(1), 
	IN oversight_type_in VARCHAR(30), IN informed_consent_in VARCHAR(100), IN privacy_considerations_in VARCHAR(100), IN provenance_in VARCHAR(100),
    IN permissions_in VARCHAR(100), IN date_in DATETIME, IN manifest_id_in INT(10))
    BEGIN
		INSERT INTO `OCDXGroup1`.`research_object`
		(`title`,
		`abstract`,
		`oversight`,
		`oversight_type`,
		`informed_consent`,
		`privacy_considerations`,
		`provenance`,
		`permissions`,
		`date`,
		`manifest_id`)
		VALUES
		(title_in,
		abstract_in,
		oversight_in,
		oversight_type_in,
		informed_consent_in,
		privacy_considerations_in,
		provenance_in,
		permissions_in,
		date_in,
		manifest_id_in);
        
        SELECT LAST_INSERT_ID() INTO research_object_id_out;
	END
//

DELIMITER ;