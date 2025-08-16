<?php
session_start();
require_once 'aluno.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'menu.php'; ?>

    <div class="container mt-4">
        <?php if (isset($_SESSION['aluno'])): ?>
            <?php $aluno = unserialize($_SESSION['aluno']); ?>
            <div class="card" style="width: 25rem;">
                <div class="card-header">
                    <h4>Dados do Aluno</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nome:</strong> <?php echo htmlspecialchars($aluno->nome); ?></li>
                    <li class="list-group-item"><strong>Nascimento:</strong> <?php echo htmlspecialchars($aluno->nascimento); ?></li>
                    <li class="list-group-item"><strong>Curso:</strong> <?php echo htmlspecialchars($aluno->curso); ?></li>
                    <li class="list-group-item"><strong>Matrícula:</strong> <?php echo htmlspecialchars($aluno->matricula); ?></li>
                </ul>
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