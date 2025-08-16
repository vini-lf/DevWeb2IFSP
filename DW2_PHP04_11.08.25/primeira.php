<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>

    <div style="padding: 10px; border-bottom: 1px solid #ccc;">
        <?php
        include 'nav.php'; 
        if (isset($_SESSION['nome'])) {
            echo 'Olá, ' . $_SESSION['nome'] . ' | <a href="encerrar.php">Sair</a>';
        } else {
            echo '<a href="primeira.php"></a>';
        }
        ?>
    </div>
    <hr>

    <h1>receber o nome</h1>
    
    <form action="salvar.php" method="POST">
        <label for="nome">Digite seu nome:</label>
        <br>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <button type="submit">Salvar Nome na Sessão</button>
    </form>

</body>
</html>