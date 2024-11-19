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
    <title>Selecionar Posts</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Posts Cadastrados</h1>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Mensagem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT * FROM posts';
                $result = mysqli_query($conexao, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['Nome']) ?></td>
                            <td><?= htmlspecialchars($row['Mensagem']) ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="3" class="text-center">Nenhum registro encontrado</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
    </div>
</body>
</html>
