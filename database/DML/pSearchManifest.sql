CREATE DEFINER=`daniel`@`%` PROCEDURE `pSearchManifest`(IN search VARCHAR(100))
  BEGIN
    SELECT  manifest.manifest_id,manifest.standards_versions AS 'title', manifest.comment AS 'description',users.username,files.name,manifest.date_created
    FROM OCDXGroup1.manifest
      INNER JOIN OCDXGroup1.research_object
        ON manifest.manifest_id = research_object.manifest_id
      INNER JOIN OCDXGroup1.users
        ON manifest.user_id = users.user_id
      INNER JOIN OCDXGroup1.files
        ON research_object.research_object_id = files.research_object_id
    WHERE manifest.title LIKE CONCAT('%',search,'%') OR manifest.comment LIKE CONCAT('%',search,'%');
  END;