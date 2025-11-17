<?php
include 'auth_check.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Submissões - Clube de Escrita</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <h1>Submissões da Comunidade</h1>
    <p>Veja os textos enviados por outros membros e avalie.</p>
 
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT s.id, s.titulo, s.data_submissao, u.usuario 
                    FROM submissoes s
                    JOIN usuarios u ON s.usuario_id = u.id
                    WHERE s.usuario_id != ?
                    ORDER BY s.data_submissao DESC";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $usuario_logado_id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                while ($sub = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($sub['titulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($sub['usuario']) . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($sub['data_submissao'])) . "</td>";
                    echo '<td><a href="avalia_submissao.php?id=' . $sub['id'] . '">Avaliar</a></td>';
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="4">Nenhuma submissão de outros usuários encontrada.</td></tr>';
            }
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>