CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    isAdmin TINYINT(1) DEFAULT 0,
    UNIQUE (username),
    UNIQUE (email)
);

-- Jobs table
-- Reviews table
