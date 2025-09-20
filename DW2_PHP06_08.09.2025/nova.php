<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "menu.php"; ?>
<div class="container mt-4">
    <h2>Cadastrar Nova Tarefa</h2>
    <form action="salva.php" method="post" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Nome da Tarefa</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Data da Tarefa</label>
            <input type="date" name="data" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
</body>
</html>