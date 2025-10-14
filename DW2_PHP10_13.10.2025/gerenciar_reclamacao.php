<?php
require 'config.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'administrador') {
    header("Location: login.php");
    exit();
}

$id_reclamacao = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['novo_estado'])) {
    $novo_estado = $_POST['novo_estado'];
    
    $sql_update = "UPDATE reclamacao SET estado = ? WHERE id = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$novo_estado, $id_reclamacao]);
    
    header("Location: gerenciar_reclamacao.php?id=" . $id_reclamacao);
    exit();
}

$sql = "SELECT * FROM reclamacao WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_reclamacao]);
$reclamacao = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reclamacao) {
    echo "Reclamação não encontrada.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Reclamação</title>
</head>
<body>
    <h2>Gerenciar Reclamação #<?php echo $reclamacao['id']; ?></h2>
    <p><strong>Título:</strong> <?php echo htmlspecialchars($reclamacao['titulo']); ?></p>
    <p><strong>Descrição:</strong><br><?php echo nl2br(htmlspecialchars($reclamacao['descricao'])); ?></p>
    <?php if ($reclamacao['foto']): ?>
        <p><strong>Foto:</strong><br><img src="<?php echo $reclamacao['foto']; ?>" width="300"></p>
    <?php endif; ?>
    <p><strong>Estado Atual:</strong> <?php echo $reclamacao['estado']; ?></p>

    <hr>
    <h3>Alterar Estado</h3>
    <form method="POST">
        <select name="novo_estado">
            <option value="Atribuída" <?php echo ($reclamacao['estado'] == 'Atribuída') ? 'selected' : ''; ?>>Atribuída</option>
            <option value="Em andamento" <?php echo ($reclamacao['estado'] == 'Em andamento') ? 'selected' : ''; ?>>Em andamento</option>
            <option value="Resolvida" <?php echo ($reclamacao['estado'] == 'Resolvida') ? 'selected' : ''; ?>>Resolvida</option>
        </select>
        <button type="submit">Atualizar</button>
    </form>
    
    <p><a href="admin.php">Voltar ao Painel</a></p>
</body>
</html>