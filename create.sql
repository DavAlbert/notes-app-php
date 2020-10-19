CREATE TABLE users (
    id int unsigned AUTO_INCREMENT PRIMARY KEY,
    username varchar(30) not null,
    password varchar(100) not null,
    creation_date timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE notices (
    id int unsigned AUTO_INCREMENT PRIMARY KEY,
    text varchar(300) not null,
    creation_date timestamp DEFAULT CURRENT_TIMESTAMP,
    user_id int unsigned not null,
    FOREIGN KEY(user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);