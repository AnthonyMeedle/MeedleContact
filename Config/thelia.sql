
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- meedleContact
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `meedleContact`;

CREATE TABLE `meedleContact`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `civilite` VARCHAR(20),
    `nom` VARCHAR(50),
    `prenom` VARCHAR(50),
    `email` VARCHAR(100),
    `phone` VARCHAR(20),
    `sujet` VARCHAR(255),
    `description` LONGTEXT,
    `autre` LONGTEXT,
    `infosCaptcha` LONGTEXT,
    `infosNavig` LONGTEXT,
    `score` VARCHAR(10),
    `accepte_newsletter` TINYINT DEFAULT 0 NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
