USE `project`;

-- Contact/"Send a message" form submissions. Needed after the fix that
-- makes Contact::send() and the admin Messages page read from the same
-- table (previously they used two different table names, so submitted
-- messages never showed up in the admin panel).
CREATE TABLE IF NOT EXISTS `contact_form_submissions` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(150) NULL,
    `email` VARCHAR(150) NULL,
    `message` TEXT NULL,
    `submitted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
