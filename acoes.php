<?php
session_start();
require 'conexao.php';

if (isset($_POST['create_usuario'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $mensagem = mysqli_real_escape_string($conexao, trim($_POST['mensagem']));

    $query = "INSERT INTO posts (Nome, Mensagem) VALUES ('$nome', '$mensagem')";
    $result = mysqli_query($conexao, $query);

    if ($result) {
        $_SESSION['mensagem'] = 'Mensagem criada com sucesso';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao criar a mensagem';
        header('Location: index.php');
        exit;
    }
} 
?>
