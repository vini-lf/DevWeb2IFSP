<?php
include 'auth_check.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividades - Clube de Escrita</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <h1>Atividades da Comunidade</h1>
    <p>Participe das discussões e exercícios.</p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Título da Atividade</th>
                <th>Criador</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT a.id, a.titulo, a.data_criacao, u.usuario 
                    FROM atividades a
                    JOIN usuarios u ON a.usuario_id = u.id
                    ORDER BY a.data_criacao DESC";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                while ($at = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($at['titulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($at['usuario']) . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($at['data_criacao'])) . "</td>";
                    echo '<td><a href="participa_atividade.php?id=' . $at['id'] . '">Participar</a></td>';
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="4">Nenhuma atividade criada ainda.</td></tr>';
            }
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table> 
</body>
</html>