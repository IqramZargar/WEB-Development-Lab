
CREATE DATABASE web_lab;

USE web_lab;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);

INSERT INTO students (name, email)
VALUES
('Rahul', 'rahul@gmail.com'),
('Amit', 'amit@gmail.com');
