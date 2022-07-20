CREATE DATABASE shop_lamp_dev;

CREATE TABLE `categories` (
    `id` BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(150) NOT NULL
);

CREATE TABLE `products` (
    `id` BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(250) NOT NULL,
    `price` DECIMAL(10, 2) DEFAULT(000.00),
    `amount` SMALLINT UNSIGNED DEFAULT(1),
    `category_id` BIGINT UNSIGNED NOT NULL,
    CONSTRAINT `category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
);

CREATE TABLE `users` (
    `id` BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(150) UNIQUE NOT NULL,
    `email` DECIMAL(10, 2) UNIQUE NOT NULL,
    `password` VARCHAR(200) NOT NULL
);

CREATE TABLE `carts` (
    `product_id` BIGINT UNSIGNED NOT NULL,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `amount` SMALLINT UNSIGNED DEFAULT(1),
    `created_at` TIMESTAMP DEFAULT(CURRENT_TIMESTAMP),
    PRIMARY KEY (`product_id`, `user_id`),
    CONSTRAINT `product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`),
    CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);

//////////////////////////////////////////////////////////////////////

mysqldump -u root -p shop_lamp_dev > shop_lamp_dev_dump.sql;

DROP DATABASE shop_lamp_dev;

CREATE DATABASE shop_lamp_dev;

mysql -u root -p shop_lamp_dev < /shop_lamp_dev_dump.sql;

//////////////////////////////////////////////////////////////////////

CREATE USER 'root_copy'@'localhost' IDENTIFIED BY 'root_copy';
GRANT ALL PRIVILEGES ON *.* TO 'root_copy'@'localhost';

CREATE USER 'client'@'localhost' IDENTIFIED BY 'client';
GRANT SELECT, INSERT ON shop_lamp_dev.* TO 'client'@'localhost';

///////////////////////////////////////////////////////////////////////
