USE `project`;

-- CI3 MVC Admin authentication table.
CREATE TABLE IF NOT EXISTS `admin_login` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_admin_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default login for local development. Change it after first login.
INSERT INTO `admin_login` (`username`, `password`)
SELECT 'admin', 'admin123'
WHERE NOT EXISTS (SELECT 1 FROM `admin_login` WHERE `username` = 'admin');

-- Profile fields are NOT altered here because the existing users table already
-- contains `address`. Run your profile migration separately when needed:
-- image, mobile, city, state, country, pincode.
