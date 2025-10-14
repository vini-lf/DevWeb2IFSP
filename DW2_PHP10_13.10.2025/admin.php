<?php
require 'config.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'administrador') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT r.*, u.nome as reclamante_nome FROM reclamacao r JOIN usuarios u ON r.id_reclamante = u.id ORDER BY r.id DESC";
$stmt = $pdo->query($sql);
$reclamacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin</title>
</head>
<body>
    <h2>Painel do Administrador - Todas as Reclamações</h2>
    <p><a href="sair.php">Sair</a></p>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Reclamante</th>
            <th>Estado</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($reclamacoes as $item): ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo htmlspecialchars($item['titulo']); ?></td>
            <td><?php echo htmlspecialchars($item['reclamante_nome']); ?></td>
            <td><?php echo $item['estado']; ?></td>
            <td><a href="gerenciar_reclamacao.php?id=<?php echo $item['id']; ?>">Gerenciar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>