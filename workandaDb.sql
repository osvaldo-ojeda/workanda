CREATE DATABASE
    IF NOT EXISTS workandaDb DEFAULT CHARACTER SET = 'utf8mb4';

USE workandaDb;

CREATE TABLE
    roles(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(250) NOT NULL UNIQUE
    );

INSERT INTO roles (name) VALUES( "admin"),( "user");

CREATE TABLE
    users(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(250) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        roleId INT(11) DEFAULT 2,
        active INT(11) DEFAULT 1,
        image VARCHAR(255) DEFAULT "https://cdn.pixabay.com/photo/2020/06/26/21/36/sunset-5344024_1280.jpg",
        FOREIGN KEY (roleId) REFERENCES roles(id)
    ) ENGINE = InnoDB;

INSERT INTO
    users (
        name,
        lastname,
        email,
        password,
        roleId,
        active,
        image
    )
VALUES (
        "Kuka",
        "Kuka",
        "kuka@gmail.com",
        "$2y$10$.rUhZz0YvsyCsfv70ZTH8OfGThi1kIW2eROFB6N66oQe4snOiVnWq",
        1,
        DEFAULT,
        "https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
    ), (
        "Canela",
        "Canela",
        "canela@gmail.com",
        "$2y$10$.rUhZz0YvsyCsfv70ZTH8OfGThi1kIW2eROFB6N66oQe4snOiVnWq",
        1,
        DEFAULT,
        "https://images.pexels.com/photos/2228567/pexels-photo-2228567.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
    ), (
        "Jaco",
        "Jaco",
        "jaco@gmail.com",
        "$2y$10$.rUhZz0YvsyCsfv70ZTH8OfGThi1kIW2eROFB6N66oQe4snOiVnWq",
        1,
        DEFAULT,
        "https://images.pexels.com/photos/10131170/pexels-photo-10131170.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
    ), (
        "Os",
        "Os",
        "os@gmail.com",
        "$2y$10$.rUhZz0YvsyCsfv70ZTH8OfGThi1kIW2eROFB6N66oQe4snOiVnWq",
        DEFAULT,
        0,
        DEFAULT
    );