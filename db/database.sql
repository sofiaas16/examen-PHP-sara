-- Active: 1754051059449@@127.0.0.1@3307
CREATE DATABASE IF NOT EXISTS `garden`;

USE `garden`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
);
CREATE TABLE `plantas` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
);
CREATE TABLE `categoria` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `familia` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `riego` (
    `id` int NOT NULL AUTO_INCREMENT,
    `fecha_riego` TIMESTAMP,
    `info_riego` VARCHAR(100),
    PRIMARY KEY (`id`)
);


INSERT INTO
    `users` (`name`, `email`, `password`)
VALUES (
        'adrian',
        'adrian@gmail.com',
        SHA2('h3ll0.', 512)
    );

INSERT INTO
    `users` (`name`, `email`, `password`)
VALUES (
        'ana',
        'ana@gmail.com',
        SHA2('h3ll0.', 512)
    );

INSERT INTO
    `categoria` (`name`, `familia`)
VALUES (
        'frutal',
        'Solanaceae'
    );

INSERT INTO
    `categoria` (`name`, `familia`)
VALUES (
        'ornamental',
        'Lamiaceae'
    );

INSERT INTO 
    `riego` (`fecha_riego`, `info_riego`)
VALUES (
        '2025-08-09',
        'Riego con mucha agua'
    );


INSERT INTO 
    `riego` (`fecha_riego`, `info_riego`)
VALUES (
        '2025-12-10',
        'Riego suave'
    );

