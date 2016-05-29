
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `roles` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(255),
    `news_option` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- auction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `auction`;

CREATE TABLE `auction`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `title` TEXT NOT NULL,
    `estimated_value` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    `documentation` TEXT,
    `ad_number` INTEGER(11),
    `publish_date` DATE NOT NULL,
    `gainer` VARCHAR(255),
    `contract_type` VARCHAR(255) NOT NULL,
    `funding_type` VARCHAR(255) NOT NULL,
    `contract_subject` TEXT,
    `offer_end_date` DATE NOT NULL,
    `apply_mode` VARCHAR(255),
    `contract_period` VARCHAR(255),
    `participation_warranty` VARCHAR(255),
    `participation_conditions` VARCHAR(255),
    `professional_ability` TEXT,
    `average_turnover` VARCHAR(255),
    `cash_flow` VARCHAR(255),
    `similar_experience` TEXT,
    `key_personnel` VARCHAR(255),
    `equipment` TEXT,
    `quality_assurance` TEXT,
    `additional_information` TEXT,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
