drop database if exists desafio;
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

insert into produtos (nome, descricao, preco, foto) values
	('Produto A', 'Descrição do produto A', 20.00, 'produto-a.jpg'),
    ('Produto B', 'Descrição do produto B', 50.00, 'produto-b.jpg'),
    ('Produto C', 'Descrição do produto C', 100.00, 'produto-c.jpg'),
    ('Produto D', 'Descrição do produto D', 30.00, 'produto-d.jpg');
    
insert into usuarios (nome, email, senha) values
	('Usuário A', 'usuarioa@email.com', '1234qwer'),
    ('Usuário B', 'usuariob@email.com', 'qwer1234'),
    ('Usuário C', 'usuarioc@email.com', '12345qwert'),
    ('Usuário D', 'usuariod@email.com', '1234qwer123');