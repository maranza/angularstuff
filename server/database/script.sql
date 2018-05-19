
CREATE EXTENSION pgcrypto;

CREATE TABLE patients(
    id SERIAL NOT NULL PRIMARY KEY,
    uuid UUID  DEFAULT gen_random_uuid(),
    first_name VARCHAR NOT NULL,
    last_name VARCHAR NOT NULL,
    id_number VARCHAR NOT NULL UNIQUE
);

CREATE TABLE admins(

    id SERIAL NOT NULL PRIMARY KEY,
    uuid UUID  DEFAULT gen_random_uuid(),
    username VARCHAR NOT NULL UNIQUE,
    password VARCHAR NOT NULL
);

INSERT INTO patients(first_name,last_name,id_number) VALUES('Anabelle','Annabelle','9411210001123');
INSERT INTO admins(username,password) VALUES('kwasidev','$2y$10$kLPbMCGfqo4JJjQLnbBnOOwN2wUYPHXNzj4QQJ./E5T7riitoD6vm');

