CREATE DATABASE ecommerce;
USE ecommerce;

CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  preco DECIMAL(10,2),
  imagem VARCHAR(255)
);

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100),
  senha VARCHAR(255)
);

INSERT INTO usuarios (email, senha) VALUES
('teste@email.com', '123456');

ALTER TABLE produtos 
ADD categoria VARCHAR(50);

INSERT INTO produtos (nome, preco, imagem, categoria) VALUES
('Perfume Floral', 89.90, 'img/perfume-floral.png', 'floral'),
('Perfume Amadeirado', 109.90, 'img/perfume-amadeirado.png', 'amadeirado'),
('Perfume Doce', 79.90, 'img/perfume-doce.png', 'doce'),
('Perfume Citrico', 69.90, 'img/perfume-citrico.png', 'citrico'),
('Perfume Oriental', 129.90, 'img/perfume-oriental.png', 'oriental'),
('Perfume Frutal', 84.90, 'img/perfume-frutal.png', 'frutal');
