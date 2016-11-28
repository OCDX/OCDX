CREATE DEFINER=`daniel`@`%` PROCEDURE `pSelectRecentlyAdded`()
BEGIN
    SELECT  *
    FROM OCDXGroup1.manifest
    ORDER BY manifest.date_created DESC LIMIT 4;
  END
