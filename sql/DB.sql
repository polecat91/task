
-- Create database

CREATE DATABASE task DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

-- Create User table
CREATE TABLE user
(
    id int NOT NULL AUTO_INCREMENT,
    status tinyint(1) NOT NULL DEFAULT 1,
    username varchar(64) NOT NULL,
    email varchar(128) NOT NULL,
    password varchar(32) NOT NULL,
    create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    create_user varchar(64) NOT NULL,
    modify_date TIMESTAMP,
    modify_user varchar(64),
    PRIMARY KEY(id)
);
-- add index
ALTER TABLE user ADD INDEX(status);
ALTER TABLE user ADD INDEX(username);
ALTER TABLE user ADD INDEX(email);
ALTER TABLE user ADD INDEX(password);

-- Create task table
CREATE TABLE task
(
    id int NOT NULL AUTO_INCREMENT,
    status tinyint(1) NOT NULL DEFAULT 1,
    user_id int NOT NULL,
    title varchar(256) NOT NULL,
    description text NOT NULL,
    is_success tinyint(1) DEFAULT 0,
    create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    create_user varchar(64) NOT NULL,
    modify_date TIMESTAMP,
    modify_user varchar(64),
    PRIMARY KEY(id)
);
-- add index
ALTER TABLE task ADD INDEX(status);
ALTER TABLE task ADD INDEX(user_id);
ALTER TABLE task ADD INDEX(title);
ALTER TABLE task ADD INDEX(is_success);