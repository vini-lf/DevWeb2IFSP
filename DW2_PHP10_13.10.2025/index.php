<?php
require 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['usuario_tipo'] == 'administrador') {
    header("Location: admin.php");
    exit();
}


$id_usuario_logado = $_SESSION['usuario_id'];

$sql = "SELECT * FROM reclamacao WHERE id_reclamante = ? ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_usuario_logado]);
$reclamacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Reclamações</title>
</head>
<body>
    <h2>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h2>
    <p><a href="nova_reclamacao.php">Fazer Nova Reclamação</a> | <a href="sair.php">Sair</a></p>
    
    <h3>Suas Reclamações:</h3>
    
    <?php if (count($reclamacoes) > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Ação</th>
            </tr>
            <?php foreach ($reclamacoes as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['titulo']); ?></td>
                <td><?php echo $item['estado']; ?></td>
                <td><a href="ver_reclamacao.php?id=<?php echo $item['id']; ?>">Ver Detalhes</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Você ainda não fez nenhuma reclamação.</p>
    <?php endif; ?>
</body>
</html>