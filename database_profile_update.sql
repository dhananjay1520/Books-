USE `project`;

-- Safe for the current `users` table: `address` already exists, so it is not added again.
ALTER TABLE `users`
    ADD COLUMN IF NOT EXISTS `image` VARCHAR(255) NULL AFTER `password`,
    ADD COLUMN IF NOT EXISTS `mobile` VARCHAR(30) NULL AFTER `image`,
    ADD COLUMN IF NOT EXISTS `city` VARCHAR(100) NULL AFTER `address`,
    ADD COLUMN IF NOT EXISTS `state` VARCHAR(100) NULL AFTER `city`,
    ADD COLUMN IF NOT EXISTS `country` VARCHAR(100) NULL AFTER `state`,
    ADD COLUMN IF NOT EXISTS `pincode` VARCHAR(20) NULL AFTER `country`;
