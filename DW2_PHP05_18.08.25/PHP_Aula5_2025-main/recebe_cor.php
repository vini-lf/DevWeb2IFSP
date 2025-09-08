<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salva cor em SESSION</title>
</head>
<body>
    <?php
    if(isset($_GET['cor'])) {
        session_start();

        $_SESSION['cor'] = $_GET['cor'];
        echo "Cor salva na sessão!";
    }
    ?>
</body>
</html>