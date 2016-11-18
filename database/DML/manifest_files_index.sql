ALTER TABLE `OCDXGroup1`.`manifest` 
ADD INDEX `manifest_files_index` (`manifest_id` ASC, `standards_versions` ASC, `date_created` ASC, `comment` ASC, `user_id` ASC, `title` ASC);
ALTER TABLE `OCDXGroup1`.`files` 
ADD INDEX `manifest_files_index` (`name` ASC, `format` ASC, `abstract` ASC, `size` ASC, `url` ASC, `checksum` ASC, `created_on` ASC, `research_object_id` ASC);
ALTER TABLE `OCDXGroup1`.`research_object` 
ADD INDEX `manifest_files_index` (`research_object_id` ASC, `manifest_id` ASC);
