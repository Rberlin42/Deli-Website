CREATE DATABASE deli;

USE deli;

CREATE TABLE menu_sections (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(500),
    type varchar(255),
    position int NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE menu_items (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(500),
    description text,
    sectionID int NOT NULL,
    price varchar(50),
    position int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (sectionID) REFERENCES menu_sections(id)
);

CREATE TABLE announcements (
    id int NOT NULL AUTO_INCREMENT,
    title varchar(300) NOT NULL,
    description text,
    position int NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE contact_us (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    subject varchar(500) NOT NULL,
    message text NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE cms_data (
    id int NOT NULL AUTO_INCREMENT,
    sectionName varchar(255) NOT NULL,
    sectionText text NOT NULL,
    PRIMARY KEY (id)
);