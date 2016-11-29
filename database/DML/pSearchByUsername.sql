CREATE DEFINER=`daniel`@`%` PROCEDURE `pSearchByUsername`(IN username_in VARCHAR(30))
BEGIN
    SELECT  manifest.standards_versions, manifest.date_created, manifest.comment, manifest.user_id, manifest.title,
		files.name, files.format, files.abstract, files.size, files.url, files.checksum, files.created_on,
        users.user_id, users.username
    FROM OCDXGroup1.manifest
		INNER JOIN OCDXGroup1.research_object
			ON manifest.manifest_id = research_object.manifest_id
		INNER JOIN OCDXGroup1.files
			ON research_object.research_object_id = files.research_object_id
		INNER JOIN OCDXGroup1.users
			ON manifest.user_id = users.user_id
    WHERE users.username LIKE CONCAT('%',username_in,'%');
  END
