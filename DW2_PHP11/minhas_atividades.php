<?php
include 'auth_check.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Atividades</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <h1>Atividades que Criei</h1>
    <p>Veja os comentários nas atividades que você iniciou.</p>
     
    <?php
    $sql = "SELECT id, titulo, comentario, data_criacao 
            FROM atividades
            WHERE usuario_id = ?
            ORDER BY data_criacao DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_logado_id);
    $stmt->execute();
    $atividades = $stmt->get_result();

    if ($atividades->num_rows > 0) {
        while ($at = $atividades->fetch_assoc()) {
            echo "<div style='border: 2px solid #000; padding: 15px; margin-bottom: 20px;'>";
            echo "<h2>" . htmlspecialchars($at['titulo']) . "</h2>";
            echo "<p><strong>Sua descrição:</strong> " . nl2br(htmlspecialchars($at['comentario'])) . "</p>";
            echo "<small>Criado em: " . date('d/m/Y', strtotime($at['data_criacao'])) . "</small>";
            echo "<hr>";
            
            echo "<h3>Respostas Recebidas:</h3>";
            
            $atividade_id = $at['id'];
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
                    echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; margin-left: 20px;'>";
                    echo "<p><strong>Participante:</strong> " . htmlspecialchars($p['usuario']) . "</p>";
                    echo "<p>" . nl2br(htmlspecialchars($p['comentario'])) . "</p>";
                    echo "<small>Em: " . date('d/m/Y H:i', strtotime($p['data_participacao'])) . "</small>";
                    echo "</div>";
                }
            } else {
                echo "<p style='margin-left: 20px;'>Nenhuma resposta ainda.</p>";
            }
            $stmt_p->close();
            
            echo "</div>"; 
        }
    } else {
        echo '<p>Você ainda não criou nenhuma atividade.</p>';
    }
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>