<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recebe texto</title>
</head>
<body>
    <?php
    if( isset($_GET['texto']) ) {
        echo "Texto recebido!";
        if( $_GET['texto'] != '' ) {
            session_start();
            $_SESSION['txt'] = $_GET['texto'];
            echo "Texto salvo na sessão!";
        } else {
            echo "Texto vazio, preencha o formulário!";
        }
    } else {
        echo "Envie o texto!";
    }
    ?>
</body>
</html>