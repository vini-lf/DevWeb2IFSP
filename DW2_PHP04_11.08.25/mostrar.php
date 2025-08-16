<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Nome</title>
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

    <h1>Nome salvo</h1>
    
    <p>
        <strong>
            <?php
            if (isset($_SESSION['nome'])) {
                echo $_SESSION['nome'];
            } else {
                echo "Nenhum nome foi encontrado na sessão.";
            }
            ?>
        </strong>
    </p>

    <a href="primeira.php">Voltar</a>

</body>
</html>