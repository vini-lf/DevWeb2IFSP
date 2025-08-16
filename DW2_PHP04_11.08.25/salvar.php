<?php
session_start();

if (isset($_POST['nome'])) {
    $_SESSION['nome'] = $_POST['nome'];
}
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
    
    <h1>Nome salvo!</h1>
    <p>A informação foi guardada.</p>
    <a href="mostrar.php">Clique aqui para ver o nome salvo</a>
    <br>
    <a href="encerrar.php">Clique aqui para encerrar a sessão</a>

</body>
</html>