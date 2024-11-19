<?php
session_start();
require 'conexao.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>CRUD</title>
</head>
<body>
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-info text-center"><?= $_SESSION['mensagem'] ?></div>
        <?php unset($_SESSION['mensagem']); ?>
    <?php endif; ?>

    <br>
    <h1 class="text-center">Operações em CRUD em PHP</h1>
    <br>

    <!-- Botões de navegação -->
    <div class="text-center">
        <a href="adicionaruser.php" class="btn btn-primary mx-1">Inserir Post</a>
        <a href="selecionar.php" class="btn btn-secondary mx-1 text-white">Selecionar Post</a>
        <a href="atualizar.php" class="btn btn-success mx-1 text-white">Atualizar Post</a>
        <a href="deletar.php" class="btn btn-danger mx-1 text-white">Deletar Post</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Mensagem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT * FROM posts';
                $result = mysqli_query($conexao, $sql);

                if ($result && mysqli_num_rows($result) > 0): 
                    foreach ($result as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['Nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['Mensagem']) ?></td>
                        </tr>
                    <?php endforeach;
                else: ?>
                    <tr>
                        <td colspan="2" class="text-center">Nenhum Post Encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
