<?php
session_start();
require_once 'aluno.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idade do Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container mt-4">
        <?php if (isset($_SESSION['aluno'])): ?>
            <?php $aluno = unserialize($_SESSION['aluno']); ?>
            <div class="alert alert-info h4" role="alert">
                <?php echo htmlspecialchars($aluno->nome) . ", " . $aluno->idade() . " anos"; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                Nenhum aluno encontrado na sessão. Por favor, <a href="formulario.php" class="alert-link">cadastre um aqui</a>.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>