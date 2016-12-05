CREATE PROCEDURE `pUpdateManifest`(`standards_versions_in` VARCHAR(64), `comment_in` VARCHAR(500),
                                   `title_in`              VARCHAR(50), `manifestid_in` INT(11))
  BEGIN
    UPDATE `OCDXGroup1`.`manifest`
    SET `standards_versions` = standards_versions_in,
     `comment` = comment_in,
     `title` = title_in
    WHERE manifest_id = manifestid_in;
  END