create database banco;
use banco;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(255) NOT NULL,
    Mensagem TEXT NOT NULL
);

select * from posts;