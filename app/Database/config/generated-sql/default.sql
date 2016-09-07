
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
    `unique_id` VARCHAR(32) NOT NULL,
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

-- ---------------------------------------------------------------------
-- mail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mail`;

CREATE TABLE `mail`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `from_email_address` VARCHAR(255) NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `auction_list` VARCHAR(255) NOT NULL,
    `mail_template` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- mail_queue
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mail_queue`;

CREATE TABLE `mail_queue`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `mail_to` VARCHAR(255) NOT NULL,
    `mail_id` INTEGER(11) NOT NULL,
    `mail_status` TINYINT(1) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `mail_queue_fi_f69d66` (`mail_id`),
    CONSTRAINT `mail_queue_fk_f69d66`
        FOREIGN KEY (`mail_id`)
        REFERENCES `mail` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- mail_criteria
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mail_criteria`;

CREATE TABLE `mail_criteria`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- mail_criteria_relation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `mail_criteria_relation`;

CREATE TABLE `mail_criteria_relation`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `email_address` VARCHAR(255) NOT NULL,
    `mail_criteria_id` INTEGER(11) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `mail_criteria_relation_fi_9615f5` (`mail_criteria_id`),
    CONSTRAINT `mail_criteria_relation_fk_9615f5`
        FOREIGN KEY (`mail_criteria_id`)
        REFERENCES `mail_criteria` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- news
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `unique_id` VARCHAR(32) NOT NULL,
    `title` TEXT NOT NULL,
    `description` TEXT NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- subscriptions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions`
(
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `company_name` VARCHAR(255) NOT NULL,
    `company_address` TEXT NOT NULL,
    `company_cui` VARCHAR(255) NOT NULL,
    `company_representative` VARCHAR(255) NOT NULL,
    `iban_account` VARCHAR(255) NOT NULL,
    `email_address` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
