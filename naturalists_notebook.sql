CREATE DATABASE  naturalists_notebook;

USE naturalists_notebook;

CREATE TABLE users (
  user_id int(10) UNSIGNED AUTO_INCREMENT,
  email varchar(50) NOT NULL,
  username varchar(25) NOT NULL UNIQUE,
  pass char(128) NOT NULL,
  PRIMARY KEY(user_id)
);

CREATE TABLE notebooks (
  notebook_id int(10) UNSIGNED AUTO_INCREMENT,
  notebook_name varchar(50) NOT NULL,
  user_id int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (notebook_id),
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE observations (
  observation_id int(10) UNSIGNED AUTO_INCREMENT,
  notebook_id int(10) UNSIGNED NOT NULL,
  image varchar(50) DEFAULT NULL,
  species varchar(50) DEFAULT NULL,
  location varchar(50) DEFAULT NULL,
  date_created date DEFAULT NULL,
  notes text(2000) DEFAULT NULL,
  PRIMARY KEY(observation_id),
  FOREIGN KEY(notebook_id) REFERENCES notebooks(notebook_id)
);

INSERT INTO users
VALUES (NULL, 'admin@naturalistsnotebook.com', 'admin', SHA1('admin'));