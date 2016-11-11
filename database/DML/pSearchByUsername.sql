DELIMITER $$
CREATE DEFINER=`daniel`@`%` PROCEDURE `pSearchByUsername`(IN username VARCHAR(30))
BEGIN
    SELECT *
    FROM OCDXGroup1.manifest
      INNER JOIN OCDXGroup1.research_object
        ON manifest.manifest_id = research_object.manifest_id
      INNER JOIN OCDXGroup1.users
        ON manifest.user_id = users.user_id
    WHERE users.username = username;
  END$$
DELIMITER ;
