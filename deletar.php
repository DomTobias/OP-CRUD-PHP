<?php
session_start();
require 'conexao.php'; // Inclui a conexão com o banco de dados

// Obtém todos os posts do banco de dados
$result = mysqli_query($conexao, "SELECT * FROM posts");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Excluir Post</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Excluir Post</h1>

        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-info text-center"><?= $_SESSION['mensagem'] ?></div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Mensagem</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($post = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $post['id'] ?></td>
                                <td><?= $post['Nome'] ?></td>
                                <td><?= $post['Mensagem'] ?></td>
                                <td>
                                    <a href="confirmar_deletar.php?id=<?= $post['id'] ?>" class="btn btn-danger btn-sm">Deletar</a>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Nenhum post encontrado</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
