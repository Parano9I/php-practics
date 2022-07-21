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

INSERT INTO `categories`(`name`) 
VALUES
    ('smartphones'),
    ('laptops'),
    ('fragrances'),
    ('skincare')
;

ALTER TABLE `users` MODIFY `email` VARCHAR(150); // У рядку 20 вказав не той тип даних

INSERT INTO `users`(`login`, `email`, `password`) 
VALUES
    ('anton16', 'anton16@gmail.com', 'anton16'),
    ('vladErg', 'vladErg@gmail.com', 'vladErg'),
    ('oleg7f', 'oleg7f@gmail.com', 'oleg7f'),
    ('$asha', '$asha@gmail.com', '$asha')
;

INSERT INTO `products`(`title`, `price`, `amount`, `category_id`) 
VALUES
    ('iPhone 9', '549', '94', '1'),
    ('iPhone X', '899', '34', '1'),
    ('Samsung Universe 9', '1249', '36', '1'),
    ('MacBook Pro', '1749', '83', '2'),
    ('Samsung Galaxy Book', '1499', '50', '2'),
    ('perfume Oil', '13', '65', '3'),
    ('Brown Perfume', '40', '52', '3'),
    ('Fog Scent Xpressio Perfume', '13', '61', '3'),
    ('Hyaluronic Acid Serum', '19', '110', '4'),
    ('Tree Oil 30ml', '12', '78', '4')
;

INSERT INTO `carts`(`product_id`, `user_id`, `amount`) 
VALUES
    ('4', '2', '1'),
    ('1', '2', '3'),
    ('8', '2', '10'),
    ('2', '3', '3'),
    ('1', '3', '1'),
    ('4', '1', '5'),
    ('2', '1', '2')
;

SELECT COUNT(*) FROM products; // загальна кількість товарів

SELECT * FROM products
    WHERE amount = (SELECT MAX(amount) FROM products)
; // товар з максимальною кількістю на складі

UPDATE products 
    SET products.amount = products.amount * 2 
    WHERE products.amount = (SELECT amount FROM (SELECT MIN(amount) FROM products) AS product)
; // збільшення значення кількості товару з найменшою кількістю

SELECT user.login, product.title, product.price, cart.amount FROM carts cart
    INNER JOIN users user ON cart.user_id = user.id
    INNER JOIN products product ON cart.product_id = product.id
;  // користувачі та їх товари у кошику

SELECT tmp_table.count_prod, c.name FROM (
	SELECT COUNT(p.id) AS count_prod, p.category_id FROM products p
	GROUP BY p.category_id  
) tmp_table 
INNER JOIN categories c ON tmp_table.category_id = c.id
ORDER BY tmp_table.count_prod DESC; // відсортована в порядку зменшення, кількість унікального товару у категорії 