<?php
require 'config.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_reclamacao = $_GET['id'];
$id_usuario = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aprovacao'])) {
    $aprovacao = $_POST['aprovacao'];
    $comentario = $_POST['comentario'];
    
    $sql_update = "UPDATE reclamacao SET aprovacao = ?, comentario = ? WHERE id = ? AND id_reclamante = ?";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute([$aprovacao, $comentario, $id_reclamacao, $id_usuario]);
    
    header("Location: ver_reclamacao.php?id=" . $id_reclamacao);
    exit();
}

$sql = "SELECT * FROM reclamacao WHERE id = ? AND id_reclamante = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_reclamacao, $id_usuario]);
$reclamacao = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reclamacao) {
    echo "Reclamação não encontrada ou não pertence a você.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes</title>
</head>
<body>
    <h2>Detalhes da Reclamação</h2>
    <p><strong>Título:</strong> <?php echo htmlspecialchars($reclamacao['titulo']); ?></p>
    <p><strong>Descrição:</strong><br><?php echo nl2br(htmlspecialchars($reclamacao['descricao'])); ?></p>
    <?php if ($reclamacao['foto']): ?>
        <p><strong>Foto:</strong><br><img src="<?php echo $reclamacao['foto']; ?>" width="300"></p>
    <?php endif; ?>
    <p><strong>Estado:</strong> <?php echo $reclamacao['estado']; ?></p>

    <hr>

    <?php if ($reclamacao['estado'] == 'Resolvida'): ?>
        <?php if (is_null($reclamacao['aprovacao'])): ?>
            <h3>Avalie a solução:</h3>
            <form method="POST">
                <input type="radio" name="aprovacao" value="1" required> Aprovo
                <input type="radio" name="aprovacao" value="0"> Reprovo
                <br><br>
                Comentário:<br>
                <textarea name="comentario" rows="3" cols="40"></textarea>
                <br><br>
                <button type="submit">Enviar Avaliação</button>
            </form>
        <?php else: ?>
            <h3>Sua Avaliação:</h3>
            <p><strong>Resultado:</strong> <?php echo $reclamacao['aprovacao'] == 1 ? 'Aprovada' : 'Reprovada'; ?></p>
            <p><strong>Comentário:</strong> <?php echo nl2br(htmlspecialchars($reclamacao['comentario'])); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <p><a href="index.php">Voltar para Minhas Reclamações</a></p>
</body>
</html>