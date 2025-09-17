DROP DATABASE IF EXISTS itivp_labs;
CREATE DATABASE itivp_labs;
USE itivp_labs;

CREATE TABLE ideas (
id INT PRIMARY KEY AUTO_INCREMENT,
title VARCHAR(255),
description TEXT,
status ENUM('отложено', 'выполняется', 'готово'),
created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
category VARCHAR(255),
complexity ENUM('легко', 'средне', 'сложно')
);

INSERT INTO ideas (title, description, status, category, complexity) VALUES 
( 'Супер идея 1', 'Описание супер идеи', 'выполняется', 'Супер идеи', 'средне');

INSERT INTO ideas (title, description, status, category, complexity) VALUES 
( 'Супер идея 2', 'Описание супер идеи Описание супер идеи Описание супер идеи Описание супер идеи Описание супер идеи',
 'отложено', 'Супер идеи', 'сложно');