<?php
include 'auth_check.php';
include 'db.php';

$atividade_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($atividade_id <= 0) {
    header("Location: atividades.php");
    exit;
}

$sql_at = "SELECT a.*, u.usuario 
           FROM atividades a 
           JOIN usuarios u ON a.usuario_id = u.id 
           WHERE a.id = ?";
$stmt_at = $conn->prepare($sql_at); 
$stmt_at->bind_param("i", $atividade_id);
$stmt_at->execute();
$atividade = $stmt_at->get_result()->fetch_assoc();

if (!$atividade) {
    echo "Atividade não encontrada.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividade: <?php echo htmlspecialchars($atividade['titulo']); ?></title>
</head>
<body>
    <?php include 'menu.php'; ?>

    <h1><?php echo htmlspecialchars($atividade['titulo']); ?></h1>
    <p><strong>Criado por:</strong> <?php echo htmlspecialchars($atividade['usuario']); ?></p>
    <p><strong>Descrição:</strong></p>
    <div style="border: 1px solid #eee; padding: 15px; background: #f9f9f9;">
        <?php echo nl2br(htmlspecialchars($atividade['comentario'])); ?>
    </div>
    
    <hr>
    
    <h2>Responder / Participar</h2>
    <form action="salva_participacao.php" method="POST">
        <input type="hidden" name="atividade_id" value="<?php echo $atividade_id; ?>">
        <p>
            <label for="comentario">Sua Resposta:</label><br>
            <textarea id="comentario" name="comentario" rows="5" cols="50" required></textarea>
        </p>
        <button type="submit">Enviar Resposta</button>
    </form>

    <hr>
    
    <h2>Participações</h2>
    <?php
    $sql_p = "SELECT p.*, u.usuario 
              FROM participacoes p 
              JOIN usuarios u ON p.usuario_id = u.id 
              WHERE p.atividade_id = ? 
              ORDER BY p.data_participacao ASC";
    $stmt_p = $conn->prepare($sql_p);
    $stmt_p->bind_param("i", $atividade_id);
    $stmt_p->execute();
    $participacoes = $stmt_p->get_result();

    if ($participacoes->num_rows > 0) {
        while ($p = $participacoes->fetch_assoc()) {
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
            echo "<p><strong>Participante:</strong> " . htmlspecialchars($p['usuario']) . "</p>";
            echo "<p>" . nl2br(htmlspecialchars($p['comentario'])) . "</p>";
            echo "<small>Em: " . date('d/m/Y H:i', strtotime($p['data_participacao'])) . "</small>";
            echo "</div>";
        }
    } else {
        echo "<p>Ninguém participou desta atividade ainda.</p>";
    }
    
    $stmt_at->close();
    $stmt_p->close();
    $conn->close();
    ?>
    
</body>
</html>