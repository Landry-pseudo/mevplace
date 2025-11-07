-- Créer la base de données
CREATE DATABASE IF NOT EXISTS mevplace;
USE mevplace;

-- Table users
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) DEFAULT NULL,
    bio TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insérer l'utilisateur Landry
INSERT IGNORE INTO users (username, email, password, bio, created_at) 
VALUES (
    'landry', 
    'friendlandry08@gmail.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'Vendeur et acheteur passionné sur MEV-PLACE. Je propose des articles de qualité et recherche de bonnes affaires !',
    NOW()
);

-- Table products
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(100),
    size VARCHAR(50),
    brand VARCHAR(100),
    product_condition ENUM('new', 'like_new', 'good', 'fair') DEFAULT 'good',
    images TEXT,
    seller_id INT NOT NULL,
    status ENUM('available', 'reserved', 'sold') DEFAULT 'available',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insérer des articles de démonstration
INSERT IGNORE INTO products (title, description, price, category, size, brand, product_condition, seller_id, images) VALUES
('Veste en cuir véritable', 'Veste en cuir de qualité, taille M, excellent état. Portée seulement quelques fois.', 45.00, 'vetements', 'M', 'Zara', 'like_new', 1, '["https://via.placeholder.com/400x400?text=Veste+Cuir"]'),
('Smartphone Samsung Galaxy S20', 'Smartphone en excellent état, écran 6.2 pouces, 128GB. Livré avec chargeur et coque.', 120.00, 'electronique', 'UNIQUE', 'Samsung', 'good', 1, '["https://via.placeholder.com/400x400?text=Smartphone"]'),
('Nike Air Max 270', 'Chaussures de sport Nike, taille 42, peu portées. Confort exceptionnel.', 35.00, 'chaussures', '42', 'Nike', 'like_new', 1, '["https://via.placeholder.com/400x400?text=Chaussures+Nike"]'),
('Livre collection Harry Potter', 'Les 7 livres Harry Potter en bon état. Édition originale.', 25.00, 'livres', 'UNIQUE', 'Gallimard', 'good', 1, '["https://via.placeholder.com/400x400?text=Livres+HP"]'),
('Sac à main en cuir véritable', 'Sac en cuir de qualité, couleur marron, plusieurs compartiments. État neuf.', 55.00, 'accessoires', 'UNIQUE', 'Unknown', 'new', 1, '["https://via.placeholder.com/400x400?text=Sac+Cuir"]');

-- Vérification
SELECT 'Utilisateurs:' AS '';
SELECT * FROM users;

SELECT 'Produits:' AS '';
SELECT * FROM products;