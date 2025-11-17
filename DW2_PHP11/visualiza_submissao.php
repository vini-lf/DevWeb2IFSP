<?php
include 'auth_check.php';
include 'db.php';

$submissao_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql_sub = "SELECT * FROM submissoes WHERE id = ? AND usuario_id = ?";
$stmt_sub = $conn->prepare($sql_sub);
$stmt_sub->bind_param("ii", $submissao_id, $usuario_logado_id);
$stmt_sub->execute();
$submissao = $stmt_sub->get_result()->fetch_assoc();
 
if (!$submissao) {
    header("Location: minhas_submissoes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes: <?php echo htmlspecialchars($submissao['titulo']); ?></title>
</head>
<body>
    <?php include 'menu.php'; ?>

    <h1>Detalhes da Submissão</h1>
    
    <h3>Título: <?php echo htmlspecialchars($submissao['titulo']); ?></h3>
    <p><strong>Observações:</strong> <?php echo nl2br(htmlspecialchars($submissao['observacoes'])); ?></p>
    
    <?php
    $nome_download = htmlspecialchars($submissao['arquivo_original']);
    ?>
    <p>
        <strong>Arquivo:</strong> 
        <a href="uploads/<?php echo htmlspecialchars($submissao['arquivo']); ?>" download="<?php echo $nome_download; ?>">
            Baixar (<?php echo $nome_download; ?>)
        </a>
    </p>
    <?php ?>

    <hr>
    
    <h2>Avaliações Recebidas</h2>
    <?php
    $sql_av = "SELECT a.*, u.usuario 
               FROM avaliacoes a 
               JOIN usuarios u ON a.usuario_id = u.id 
               WHERE a.submissao_id = ? 
               ORDER BY a.data_avaliacao DESC";
    $stmt_av = $conn->prepare($sql_av);
    $stmt_av->bind_param("i", $submissao_id);
    $stmt_av->execute();
    $avaliacoes = $stmt_av->get_result();

    if ($avaliacoes->num_rows > 0) {
        while ($av = $avaliacoes->fetch_assoc()) {
            $status = $av['aprovado'] ? 'Aprovado' : 'Reprovado';
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
            echo "<p><strong>Avaliador:</strong> " . htmlspecialchars($av['usuario']) . "</p>";
            echo "<p><strong>Status:</strong> " . $status . "</p>";
            echo "<p><strong>Comentário:</strong> " . nl2br(htmlspecialchars($av['comentario'])) . "</p>";
            echo "<small>Em: " . date('d/m/Y H:i', strtotime($av['data_avaliacao'])) . "</small>";
            echo "</div>";
        }
    } else {
        echo "<p>Seu texto ainda não recebeu avaliações.</p>";
    }
    
    $stmt_sub->close();
    $stmt_av->close();
    $conn->close();
    ?>
    
</body>
</html>