CREATE DEFINER=`daniel`@`%` PROCEDURE `pSumBytes`()
BEGIN
    SELECT  SUM(files.size) FROM OCDXGroup1.files WHERE DATE(files.created_on) = CURRENT_DATE;
  END