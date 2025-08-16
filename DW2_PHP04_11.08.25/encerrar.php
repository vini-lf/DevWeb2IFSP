<?php
session_start();
include 'nav.php';

$_SESSION = array();

session_destroy();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
</head>
<body>

    <div style="padding: 10px; border-bottom: 1px solid #ccc;">
        <a href="primeira.php">Entrar</a>
    </div>
    <hr>

    <h1>Sessão encerrada</h1>
    <p>Todos os dados da sessão foram removidos</p>
    <a href="primeira.php">Voltar</a>

</body>
</html>