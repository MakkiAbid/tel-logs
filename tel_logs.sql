DROP DATABASE IF EXISTS `tel_logs`;

CREATE DATABASE IF NOT EXISTS `tel_logs`;

USE `tel_logs`;

CREATE TABLE `logs` (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name varchar (255) not null,
	phone_no varchar(255) not null,
	created_at datetime not null default current_timestamp
);