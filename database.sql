CREATE DATABASE IF NOT EXISTS episodeslaravel;
USE episodeslaravel;

CREATE TABLE users (
id 		int(255) auto_increment not null,
role	varchar(20),
name	varchar(255),
surname varchar(255),
email	varchar(255),
password	varchar(255),
image	varchar(255),
created_at	datetime,
updated_at	datetime,
remember_token 	varchar(255),
CONSTRAINT pk_users	PRIMARY KEY (id)
) ENGINE= InnoDb;


CREATE TABLE episodes (
id 		int(255) auto_increment not null,
user_id	int(255) not null,
title	varchar(255),
description text,
ep_number	int(255),
url	varchar(255),
created_at	datetime,
updated_at	datetime,
CONSTRAINT pk_episodes PRIMARY KEY (id),
CONSTRAINT fk_episodes_users FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE= InnoDb;