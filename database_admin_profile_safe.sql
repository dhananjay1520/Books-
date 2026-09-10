USE `project`;

-- Safe on MariaDB/XAMPP: existing profile columns are left unchanged.
ALTER TABLE `admin_login`
    ADD COLUMN IF NOT EXISTS `name` VARCHAR(100) NULL AFTER `username`,
    ADD COLUMN IF NOT EXISTS `email` VARCHAR(150) NULL AFTER `name`,
    ADD COLUMN IF NOT EXISTS `image` VARCHAR(255) NULL AFTER `email`;
