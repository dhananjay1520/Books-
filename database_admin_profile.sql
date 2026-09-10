USE `project`;

ALTER TABLE `admin_login`
    ADD COLUMN `name` VARCHAR(100) NULL AFTER `username`,
    ADD COLUMN `email` VARCHAR(150) NULL AFTER `name`,
    ADD COLUMN `image` VARCHAR(255) NULL AFTER `email`;
