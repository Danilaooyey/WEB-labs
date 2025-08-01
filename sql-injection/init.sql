CREATE DATABASE IF NOT EXISTS monster CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE monster;

CREATE TABLE IF NOT EXISTS users (
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES('admin', 'super_secret_password');