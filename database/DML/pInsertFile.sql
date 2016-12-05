CREATE PROCEDURE `pInsertFile`(`fileName` VARCHAR(50), `format` VARCHAR(20), `abstract` VARCHAR(500), `size` INT(11),
                               `url`      VARCHAR(100), `checksum` VARCHAR(50), `research_id` INT(10))
  BEGIN
INSERT INTO files(file_id,name,format,abstract,size,url,checksum,research_object_id,created_on)
VALUES (DEFAULT,fileName,format,abstract,size,url,checksum,research_id,NOW());
END