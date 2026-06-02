-- SCHÉMA DE BASE DE DONNÉES MODERN LIVING

CREATE TABLE IF NOT EXISTS `customers` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `firstname` VARCHAR(100) NOT NULL,
  `lastname` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) UNIQUE NOT NULL,
  `phone` VARCHAR(20),
  `password` VARCHAR(255) NOT NULL,
  `address` TEXT,
  `city` VARCHAR(100),
  `postal_code` VARCHAR(10),
  `country` VARCHAR(100),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) UNIQUE NOT NULL,
  `description` TEXT,
  `icon` VARCHAR(50),
  `image` VARCHAR(255),
  `parent_id` INT NULL,
  `position` INT DEFAULT 0,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) UNIQUE NOT NULL,
  `description` TEXT,
  `short_description` VARCHAR(500),
  `category_id` INT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `cost` DECIMAL(10, 2),
  `discount_percent` DECIMAL(5, 2) DEFAULT 0,
  `discount_price` DECIMAL(10, 2),
  `quantity` INT DEFAULT 0,
  `sku` VARCHAR(100) UNIQUE,
  `image` VARCHAR(255),
  `images` JSON,
  `is_featured` BOOLEAN DEFAULT FALSE,
  `is_new` BOOLEAN DEFAULT FALSE,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT,
  INDEX (`slug`),
  INDEX (`category_id`)
);

CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `order_number` VARCHAR(50) UNIQUE NOT NULL,
  `customer_id` INT NOT NULL,
  `subtotal` DECIMAL(10, 2) NOT NULL,
  `shipping_cost` DECIMAL(10, 2) DEFAULT 0,
  `tax` DECIMAL(10, 2) DEFAULT 0,
  `total` DECIMAL(10, 2) NOT NULL,
  `status` ENUM('pending', 'confirmed', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
  `payment_method` VARCHAR(50),
  `payment_status` ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
  `shipping_address` TEXT,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE RESTRICT,
  INDEX (`status`),
  INDEX (`payment_status`)
);

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `subtotal` DECIMAL(10, 2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS `settings` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `key` VARCHAR(100) UNIQUE NOT NULL,
  `value` LONGTEXT,
  `type` VARCHAR(50) DEFAULT 'string',
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `banners` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(200),
  `image` VARCHAR(255) NOT NULL,
  `link` VARCHAR(255),
  `position` INT DEFAULT 0,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `promotions` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `product_id` INT,
  `category_id` INT,
  `discount_percent` DECIMAL(5, 2),
  `discount_amount` DECIMAL(10, 2),
  `start_date` DATE,
  `end_date` DATE,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `articles` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `slug` VARCHAR(200) UNIQUE NOT NULL,
  `content` LONGTEXT NOT NULL,
  `image` VARCHAR(255),
  `is_published` BOOLEAN DEFAULT FALSE,
  `published_at` DATETIME,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `events` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `image` VARCHAR(255),
  `event_date` DATETIME,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);