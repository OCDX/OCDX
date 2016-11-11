/* 
* Returns all rows of manifest, research_object, and users related to username received as input.
*/
DELIMITER //

CREATE PROCEDURE search_by_username(IN username VARCHAR(30))
	BEGIN
		SELECT *
		FROM OCDXGroup1.manifest, OCDXGroup1.research_object, OCDXGroup1.users
		WHERE manifest.manifest_id = research_object.manifest_id AND
			manifest.user_id = users.user_id AND
			users.username = username;
	END
//

DELIMITER ;