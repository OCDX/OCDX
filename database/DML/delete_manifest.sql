/*
* Receives title of manifest and user_id of current user. Deletes row from manifest table.alter
*/

DELIMITER //

CREATE PROCEDURE delete_manifest(IN title_in VARCHAR(100), IN user_id INT(10))
	BEGIN
	DELETE FROM `OCDXGroup1`.`manifest`
	WHERE manifest.title = title_in AND
		manifest.user_id = user_id_in;
	END
//

DELIMITER ;
