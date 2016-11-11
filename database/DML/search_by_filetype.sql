/* 
* Returns all rows of manifest, research_object, files, and users related to filetype received as input.
*/
DELIMITER //

CREATE PROCEDURE search_by_filetype(IN filetype VARCHAR(20))
	BEGIN
		SELECT *
		FROM OCDXGroup1.manifest, OCDXGroup1.research_object, OCDXGroup1.users, OCDXGroup1.files
		WHERE manifest.manifest_id = research_object.manifest_id AND 
			research_object.research_object_id = files.research_object_id AND
			users.user_id = manifest.user_id AND
			files.format = filetype;
	END
//

DELIMITER ;