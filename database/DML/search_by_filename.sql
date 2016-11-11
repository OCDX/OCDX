/* 
* Returns all rows of manifest, research_object, files, and users related to filename received as input.
*/
DELIMITER //

CREATE PROCEDURE search_by_filename(IN filename VARCHAR(50))
	BEGIN
		SELECT *
		FROM OCDXGroup1.manifest, OCDXGroup1.research_object, OCDXGroup1.users, OCDXGroup1.files
		WHERE manifest.manifest_id = research_object.manifest_id AND 
			research_object.research_object_id = files.research_object_id AND
			users.user_id = manifest.user_id AND
			files.name = filename;
	END
//

DELIMITER ;