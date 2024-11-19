<?php
session_start();
require 'conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar_post'])) {
    $id = intval($_POST['id']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $mensagem = mysqli_real_escape_string($conexao, trim($_POST['mensagem']));

    $query = "UPDATE posts SET Nome = '$nome', Mensagem = '$mensagem' WHERE id = $id";
    if (mysqli_query($conexao, $query)) {
        $_SESSION['mensagem'] = "Post atualizado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar o post: " . mysqli_error($conexao);
    }

    header("Location: index.php");
    exit;
}

$post = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conexao, "SELECT * FROM posts WHERE id = $id");

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['mensagem'] = "Post não encontrado.";
        header("Location: atualizar.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Atualizar Post</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Atualizar Post</h1>

        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-info text-center"><?= $_SESSION['mensagem'] ?></div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>

        <?php if ($post): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($post['Nome']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="mensagem">Mensagem:</label>
                    <textarea name="mensagem" id="mensagem" class="form-control" rows="4" required><?= htmlspecialchars($post['Mensagem']) ?></textarea>
                </div>
                <button type="submit" name="atualizar_post" class="btn btn-success">Atualizar</button>
                <a href="atualizar.php" class="btn btn-secondary">Cancelar</a>
            </form>
        <?php else: ?>
            <h5 class="text-center">Selecione um post para atualizar:</h5>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Mensagem</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conexao, "SELECT * FROM posts");
                    if ($result && mysqli_num_rows($result) > 0):
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['Nome']) ?></td>
                                <td><?= htmlspecialchars($row['Mensagem']) ?></td>
                                <td>
                                    <a href="atualizar.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                </td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhum post encontrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
