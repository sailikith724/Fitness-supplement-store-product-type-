CREATE DATABASE fitness_store;
USE fitness_store;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    type VARCHAR(100),
    weight VARCHAR(50),
    price INT,
    old_price INT,
    offer VARCHAR(50),
    image VARCHAR(100),
    description VARCHAR(255)
);

INSERT INTO products 
(name, type, weight, price, old_price, offer, image, description) 
VALUES
('Biozyme Performance Whey', 'Whey Protein', '1 kg - Rich Chocolate', 3249, 3599, '9% off', 'whey1.jpg', 'High quality whey protein for muscle growth'),
('Biozyme Whey PR', 'Whey Protein', '1 kg - Molten Chocolate Cake', 3449, 3949, '12% off', 'whey2.jpg', 'Premium whey protein for strength and recovery'),
('Iso Zero Whey', 'Whey Protein', '500 g - Ice Cream Chocolate', 2349, 2699, '12% off', 'whey3.jpg', 'Low carb whey protein supplement'),
('Creatine Monohydrate', 'Creatine', '250 g', 999, 1299, '23% off', 'creatine.jpg', 'Improves power and workout performance'),
('Pre Workout Blast', 'Pre-Workout', '300 g - Fruit Punch', 1499, 1799, '16% off', 'preworkout.jpg', 'Boosts energy before workout'),
('Fish Oil Capsules', 'Fish Oil', '60 Capsules', 699, 899, '22% off', 'fishoil.jpg', 'Supports heart and joint health'),
('Liquid Carnitine', 'Liquid Carnitine', '450 ml', 1199, 1499, '20% off', 'carnitine.jpg', 'Supports fat metabolism'),
('Multivitamin Tablets', 'Health Supplement', '60 Tablets', 599, 799, '25% off', 'multivitamin.jpg', 'Daily health and immunity support');

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    product_type VARCHAR(100),
    quantity INT,
    price INT,
    total INT
);
