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

INSERT INTO cms_data (sectionName, sectionText) VALUES
('about', 'Owner born and raised in Plainview, serving the community the finest and freshest ingredients for over 30 years. The homemade potato macaroni and cole slaw are well known throughout the community.'),
('catering', 'Stop in the deli and see Brian for all of your catering needs.  Call (516) 681-1670 and ask for Brian for more info.'),
('hours', 'Monday-Friday: 7am - 7pm\nSaturday: 7am - 4pm\nSunday: 8am - 3pm');