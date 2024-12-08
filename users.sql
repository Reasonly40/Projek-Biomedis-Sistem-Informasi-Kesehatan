USE si_kesehatan;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL

);

INSERT INTO users (name, email, password, role) VALUES
('Administrator', 'admin@example.com', MD5('admin123'), 'admin'),
('John Doe', 'user@example.com', MD5('user123'), 'user');