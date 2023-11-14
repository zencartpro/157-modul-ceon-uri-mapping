###############################################################################################
# CEON URI Mapping 5.1.2 Install - 2023-11-04 - webchills
###############################################################################################

##############################
# Create new tables
##############################

CREATE TABLE IF NOT EXISTS ceon_uri_mapping_configs (
`id` INT UNSIGNED NOT NULL,
`version` VARCHAR(14) NOT NULL,
`autogen_new` INT(1) UNSIGNED NOT NULL,
`whitespace_replacement` INT(1) UNSIGNED NOT NULL,
`capitalisation` INT(1) UNSIGNED NOT NULL,
`remove_words` TEXT DEFAULT NULL,
`char_str_replacements` TEXT DEFAULT NULL,
`language_code_add` INT(1) UNSIGNED NOT NULL,
`mapping_clash_action` VARCHAR(11) DEFAULT 'warn',
`manage_product_reviews_mappings` INT(1) UNSIGNED DEFAULT 1,
`manage_product_reviews_info_mappings` INT(1) UNSIGNED DEFAULT 1,
`manage_product_reviews_write_mappings` INT(1) UNSIGNED DEFAULT 1,
`manage_ask_a_question_mappings` INT(1) UNSIGNED DEFAULT 1,
`automatic_version_checking` INT(1) UNSIGNED DEFAULT 1,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS ceon_uri_mapping_prp_uri_parts (
`page_type` VARCHAR(21) NOT NULL,
`language_code` CHAR(2) NOT NULL,
`uri_part` VARCHAR(50) NOT NULL,
PRIMARY KEY (`page_type`, `language_code`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS ceon_uri_mappings (
  `id` int(11) NOT NULL,
  `uri` TEXT NOT NULL,
  `language_id` int(11) UNSIGNED DEFAULT NULL,
  `current_uri` int(1) UNSIGNED DEFAULT 0,
  `main_page` varchar(45) DEFAULT NULL,
  `query_string_parameters` varchar(255) DEFAULT NULL,
  `associated_db_id` int(11) UNSIGNED DEFAULT NULL,
  `alternate_uri` varchar(255) DEFAULT NULL,
  `redirection_type_code` varchar(3) DEFAULT '301',
  `date_added` DATETIME NOT NULL DEFAULT '0001-01-01 00:00:00'
) ENGINE=MyISAM;

ALTER TABLE ceon_uri_mappings
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `assoc_db_id_idx` (`language_id`,`current_uri`,`main_page`,`associated_db_id`);
  
ALTER TABLE ceon_uri_mappings
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;