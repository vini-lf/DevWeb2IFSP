<?php
session_start();
include 'conexao.php';


if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}


$id = $_SESSION['id'];
$hoje = date('Y-m-d');


$sql = "SELECT nometarefa, datalimite FROM tarefas WHERE idusuario = ? AND datalimite <= ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $hoje]);
$tarefas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Tarefas</title>
</head>
<body>
    <h2>Bem-vindo(a), <?php echo $_SESSION['nome']; ?>!</h2>
    <h3>Minhas Tarefas (com data limite até hoje):</h3>
    <?php if (count($tarefas) > 0): ?>
        <ul>
            <?php foreach ($tarefas as $tarefa): ?>
                <li>**<?php echo htmlspecialchars($tarefa['nometarefa']); ?>** - Data Limite: <?php echo date('d/m/Y', strtotime($tarefa['datalimite'])); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhuma tarefa encontrada com data limite até hoje.</p>
    <?php endif; ?>
    <br>
    <a href="logout.php">Sair</a>
</body>
</html>