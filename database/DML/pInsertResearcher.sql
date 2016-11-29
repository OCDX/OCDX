DELIMITER $$
CREATE DEFINER=`daniel`@`%` PROCEDURE `pInsertResearcher`(IN name_in VARCHAR(100), IN role_in VARCHAR(50),
                                                           IN type_IN VARCHAR(50), IN contact_in VARCHAR(50))
BEGIN
    INSERT INTO `OCDXGroup1`.`researchers`
    (`researcher_id`,
     `name`,
     `role`,
     `type`,
     `contact`)
    VALUES
      (DEFAULT,
       name_in,
       role_in,
       type_in,
       contact_in);
  END$$
DELIMITER ;
