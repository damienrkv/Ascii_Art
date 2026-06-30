USE ascii_art;

CREATE TABLE IF NOT EXISTS uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(255) NOT NULL,
    ascii_art TEXT NOT NULL,
    num_chars INT NOT NULL,
    upload_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);