-- DONNÉES D'INITIALISATION

INSERT INTO `settings` (`key`, `value`, `type`) VALUES
('site_name', 'Modern Living', 'string'),
('site_description', 'Votre magasin en ligne de fournitures de qualité', 'string'),
('store_phone', '+237 XXX XXX XXX', 'string'),
('store_email', 'contact@modern-living.com', 'string');

INSERT INTO `categories` (`name`, `slug`, `description`, `position`, `is_active`) VALUES
('Fournitures Bureau', 'fournitures-bureau', 'Tout pour votre bureau', 1, TRUE),
('Papeterie', 'papeterie', 'Articles de papeterie', 2, TRUE),
('Informatique', 'informatique', 'Équipements informatiques', 3, TRUE),
('Mobilier', 'mobilier', 'Meubles de bureau', 4, TRUE),
('Accessoires', 'accessoires', 'Accessoires divers', 5, TRUE);

INSERT INTO `products` (`name`, `slug`, `category_id`, `price`, `quantity`, `is_featured`, `is_active`) VALUES
('Rame de papier A4 500 feuilles', 'rame-papier-a4', 2, 5000, 100, TRUE, TRUE),
('Stylo Bic cristal bleu (x50)', 'stylo-bic-bleu', 2, 2500, 50, TRUE, TRUE),
('Cahier 100 pages', 'cahier-100-pages', 2, 1200, 80, FALSE, TRUE),
('Chaise de bureau ergonomique', 'chaise-bureau', 4, 45000, 20, TRUE, TRUE),
('Bureau en bois 120cm', 'bureau-bois', 4, 75000, 15, FALSE, TRUE),
('Clavier mécanique RGB', 'clavier-mecanique', 3, 25000, 30, TRUE, TRUE),
('Souris sans fil', 'souris-sans-fil', 3, 8000, 50, FALSE, TRUE),
('Lampe de bureau LED', 'lampe-led', 1, 12000, 40, FALSE, TRUE);