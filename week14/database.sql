
CREATE DATABASE student_management;

USE student_management;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    course VARCHAR(100) NOT NULL
);

-- Insert sample records

INSERT INTO students (name, email, phone, course)
VALUES
('Rahul Sharma', 'rahul@gmail.com', '9876543210', 'BCA'),
('Amit Kumar', 'amit@gmail.com', '9876543211', 'B.Tech'),
('Priya Singh', 'priya@gmail.com', '9876543212', 'BBA');
