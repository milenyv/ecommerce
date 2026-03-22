CREATE DATABASE ecommerce;
USE ecommerce;

CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  preco DECIMAL(10,2),
  imagem VARCHAR(255)
);

INSERT INTO produtos (nome, preco, imagem) VALUES
('Perfume Floral', 89.90, 'assets/perfume1.jpg'),
('Perfume Amadeirado', 119.90, 'assets/perfume2.jpg'),
('Perfume Doce', 99.90, 'assets/perfume3.jpg');

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100),
  senha VARCHAR(255)
);

INSERT INTO usuarios (email, senha) VALUES
('teste@email.com', '123456');