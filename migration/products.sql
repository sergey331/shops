CREATE TABLE IF NOT EXISTS products (
                                          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                          name VARCHAR(255) NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    description TEXT,
    avatar VARCHAR(255) NULL,
    price INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_product
    FOREIGN KEY (category_id)
    REFERENCES categories(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    );