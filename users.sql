USE si_kesehatan;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL
);

INSERT INTO users (email, password, role) VALUES
('admin@example.com', MD5('admin123'), 'admin'),
('user@example.com', MD5('user123'), 'user');
