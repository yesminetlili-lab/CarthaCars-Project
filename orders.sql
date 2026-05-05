USE luxury_cars;

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_type ENUM('quote', 'purchase') NOT NULL DEFAULT 'purchase',
    source VARCHAR(50) NULL,
    car_name VARCHAR(150) NOT NULL,
    base_price DECIMAL(12,2) NOT NULL DEFAULT 0,
    total_price DECIMAL(12,2) NOT NULL DEFAULT 0,
    color VARCHAR(100) NULL,
    interior VARCHAR(100) NULL,
    wheels VARCHAR(100) NULL,
    audio VARCHAR(100) NULL,
    options TEXT NULL,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(30) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
