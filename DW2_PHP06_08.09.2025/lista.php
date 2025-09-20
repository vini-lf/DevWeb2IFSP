<?php
session_start();

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "todas";
$tarefas = $_SESSION['tarefas'] ?? [];

$hoje = date("Y-m-d");
if ($filtro == "hoje") {
    $tarefas = array_filter($tarefas, function($t) use ($hoje) {
        return $t['data'] == $hoje;
    });
}
$total = count($_SESSION['tarefas']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "menu.php"; ?>
<div class="container mt-4">
    <h2>
      <?php echo ($filtro == "hoje") ? "Tarefas de Hoje ($hoje)" : "Todas as Tarefas"; ?>
    </h2>
    <?php if (count($tarefas) > 0): ?>
        <ul class="list-group mt-3">
            <?php foreach ($tarefas as $t): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $t['nome'] . " - " . $t['data']; ?>
                    <a href="apagar.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-danger">Apagar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="mt-3">Nenhuma tarefa encontrada.</p>
    <?php endif; ?>
</div>
</body>
</html>