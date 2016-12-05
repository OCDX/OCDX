CREATE PROCEDURE `pDeleteFile`(`file_id` INT(11))
  BEGIN
  DELETE FROM files
    WHERE files.file_id = file_id;
END