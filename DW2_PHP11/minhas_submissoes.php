<?php
include 'auth_check.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Submissões</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <h1>Minhas Submissões</h1>
    <p>Veja o status e as avaliações dos textos que você enviou.</p>
     
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Título</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT id, titulo, data_submissao 
                    FROM submissoes
                    WHERE usuario_id = ?
                    ORDER BY data_submissao DESC";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $usuario_logado_id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                while ($sub = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($sub['titulo']) . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($sub['data_submissao'])) . "</td>";
                    echo '<td><a href="visualiza_submissao.php?id=' . $sub['id'] . '">Ver Detalhes</a></td>';
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="3">Você ainda não enviou nenhuma submissão.</td></tr>';
            }
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>