<?php
session_start();
require 'conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = mysqli_query($conexao, "SELECT * FROM posts WHERE id = $id");
    $post = mysqli_fetch_assoc($result);

    if ($post) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_exclusao'])) {
            // Deleta o post
            $query = "DELETE FROM posts WHERE id = $id";
            if (mysqli_query($conexao, $query)) {
                $_SESSION['mensagem'] = "Post deletado com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Erro ao deletar o post: " . mysqli_error($conexao);
            }
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['mensagem'] = "Post não encontrado.";
        header("Location: index.php");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "ID inválido ou não informado.";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Confirmar Exclusão de Post</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Confirmar Exclusão de Post</h1>

        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-info text-center"><?= $_SESSION['mensagem'] ?></div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <p class="text-center">Tem certeza que deseja excluir o post com ID <?= $id ?>?</p>
                <form method="POST" class="text-center">
                    <button type="submit" name="confirmar_exclusao" class="btn btn-danger">Sim, Excluir</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
