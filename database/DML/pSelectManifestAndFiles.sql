CREATE DEFINER=`daniel`@`%` PROCEDURE `pSelectManifestAndFiles`(IN manifest_id_in INT(10))
BEGIN
    SELECT  manifest.standards_versions, manifest.date_created, manifest.comment, manifest.user_id, manfest.title,
		files.name, files.format, files.abstract, files.size, files.url, files.checksum, files.created_on
    FROM OCDXGroup1.manifest
		INNER JOIN OCDXGroup1.research_object
			ON manifest.manifest_id = research_object.manifest_id
		INNER JOIN OCDXGroup1.files
			ON research_object.research_object_id = files.research_object_id
	WHERE manifest.manifest_id = manifest_id_in;
  END