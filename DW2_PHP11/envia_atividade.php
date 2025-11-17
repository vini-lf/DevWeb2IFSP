<?php
include 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Atividade</title>
</head>
<body>
    <?php include 'menu.php'; ?>
     
    <h1>Criar Nova Atividade</h1>
    <p>Inicie uma discussão, um exercício criativo, etc.</p>

    <form action="salva_atividade.php" method="POST">
        <p>
            <label for="titulo">Título da Atividade:</label>
            <input type="text" id="titulo" name="titulo" required style="width: 300px;">
        </p>
        <p>
            <label for="comentario">Comentário / Descrição:</label><br>
            <textarea id="comentario" name="comentario" rows="8" cols="50" required></textarea>
        </p>
        <button type="submit">Publicar Atividade</button>
    </form>

</body>
</html>