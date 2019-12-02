create database desafio;

use desafio;

create table usuarios (
	id int auto_increment primary key not null,
    nome varchar(100) not null,
    email varchar(50) not null,
    senha varchar(100) not null
);

create table produtos (
	id int auto_increment primary key not null,
    nome varchar(50) not null,
    descricao varchar(500),
    preco decimal(7,2),
    foto varchar(50) not null
);

select * from usuarios;

insert into usuarios (nome, email, senha) values
	('Tatiana Alves de Oliveira', 'tatiialveso@gmail.com', '1234qwer');

select * from produtos;

insert into produtos (nome, descricao, preco, foto) values
	('Sabonete natural', 'Sabonete natural de coco e argan', 20.00, 'sabonete-natural.jpg');
    
select * from usuarios;

insert into produtos (nome, descricao, preco, foto) values
	('Shampoo em barra', 'Shampoo em barra de melaleuca', 18.00, 'shampoo-melaleuca.jpg');
    
select * from produtos;

select * from usuarios;

delete from produtos where id > 2;

SELECT nome, descricao, preco, foto FROM produtos WHERE id = 2;

INSERT INTO produtos (nome, descricao, preco, foto) VALUES
	('Perfume', 'Perfume floral', 300.00, 'perfume-floral.jpg');
    
UPDATE produtos SET nome = 'Perfuminho', descricao = 'Perfuminho floral infantil', preco = 30.00, foto = 'perfuminho-floral.jpg' WHERE id = 12;