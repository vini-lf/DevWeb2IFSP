<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Nota</title>
</head>
<body>
    <h2>Cadastrar Nota</h2>
    <form action="salva.php" method="post">
        Nome: <input type="text" name="nome" required><br><br>
        Nota: <input type="number" name="nota" step="0.01" required><br><br>
        <input type="submit" value="Salvar">
    </form>

    <br>
    <a href="mostra.php">Ver lista de alunos</a>
</body>
</html>